<?php

namespace Tlr\Tables\Elements\Traits;

use Tlr\Tables\Elements\Interfaces\Element;

trait Spannable {

    /**
     * The element span
     *
     * @var int
     */
    protected $rowSpan;

    /**
     * The element span
     *
     * @var int
     */
    protected $colSpan;

    /**
     * Set the span property
     *
     * @param  int    $spans
     * @return $this
     */
    public function spanRows(int $spans) : Element
    {
        $this->rowSpan = $spans;

        return $this;
    }

    /**
     * Set the span property
     *
     * @param  int    $spans
     * @return $this
     */
    public function spanColumns(int $spans) : Element
    {
        $this->colSpan = $spans;

        return $this;
    }

    /**
     * Render the class attribute as a string
     *
     * @return string
     */
    public function renderSpanAttribute() : string
    {
        $attribute = '';

        if ($this->colSpan) {
            $attribute .= 'colspan=' . $this->colSpan;
        }

        if ($this->rowSpan) {
            $attribute .= 'rowspan=' . $this->rowSpan;
        }

        return $attribute;
    }
}
