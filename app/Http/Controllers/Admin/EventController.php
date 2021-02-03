<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index ()
    {
        return view('pages.event.index', [
            'content' => Content::class
        ]);
    }

    public function create()
    {
        return view('pages.event.create');
    }

    public function edit($id)
    {
        return view('pages.event.edit');
    }}
