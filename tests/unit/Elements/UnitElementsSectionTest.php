<?php

use Mockery as m;
use Tlr\Tables\Elements\Row;
use Tlr\Tables\Elements\Section;
use Tlr\Tables\Elements\Table;

class UnitElementsSectionTest extends TestCase
{
    public function testGetTable()
    {
        $section = new Section($table = m::mock(Table::class));

        $this->assertEquals($table, $section->table());
    }

    public function testGetNextRowReturnsCorrectRowInOrder()
    {
        $section = new Section($table = m::mock(Table::class));

        $this->assertInstanceOf(Row::class, $one = $section->row());
        $this->assertInstanceOf(Row::class, $two = $section->row());
        $this->assertInstanceOf(Row::class, $three = $section->row());

        $this->assertSame($two, $section->nextRow($one));
        $this->assertSame($three, $section->nextRow($two));

        $this->assertEquals(3, count($section->getChildren()));
    }

    public function testGetNextRowReturnsNewRowFromFinalRow()
    {
        $section = new Section($table = m::mock(Table::class));

        $this->assertInstanceOf(Row::class, $one = $section->row());
        $this->assertInstanceOf(Row::class, $two = $section->row());
        $this->assertInstanceOf(Row::class, $three = $section->row());

        $this->assertEquals(3, count($section->getChildren()));

        $section->nextRow($three);

        $this->assertEquals(4, count($section->getChildren()));
    }
}
