<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Posts;
use App\Models\PostImages;
use App\Models\WpUsers;
use App\Models\WpBpActivity;
use App\Models\PostsLike;
use App\Models\PostsComment;
use App\Models\BigCategory;
use App\Models\SmallCategory;
use App\Models\BigSmallCategory;

use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;

class PostsController extends Controller
{
    public function index(){
        $posts = Posts::orderBy('updated_at', 'desc')
                        ->with('images', 'comments', 'likes')
                        ->get()
                        ->map(function ($post) {
                            $wpbpactivity_data = WpBpActivity::where('user_id', $post['userId'])
                                        ->where("component", 'members')
                                        ->where("type", 'new_avatar')
                                        ->where("action", "!=", '')
                                        ->where("primary_link", "!=", '')
                                        ->orderBy('date_recorded', 'desc')->first();
                            $post->timestamp = strtotime($wpbpactivity_data['date_recorded']);
                            return $post;
                        })->toArray();
        return view('posts.index', compact('posts'));
    }

    public function index_modify(Request $request){
        $result = Posts::where('id', $request['postid'])->with('images')->with('comments')->get();
        $post = $result[0];

        $second_result = WpUsers::where('user_email', Session::get('user_email'))->get();
        $modify_status;
        $like_result;
        
        if (Session::has('user_email')) {   
            $modify_status = ($post['userLogin'] == $second_result[0]['user_login']); 
            $like_result = PostsLike::where('user_email', Session::get('user_email'))->where('post_id', $post['id'])->first();
        }else {
            $modify_status = false;
            $like_result =  [];
        }

        $big_categories = BigCategory::get();
        $big_small_categories = BigSmallCategory::where('big_category', $post['categoryFirst'])->get();
        $small_categories = SmallCategory::get();

        $submissionTime = Carbon::parse($post['updated_at']);
        $currentTime = Carbon::now();

        $timeDiff = $currentTime->diffInMinutes($submissionTime);

        if ($timeDiff < 60) {
            $displayTime = $timeDiff . '分前';
        } elseif ($timeDiff < 1440) {
            $displayTime = $currentTime->diffInHours($submissionTime) . '時間前';
        } else {
            $displayTime = $currentTime->diffInDays($submissionTime) . '日前';
        }

        return view('posts.index_modify', compact('post', 'modify_status', 'like_result', 'big_categories', 'big_small_categories', 'small_categories', 'displayTime'));
    }

    public function new_modify(Request $request){
        if (Session::has('user_email')) {
            $result = WpUsers::where('user_email', Session::get('user_email'))->get();
            $posts = Posts::find($request->input('id'));
            $posts->brandName = $request->input('brand-name');
            $posts->countryOrigin = $request->input('country-origin');
            $posts->maker = $request->input('maker');
            $posts->storePurchase = $request->input('store-purchase');
            $posts->note = $request->input('note');
            $posts->userLogin =  $result[0]['user_login'];
            $posts->categoryFirst =  $request->input('big-category');
            $posts->categorySecond =  $request->input('small-category');
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
            
            return redirect()->route('posts.index');
        }else {
            $posts = Posts::orderBy('updated_at', 'desc')->with('images')->get();
            return view('posts.index', compact('posts'));
        }
    }

    public function create(){
        if (Session::has('user_email')) {
            $result = WpUsers::where('user_email', Session::get('user_email'))->get();
            $userdata = $result[0];

            $other_result = WpBpActivity::where('user_id', $result[0]['ID'])
                                        ->where("component", 'members')
                                        ->where("type", 'new_avatar')
                                        ->where("action", "!=", '')
                                        ->where("primary_link", "!=", '')
                                        ->orderBy('date_recorded', 'desc')->first();
            $timestamp = strtotime($other_result['date_recorded']);

            $big_categories = BigCategory::get();

            return view('posts.create', compact('userdata', 'timestamp', 'big_categories'));
        }else {
            $posts = Posts::orderBy('updated_at', 'desc')->with('images')->get();
            return view('posts.index', compact('posts'));
        }
    }

    public function sso_login(Request $request){
        $email = $request['email'];
        // $password = $request['password'];
        return view('welcome', compact('email'));
    }

