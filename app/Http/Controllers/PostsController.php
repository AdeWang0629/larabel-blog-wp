<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Posts;
use App\Models\PostImages;
use App\Models\WpUsers;

class PostsController extends Controller
{
    public function index(){
        if (Session::has('user_email')) {
            $posts = Posts::orderBy('updated_at', 'desc')->with('images')->get();
            return view('posts.index', compact('posts'));
        }else {
            dd('---------------------------------------');
        }
    }

    public function index_modify(Request $request){
        if (Session::has('user_email')) {   
            $result = Posts::find($request['postid'])->with('images')->get();
            $post = $result[0];
            $result = WpUsers::where('user_email', Session::get('user_email'))->get();
            $user_login = $result[0]['user_login'];
            $modify_status = ($post['userEmail'] == Session::get('user_email'));
            return view('posts.index_modify', compact('post', 'user_login', 'modify_status'));
        }else {
            dd('---------------------------------------');
        }
    }

    public function new_modify(Request $request){
        if (Session::has('user_email')) {
            $posts = Posts::find($request->input('id'));
            $posts->brandName = $request->input('brand-name');
            $posts->countryOrigin = $request->input('country-origin');
            $posts->maker = $request->input('maker');
            $posts->storePurchase = $request->input('store-purchase');
            $posts->note = $request->input('note');
            $posts->userEmail = Session::get('user_email');
            $posts->save();

            // if ($request->hasFile('upload-file1')) {
            //     $file1 = $request->file('upload-file1');
            //     $filename = 'first.' . time() . '.' . $file1->getClientOriginalExtension();
            //     $file1->storeAs('public/uploads', $filename);
            //     $filePath1 = 'storage/uploads/' . $filename;

            //     $postImages = new PostImages;
            //     $postImages->link = $filePath1;
            //     $postImages->postId = $posts->id;
            //     $postImages->save();
            // } else if ($request->hasFile('upload-file2')) {
            //     $file2 = $request->file('upload-file2');
            //     $filename = time() . '.second.' . $file2->getClientOriginalExtension();
            //     $file2->storeAs('public/uploads', $filename);
            //     $filePath2 = 'storage/uploads/' . $filename;

            //     $postImages = new PostImages;
            //     $postImages->link = $filePath2;
            //     $postImages->postId = $posts->id;
            //     $postImages->save();
            // } else if ($request->hasFile('upload-file3')) {
            //     $file3 = $request->file('upload-file3');
            //     $filename = time() . '.third.' . $file3->getClientOriginalExtension();
            //     $file3->storeAs('public/uploads', $filename);
            //     $filePath3 = 'storage/uploads/' . $filename;

            //     $postImages = new PostImages;
            //     $postImages->link = $filePath3;
            //     $postImages->postId = $posts->id;
            //     $postImages->save();
            // } else if ($request->hasFile('upload-file4')) {
            //     $file4 = $request->file('upload-file4');
            //     $filename = time() . '.fourth.' . $file4->getClientOriginalExtension();
            //     $file4->storeAs('public/uploads', $filename);
            //     $filePath4 = 'storage/uploads/' . $filename;

            //     $postImages = new PostImages;
            //     $postImages->link = $filePath4;
            //     $postImages->postId = $posts->id;
            //     $postImages->save();
            // } else if ($request->hasFile('upload-file5')) {
            //     $file5 = $request->file('upload-file5');
            //     $filename = time() . '.fifth.' . $file5->getClientOriginalExtension();
            //     $file5->storeAs('public/uploads', $filename);
            //     $filePath5 = 'storage/uploads/' . $filename;

            //     $postImages = new PostImages;
            //     $postImages->link = $filePath5;
            //     $postImages->postId = $posts->id;
            //     $postImages->save();
            // } else if ($request->hasFile('upload-file6')) {
            //     $file6 = $request->file('upload-file6');
            //     $filename = time() . '.sixth.' . $file6->getClientOriginalExtension();
            //     $file6->storeAs('public/uploads', $filename);
            //     $filePath6 = 'storage/uploads/' . $filename;

            //     $postImages = new PostImages;
            //     $postImages->link = $filePath6;
            //     $postImages->postId = $posts->id;
            //     $postImages->save();
            // }
            
            return redirect()->route('posts.index');
        }else {
            dd('---------------------------------------');
        }
    }

    public function create(){
        if (Session::has('user_email')) {
            $result = WpUsers::where('user_email', Session::get('user_email'))->get();
            $user_login = $result[0]['user_login'];
            return view('posts.create', compact('user_login'));
        }else {
            dd('---------------------------------------');
        }
    }

    public function sso_login(Request $request){
        $email = $request['email'];
        $password = $request['password'];
        return view('welcome', compact('email', 'password'));
    }

