<?php

namespace Tlr\Tables\Elements;

use Tlr\Tables\Elements\Interfaces\CellInterface;
use Tlr\Tables\Elements\Traits\Attributable;
use Tlr\Tables\Elements\Traits\Classable;
use Tlr\Tables\Elements\Traits\Spannable;

abstract class Cell implements CellInterface
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
     * @return \Tlr\Tables\Elements\Interfaces\CellInterface
     */
    public function setElement(string $element) : CellInterface
    {
        return $this;
    }

    /**
     * Set this cell as a header cell
     *
     * @return \Tlr\Tables\Elements\Interfaces\CellInterface
     */
    public function headerCell() : CellInterface
    {
        return $this->setElement('th');
    }

    /**
     * Set this cell as a body cell
     *
     * @return \Tlr\Tables\Elements\Interfaces\CellInterface
     */
    public function bodyCell() : CellInterface
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
