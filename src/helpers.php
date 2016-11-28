<?php

namespace Tlr\Tables
{
    /**
     * Escape HTML special characters in a string.
     *
     * Taken from illuminate/support 5.3 - https://github.com/laravel/framework/blob/5.3/src/Illuminate/Support/helpers.php
     *
     * @param  \Illuminate\Contracts\Support\Htmlable|string  $value
     * @return string
     */
    function e($value)
    {
        if ($value instanceof Htmlable) {
            return $value->toHtml();
        }

        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
    }

    /**
     * Returns all traits used by a trait and its traits.
     *
     * Taken from illuminate/support 5.3 - https://github.com/laravel/framework/blob/5.3/src/Illuminate/Support/helpers.php
     *
     * @param  string  $trait
     * @return array
     */
    function trait_uses_recursive($trait)
    {
        $traits = class_uses($trait);

        foreach ($traits as $trait) {
            $traits += trait_uses_recursive($trait);
        }

        return $traits;
    }

    /**
     * Returns all traits used by a class, its subclasses and trait of their traits.
     *
     * Taken from illuminate/support 5.3 - https://github.com/laravel/framework/blob/5.3/src/Illuminate/Support/helpers.php
     *
     * @param  object|string  $class
     * @return array
     */
    function class_uses_recursive($class)
    {
        if (is_object($class)) {
            $class = get_class($class);
        }

        $results = [];

        foreach (array_merge([$class => $class], class_parents($class)) as $class) {
            $results += trait_uses_recursive($class);
        }

        return array_unique($results);
    }
}
