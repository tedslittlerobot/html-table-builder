<?php

use Mockery as m;
use Tlr\Tables\Elements\Table;

class IntegrationTableTest extends TestCase
{
    public function testBasicTableElement()
    {
        $table = new Table();

        $this->assertEquals('<table></table>', $table->render());
    }

    public function testBasicFullTable()
    {
        $table = new Table();
        $table->body()->row()->cell();

        $this->assertEquals('<table><tbody><tr><td></td></tr></tbody></table>', $table->render());
    }

    public function testBasicTableWithBodyAndAllCellElements()
    {
        $table = new Table;
        $table->body()->row()->cell()->content('Foo');
        $table->body()->row()->linkCell('foo.com')->content('bar');
        $table->body()->row()->imageCell('foo.jpg');

        $this->assertEquals('<table><tbody><tr><td>Foo</td></tr><tr><td><a href="foo.com">bar</a></td></tr><tr><td><img src="foo.jpg" /></td></tr></tbody></table>', $table->render());
    }

    public function testBasicTableWithAllThreeSections()
    {
        $table = new Table;
        $table->header()->row()->cell()->content('Foo');
        $table->body()->row()->cell()->content('Bar');
        $table->footer()->row()->cell()->content('Baz');

        $this->assertEquals('<table><thead><tr><th>Foo</th></tr></thead><tbody><tr><td>Bar</td></tr></tbody><tfoot><tr><th>Baz</th></tr></tfoot></table>', $table->render());
    }

    public function testToStringRendersTheTable()
    {
        // This isn't really a unit test...
        $table = new Table;

        $table->class('foo bar');

        $this->assertEquals($table->render(), (string)$table);
    }
}
