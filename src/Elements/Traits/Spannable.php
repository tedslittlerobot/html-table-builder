<?php

namespace Tlr\Tables\Elements\Traits;

trait Spannable {

    /**
     * The element span
     *
     * @var int
     */
    protected $spans;

    /**
     * Set the span property
     *
     * @param  int    $spans
     * @return $this
     */
    public function span(int $spans)
    {
        $this->spans = $spans;

        return $this;
    }

    /**
     * Get the span property
     *
     * @return int
     */
    public function getSpans() : int
    {
        return $this->spans;
    }

    /**
     * Determine if this is a row or a column
     *
     * @return boolean
     */
    public function isRow() : bool
    {
        return str_slug(class_basename($this)) === 'row';
    }

    /**
     * Determine if this is a row or a column
     *
     * @return boolean
     */
    abstract public function getSpanAttributeName() : string;

    /**
     * Render the class attribute as a string
     *
     * @return string
     */
    public function renderSpanAttribute() : string
    {
        if (!$this->spans) {
            return '';
        }

        return sprintf(
            '%s="%s"',
            $this->getSpanAttributeName(),
            $this->spans
        );
    }
}
