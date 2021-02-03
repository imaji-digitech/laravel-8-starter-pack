<?php


namespace App\Http\Controllers;


use App\Models\Content;
use App\Models\Tag;
use Illuminate\Support\Facades\Facade;

class Helper extends Facade
{
    public static function getCategory(){
        return Tag::get();
    }
    public static function getRecentPost(){
        return Content::get();
    }
    public static function getTag(){
        return Tag::get();
    }
}
