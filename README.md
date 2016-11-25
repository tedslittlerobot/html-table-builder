# HTML Table Builder

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

More information to come...!
