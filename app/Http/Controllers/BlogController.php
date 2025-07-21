<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Posts;
use App\PostLikes;
use Validator;
use App\Configuration;

class BlogController extends Controller
{
    private $configuration;

    public function __construct()
    {
        $this->configuration = Configuration::first();

        if($this->configuration->enablePassword == 1 && !(\Illuminate\Support\Facades\Session::has('passwordIn')))
        {
            return view('password');
        }

        // Share config to all views
        \View::share('configuration', $this->configuration);
    }


    public function index($word = '')
    {
        if($word != "")
        {
            $validator = Validator::make(['word' => $word], ['word' => 'required|string|max:255']);
            if ($validator->fails()) $word = '';
        }
        
        $posts = new Posts;
        if($word != "") $posts = $posts->where('title', 'like', '%' . $word . '%');
        $posts = $posts->orderBy('updated_at', 'DESC');
        $posts = $posts->get();

        return view('blog.index', compact('posts', 'word'));
    }

    public function detail($slug)
    {
    	$post = Posts::where('slug', $slug)->first();
    	if($post){
            $recentPosts = Posts::where('id', '!=', $post->id)->orderBy('created_at', 'DESC')->limit(3)->get();
        	return view('blog.detail', compact('post', 'recentPosts'));
        }
        else{
        	abort(404);
        }
    }

    
    public function likePost(Request $request) {
        if(Auth::guard('web')->check())
        {
            ///// validation /////
            $rules = [
                'postSlug' => 'required|max:255|exists:posts,slug'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) 
            {
                $error_message = [];
                foreach ($validator->errors()->all() as $value) {
                    $error_message[] = $value;
                }

                return ['error' => true, 'msg' => $error_message];
            }
            ///// validation /////

            $post = Posts::where('slug', $request->postSlug)->first();

            $like = true;
            $checkLike = PostLikes::where('user_id', Auth::guard('web')->user()->id)->where('post_id', $post->id)->first();
            if($checkLike)
            {
                $like = false;
                $checkLike->delete();
            }
            else
            {
                $postLike = new PostLikes;
                $postLike->user_id = Auth::guard('web')->user()->id;
                $postLike->post_id = $post->id;
                $postLike->save();
            }

            $nbLikesTemp = PostLikes::where('post_id', $post->id)->count();
            
            return ['error' => false, 'like' => $like, 'nbLikes' => $nbLikesTemp];
        }

        return ['error' => true, 'msg' => ['Error, please try again later']];
    }
}
