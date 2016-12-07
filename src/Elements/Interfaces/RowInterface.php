<?php

namespace Tlr\Tables\Elements\Interfaces;

use Tlr\Tables\Elements\Interfaces\CellInterface;
use Tlr\Tables\Elements\Interfaces\Element;

interface RowInterface extends Element {
    /**
     * Add a new cell
     */
    public function addCell(CellInterface $cell) : RowInterface;
}
