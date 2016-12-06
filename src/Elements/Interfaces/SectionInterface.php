<?php

namespace Tlr\Tables\Elements\Interfaces;

use Tlr\Tables\Elements\Interfaces\Element;

interface SectionInterface extends Element {
    /**
     * Make a new row
     *
     * @return \Tlr\Tables\Elements\Interfaces\RowInterface
     */
    public function row() : RowInterface;
}
