<?php

namespace Tlr\Tables\Elements\Traits;

use Illuminate\Support\Collection;
use Tlr\Tables\Elements\Interfaces\Element;

trait Classable {

    /**
     * The classes
     *
     * @var array
     */
    protected $classes = [];

    /**
     * Add a class
     *
     * @param string $class
     * @return  $this
     */
    public function class(string $class) : Element
    {
        return $this->classes([$class]);
    }

    /**
     * Add several classes
     *
     * @param string $class
     * @return  $this
     */
    public function classes(array $classes) : Element
    {
        $this->classes = array_merge($this->classes, $classes);

        return $this;
    }

    /**
     * Get the classes
     *
     * @return \Illuminate\Support\Collection
     */
    public function getClasses() : Collection
    {
        return collect($this->classes);
    }

    /**
     * Render the class attribute as a string
     *
     * @return string
     */
    public function renderClassAttribute() : string
    {
        if (!$this->classes) {
            return '';
        }

        return sprintf(
            'class="%s"',
            $this->getClasses()->map(function($item) {
                return e($item);
            })->implode(' ')
        );
    }
}
