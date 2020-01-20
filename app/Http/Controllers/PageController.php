<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
use GuzzleHttp\Client;
use App\Model\Article;
use App\Model\Category;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function homepage()
    {
        $lifestyle = Article::where('category_id', '=', 4)
                  ->where('is_homepage', '=', 1)
                  ->take(3)
                  ->orderby('id', 'desc')
                  ->get();

        $tips = Article::where('category_id', '=', 8)
                  ->where('is_homepage', '=', 1)
                  ->take(3)
                  ->orderby('id', 'desc')
                  ->get();

        if ($lifestyle) {
            return response()->json(
                array(
                    'status' => 200,
                    'data' => array(
                        'lifestyle' => $lifestyle,
                        'tips' => $tips
                    ),
                    'message' => 'Success to get page.'
                )
            );
        } else {
            return response()->json(array(
                'status' => 400,
                'message' => 'The requested object was not found.'
            ));
        }
    }

    public function food_drink()
    {
        $food_page = Article::where('category_id', '=', 2)
                  ->where('is_page', '=', 1)
                  ->take(4)
                  ->orderby('id', 'desc')
                  ->get();


        if ($food_page) {
            return response()->json(
                array(
                    'status' => 200,
                    'data' => array(
                        'food-drink' => $food_page,
                    ),
                    'message' => 'Success to get page.'
                )
            );
        } else {
            return response()->json(array(
                'status' => 400,
                'message' => 'The requested object was not found.'
            ));
        }
    }

    public function nightlife()
    {
        $nightlife_page = Article::where('category_id', '=', 3)
                  ->where('is_page', '=', 1)
                  ->take(4)
                  ->get();


        if ($nightlife_page) {
            return response()->json(
                array(
                    'status' => 200,
                    'data' => array(
                        'nightlife' => $nightlife_page,
                    ),
                    'message' => 'Success to get page.'
                )
            );
        } else {
            return response()->json(array(
                'status' => 400,
                'message' => 'The requested object was not found.'
            ));
        }
    }

    public function lifestyle()
    {
        $lifestyle_page = Article::where('category_id', '=', 4)
                  ->where('is_page', '=', 1)
                  ->take(3)
                  ->get();


        if ($lifestyle_page) {
            return response()->json(
                array(
                    'status' => 200,
                    'data' => array(
                        'lifestyle' => $lifestyle_page,
                    ),
                    'message' => 'Success to get page.'
                )
            );
        } else {
            return response()->json(array(
                'status' => 400,
                'message' => 'The requested object was not found.'
            ));
        }
    }

    public function fashion()
    {
        $fashion_page = Article::where('category_id', '=', 5)
                  ->where('is_page', '=', 1)
                  ->take(4)
                  ->get();


        if ($fashion_page) {
            return response()->json(
                array(
                    'status' => 200,
                    'data' => array(
                        'fashion' => $fashion_page,
                    ),
                    'message' => 'Success to get page.'
                )
            );
        } else {
            return response()->json(array(
                'status' => 400,
                'message' => 'The requested object was not found.'
            ));
        }
    }

    public function culture()
    {
        $culture_page = Article::where('category_id', '=', 6)
                  ->where('is_page', '=', 1)
                  ->take(6)
                  ->get();


        if ($culture_page) {
            return response()->json(
                array(
                    'status' => 200,
                    'data' => array(
                        'culture' => $culture_page,
                    ),
                    'message' => 'Success to get page.'
                )
            );
        } else {
            return response()->json(array(
                'status' => 400,
                'message' => 'The requested object was not found.'
            ));
        }
    }

    public function resource()
    {
        $resource_page = Article::where('category_id', '=', 7)
                  ->where('is_page', '=', 1)
                  ->take(4)
                  ->get();


        if ($resource_page) {
            return response()->json(
                array(
                    'status' => 200,
                    'data' => array(
                        'resource' => $resource_page,
                    ),
                    'message' => 'Success to get page.'
                )
            );
        } else {
            return response()->json(array(
                'status' => 400,
                'message' => 'The requested object was not found.'
            ));
        }
    }

    public function chill()
    {
        $chill_page_pay = Article::where('category_id', '=', 10)
                  ->where('is_page', '=', 1)
                  ->where('is_pay', '=', 1)
                  ->take(6)
                  ->get();

        $chill_page_free = Article::where('category_id', '=', 10)
                            ->where('is_page', '=', 1)
                            ->where('is_pay', '=', 0)
                            ->take(6)
                            ->get();

        $category = Category::get();


        if ($chill_page_pay && $chill_page_free && $category) {
            return response()->json(
                array(
                    'status' => 200,
                    'data' => array(
                        'chill_page_pay' => $chill_page_pay,
                        'chill_page_free' => $chill_page_free,
                        'category' => $category
                    ),
                    'message' => 'Success to get page.'
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
