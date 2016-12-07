# HTML Table Builder

[![Build Status](https://travis-ci.org/tedslittlerobot/html-table-builder.svg?branch=master)](https://travis-ci.org/tedslittlerobot/html-table-builder)

A class-based, "fluent" HTML table builder in PHP.

```php
use Tlr\Tables\Elements\Table;

$table = new Table;

$table->class('ui celled table');

$row = $table->header()->row();
$row->cell('Name');
$row->cell('Age');
$row->cell('Something Else');

$row = $table->body()->row();

$row->cell('George');
$row->cell('12');
$row->cell('Food');

$table->footer()->row()
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

#### `$row->addCell(CellInterface $cell)`

This adds a new cell to the row. You can use this to add a custom cell to the row.

The following helper methods use this method to add the basic included cell types.

- `$row->cell(string $content = null)`
- `$row->linkCell(string $link)`
- `$row->imageCell(string $src)`

### Cells

These objects represent cells in a table row.

See `Spannable` below for information on setting the column spanning.

See `Classable` below for information on setting the cells' classes.

See `Attributable` below for information on setting other attributes on the cell element.

#### Content Cell

This is the default cell. It is fairly versatile, although basic.

You can set the content on initialiastaion, or by calling the `->content(string $content)` method.

The default behaviour is to escape the content. If you want to override this, chain in the `->dontEscape()` or `->raw()` methods.

There is a `->wrapContent(string $open, string $content, string $close)` method. This lets you enter some unescaped HTML that wrap some escaped content. Essentially, all this does is escape the `$content` value, then concatenate them in order, and set the cell to `->raw()` or `->dontEscape()`. Nevertheless, it can still be helpful - allowing you to mix your own unescaped HTML with some content that should be escaped.

As with any unescaped content, it is up to you to ensure the HTML is valid.

See below for some examples.

```php
$row->cell('Cat'); // <td>Cat</td>
$row->cell('<Cat>'); // <td>&lt;Cat&gt;</td>
$row->cell('<Cat>')->raw(); // <td><Cat></td>
$row->cell()->content('Cat'); // <td>Cat</td>
$row->cell()->wrapContent('<strong>', '<Cat>', '</strong>'); // <strong>&lt;Cat&gt;</strong>
```

#### Link Cell

A link cell is a cell with a link in it. Other than the link argument to its constructor, it behaves like a `ContentCell`

```php
$row->linkCell('https://google.com')->content('Visit Google.');
// <td><a href="https://google.com">Visit Google.</a></td>

$cell = new LinkCell('localhost')->content('<pre>some preformatted text</pre>')->raw();
```

#### Image Cell

```php
$row->imageCell('cat.jpg');
// <td><img src="cat.jpg" /></td>
```

### Traits

#### Spannable

On the `Cell` objects, you can call:

```php
// setting rowspan
$row->cell('A double height column')->spanRows(2);

// setting colspan
$row->cell('A triple width column')->spanColumns(3);
```

This returns the element object for chaining.

#### Classable

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

#### Attributable

You can set any other HTML attribute:

```php
$table->attribute('foo', 'bar');
```

This returns the element object for chaining.
