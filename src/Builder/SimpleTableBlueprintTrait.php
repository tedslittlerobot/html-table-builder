<?php

namespace Tlr\Tables\Builder;

use Tlr\Tables\Elements\Cell;

trait SimpleTableBlueprintTrait
{
    // Interface

    /**
     * Get the columns to render
     *
     * @return array
     */
    public function getColumns() : array
    {
        if (property_exists($this, 'columns')) {
            return $this->columns;
        }

        // @todo - custom exception
        throw new \Exception(
            sprintf('No columns! Class [%s] must have a [$columns: array] property or override [getColumns(): array]', get_class($this))
        );
    }

    /**
     * Get the given header cell
     *
     * @param  string $columnName
     * @return Cell
     */
    public function getHeaderCell(string $columnName) : Cell
    {
        return $this->callForCell($columnName, 'header');
    }

    /**
     * Get the given body cell
     *
     * @param  string $columnName
     * @return Cell
     */
    public function getBodyCell(string $columnName) : Cell
    {
        return $this->callForCell($columnName, 'body');
    }

    /**
     * Get the given footer cell
     *
     * @param  string $columnName
     * @return Cell
     */
    public function getFooterCell(string $columnName) : Cell
    {
        return $this->callForCell($columnName, 'footer');
    }

    // Helpers

    protected function callForCell(string $column, string $domain) : Cell
    {
        $cell = new Cell;

        // @todo - camelcase column name (stringy?)
        $method = $column . $domain . 'Cell';

        if (!method_exists($this, $method)) {
            throw new \Exception(sprintf('Class [%s] must implement a [%s(Cell $cell)] method', get_class($this), $method));
        }

        $customCell = call_user_func([$this, $method], $cell);

        if (!$customCell instanceof Cell) {
            throw new \Exception("Method [%s@%s] must have return type \Tlr\Tables\Elements\Cell.");
        }

        return $customCell;
    }
}
