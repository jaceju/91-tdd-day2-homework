<?php

namespace BookStore;

class Book
{
    private $name;
    private $price;

    /**
     * Book constructor.
     * @param $name
     * @param $price
     */
    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    /**
     * @param $name
     * @return null
     */
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        return null;
    }
}