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
     * The table section element
     *
     * @var string
     */
    protected $element;

    /**
     * The section's rows
     *
     * @var array
     */
    protected $rows = [];

    public function __construct(string $element = 'tbody')
    {
        $this->element = $element;
    }

    /**
     * Make a new row
     *
     * @return \Tlr\Tables\Elements\Row
     */
    public function row() : Row
    {
        return $this->rows[] = $row = new Row;
    }

    /**
     * Get the next row from the one given. Creates a new row if it's the last
     * row
     *
     * @return \Tlr\Tables\Elements\Row
     */
    public function nextRow(Row $current) : Row
    {
        $index = array_search($current, $this->rows, true);

        if ($index === false) {
            throw new InvalidArgumentException('The given row is not in the rows array');
        }

        return $this->rows[$index + 1] ?? $this->row();
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
