<?php

namespace Tlr\Tables\Elements;

use Tlr\Tables\Elements\Interfaces\Element;
use Tlr\Tables\Elements\Row;
use Tlr\Tables\Elements\Traits\Attributable;
use Tlr\Tables\Elements\Traits\Classable;
use Tlr\Tables\Elements\Traits\Spannable;

abstract class Cell implements Element
{
    use Attributable, Classable, Spannable;

    /**
     * The HTML element
     *
     * @var string
     */
    protected $element = 'td';

    /**
     * Set this cell's element
     *
     * @return \Tlr\Tables\Elements\Cell
     */
    public function setElement(string $element) : Cell
    {
        return $this;
    }

    /**
     * Set this cell as a header cell
     *
     * @return \Tlr\Tables\Elements\Cell
     */
    public function headerCell() : Cell
    {
        return $this->setElement('th');
    }

    /**
     * Set this cell as a body cell
     *
     * @return \Tlr\Tables\Elements\Cell
     */
    public function bodyCell() : Cell
    {
        return $this->setElement('td');
    }

    /**
     * Get the element for this cell
     *
     * @return string
     */
    public function getElement() : string
    {
        return $this->element;
    }
}
