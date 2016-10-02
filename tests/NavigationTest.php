<?php

/**
 * Class NavigationTest
 *
 * @package \\${NAMESPACE}
 */
class NavigationTest extends PHPUnit_Framework_TestCase
{
    protected $array;
    protected $urls;
    public function setUp()
    {
        parent::setUp();

        $this->array = [
            [
                'Introduction',
                'Requirements',
                'Installation & setup',
                'Questions & issues',
                'Changelog',
            ],
            'Basic usage' => [
                'Preparing your model',
                'Associating files',
                'Retrieving media',
                'Working with collections',
            ],
        ];

        $this->urls = [
            "introduction",
            "requirements",
            "installation-setup",
            "questions-issues",
            "changelog",
            "basic-usage/preparing-your-model",
            "basic-usage/associating-files",
            "basic-usage/retrieving-media",
            "basic-usage/working-with-collections",

        ];
    }

    /** @test */
    public function it_can_get_a_next_item()
    {
//        dd(count($this->urls));
        $randomIndex = random_int(0, 8);
//        dd($randomIndex);
        $url =  $this->urls[$randomIndex];
        $nextUrl = $this->urls[$randomIndex+1];
//        dd($url);

        $flattenArray = $this->getFlattenArray();
//        dd($flattenArray);

        $index = $flattenArray->search($url);

        $next = $this->getFlattenArray()->get($index+1, '');

        if (!empty($next)) {
            $this->assertEquals($next, $nextUrl);
        }
    }

    /** @test */
    public function it_can_get_a_previous_item()
    {
        $url = "installation-setup";

        $flattenArray = $this->getFlattenArray();
//        dd($flattenArray);

        $slug = str_slug($url);

        $index = $flattenArray->search($slug);

        $previous = $flattenArray->get($index-1, '');

        $this->assertEquals($previous, "requirements");
    }

    /** @test */
    public function it_prevents_going_under_the_min_index()
    {
        $url = "introduction";

        $flattenArray = $this->getFlattenArray();

        $slug = str_slug($url);

        $index = $flattenArray->search($slug);

        $previous = $flattenArray->get($index-1, '');

        $this->assertEquals($previous, '');
    }

    /** @test */
    public function it_prevents_going_above_the_max_index()
    {
        $url = "basic-usage/working-with-collections";

        $index = $this->getFlattenArray()->search($url);

        $next = $this->getFlattenArray()->get($index+1, '');

        $this->assertEquals($next, '');
    }

    protected function getFlattenArray()
    {
        return collect($this->array)
            ->flatMap(function (array $block, string $title) : array {

                if (empty($title)) {
                    return collect($block)->map(function (string $page) {
                        return str_slug($page);
                    })->toArray();
                }

                return collect($block)->map(function (string $page) use ($title) {
                    $slug_title = str_slug($title);
                    $slug_page = str_slug($page);
                    return "{$slug_title}/{$slug_page}";
                })->toArray();
            });
    }
}
