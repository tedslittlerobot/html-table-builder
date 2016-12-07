<?php

namespace Tlr\Tables\Builder;

use Tlr\Tables\Elements\Cell;

interface TableBlueprintInterface
{
    /**
     * Get the columns to render
     *
     * @return array
     */
    public function getColumns() : array;

    /**
     * Get the given header cell
     *
     * @param  string $columnName
     * @return Cell
     */
    public function getHeaderCell(string $columnName) : Cell;

    /**
     * Get the given body cell
     *
     * @param  string $columnName
     * @return Cell
     */
    public function getBodyCell(string $columnName) : Cell;

    /**
     * Get the given footer cell
     *
     * @param  string $columnName
     * @return Cell
     */
    public function getFooterCell(string $columnName) : Cell;
}
