<?php

namespace App\Http\Controllers\Article;

use Laravel\Lumen\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
use GuzzleHttp\Client;
use App\Model\Article;
use App\Model\Category;
use App\Model\Admin;
use App\Model\Klien;
use App\Model\Region;
use App\Model\Contract;
use App\Model\Media;
use DateTime;

class ArticleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function postArticle(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'thumbnail_pict' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ));

        if ($validator->fails()) {
            return response()->json(array(
                'code' => 400,
                'type' => 'failed',
                'status' => 'FAILED',
                'message' => $validator->messages()
            ), 400);
        }

        if ($request->file('thumbnail_pict')) {
            $file = $request->file('thumbnail_pict')->getClientOriginalName();
            $date = new DateTime();
            $d = env('API_IMAGE').$file;
            $destinationPath ="thumbnail_images/";
            $request->file('thumbnail_pict')->move($destinationPath, $d);
        } else {
            $d = '';
        }

        $post_article = Article::create(array(
            'parent_category_id'=> $request->input('parent_category_id'),
            'category_id'       => $request->input('category_id'),
            'author_id'         => $request->input('author_id'),
            'client_id'         => $request->input('client_id'),
            'location_id'       => $request->input('location_id'),
            'title'             => $request->input('title'),
            'content'           => $request->input('content'),
            'thumbnail_pict'    => $d,
            'video'             => $request->input('video'),
            'active'             => $request->input('active'),
            'is_page'           => $request->input('is_page'),
            'is_homepage'       => $request->input('is_homepage'),
            'description'       => $request->input('description'),
        ));

        if ($post_article) {
            return response()->json(array(
                'code' => 200,
                'type' => 'success',
                'status' => 'SUCCESS',
                'data' => $post_article,
                'message' => 'Success to post article.'
            ), 200);
        } else {
            return response()->json(array(
                'code' => 404,
                'type' => 'not_found',
                'status' => 'FAILED',
                'message' => 'The requested object was not found.'
            ), 404);
        }
    }

    public function postMedia(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'link' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ));

        if ($validator->fails()) {
            return response()->json(array(
                'code' => 400,
                'type' => 'failed',
                'status' => 'FAILED',
                'message' => $validator->messages()
            ), 400);
        }

        if ($request->file('link')) {
            $file = $request->file('link')->getClientOriginalName();
            $d = env('API_IMAGE').$file;
            $destinationPath ="thumbnail_images/media";
            $request->file('link')->move($destinationPath, $d);
        } else {
            $d = '';
        }

        $post_media= Media::create(array(
            'name'    => $request->input('name'),
            'link'    => $d,
        ));

        if ($post_media) {
            return response()->json(array(
                'code' => 200,
                'type' => 'success',
                'status' => 'SUCCESS',
                'data' => $post_media,
                'message' => 'Success to post media.'
            ), 200);
        } else {
            return response()->json(array(
                'code' => 404,
                'type' => 'not_found',
                'status' => 'FAILED',
                'message' => 'The requested object was not found.'
            ), 404);
        }
    }

    public function getMedia()
    {
        $get_media = Media::take(10)
                      ->get();

        if ($get_media) {
            return response()->json(array(
                'code' => 200,
                'type' => 'success',
                'status' => 'SUCCESS',
                'data' => $get_media,
                'message' => 'Success to get Media.'
            ), 200);
        } else {
            return response()->json(array(
                'code' => 404,
                'type' => 'not_found',
                'status' => 'FAILED',
                'message' => 'The requested object was not found.'
            ), 404);
        }
    }

    public function updateArticle($id, Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'thumbnail_pict' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ));

        if ($validator->fails()) {
            return response()->json(array(
                'code' => 400,
                'type' => 'failed',
                'status' => 'FAILED',
                'message' => $validator->messages()
            ), 400);
        }

        if ($request->file('thumbnail_pict')) {
            $file = $request->file('thumbnail_pict')->getClientOriginalName();
            $date = new DateTime();
            $d = env('API_IMAGE').$file;
            $destinationPath ="thumbnail_images/";
            $request->file('thumbnail_pict')->move($destinationPath, $d);
        } else {
            $d = '';
        }
        $update_article = Article::findOrFail($id);

        $update_article->category_id    = $request->input('category_id');
        $update_article->author_id      = $request->input('author_id');
        $update_article->client_id      = $request->input('client_id');
        $update_article->location_id    = $request->input('location_id');
        $update_article->title          =  $request->input('title');
        $update_article->content        =  $request->input('content');
        $update_article->thumbnail_pict = $d;
        $update_article->video          =  $request->input('video');
        $update_article->is_page        =  $request->input('is_page');
        $update_article->is_homepage    =  $request->input('is_homepage');
        $update_article->description    = $request->input('description');

        // dd($update_article);

        if ($update_article) {
            return response()->json(array(
                'code' => 200,
                'type' => 'success',
                'status' => 'SUCCESS',
                'data' => $update_article,
                'message' => 'Success to post article.'
            ), 200);
        } else {
            return response()->json(array(
                'code' => 404,
                'type' => 'not_found',
                'status' => 'FAILED',
                'message' => 'The requested object was not found.'
            ), 404);
        }
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();

        if ($article) {
            return response()->json(array(
                'code' => 200,
                'type' => 'success',
                'status' => 'SUCCESS',
                'message' => 'Success to delete article.'
            ), 200);
        } else {
            return response()->json(array(
                'code' => 404,
                'type' => 'not_found',
                'status' => 'FAILED',
                'message' => 'The requested object was not found.'
            ), 404);
        }
    }

    public function getArticle(Request $request)
    {
        $get_article = Article::where('category_id', $request->input('category_id'))
                ->take(10)
                ->get();

        foreach ($get_article as $index => $key) {
            $category = Category::where('id', $key->category_id)
                                            ->get();

            $get_article[$index]['category'] = $category;
        }

        foreach ($get_article as $index => $key) {
            $author = Admin::where('id', $key->author_id)
                                            ->get();

            $get_article[$index]['author'] = $author;
        }

        foreach ($get_article as $index => $key) {
            $klien = Klien::where('id', $key->client_id)
                                            ->get();

            $get_article[$index]['klien'] = $klien;
        }

        if ($get_article) {
            return response()->json(array(
                'code' => 200,
                'type' => 'success',
                'status' => 'SUCCESS',
                'data' => $get_article,
                'message' => 'Success to get Article.'
            ), 200);
        } else {
            return response()->json(array(
                'code' => 404,
                'type' => 'not_found',
                'status' => 'FAILED',
                'message' => 'The requested object was not found.'
            ), 404);
        }
    }

    public function getArticleHomepage(Request $request)
    {
        $get_article = Article::where('category_id', $request->input('category_id'))
                ->where('is_homepage', 1)
                ->orderby('id', 'desc')
                ->get();

        foreach ($get_article as $index => $key) {
            $category = Category::where('id', $key->category_id)
                                            ->get();

            $get_article[$index]['category'] = $category;
        }

        foreach ($get_article as $index => $key) {
            $author = Admin::where('id', $key->author_id)
                                            ->get();

            $get_article[$index]['author'] = $author;
        }

        foreach ($get_article as $index => $key) {
            $klien = Klien::where('id', $key->client_id)
                                            ->get();

            $get_article[$index]['klien'] = $klien;
        }

        if ($get_article) {
            return response()->json(array(
                'code' => 200,
                'type' => 'success',
                'status' => 'SUCCESS',
                'data' => $get_article,
                'message' => 'Success to get Article Homepage.'
            ), 200);
        } else {
            return response()->json(array(
                'code' => 404,
                'type' => 'not_found',
                'status' => 'FAILED',
                'message' => 'The requested object was not found.'
            ), 404);
        }
    }

    public function getArticlePage(Request $request)
    {
        $get_article = Article::where('parent_category_id', $request->input('parent_category_id'))
                ->where('is_page', 1)
                ->take(4)
                ->orderby('id', 'desc')
                ->get();

        foreach ($get_article as $index => $key) {
            $category = Category::where('id', $key->category_id)
                                            ->get();

            $get_article[$index]['category'] = $category;
        }

        foreach ($get_article as $index => $key) {
            $author = Admin::where('id', $key->author_id)
                                            ->get();

            $get_article[$index]['author'] = $author;
        }

        foreach ($get_article as $index => $key) {
            $klien = Klien::where('id', $key->client_id)
                                            ->get();

            $get_article[$index]['klien'] = $klien;
        }

        if ($get_article) {
            return response()->json(array(
                'code' => 200,
                'type' => 'success',
                'status' => 'SUCCESS',
                'data' => $get_article,
                'message' => 'Success to get Article Page.'
            ), 200);
        } else {
            return response()->json(array(
                'code' => 404,
                'type' => 'not_found',
                'status' => 'FAILED',
                'message' => 'The requested object was not found.'
            ), 404);
        }
    }

    public function addContract(Request $request)
    {
        $add_contract= Contract::create(array(
            'contract_number'       => $request->input('contract_number'),
            'client_id'              => $request->input('client_id'),
            'sales_id'              => $request->input('sales_id'),
            'files'                 => $request->input('files'),
            'expired'               => $request->input('expired'),
        ));

        if ($add_contract) {
            return response()->json(array(
                'code' => 200,
                'type' => 'success',
                'status' => 'SUCCESS',
                'data' => $add_contract,
                'message' => 'Success to create contract.'
            ), 200);
        } else {
            return response()->json(array(
                'code' => 404,
                'type' => 'not_found',
                'status' => 'FAILED',
                'message' => 'The requested object was not found.'
            ), 404);
        }
    }

    public function getContract()
    {
        $get_contract = Contract::where('active', 1)
                      ->take(10)
                      ->get();

        foreach ($get_contract as $index => $key) {
            $client = Klien::where('id', $key->client_id)
                                            ->get();

            $get_contract[$index]['client'] = $client;
        }

        foreach ($get_contract as $index => $key) {
            $author = Admin::where('id', $key->sales_id)
                                            ->get();

            $get_contract[$index]['author'] = $author;
        }

        if ($get_contract) {
            return response()->json(array(
                'code' => 200,
                'type' => 'success',
                'status' => 'SUCCESS',
                'data' => $get_contract,
                'message' => 'Success to get Article.'
            ), 200);
        } else {
            return response()->json(array(
                'code' => 404,
                'type' => 'not_found',
                'status' => 'FAILED',
                'message' => 'The requested object was not found.'
            ), 404);
        }
    }

    public function getArticleById($id)
    {
        $get_articlebyid = Article::where('id', $id)
                ->get();

        // dd($get_articlebyid);

        foreach ($get_articlebyid as $index => $key) {
            $region = Region::where('id', $key->region_id)
                                            ->get();

            $get_articlebyid[$index]['region'] = $region;
        }

        foreach ($get_articlebyid as $index => $key) {
            $category = Category::where('id', $key->category_id)
                                            ->get();

            $get_articlebyid[$index]['category'] = $category;
        }

        foreach ($get_articlebyid as $index => $key) {
            $parent_category = Category::where('id', $key->parent_category_id)
                              ->get();

            $get_articlebyid[$index]['parent_category'] = $parent_category;
        }


        foreach ($get_articlebyid as $index => $key) {
            $author = Admin::where('id', $key->author_id)
                                            ->get();

            $get_articlebyid[$index]['author'] = $author;
        }

        foreach ($get_articlebyid as $index => $key) {
            $klien = Klien::where('id', $key->client_id)
                                            ->get();

            $get_articlebyid[$index]['klien'] = $klien;
        }

        if ($get_articlebyid) {
            $visitor=Article::where('id', $id)->first();
            $visitor->total_visitors =  $visitor->total_visitors +1 ;
            $visitor->save();

            return response()->json(array(
                'code' => 200,
                'type' => 'success',
                'status' => 'SUCCESS',
                'data' => $get_articlebyid,
                'message' => 'Success to get Article By Id.'
            ), 200);
        } else {
            return response()->json(array(
                'code' => 404,
                'type' => 'not_found',
                'status' => 'FAILED',
                'message' => 'The requested object was not found.'
            ), 404);
        }
    }
}
