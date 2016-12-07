<?php

use Mockery as m;
use Tlr\Tables\Elements\Cells\ContentCell;

class UnitElementsContentCellTest extends TestCase
{
    public function testSetContentInInitialiser()
    {
        $cell = new ContentCell;

        $cell->content('Foo');

        $this->assertEquals('Foo', $cell->getContent());
    }

    public function testContentEscapes()
    {
        $cell = new ContentCell;

        $cell->content('<Foo />')->escape();

        $this->assertEquals('&lt;Foo /&gt;', $cell->getContent());
    }

    public function testContentDoesNotEscape()
    {
        $cell = new ContentCell;

        $cell->content('<Foo />')->dontEscape();
        $this->assertEquals('<Foo />', $cell->getContent());

        $cell->content('<Bar />')->raw();
        $this->assertEquals('<Bar />', $cell->getContent());
    }
}
