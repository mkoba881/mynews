<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AAAController extends Controller
{
    public function bbb()
    {
        return view('AAA.news.create');
    }
}
