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
     * @var \Illuminate\Support\Collection
     */
    protected $cells;

    public function __construct(Section $section)
    {
        $this->section = $section;
        $this->cells = collect();
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
        $this->cells->push($cell = new Cell($this));

        return $content ? $cell->content($content) : $cell;
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
     * @return Collection
     */
    public function getChildren() : Collection
    {
        return $this->cells;
    }
}
