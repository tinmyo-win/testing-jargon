<?php

namespace Tests;

use App\TagParser;
use PHPUnit\Framework\TestCase;

class TagParserTest extends TestCase
{
    /**
     * @dataProvider tagsProvider
     */
    public function test_it_parses_tags($input, $expected)
    {
        $parser = new TagParser;
        $result = $parser->parse($input);

        $this->assertSame($expected, $result);
    }

    public static function tagsProvider()
    {
        return [
            ['personal', ['personal']],
            ['personal, money, family', ['personal', 'money', 'family']],
            ['personal | money | family', ['personal', 'money', 'family']],
            ['personal|money|family', ['personal', 'money', 'family']],
            ['personal!money!family', ['personal', 'money', 'family']],
        ];
    }

    // public function test_it_parses_a_single_tag()
    // {

    //     $result = $this->parser->parse('personal');
    //     $expected = ['personal'];

    //     $this->assertSame($expected, $result);
    // }

    // public function test_it_parses_a_comma_seperated_list_of_tag()
    // {

    //     $result = $this->parser->parse('personal, money, family');
    //     $expected = ['personal', 'money', 'family'];

    //     $this->assertSame($expected, $result);
    // }

    // public function test_spaces_are_optionals()
    // {

    //     $result = $this->parser->parse('personal,money,family');
    //     $expected = ['personal', 'money', 'family'];

    //     $this->assertSame($expected, $result);

    //     $result = $this->parser->parse('personal|money|family');
    //     $expected = ['personal', 'money', 'family'];

    //     $this->assertSame($expected, $result);
    // }

    // public function test_it_parses_a_pipe_seperated_list_of_tag()
    // {

    //     $result = $this->parser->parse('personal | money | family');
    //     $expected = ['personal', 'money', 'family'];

    //     $this->assertSame($expected, $result);
    // }
}
