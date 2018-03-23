<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->query('test-image')) {
            return $this->showTestFile();
        }

        return view('home.index');
    }

    protected function showTestFile()
    {
        $imageToDisplay = 'images/medialibrary/test-image.jpg';

        return response()->file($imageToDisplay);
    }
}
