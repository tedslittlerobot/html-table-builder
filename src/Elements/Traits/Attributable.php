<?php

namespace Tlr\Tables\Elements\Traits;

use Illuminate\Support\Collection;
use InvalidArgumentException;
use Tlr\Tables\Elements\Interfaces\Element;

trait Attributable {

    /**
     * The attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Get the reserved attributes
     *
     * @return array
     */
    protected function reservedAttributes()
    {
        return ['class', 'colspan', 'rowspan'];
    }

    /**
     * Set an attribute
     *
     * @param  string $name
     * @param  string $value
     * @return $this
     */
    public function attribute(string $name, string $value) : Element
    {
        if (in_array($name, $this->reservedAttributes())) {
            throw new InvalidArgumentException("The attribute [$name] is reserved.");
        }

        $this->attributes[$name] = $value;

        return $this;
    }

    /**
     * Get the attributes
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAttributes() : Collection
    {
        return collect($this->attributes);
    }

    /**
     * Render the attributes as a string
     *
     * @return string
     */
    public function renderAttributes() : string
    {
        return $this->getAttributes()->map(function(string $value, string $key) {
            return sprintf('%s="%s"', e($key), e($value));
        })->implode(' ');
    }
}
