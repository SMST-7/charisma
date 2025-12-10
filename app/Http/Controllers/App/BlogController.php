<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function index()
    {
        $blogs = Blog::all();
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(12);
        return view('app.blogs.index', compact('blogs'));
    }



    public function show($slug)
    {
        $recentBlogs=Blog::orderBy('created_at', 'desc')->get();
        $blog = Blog::where('slug',$slug)->firstorFail();
        return view('app.blogs.singleBlog1', compact('blog','recentBlogs'));
    }

}
