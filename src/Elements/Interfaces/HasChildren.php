<?php

namespace Tlr\Tables\Elements\Interfaces;

interface HasChildren {
    /**
     * Get the child elements
     *
     * @return array
     */
    public function getChildren() : array;
}
