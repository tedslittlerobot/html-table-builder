<?php

namespace Tlr\Tables\Elements;

use Tlr\Tables\Elements\Interfaces\HasChildren;
use Tlr\Tables\Elements\Interfaces\RowInterface;
use Tlr\Tables\Elements\Interfaces\SectionInterface;
use Tlr\Tables\Elements\Row;
use Tlr\Tables\Elements\Traits\Attributable;
use Tlr\Tables\Elements\Traits\Classable;

abstract class Section implements SectionInterface, HasChildren
{
    use Attributable, Classable;

    /**
     * The section's rows
     *
     * @var array
     */
    protected $rows = [];

    /**
     * Get the next row from the one given. Creates a new row if it's the last
     * row
     *
     * @return \Tlr\Tables\Elements\Interfaces\RowInterface
     */
    public function nextRow(Row $current) : RowInterface
    {
        $index = array_search($current, $this->rows, true);

        if ($index === false) {
            throw new InvalidArgumentException('The given row is not in the rows array');
        }

        return $this->rows[$index + 1] ?? $this->row();
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
