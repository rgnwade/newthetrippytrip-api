<?php

namespace App\Http\Controllers\Location;

use Laravel\Lumen\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
use GuzzleHttp\Client;
use App\Model\Countries;
use App\Model\Location;
use App\Model\Region;

class LocationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function getCountries()
    {
        $countries = Countries::where('id', '=', 102)
                  ->get();

        if ($countries) {
            return response()->json(
                array(
                    'status' => 200,
                    'data' => $countries,
                    'message' => 'Success to get countries.'
                )
            );
        } else {
            return response()->json(array(
                'status' => 400,
                'message' => 'The requested object was not found.'
            ));
        }
    }

    public function getLocation(Request $request)
    {
        $location = Location::where('parent', $request->input('parent'))
                  ->get();

        // dd($location);

        if ($location) {
            return response()->json(
                array(
                    'status' => 200,
                    'data' => $location,
                    'message' => 'Success to get location.'
                )
            );
        } else {
            return response()->json(array(
                'status' => 400,
                'message' => 'The requested object was not found.'
            ));
        }
    }

    public function getRegion(Request $request)
    {
        $region = Region::where('location_id', $request->input('location_id'))
                  ->get();

        // dd($location);

        if ($region) {
            return response()->json(
                array(
                    'status' => 200,
                    'data' => $region,
                    'message' => 'Success to get region.'
                )
            );
        } else {
            return response()->json(array(
                'status' => 400,
                'message' => 'The requested object was not found.'
            ));
        }
    }
}
