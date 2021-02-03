<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){

    }

    public function tausiyah(){
        $contents=Content::whereStatus('accepted')->whereType(2)->get();
        return view('front.content',compact('contents'));
    }
    public function blog(){
        $contents=Content::whereStatus('accepted')->whereType(1)->get();
        return view('front.content',compact('contents'));
    }
    public function event(){
        $contents=Content::whereStatus('accepted')->whereType(3)->get();
        return view('front.content',compact('contents'));
    }
    public function about(){

    }
    public function detail($slug){
        $content=Content::whereSlug($slug)->whereStatus('accepted')->firstOrFail();
        return view('front.detail',compact('content'));
    }


}
