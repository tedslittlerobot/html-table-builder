<?php

namespace Tlr\Tables\Elements;

use Tlr\Tables\Elements\Interfaces\Element;
use Tlr\Tables\Elements\Interfaces\HasChildren;
use Tlr\Tables\Elements\Sections\BodySection;
use Tlr\Tables\Elements\Sections\FooterSection;
use Tlr\Tables\Elements\Sections\HeaderSection;
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
     * @return HeaderSection
     */
    public function header() : HeaderSection
    {
        return $this->header = $this->header ?: new HeaderSection;
    }

    /**
     * Get the table footer section
     *
     * @return Section
     */
    public function body() : BodySection
    {
        return $this->body = $this->body ?: new BodySection;
    }

    /**
     * Get the table footer section
     *
     * @return Section
     */
    public function footer() : FooterSection
    {
        return $this->footer = $this->footer ?: new FooterSection;
    }

    /**
     * Get the child elements
     *
     * @return array
     */
    public function getChildren() : array
    {
        return array_filter([$this->header, $this->body, $this->footer]);
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
