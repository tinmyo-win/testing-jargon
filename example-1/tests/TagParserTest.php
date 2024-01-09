<?php

namespace Tests;

use App\TagParser;
use PHPUnit\Framework\TestCase;

class TagParserTest extends TestCase
{
    public function test_it_parses_a_single_tag()
    {
        $parser = new TagParser;

        $result = $parser->parse('personal');
        $expected = ['personal'];

        $this->assertSame($expected, $result);
    }

    public function test_it_parses_a_comma_seperated_list_of_tag()
    {
        $parser = new TagParser;

        $result = $parser->parse('personal, money, family');
        $expected = ['personal', 'money', 'family'];

        $this->assertSame($expected, $result);
    }

    public function test_spaces_are_optionals()
    {
        $parser = new TagParser;

        $result = $parser->parse('personal,money,family');
        $expected = ['personal', 'money', 'family'];

        $this->assertSame($expected, $result);

        $result = $parser->parse('personal|money|family');
        $expected = ['personal', 'money', 'family'];

        $this->assertSame($expected, $result);
    }

    public function test_it_parses_a_pipe_seperated_list_of_tag()
    {
        $parser = new TagParser;

        $result = $parser->parse('personal | money | family');
        $expected = ['personal', 'money', 'family'];

        $this->assertSame($expected, $result);
    }
}