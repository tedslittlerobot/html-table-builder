<?php

namespace Tlr\Tables\Elements;

use Illuminate\Support\Collection;
use Tlr\Tables\Elements\Cell;
use Tlr\Tables\Elements\Interfaces\Element;
use Tlr\Tables\Elements\Interfaces\HasChildren;
use Tlr\Tables\Elements\Section;
use Tlr\Tables\Elements\Traits\Attributable;
use Tlr\Tables\Elements\Traits\Classable;

class Row implements Element, HasChildren
{
    use Attributable, Classable;

    /**
     * The parent section
     *
     * @var \Tlr\Tables\Elements\Section
     */
    protected $section;

    /**
     * The cells
     *
     * @var array
     */
    protected $cells = [];

    public function __construct(Section $section)
    {
        $this->section = $section;
    }

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
    public function cell(string $content = null) : Cell
    {
        return $content ? $this->addCell()->content($content) : $this->addCell();
    }

    /**
     * Get the next cell from the one given. Creates a new cell if it's the last
     * cell
     *
     * @return \Tlr\Tables\Elements\Cell
     */
    public function nextCell(Cell $current) : Cell
    {
        $index = array_search($current, $this->cells, true);

        if ($index === false) {
            throw new InvalidArgumentException('The given cell is not in the cells array');
        }

        return $this->cells[$index + 1] ?? $this->addCell();
    }

    /**
     * Add a new cell
     */
    protected function addCell() : Cell
    {
        return $this->cells[] = new Cell($this);
    }

    /**
     * Get the parent section
     *
     * @return \Tlr\Tables\Elements\Section
     */
    public function section() : Section
    {
        return $this->section;
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
