<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index ()
    {
        return view('pages.blog.index', [
            'content' => Content::class
        ]);
    }

    public function create()
    {
        return view('pages.blog.create');
    }

    public function edit($id)
    {
        return view('pages.blog.edit');
    }

}
