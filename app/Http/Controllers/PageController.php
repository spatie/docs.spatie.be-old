<?php

namespace App\Http\Controllers;

use Exception;
use Spatie\YamlFrontMatter\Parser;
use Storage;

class PageController extends Controller
{
    public function page()
    {
        $pageProperties = $this->getPageProperties();

        return view('page')->with($pageProperties);
    }

    public function getPageProperties() : array
    {
        try {
            $content = Storage::disk('content')->get(request()->path() . '.md');
        } catch (Exception $e) {
            abort(404);
        }

        $document = (new Parser())->parse($content);

        $pageProperties = $document->matter();
        $pageProperties['pagePath'] = request()->path();
        $pageProperties['content'] = markdown($document->body());
        $pageProperties['layout'] = $pageProperties['layout'] ?? request()->segment(1);

        return $pageProperties;
    }
}