    public function new_create(Request $request){
        if (Session::has('user_email')) {
            $validator = Validator::make($request->all(), [
                'upload-file1' => 'image|max:2048',
                'upload-file2' => 'image|max:2048',
                'upload-file3' => 'image|max:2048',
                'upload-file4' => 'image|max:2048',
                'upload-file5' => 'image|max:2048',
                'upload-file6' => 'image|max:2048',
                'big-category' => 'required',
                'small-category' => 'required',
                'brand-name' => 'required|max:255',
                'country-origin' => 'required|max:255',
                'maker' => 'required|max:255',
                'store-purchase' => 'required|max:255',
                'note' => 'required',
            ],[
                'required' => 'この項目入力は必須です。',
            ]);
            
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $result = WpUsers::where('user_email', Session::get('user_email'))->get();
            $posts = new Posts;
            $posts->brandName = $request->input('brand-name');
            $posts->countryOrigin = $request->input('country-origin');
            $posts->maker = $request->input('maker');
            $posts->storePurchase = $request->input('store-purchase');
            $posts->note = $request->input('note');
            $posts->userLogin =  $result[0]['user_login'];
            $posts->userId =  $result[0]['ID'];
            $posts->categoryFirst =  $request->input('big-category');
            $posts->categorySecond =  $request->input('small-category');
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
            } 
            if ($request->hasFile('upload-file2')) {
                $file2 = $request->file('upload-file2');
                $filename = time() . '.second.' . $file2->getClientOriginalExtension();
                $file2->storeAs('public/uploads', $filename);
                $filePath2 = 'storage/uploads/' . $filename;

                $postImages = new PostImages;
                $postImages->link = $filePath2;
                $postImages->postId = $posts->id;
                $postImages->save();
            } 
            if ($request->hasFile('upload-file3')) {
                $file3 = $request->file('upload-file3');
                $filename = time() . '.third.' . $file3->getClientOriginalExtension();
                $file3->storeAs('public/uploads', $filename);
                $filePath3 = 'storage/uploads/' . $filename;

                $postImages = new PostImages;
                $postImages->link = $filePath3;
                $postImages->postId = $posts->id;
                $postImages->save();
            } 
            if ($request->hasFile('upload-file4')) {
                $file4 = $request->file('upload-file4');
                $filename = time() . '.fourth.' . $file4->getClientOriginalExtension();
                $file4->storeAs('public/uploads', $filename);
                $filePath4 = 'storage/uploads/' . $filename;

                $postImages = new PostImages;
                $postImages->link = $filePath4;
                $postImages->postId = $posts->id;
                $postImages->save();
            } 
            if ($request->hasFile('upload-file5')) {
                $file5 = $request->file('upload-file5');
                $filename = time() . '.fifth.' . $file5->getClientOriginalExtension();
                $file5->storeAs('public/uploads', $filename);
                $filePath5 = 'storage/uploads/' . $filename;

                $postImages = new PostImages;
                $postImages->link = $filePath5;
                $postImages->postId = $posts->id;
                $postImages->save();
            } 
            if ($request->hasFile('upload-file6')) {
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
            $posts = Posts::orderBy('updated_at', 'desc')->with('images')->get();
            return view('posts.index', compact('posts'));
        }
    }

    public function search(){
        $search_data = [];
        $brandName = '';
        $countryOrigin = '';
        $maker = '';
        $storePurchase = '';
        $note = '';
        $search_status = false;
        $big_categories = BigCategory::get();
        $big_category = '';
        $small_category = '';
        return view('posts.search', compact('search_data', 'brandName', 'countryOrigin', 'maker', 'storePurchase', 'note', 'search_status', 'big_categories', 'big_category', 'small_category'));
    }

    public function search_result(Request $request){
        $brandName = $request->input('brand-name');
        $countryOrigin = $request->input('country-origin');
        $maker = $request->input('maker');
        $storePurchase = $request->input('store-purchase');
        $note = $request->input('note');
        $big_category = $request->input('big-category');
        $small_category = $request->input('small-category');

        $big_categories = BigCategory::get();
        $big_small_categories = BigSmallCategory::where('big_category', $big_category)->get();
        $small_categories = SmallCategory::get();

        // Build the query to fetch the matching posts
        $posts = Posts::query();

        if ($big_category) {
            $posts->where('categoryFirst', $big_category);
        }

        if ($small_category) {
            $posts->where('categorySecond', $small_category);
        }

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

        $search_data = $posts ->with('images', 'comments', 'likes')
                            ->get()
                            ->map(function ($post) {
                                $wpbpactivity_data = WpBpActivity::where('user_id', $post['userId'])
                                            ->where("component", 'members')
                                            ->where("type", 'new_avatar')
                                            ->where("action", "!=", '')
                                            ->where("primary_link", "!=", '')
                                            ->orderBy('date_recorded', 'desc')->first();
                                $post->timestamp = strtotime($wpbpactivity_data['date_recorded']);
                                return $post;
                            })->toArray();
        $search_status = true;
        // Pass the search results to the view
        return view('posts.search', compact('search_data', 'brandName', 'countryOrigin', 'maker', 'storePurchase', 'note', 'search_status', 'big_categories', 'big_category', 'big_small_categories', 'small_categories', 'small_category'));
    }

