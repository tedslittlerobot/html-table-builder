<?php

use Mockery as m;
use Tlr\Tables\Elements\Cell;
use Tlr\Tables\Elements\Row;

class UnitElementsCellTest extends TestCase
{
    public function testSetContent()
    {
        $cell = new Cell($row = m::mock(Row::class));

        $cell->content('Foo');

        $this->assertEquals('Foo', $cell->getContent());
    }

    public function testContentEscapes()
    {
        $cell = new Cell($row = m::mock(Row::class));

        $cell->content('<Foo />')->escape();

        $this->assertEquals('&lt;Foo /&gt;', $cell->getContent());
    }

    public function testContentDoesNotEscape()
    {
        $cell = new Cell($row = m::mock(Row::class));

        $cell->content('<Foo />')->dontEscape();
        $this->assertEquals('<Foo />', $cell->getContent());

        $cell->content('<Bar />')->raw();
        $this->assertEquals('<Bar />', $cell->getContent());
    }
}
