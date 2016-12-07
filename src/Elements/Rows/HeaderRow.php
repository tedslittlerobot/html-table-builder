<?php

namespace Tlr\Tables\Elements\Rows;

use Tlr\Tables\Elements\Interfaces\CellInterface;
use Tlr\Tables\Elements\Interfaces\RowInterface;
use Tlr\Tables\Elements\Row;

class HeaderRow extends Row
{
    /**
     * Add a new cell
     */
    public function addCell(CellInterface $cell) : RowInterface
    {
        return parent::addCell($cell->headerCell());
    }
}
