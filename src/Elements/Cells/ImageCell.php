<?php

namespace Tlr\Tables\Elements\Cells;

use Tlr\Tables\Elements\Cell;
use Tlr\Tables\Elements\Interfaces\HasContent;

class ImageCell extends Cell implements HasContent
{
    /**
     * The image source
     *
     * @var string
     */
    protected $source = '';

    public function __construct(string $source)
    {
        $this->source = $source;
    }

    /**
     * Get the cell content
     *
     * @return string
     */
    public function getContent() : string
    {
        return sprintf('<img src="%s" />', $this->source);
    }
}
