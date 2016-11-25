<?php

namespace Tlr\Tables\Elements;

use Tlr\Tables\Elements\Interfaces\Element;
use Tlr\Tables\Elements\Interfaces\HasContent;
use Tlr\Tables\Elements\Row;
use Tlr\Tables\Elements\Traits\Attributable;
use Tlr\Tables\Elements\Traits\Classable;
use Tlr\Tables\Elements\Traits\Spannable;

class Cell implements Element, HasContent
{
    use Attributable, Classable, Spannable;

    /**
     * The parent row
     *
     * @var \Tlr\Tables\Elements\Row
     */
    protected $row;

    /**
     * The parent row
     *
     * @var string
     */
    protected $content = '';

    /**
     * Should the cell escape its contents
     *
     * @var bool
     */
    protected $escape = true;

    public function __construct(Row $row)
    {
        $this->row = $row;
    }

    /**
     * Get the element for this cell
     *
     * @return string
     */
    public function getElement() : string
    {
        return $this->row()->section()->getCellElement();
    }

    /**
     * Get the parent row
     *
     * @return \Tlr\Tables\Elements\Row
     */
    public function row() : Row
    {
        return $this->row;
    }

    /**
     * Make a sibling cell
     *
     * @return \Tlr\Tables\Elements\Cell
     */
    public function cell(string $content = null) : Cell
    {
        return $this->row()->cell($content);
    }

    /**
     * Set the cell's content
     *
     * @param  string $content
     * @param  bool   $escape
     * @return \Tlr\Tables\Elements\Cell
     */
    public function content(string $content) : Cell
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Set whether we should escape or not
     *
     * @param  bool|boolean $escape
     * @return \Tlr\Tables\Elements\Cell
     */
    public function escape(bool $escape = true) : Cell
    {
        $this->escape = $escape;

        return $this;
    }

    /**
     * Set whether we should escape or not
     *
     * @param  bool|boolean $escape
     * @return \Tlr\Tables\Elements\Cell
     */
    public function dontEscape() : Cell
    {
        return $this->escape(false);
    }

    /**
     * Set whether we should escape or not
     *
     * @param  bool|boolean $escape
     * @return \Tlr\Tables\Elements\Cell
     */
    public function raw() : Cell
    {
        return $this->escape(false);
    }

    /**
     * Get the cell content
     *
     * @return string
     */
    public function getContent() : string
    {
        return $this->escape ? e($this->content) : $this->content;
    }
}
