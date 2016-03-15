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
        if (empty($this->books)) {
            $this->addFirstBook($book);
        } else {
            $this->addUniqueBook($book);
        }
    }

    /**
     *
     */
    public function calculateDiscount()
    {
        foreach ($this->books as $books) {
            $this->calculateTotalByUniqueBooks($books);
        }
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

    /**
     * @param $books
     * @return int
     */
    private function getTotalByUniqueBooks($books)
    {
        $total = 0;
        foreach ($books as $book) {
            $total += $book->price;
        }
        return $total;
    }

    /**
     * @param $books
     */
    private function calculateTotalByUniqueBooks($books)
    {
        $count = count($books);
        $total = $this->getTotalByUniqueBooks($books);
        $discount = $this->getDiscountByUniqueCount($count);
        $this->total += $total * $discount;
    }

    /**
     * @param Book $book
     */
    private function addFirstBook(Book $book)
    {
        $this->books[] = [
            $book->name => $book,
        ];
    }

    /**
     * @param Book $book
     */
    private function addUniqueBook(Book $book)
    {
        foreach ($this->books as $index => $books) {
            if (array_key_exists($book->name, $books)) {
                $this->books[$index] = [];
            }
            $this->books[$index][$book->name] = $book;
        }
    }
}
