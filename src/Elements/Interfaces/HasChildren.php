<?php

namespace Tlr\Tables\Elements\Interfaces;

use Illuminate\Support\Collection;

interface HasChildren {
    /**
     * Get the child elements
     *
     * @return Collection
     */
    public function getChildren() : Collection;
}
