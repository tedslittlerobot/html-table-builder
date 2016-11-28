<?php

use Mockery as m;
use Tlr\Tables\Elements\Section;
use Tlr\Tables\Elements\Table;

class UnitElementsSectionTest extends TestCase
{
    public function testGetTable()
    {
        $section = new Section($table = m::mock(Table::class));

        $this->assertEquals($table, $section->table());
    }
}
