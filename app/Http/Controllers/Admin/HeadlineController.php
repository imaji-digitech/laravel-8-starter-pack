<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Headline;
use Illuminate\Http\Request;

class HeadlineController extends Controller
{
    public function index ()
    {
        return view('pages.headline.index', [
            'headline' => Headline::class
        ]);
    }

    public function create()
    {
        return view('pages.headline.create');
    }

    public function edit($id)
    {
        return view('pages.headline.edit');
    }
}
