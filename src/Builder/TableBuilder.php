<?php

namespace Tlr\Tables\Builder;

use Tlr\Tables\Elements\Table;

class TableBuilder
{
    public function buildTable(TableBlueprintInterface $blueprint) : Table
    {
        $table = new Table;

        // foreach sectionn
        // foreach row
        // foreach column
        // $row -> addcell == $this->getBodyCell($column)

        return $table
    }
}
