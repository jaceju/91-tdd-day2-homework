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

        switch (count($this->books)) {
            case 2:
                $this->total *= 0.95;
                break;
            case 3:
                $this->total *= 0.9;
                break;
            case 4:
                $this->total *= 0.8;
                break;
            default:
                break;
        }
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return (int) $this->total;
    }
}
