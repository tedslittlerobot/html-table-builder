# HTML Table Builder

[![Build Status](https://travis-ci.org/tedslittlerobot/html-table-builder.svg?branch=master)](https://travis-ci.org/tedslittlerobot/html-table-builder)

A class-based, "fluent" HTML table builder in PHP.

```php
use Tlr\Tables\Elements\Table;

$table = new Table;

$table->class('ui celled table');

$table->header()->row()
    ->cell('Name')
    ->cell('Age')
    ->cell('Something Else');

$table->body()
    ->row()
        ->cell('George')
        ->cell('12')
        ->cell('Food');

$table->footer()
    ->row()
        ->cell('<a href="/create">Add a new entry</a>')->dontEscape()->span(3);

echo $table->render();
```

## Installation

```bash
composer require tlr/html-table-builder
```

## Basic Usage

You can see much of the functionality in the above example. More detailed explanations are below.

## Reference

### Table

The table object represents a top level HTML table.

See `Classable` below for information on setting the rows' classes.

See `Attributable` below for information on setting other attributes on the cell element.

It has four other main methods.

#### `$table->render()`

This is a helpful shortcut to doing the following:

```php
(new TableRenderer)->renderElement($table);
```

If you want to pretty print the HTML in your table, you can set it like so:

```php
(new TableRenderer)->prettyPrint()->renderElement($table);
```

#### `$table->header()` `$table->body()` `$table->footer()`

These all return a table section object (see below).

These will be initialised the first time you call the function, so if you never call `->header()`, then a `<thead>` section will not be rendered.

You can call them multiple times, and they will return the same object.

### Section (`thead`, `tbody`, `tfoot`)

These objects represent sections in a table.

See `Classable` below for information on setting the rows' classes.

See `Attributable` below for information on setting other attributes on the cell element.

There are two other methods to talk about here.

#### `$section->row()`

This initialises and returns a new `Row` object. Calling it multiple times will add multiple rows to the table.

#### `$section->nextRow(Row $current)`

Returns the next row in its children from the one passed to it.

Throws an error if passed a row that is not one of its children.

See the code example for the logic of how this works.

```php

$one = $section->row();
$two = $section->row();

$section->nextRow($one) === $two; // true
$section->nextRow($two); // a new row
```

### Row

These objects represent rows in a table section.

See `Classable` below for information on setting the rows' classes.

See `Attributable` below for information on setting other attributes on the cell element.

There are two other methods to talk about here.

#### `$row->cell(string $content = null)`

This initialises a new cell object, with the given content. You can leave the argument out to initialise the cell without any content (you can set the content later - see `Cell` below).

#### `$row->nextCell(Cell $current)`

Returns the next cell in its children from the one passed to it. This works the same as `Section@nextRow`.

Throws an error if passed a row that is not one of its children.

See the code example for the logic of how this works.

```php

$one = $row->cell();
$two = $row->cell();

$row->nextCell($one) === $two; // true
$row->nextCell($two); // a new row
```

### Cell

These objects represent cells in a table row.

See `Spannable` below for information on setting the column spanning.

See `Classable` below for information on setting the cells' classes.

See `Attributable` below for information on setting other attributes on the cell element.

There are a few other useful methods:

#### `$cell->content($content)`

Sets the content of a cell. You can use this to change the content of a cell after initialisation.

This returns the cell object for chaining.

#### `$cell->escape(bool $escape = true)` `$cell->dontEscape()` `$cell->raw()`

These control how the content given to the cell is rendered. The latter two are all eqivalent to calling `->escape(false)`.

These all return the cell object for chaining.

#### `$cell->wrapContent(string $opening, string $content, string $closing)`

This lets you enter some unescaped HTML that wrap some escaped content. Essentially, all this does is escape the `$content` value, then concatenate them in order, and set the cell to `->raw()` or `->dontEscape()`. Nevertheless, it can still be helpful - allowing you to mix your own unescaped HTML with some content that should be escaped.

As with any unescaped content, it is up to you to ensure the HTML is valid.

For example:

```php
$cell->wrapContent('<a href="edit/2">', $user->first_name, '</a>');
// if $user->first_name is James
// <td><a href="edit/2">James</a></td>
// if $user->first_name is <James>
// <td><a href="edit/2">&lt;James&gt;</a></td>
```

This returns the cell object for chaining.

#### `$cell->cell(string $content = null)`

This creates a new "sibling" cell - ie. one immediately after it in the row. You can use this method to chain-create cells in a row:

```php
// This is equivalent...
$row->cell('Cell 1')->cell('Cell 2')->cell('Cell 3');

// ...to this
$row->cell('Cell 1');
$row->cell('Cell 2');
$row->cell('Cell 3');

### Spannable

On the `Cell` objects, you can call:

```php
// setting rowspan
$row->cell('A double height column')->spanRows(2);

// setting colspan
$row->cell('A triple width column')->spanColumns(3);
```

This returns the element object for chaining.

### Classable

On any of the element objects - `Table`, `Section`, `Row`, `Cell`, you can set the class. The following three examples all result in `<table class="ui table">`:

```php
// This is the semantic ui CSS framework table class
$table->class('ui table');

// You don't have to set the classes at the same time.
$table->class('ui')->class('table');

// You can pass an array of string
$table->class(['ui', 'table']);
```

This returns the element object for chaining.

### Attributable

You can set any other HTML attribute:

```php
$table->attribute('foo', 'bar');
```

This returns the element object for chaining.
