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

    public function testBasicTableWithContentElement()
    {
        $table = new Table();
        $table->body()->row()->cell('Foo');

        $this->assertEquals('<table><tbody><tr><td>Foo</td></tr></tbody></table>', $table->render());
    }

    public function testAllFeatures()
    {
        $table = (new Table())->class('ui table')->attribute('id', 'test-table');

        $row = $table->header()->row();
        $row->cell()->spanColumns(2)->content('Name');
        $row->cell()->spanRows(2)->content('Age');

        $row = $table->header()->row();
        $row->cell()->content('First Name');
        $row->cell()->content('Last Name');

        $expectedHeader = '<thead><tr><th colspan=2>Name</th><th rowspan=2>Age</th></tr><tr><th>First Name</th><th>Last Name</th></tr></thead>';

        $table->body()->row()
            ->cell('Jeremy')->cell('Christmas')->cell(42)
        ->row()
            ->cell('Jeremy')->cell('Clarkson')->cell('>42');

        $expectedBody = '<tbody><tr><td>Jeremy</td><td>Christmas</td><td>42</td><td>Jeremy</td><td>Clarkson</td><td>&gt;42</td></tr></tbody>';

        $table->footer()->row()->cell('<a href="/new">New</a>')->raw();
        $table->footer()->row()->cell()->wrapContent('<a href="/home">', '<Home>', '</a>');

        $expectedFooter = '<tfoot><tr><th><a href="/new">New</a></th></tr><tr><th><a href="/home">&lt;Home&gt;</a></th></tr></tfoot>';

        $this->assertEquals(
            sprintf('<table class="ui table" id="test-table">%s%s%s</table>', $expectedHeader, $expectedBody, $expectedFooter),
            $table->render()
        );
    }
}
