<?php

namespace App\Http\Controllers\Auth;

use Laravel\Lumen\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
use GuzzleHttp\Client;
use App\Model\User;
use App\Model\Subscribe;
use App\Helpers\Ip;
use App\AccessToken;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'email'       => 'required|email|max:255|unique:users',
            'password'    => 'required|min:6',
            'name'        => 'required|string|max:20',
            'birthdate'   => 'required|min:10|max:10',
            'gender'      => 'required|min:4|max:6'
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

        $register = User::create(array(
            'email'            => $request->input('email'),
            'password'         => $hasher->make($request->input('password')),
            'name'             => $request->input('name'),
            'birthdate'        => $request->input('birthdate'),
            'gender'           => $request->input('gender'),
            'ip_addr'          => Ip::get(),
            'activation_token' => md5(uniqid()),
        ));

        if ($register) {
            return response()->json(array(
                'status' => 200,
                'data' => $register,
                'message' => 'Success to create user.'
            ), 200);
        } else {
            return response()->json(array(
                'status' => 400,
                'message' => 'The requested object was not found.'
            ), 404);
        }

        // send verify account user
        if ($register) {
            //send an email to user's mail
            Mail::send('mail.emailVerification', array('user' => $register), function ($mail) use ($register) {
                $mail->to($register->email)
                        ->subject('Verify your account!')
                        ->from(env('MAIL_NO_REPLY'), 'Trippytrip');
            });
        }
    }

    public function activationAccount(Request $request)
    {
        $activation = User::where('activation_token', $request->input('activation_token'))->first();

        if ($activation) {
            // set user status to active
            $activation->active = 1;
            // $activation->activation_token = str_random(15) . uniqid();
            $activation->updated_at = date('Y-m-d H:i:s');
            $activation->save();

            return response()->json(
                array(
                    'status' => 200,
                    'data' => array(
                        'user_id' => $activation->id,
                        'message' => 'Success to activation user.'
                    )
                )
            );
        } else {
            return response()->json(array(
                'status' => 400,
                'message' => 'The requested object was not found.'
            ));
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'email' => 'required|email',
            'password' => 'required',
        ));

        if ($validator->fails()) {
            return response()->json(array(
                'code' => 400,
                'type' => 'failed',
                'status' => 'VALIDATION',
                'message' => $validator->messages()
            ), 400);
        }

        $user = User::where('email', $request->input('email'))->first();


        // User exists
        if ($user && $user->active == 1 && Hash::check($request->input('password'), $user->password)) {
            // Creating user access token
            $token = new AccessToken($user);
            $token->storeAccessToken()->storeRefreshToken();

            // Attach tokens to user data
            $user->access_token = $token->getAccessToken();
            $user->refresh_token = $token->getRefreshToken();


            // $token_user =  User::create(array(
            //     'access_token' => $request->input($user->access_tokrn = $token->getAccessToken()),
            //     'refresh_token' =>   $user->refresh_token = $token->getRefreshToken()
            // ));

            return response()->json(array(
                'code' => 200,
                'type' => 'success',
                'message' => 'Login Succeded.',
                'status' => 'SUCCESS',
                'data' => array(
                    'user_id' => $user->id,
                    'access_token' => $token->getAccessToken(),
                    'refresh_token' =>  $token->getRefreshToken()
                )
            ), 200);
        }

        // User exists but status is inactive
        if ($user && $user->active == 0) {
            return response()->json(array(
                'code' => 200,
                'type' => 'inactive',
                'message' => 'Please check your email to verify your account.',
                'status' => 'INACTIVE'
            ), 200);
        }

        // User's password is incorrect
        if ($user && $user->active == 1) {
            $message = array('password' => array("The password you entered doesn't match."));

        // User doesn't exists
        } else {
            $message = array('email' => array("Sorry, We doesn't recognize that email."));
        }

        return response()->json(array(
            'code' => 200,
            'type' => 'failed',
            'message' => $message,
            'status' => 'FAILED'
        ), 200);
    }

    public function getProfile(Request $request)
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

    public function getAllUser()
    {
        $get_all_user = User::where('active', '>=', 0)
                        ->take(50)
                        ->get();

        if ($get_all_user) {
            return response()->json(array(
                'status' => 200,
                'data' => $get_all_user,
                'message' => 'Success to get all user.'
            ));
        } else {
            return response()->json(array(
                'status' => 400,
                'message' => 'The requested object was not found.'
            ));
        }
    }

    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'email'  => 'required|email|max:255|unique:users',
        ));


        if ($validator->fails()) {
            return response()->json(array(
                'code' => 400,
                'type' => 'failed',
                'status' => 'FAILED',
                'message' => $validator->messages()
            ), 400);
        }

        $subscribe = Subscribe::create(array(
            'email'  => $request->input('email'),
        ));

        if ($subscribe) {
            return response()->json(array(
                'status' => 200,
                'data' => $subscribe,
                'message' => 'Success to register email subscribe.'
            ), 200);
        } else {
            return response()->json(array(
                'status' => 400,
                'message' => 'The requested object was not found.'
            ), 404);
        }

        // send verify account user
        if ($subscribe) {
            //send an email to user's mail
            Mail::send('mail.emailSubscribe', array('user' => $subscribe), function ($mail) use ($subscribe) {
                $mail->to($subscribe->email)
                      ->subject('Verify your account!')
                      ->from(env('MAIL_NO_REPLY'), 'Trippytrip');
            });
        }
    }

    public function getAllSubscribe()
    {
        $get_all_subscribe = Subscribe::where('status', '=', 1)
                        ->take(50)
                        ->get();

        if ($get_all_subscribe) {
            return response()->json(array(
                'status' => 200,
                'data' => $get_all_subscribe,
                'message' => 'Success to get all subscribe.'
            ));
        } else {
            return response()->json(array(
                'status' => 400,
                'message' => 'The requested object was not found.'
            ));
        }
    }
}
