<?php

use Mockery as m;
use Tlr\Tables\Elements\Section;
use Tlr\Tables\Elements\Table;

class UnitElementsTableTest extends TestCase
{
    public function testToStringIsTheSameAsRender()
    {
        // This isn't really a unit test...

        $table = new Table();

        $table->class('foo bar');

        $this->assertEquals($table->render(), (string)$table);
    }
}
