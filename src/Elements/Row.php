<?php

namespace Tlr\Tables\Elements;

use Illuminate\Support\Collection;
use Tlr\Tables\Elements\Cells\ContentCell;
use Tlr\Tables\Elements\Cells\ImageCell;
use Tlr\Tables\Elements\Cells\LinkCell;
use Tlr\Tables\Elements\Interfaces\CellInterface;
use Tlr\Tables\Elements\Interfaces\HasChildren;
use Tlr\Tables\Elements\Interfaces\RowInterface;
use Tlr\Tables\Elements\Section;
use Tlr\Tables\Elements\Traits\Attributable;
use Tlr\Tables\Elements\Traits\Classable;

class Row implements RowInterface, HasChildren
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
     * Add a new cell
     */
    public function addCell(CellInterface $cell) : RowInterface
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

    /////// FACTORIES ///////

    /**
     * Make a new cell
     *
     * @return \Tlr\Tables\Elements\Cells\ContentCell
     */
    public function cell() : ContentCell
    {
        $this->addCell($cell = new ContentCell);

        return $cell;
    }

    /**
     * Make a new cell
     *
     * @param string $link
     * @return \Tlr\Tables\Elements\Cells\LinkCell
     */
    public function linkCell(string $link) : LinkCell
    {
        $this->addCell($cell = new LinkCell($link));

        return $cell;
    }

    /**
     * Make a new cell
     *
     * @param  string  $source
     * @return \Tlr\Tables\Elements\Cells\ImageCell
     */
    public function imageCell(string $source) : ImageCell
    {
        $this->addCell($cell = new ImageCell($source));

        return $cell;
    }
}
