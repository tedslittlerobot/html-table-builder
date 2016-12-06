<?php

namespace Tlr\Tables\Elements\Interfaces;

use Tlr\Tables\Elements\Interfaces\Element;

interface CellInterface extends Element {
    /**
     * Set this cell as a header cell
     *
     * @return \Tlr\Tables\Elements\Interfaces\CellInterface
     */
    public function headerCell() : CellInterface;

    /**
     * Set this cell as a body cell
     *
     * @return \Tlr\Tables\Elements\Interfaces\CellInterface
     */
    public function bodyCell() : CellInterface;
}
