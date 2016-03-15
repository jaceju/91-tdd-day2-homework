<?php

namespace BookStore;

class DiscountCalculator
{
    private $books = [];
    private $total = 0;

    /**
     * @param Book $book
     */
    public function addBook(Book $book)
    {
        $this->books[] = $book;
    }

    /**
     *
     */
    public function calculateDiscount()
    {
        foreach ($this->books as $book) {
            $this->total += $book->price;
        }
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }
}