    public function destroy($id){
        $post = Posts::find($id);
        $post->delete();
        $posts = Posts::orderBy('updated_at', 'desc')->with('images')->get();
        return view('posts.index', compact('posts'));
    }

    public function comment_destroy($comment_id){
        $comment_data = PostsComment::where('id', $comment_id)->first();
        $post_id = $comment_data['post_id'];
        $comment_data->delete();

        $result = Posts::where('id', $post_id)->with('images')->with('comments')->get();
        $post = $result[0];

        $second_result = WpUsers::where('user_email', Session::get('user_email'))->get();

        $modify_status = ($post['userLogin'] == $second_result[0]['user_login']); 

        $like_result = PostsLike::where('user_email', Session::get('user_email'))->where('post_id', $post['id'])->first();

        $big_categories = BigCategory::get();
        $big_small_categories = BigSmallCategory::where('big_category', $post['categoryFirst'])->get();
        $small_categories = SmallCategory::get();

        $submissionTime = Carbon::parse($post['updated_at']);
        $currentTime = Carbon::now();

        $timeDiff = $currentTime->diffInMinutes($submissionTime);

        if ($timeDiff < 60) {
            $displayTime = $timeDiff . '分前';
        } elseif ($timeDiff < 1440) {
            $displayTime = $currentTime->diffInHours($submissionTime) . '時間前';
        } else {
            $displayTime = $currentTime->diffInDays($submissionTime) . '日前';
        }

        return view('posts.index_modify', compact('post', 'modify_status', 'like_result', 'big_categories', 'big_small_categories', 'small_categories', 'displayTime'));
    }

    public function like(Request $request){
        if (Session::has('user_email')) {
 
            $posts_like_data = PostsLike::where('user_email', Session::get('user_email'))->where('post_id', $request->post_id)->first();

            if ($posts_like_data) {
                $posts_like_data->delete();
                return false;
            } else {
                $posts_like = new PostsLike;
                $posts_like->user_email = Session::get('user_email');
                $posts_like->post_id = $request->post_id;
                $posts_like->save();
                return true;
            }
        }else {
            $posts = Posts::orderBy('updated_at', 'desc')->with('images')->get();
            return view('posts.index', compact('posts'));
        }
    }

    public function comment(Request $request) {
        $posts_comment = new PostsComment;
        $posts_comment->post_id = $request->input('comment_post_id');
        $posts_comment->comment = $request->input('comment_note');
        $posts_comment->save();
  
        $result = Posts::where('id', $request->input('comment_post_id'))->with('images')->with('comments')->get();
        $post = $result[0];

        $second_result = WpUsers::where('user_email', Session::get('user_email'))->get();

        $modify_status = ($post['userLogin'] == $second_result[0]['user_login']); 

        $like_result = PostsLike::where('user_email', Session::get('user_email'))->where('post_id', $request->input('comment_post_id'))->first();

        $big_categories = BigCategory::get();
        $big_small_categories = BigSmallCategory::where('big_category', $post['categoryFirst'])->get();
        $small_categories = SmallCategory::get();

        $submissionTime = Carbon::parse($post['updated_at']);
        $currentTime = Carbon::now();

        $timeDiff = $currentTime->diffInMinutes($submissionTime);

        if ($timeDiff < 60) {
            $displayTime = $timeDiff . '分前';
        } elseif ($timeDiff < 1440) {
            $displayTime = $currentTime->diffInHours($submissionTime) . '時間前';
        } else {
            $displayTime = $currentTime->diffInDays($submissionTime) . '日前';
        }

        return view('posts.index_modify', compact('post', 'modify_status', 'like_result', 'big_categories', 'big_small_categories', 'small_categories', 'displayTime'));
    }   

    public function index_blog() {
        return view('blogs.index');
    }

    public function loadSubCategories(Request $request)
    {
        $bigCategoryId = $request->input('big_category_id');
        $subCategories = BigSmallCategory::where('big_category', $bigCategoryId)->get();
        $smallCategories = SmallCategory::get();

        $html = '<option value="">クリックして選択</option>';
        foreach ($subCategories as $category) {
            $html .= '<option value="' . $category->small_category . '">' . $smallCategories[$category->small_category - 1]->category . '</option>';
        }

        return $html;
    }
}