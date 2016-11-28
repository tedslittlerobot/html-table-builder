<?php

namespace Tlr\Tables\Elements;

use Tlr\Tables\Elements\Interfaces\Element;
use Tlr\Tables\Elements\Interfaces\HasChildren;
use Tlr\Tables\Elements\Row;
use Tlr\Tables\Elements\Traits\Attributable;
use Tlr\Tables\Elements\Traits\Classable;

class Section implements Element, HasChildren
{
    use Attributable, Classable;

    /**
     * The parent table
     *
     * @var \Tlr\Tables\Elements\Table
     */
    protected $table;

    /**
     * The table section element
     *
     * @var string
     */
    protected $element;

    /**
     * The cell element for this section
     *
     * @var string
     */
    protected $cellElement;

    /**
     * The section's rows
     *
     * @var array
     */
    protected $rows = [];

    public function __construct(Table $table, string $element = 'tbody', string $cellElement = 'td')
    {
        $this->table = $table;
        $this->element = $element;
        $this->cellElement = $cellElement;
    }

    /**
     * Make a new row
     *
     * @return \Tlr\Tables\Elements\Row
     */
    public function row() : Row
    {
        $this->rows[] = $row = new Row($this);

        return $row;
    }

    /**
     * Get the parent table
     *
     * @return \Tlr\Tables\Elements\Table
     */
    public function table() : Table
    {
        return $this->table;
    }

    /**
     * Get the element
     *
     * @return string
     */
    public function getElement() : string
    {
        return $this->element;
    }

    /**
     * Get the cell element
     *
     * @return string
     */
    public function getCellElement() : string
    {
        return $this->cellElement;
    }

    /**
     * Get the child elements
     *
     * @return array
     */
    public function getChildren() : array
    {
        return $this->rows;
    }
}
