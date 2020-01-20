<?php

namespace App\Http\Controllers\Page;

use Laravel\Lumen\Routing\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
use GuzzleHttp\Client;
use App\Model\Article;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function categoryPage($request)
    {
        $headline = Article::where('headline', '=', 1)
                  ->get();

        $article_page =  Article::where('is_page', '=', 1)
                        ->get();

        $article_pay = Article::where('category_id', '=', $request->input('category_id'))
                  ->where('is_pay', '=', 1)
                  ->orderBy('position', 'asc')
                  ->get();

        if ($headline || $article_pay || $article_page) {
            return response()->json(
                array(
                    'status' => 200,
                    'data' => array(
                        'headline' => array(
                            'img' => $headline->image,
                            'title' => $headline->title
                        ),

                        'article_pay' =>array(
                            'title' => $article_pay->title,
                            'img' => $article_pay->img,
                            'content' => $article_pay->content
                        ),

                        'article_pay' =>array(
                            'title' => $article_page->title,
                            'img' => $article_page->img,
                            'content' => $article_page->content
                        )
                    ),
                    'message' => 'Success get page.'
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
