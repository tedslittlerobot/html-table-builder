<?php

namespace Tlr\Tables;

use InvalidArgumentException;
use Tlr\Tables as helpers;
use Tlr\Tables\Elements\Interfaces\Element;
use Tlr\Tables\Elements\Interfaces\HasChildren;
use Tlr\Tables\Elements\Interfaces\HasContent;
use Tlr\Tables\Elements\Traits\Attributable;
use Tlr\Tables\Elements\Traits\Classable;
use Tlr\Tables\Elements\Traits\Spannable;

class TableRenderer
{
    /**
     * Whether to indent the table or not
     *
     * @var bool
     */
    protected $pretty = false;

    /**
     * Get the current render depth
     *
     * @var int
     */
    protected $depth = 0;

    /**
     * Set the renderer to pretty print
     *
     * @param  boolean $pretty
     * @return \Tlr\Tables\TableRenderer
     */
    public function prettyPrint($pretty = true) : TableRenderer
    {
        $this->pretty = $pretty;

        return $this;
    }

    /**
     * Determine if the given object uses the trait
     *
     * @param  mixed $object
     * @param  string $trait
     * @return bool
     */
    protected function usesTrait($object, string $trait) : bool
    {
        return in_array($trait, helpers\class_uses_recursive($object));
    }

    /**
     * Get the attribute string for the element
     *
     * @param  Element $element
     * @return string
     */
    public function getAttributesForElement(Element $element) : string
    {
        $attributes = [];

        if ($this->usesTrait($element, Classable::class)) {
            $attributes[] = $element->renderClassAttribute();
        }

        if ($this->usesTrait($element, Spannable::class)) {
            $attributes[] = $element->renderSpanAttribute();
        }

        if ($this->usesTrait($element, Attributable::class)) {
            $attributes[] = $element->renderAttributes();
        }

        $attributes = array_filter($attributes);

        return $attributes ? ' ' . implode(' ', $attributes) : '';
    }

    /**
     * Get the content for the element
     *
     * @param  Element $element
     * @return string
     */
    public function getContentForElement(Element $element) : string
    {
        if ($element instanceof HasChildren && $element instanceof HasContent) {
            throw new InvalidArgumentException('An element can only implement one of HasChildren and HasContent');
        }

        if ($element instanceof HasChildren) {
            $renderedChildren = array_map(function(Element $element) {
                return $this->renderElement($element);
            }, $element->getChildren());

            return implode('', $renderedChildren);
        }

        if ($element instanceof HasContent) {
            return $element->getContent();
        }

        return '';
    }

    /**
     * Get the indentation for the current level
     *
     * @return string
     */
    public function indent(int $depth, string $content) : string
    {
        if (!$this->pretty) {
            return $content;
        }

        return PHP_EOL . str_repeat('    ', $this->depth) . $content;
    }

    /**
     * Render the element
     *
     * @return string
     */
    public function renderElement(Element $element) : string
    {
        // @todo - if the element implements neither HasContent or HasChildren, make it self-closing <img />
        // @todo - fix indentation - currently it adds an extra line as the middle indentation
        return $this->indent($this->depth, sprintf('<%s%s>', $element->getElement(), $this->getAttributesForElement($element))) .
            $this->indent($this->depth++, $this->getContentForElement($element)) .
            $this->indent(--$this->depth, sprintf('</%s>', $element->getElement()));
    }
}
