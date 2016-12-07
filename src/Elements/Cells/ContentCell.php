<?php

namespace Tlr\Tables\Elements\Cells;

use Tlr\Tables as helpers;
use Tlr\Tables\Elements\Cell;
use Tlr\Tables\Elements\Interfaces\HasContent;

class ContentCell extends Cell implements HasContent
{
    /**
     * The content
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

    /**
     * Set the cell's content
     *
     * @param  string $content
     * @return \Tlr\Tables\Elements\ContentCell
     */
    public function content(string $content) : ContentCell
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Set the cell's content, wrapping it in some html
     *
     * @param  string $opening
     * @param  string $content
     * @param  string $closing
     * @return \Tlr\Tables\Elements\ContentCell
     */
    public function wrapContent(string $opening, string $content, string $closing) : ContentCell
    {
        $this->content = $opening . helpers\e($content) . $closing;

        return $this->raw();
    }

    /**
     * Set whether we should escape or not
     *
     * @param  bool|boolean $escape
     * @return \Tlr\Tables\Elements\ContentCell
     */
    public function escape(bool $escape = true) : ContentCell
    {
        $this->escape = $escape;

        return $this;
    }

    /**
     * Set whether we should escape or not
     *
     * @param  bool|boolean $escape
     * @return \Tlr\Tables\Elements\ContentCell
     */
    public function dontEscape() : ContentCell
    {
        return $this->escape(false);
    }

    /**
     * Set whether we should escape or not
     *
     * @param  bool|boolean $escape
     * @return \Tlr\Tables\Elements\ContentCell
     */
    public function raw() : ContentCell
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
        return $this->escape ? helpers\e($this->content) : $this->content;
    }
}
