<?php

namespace App\Http\Controllers;

use Spatie\YamlFrontMatter\Parser;
use Storage;

class PageController extends Controller
{
    public function page()
    {
        $content = $this->getContent();

        if (! array_key_exists('layout', $content)) {
            $content['layout'] = request()->segment(1);
        }

        return view('page', $content);
    }

    public function getContent() : array
    {
        try {
            $content = Storage::disk('content')->get(request()->path().'.md');
        } catch (Exception $e) {
            abort(404);
        }

        $document = (new Parser())->parse($content);

        return array_merge(
            $document->matter(),
            ['content' => markdown($document->body())]
        );
    }
}
