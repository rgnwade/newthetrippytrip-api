<?php

namespace App\Http\Controllers\Article;

use Laravel\Lumen\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
use GuzzleHttp\Client;
use App\Model\Category;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function getParentCategory()
    {
        $category = Category::where('parent_id', '=', 0)
                  ->orderBy('id', 'asc')
                  ->get();

        if ($category) {
            return response()->json(
                array(
                    'status' => 200,
                    'data' => $category,
                    'message' => 'Success to get category.'
                )
            );
        } else {
            return response()->json(array(
                'status' => 400,
                'message' => 'The requested object was not found.'
            ));
        }
    }

    public function getChildCategory(Request $request)
    {
        $category_child = Category::where('parent_id', $request->input('parent_id'))
                        ->get();

        if ($category_child) {
            return response()->json(
                array(
                    'status' => 200,
                    'data' => $category_child,
                    'message' => 'Success to get category.'
                )
            );
        } else {
            return response()->json(array(
                'status' => 400,
                'message' => 'The requested object was not found.'
            ));
        }
    }

    public function getAllCategory(Request $request)
    {
        $all_category = Category::get();

        if ($all_category) {
            return response()->json(
                array(
                    'status' => 200,
                    'data' => $all_category,
                    'message' => 'Success to get category.'
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
