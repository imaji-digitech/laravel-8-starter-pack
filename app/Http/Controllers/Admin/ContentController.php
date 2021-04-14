<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{

    public function index()
    {
        return view('pages.content.index',['content'=>Content::class]);
    }

    public function create()
    {
        return view('pages.content.create');
    }

    public function edit($id)
    {
        return view('pages.content.edit',compact('id'));
    }


}
