<?php

namespace App\Http\Controllers\Admin;

use Laravel\Lumen\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
use GuzzleHttp\Client;
use App\Model\Admin;
use App\Model\Klien;
use App\Model\Roles;
use App\Model\Countries;
use App\Model\Location;
use App\Model\Region;
use App\Model\Contract;
use App\Helpers\Ip;
use App\AccessToken;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function Roles()
    {
        $roles = Roles::orderBy('id', 'asc')
                   ->get();

        if ($roles) {
            return response()->json(
                 array(
                     'status' => 200,
                     'data' => $roles,
                     'message' => 'Success to activation user.'
                 )
             );
        } else {
            return response()->json(array(
                'status' => 400,
                'message' => 'The requested object was not found.'
            ));
        }
    }

    public function registerAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'email'       => 'required|email|max:255|unique:users',
            'password'    => 'required|min:6',
            'name'        => 'required|string|max:20',
            'phone_num'   => 'required',
            'roles'       => 'required'
        ));


        if ($validator->fails()) {
            return response()->json(array(
                'code' => 400,
                'type' => 'failed',
                'status' => 'FAILED',
                'message' => $validator->messages()
            ), 400);
        }


        $hasher = app()->make('hash');

        $register_admin = Admin::create(array(
            'email'            => $request->input('email'),
            'password'         => $hasher->make($request->input('password')),
            'name'             => $request->input('name'),
            'roles'             => $request->input('roles'),
            'phone_num'        => $request->input('phone_num'),
            'ip_addr'          => Ip::get(),
        ));

        if ($register_admin) {
            return response()->json(array(
                'status' => 200,
                'data' => $register_admin,
                'message' => 'Success to create user.'
            ));
        } else {
            return response()->json(array(
                'status' => 400,
                'message' => 'The requested object was not found.'
            ));
        }
    }

    public function loginAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'email' => 'required|email',
            'password' => 'required',
        ));

        if ($validator->fails()) {
            return response()->json(array(
                'status' => 400,
                'message' => 'failed',
                'data' => $validator->messages()
            ), 400);
        }

        $admin = Admin::where('email', $request->input('email'))->first();


        // User exists
        if ($admin && $admin->active == 1 && Hash::check($request->input('password'), $admin->password)) {
            // Creating user access token
            $token = new AccessToken($admin);
            $token->storeAccessToken()->storeRefreshToken();

            // Attach tokens to user data
            $admin->access_token = $token->getAccessToken();
            $admin->refresh_token = $token->getRefreshToken();

            return response()->json(array(
                'status' => 200,
                'message' => 'success',
                'data' => array(
                    'admin_id' => $admin->id,
                    'name'=> $admin->name,
                    'access_token' => $token->getAccessToken(),
                    'refresh_token' =>  $token->getRefreshToken()
                )
            ), 200);
        }

        // User's password is incorrect
        if ($admin) {
            $message = array('password' => array("The password you entered doesn't match."));

        // User doesn't exists
        } else {
            $message = array('email' => array("Sorry, We doesn't recognize that email."));
        }

        return response()->json(array(
            'status' => 400,
            'message' => 'failed',
        ));
    }

    public function getProfileAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'access_token' => 'required',

        ));

        if ($validator->fails()) {
            return response()->json(array(
                'code' => 200,
                'type' => 'failed',
                'status' => 'VALIDATION',
                'message' => $validator->messages()
            ), 200);
        }

        // User exists
        if ($user && $user->active == 1 && Hash::check($request->input('password'), $user->password)) {
            // Creating user access token
            $token = new AccessToken($user);
        }
    }

    public function registerClient(Request $request)
    {
        $register_client = Klien::create(array(
            'email'            => $request->input('email'),
            'name'             => $request->input('name'),
            'address'          => $request->input('address'),
            'phone_number'     => $request->input('phone_number'),
            'country_id'       => $request->input('country_id'),
            'location_id'      => $request->input('location_id'),

        ));

        if ($register_client) {
            return response()->json(array(
                'status' => 200,
                'data' => $register_client,
                'message' => 'Success to create user.'
            ));
        } else {
            return response()->json(array(
                'status' => 400,
                'message' => 'The requested object was not found.'
            ));
        }
    }

    public function getAllAdmin(Request $request)
    {
        $get_all_admin = Admin::where('active', '>=', 0)
                        ->take(20)
                        ->get();

        foreach ($get_all_admin as $index => $key) {
            $roles = Roles::where('id', $key->roles)
                            ->get();

            $get_all_admin[$index]['roles'] = $roles;
        }

        if ($get_all_admin) {
            return response()->json(array(
                'status' => 200,
                'data' => $get_all_admin,
                'message' => 'Success to get all admin.'
            ));
        } else {
            return response()->json(array(
                'status' => 400,
                'message' => 'The requested object was not found.'
            ));
        }
    }

    public function getAllClient(Request $request)
    {
        $get_all_client = Klien::where('active', '>=', 0)
                        ->take(10)
                        ->get();

        foreach ($get_all_client as $index => $key) {
            $contract = Contract::where('id', $key->contract_id)
                                    ->get();

            $get_all_client[$index]['contract'] = $contract;
        }

        foreach ($get_all_client as $index => $key) {
            $country = Countries::where('id', $key->country_id)
                ->get();

            $get_all_client[$index]['country'] = $country;
        }

        foreach ($get_all_client as $index => $key) {
            $location = Location::where('id', $key->location_id)
                  ->get();

            $get_all_client[$index]['location'] = $location;
        }

        foreach ($get_all_client as $index => $key) {
            $region = Region::where('id', $key->location_id)
                    ->get();

            $get_all_client[$index]['region'] = $region;
        }


        if ($get_all_client) {
            return response()->json(array(
                'status' => 200,
                'data' => $get_all_client,
                'message' => 'Success to get all client.'
            ));
        } else {
            return response()->json(array(
                'status' => 400,
                'message' => 'The requested object was not found.'
            ));
        }
    }

    public function getAuthor(Request $request)
    {
        $get_author = Admin::where('roles', 2)
                        ->take(20)
                        ->get();

        if ($get_author) {
            return response()->json(array(
                'status' => 200,
                'data' => $get_author,
                'message' => 'Success to get all admin.'
            ));
        } else {
            return response()->json(array(
                'status' => 400,
                'message' => 'The requested object was not found.'
            ));
        }
    }
}