    public function new_create(Request $request){
        if (Session::has('user_email')) {
            $posts = new Posts;
            $posts->brandName = $request->input('brand-name');
            $posts->countryOrigin = $request->input('country-origin');
            $posts->maker = $request->input('maker');
            $posts->storePurchase = $request->input('store-purchase');
            $posts->note = $request->input('note');
            $posts->userEmail = Session::get('user_email');
            $posts->save();

            if ($request->hasFile('upload-file1')) {
                $file1 = $request->file('upload-file1');
                $filename = 'first.' . time() . '.' . $file1->getClientOriginalExtension();
                $file1->storeAs('public/uploads', $filename);
                $filePath1 = 'storage/uploads/' . $filename;

                $postImages = new PostImages;
                $postImages->link = $filePath1;
                $postImages->postId = $posts->id;
                $postImages->save();
            } else if ($request->hasFile('upload-file2')) {
                $file2 = $request->file('upload-file2');
                $filename = time() . '.second.' . $file2->getClientOriginalExtension();
                $file2->storeAs('public/uploads', $filename);
                $filePath2 = 'storage/uploads/' . $filename;

                $postImages = new PostImages;
                $postImages->link = $filePath2;
                $postImages->postId = $posts->id;
                $postImages->save();
            } else if ($request->hasFile('upload-file3')) {
                $file3 = $request->file('upload-file3');
                $filename = time() . '.third.' . $file3->getClientOriginalExtension();
                $file3->storeAs('public/uploads', $filename);
                $filePath3 = 'storage/uploads/' . $filename;

                $postImages = new PostImages;
                $postImages->link = $filePath3;
                $postImages->postId = $posts->id;
                $postImages->save();
            } else if ($request->hasFile('upload-file4')) {
                $file4 = $request->file('upload-file4');
                $filename = time() . '.fourth.' . $file4->getClientOriginalExtension();
                $file4->storeAs('public/uploads', $filename);
                $filePath4 = 'storage/uploads/' . $filename;

                $postImages = new PostImages;
                $postImages->link = $filePath4;
                $postImages->postId = $posts->id;
                $postImages->save();
            } else if ($request->hasFile('upload-file5')) {
                $file5 = $request->file('upload-file5');
                $filename = time() . '.fifth.' . $file5->getClientOriginalExtension();
                $file5->storeAs('public/uploads', $filename);
                $filePath5 = 'storage/uploads/' . $filename;

                $postImages = new PostImages;
                $postImages->link = $filePath5;
                $postImages->postId = $posts->id;
                $postImages->save();
            } else if ($request->hasFile('upload-file6')) {
                $file6 = $request->file('upload-file6');
                $filename = time() . '.sixth.' . $file6->getClientOriginalExtension();
                $file6->storeAs('public/uploads', $filename);
                $filePath6 = 'storage/uploads/' . $filename;

                $postImages = new PostImages;
                $postImages->link = $filePath6;
                $postImages->postId = $posts->id;
                $postImages->save();
            }
            
            return redirect()->route('posts.create');
        }else {
            dd('---------------------------------------');
        }
    }

    public function search(){
        if (Session::has('user_email')) {
            $search_data = [];
            $brandName = '';
            $countryOrigin = '';
            $maker = '';
            $storePurchase = '';
            $note = '';
            return view('posts.search', compact('search_data', 'brandName', 'countryOrigin', 'maker', 'storePurchase', 'note'));
        }else {
            dd('---------------------------------------');
        }
    }

    public function search_result(Request $request){
        if (Session::has('user_email')) {
            $brandName = $request->input('brand-name');
            $countryOrigin = $request->input('country-origin');
            $maker = $request->input('maker');
            $storePurchase = $request->input('store-purchase');
            $note = $request->input('note');

             // Build the query to fetch the matching posts
            $posts = Posts::query();

            // if ($categoryFirst) {
            //     $posts->where('category_first', $categoryFirst);
            // }

            // if ($categorySecond) {
            //     $posts->where('category_second', $categorySecond);
            // }

            if ($brandName) {
                $posts->where('brandName', 'like', '%' . $brandName . '%');
            }

            if ($countryOrigin) {
                $posts->where('countryOrigin', 'like', '%' . $countryOrigin . '%');
            }

            if ($maker) {
                $posts->where('maker', 'like', '%' . $maker . '%');
            }

            if ($storePurchase) {
                $posts->where('storePurchase', 'like', '%' . $storePurchase . '%');
            }

            if ($note) {
                $posts->where('note', 'like', '%' . $note . '%');
            }

            $search_data = $posts->get();

            // Pass the search results to the view
            return view('posts.search', compact('search_data', 'brandName', 'countryOrigin', 'maker', 'storePurchase', 'note'));
        }else {
            dd('---------------------------------------');
        }
    }
}