<?php

namespace App\Http\Controllers;

class TestFileController extends Controller
{
    public function show()
    {
        return response()->file('images/medialibrary/test-image.jpg');
    }
}
