<?php

namespace Tlr\Tables\Elements\Cells;

use Tlr\Tables\Elements\Cells\ContentCell;

class LinkCell extends ContentCell
{
    /**
     * The link
     *
     * @var string
     */
    protected $link = '';

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

    public function __construct(string $link)
    {
        $this->link = $link;
    }

    /**
     * Get the cell content
     *
     * @return string
     */
    public function getContent() : string
    {
        return sprintf('<a href="%s">%s</a>', $this->link, parent::getContent());
    }
}
