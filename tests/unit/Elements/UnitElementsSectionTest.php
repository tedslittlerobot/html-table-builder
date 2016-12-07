<?php

use Mockery as m;
use Tlr\Tables\Elements\Rows\BodyRow;
use Tlr\Tables\Elements\Sections\BodySection;

class UnitElementsSectionTest extends TestCase
{
    public function testGetNextRowReturnsCorrectRowInOrder()
    {
        $section = new BodySection;

        $this->assertInstanceOf(BodyRow::class, $one = $section->row());
        $this->assertInstanceOf(BodyRow::class, $two = $section->row());
        $this->assertInstanceOf(BodyRow::class, $three = $section->row());

        $this->assertSame($two, $section->nextRow($one));
        $this->assertSame($three, $section->nextRow($two));

        $this->assertEquals(3, count($section->getChildren()));
    }

    public function testGetNextRowReturnsNewRowFromFinalRow()
    {
        $section = new BodySection;

        $this->assertInstanceOf(BodyRow::class, $one = $section->row());
        $this->assertInstanceOf(BodyRow::class, $two = $section->row());
        $this->assertInstanceOf(BodyRow::class, $three = $section->row());

        $this->assertEquals(3, count($section->getChildren()));

        $section->nextRow($three);

        $this->assertEquals(4, count($section->getChildren()));
    }
}
