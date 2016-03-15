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
        $count = count($this->books);
        $discount = $this->getDiscountByUniqueCount($count);
        $this->total *= $discount;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return (int) $this->total;
    }

    /**
     * @param $count
     * @return float|int
     */
    private function getDiscountByUniqueCount($count)
    {
        switch ($count) {
            case 2:
                $discount = 0.95;
                break;
            case 3:
                $discount = 0.9;
                break;
            case 4:
                $discount = 0.8;
                break;
            case 5:
                $discount = 0.75;
                break;
            default:
                $discount = 1;
                break;
        }
        return $discount;
    }
}
