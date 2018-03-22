<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->query('test-image')) {
            $this->handleTestFile();
        }

        return view('home.index');
    }

    protected function handleTestFile()
    {
        header('Content-Type: image/jpeg');

        $imageToDisplay = 'images/medialibrary/test-image.jpg';

        return readfile($imageToDisplay, true);
    }
}
