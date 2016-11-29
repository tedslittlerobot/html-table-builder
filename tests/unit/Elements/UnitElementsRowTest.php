<?php

use Mockery as m;
use Tlr\Tables\Elements\Cell;
use Tlr\Tables\Elements\Row;
use Tlr\Tables\Elements\Section;

class UnitElementsRowTest extends TestCase
{
    public function testGetCellReturnsProperCell()
    {
        $row = new Row($section = m::mock(Section::class));

        $this->assertInstanceOf(Cell::class, $row->cell());
    }

    public function testGetCellDoesNotReturnTheSameCell()
    {
        $row = new Row($section = m::mock(Section::class));

        $this->assertInstanceOf(Cell::class, $one = $row->cell());
        $this->assertInstanceOf(Cell::class, $two = $row->cell());

        $this->assertFalse($one === $two);
    }

    public function testGetNextCellReturnsCorrectCellInOrder()
    {
        $row = new Row($section = m::mock(Section::class));

        $this->assertInstanceOf(Cell::class, $one = $row->cell());
        $this->assertInstanceOf(Cell::class, $two = $row->cell());
        $this->assertInstanceOf(Cell::class, $three = $row->cell());

        $this->assertSame($two, $row->nextCell($one));
        $this->assertSame($three, $row->nextCell($two));

        $this->assertEquals(3, count($row->getChildren()));
    }

    public function testGetNextCellReturnsNewCellFromFinalCell()
    {
        $row = new Row($section = m::mock(Section::class));

        $this->assertInstanceOf(Cell::class, $one = $row->cell());
        $this->assertInstanceOf(Cell::class, $two = $row->cell());
        $this->assertInstanceOf(Cell::class, $three = $row->cell());

        $this->assertEquals(3, count($row->getChildren()));

        $row->nextCell($three);

        $this->assertEquals(4, count($row->getChildren()));
    }
}
