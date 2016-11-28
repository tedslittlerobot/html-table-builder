<?php

namespace Tlr\Tables\Elements;

use Illuminate\Support\Collection;
use Tlr\Tables\Elements\Interfaces\Element;
use Tlr\Tables\Elements\Interfaces\HasChildren;
use Tlr\Tables\Elements\Section;
use Tlr\Tables\Elements\Traits\Attributable;
use Tlr\Tables\Elements\Traits\Classable;
use Tlr\Tables\TableRenderer;

class Table implements Element, HasChildren
{
    use Attributable, Classable;

    /**
     * The Header Section
     *
     * @var \Tlr\Tables\Elements\Section
     */
    protected $header;

    /**
     * The Body Section
     *
     * @var \Tlr\Tables\Elements\Section
     */
    protected $body;

    /**
     * The Footer Section
     *
     * @var \Tlr\Tables\Elements\Section
     */
    protected $footer;

    /**
     * Get the table footer section
     *
     * @return Section
     */
    public function header() : Section
    {
        return $this->header = $this->header ?: new Section($this, 'thead', 'th');
    }

    /**
     * Get the table footer section
     *
     * @return Section
     */
    public function body() : Section
    {
        return $this->body = $this->body ?: new Section($this, 'tbody');
    }

    /**
     * Get the table footer section
     *
     * @return Section
     */
    public function footer() : Section
    {
        return $this->footer = $this->footer ?: new Section($this, 'tfoot', 'th');
    }

    /**
     * Get the child elements
     *
     * @return Collection
     */
    public function getChildren() : Collection
    {
        return collect([$this->header, $this->body, $this->footer])->filter();
    }

    /**
     * Get the element name
     *
     * @return string
     */
    public function getElement() : string
    {
        return 'table';
    }

    /**
     * Render the table
     *
     * @return string
     */
    public function render() : string
    {
        return (new TableRenderer)->renderElement($this);
    }

    /**
     * Convert the table to a string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}
