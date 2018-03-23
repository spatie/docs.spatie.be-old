<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->query('test-image')) {
            return (new TestFileController)->show();
        }

        return view('home.index');
    }
}
