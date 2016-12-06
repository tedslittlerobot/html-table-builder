<?php

namespace Tlr\Tables\Elements;

use Illuminate\Support\Collection;
use Tlr\Tables\Elements\Cell;
use Tlr\Tables\Elements\Cells\ContentCell;
use Tlr\Tables\Elements\Interfaces\Element;
use Tlr\Tables\Elements\Interfaces\HasChildren;
use Tlr\Tables\Elements\Section;
use Tlr\Tables\Elements\Traits\Attributable;
use Tlr\Tables\Elements\Traits\Classable;

class Row implements Element, HasChildren
{
    use Attributable, Classable;

    /**
     * The cells
     *
     * @var array
     */
    protected $cells = [];

    /**
     * Get the element name
     *
     * @return string
     */
    public function getElement() : string
    {
        return 'tr';
    }

    /**
     * Make a new cell
     *
     * @return \Tlr\Tables\Elements\Cell
     */
    public function cell() : Cell
    {
        $this->addCell($cell = new ContentCell);

        return $cell;
    }

    /**
     * Add a new cell
     */
    public function addCell(Cell $cell) : Row
    {
        $this->cells[] = $cell;

        return $this;
    }

    /**
     * Get the child elements
     *
     * @return array
     */
    public function getChildren() : array
    {
        return $this->cells;
    }
}
