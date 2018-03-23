<?php

namespace App\Http\Controllers;

class TestFileController extends Controller
{
    public function show()
    {
        $imageToDisplay = 'images/medialibrary/test-image.jpg';

        return response()->file($imageToDisplay);
    }
}
