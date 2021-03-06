<?php

namespace BookStore;

class DiscountCalculator
{
    private $allUniqueBooks = [];
    private $total = 0;

    /**
     * @param Book $book
     */
    public function addBook(Book $book)
    {
        if (!$this->addBookToUniqueBooks($book)) {
            $this->addFirstBook($book);
        }
    }

    /**
     *
     */
    public function calculateDiscount()
    {
        foreach ($this->getAllUniqueBooks() as $uniqueBooks) {
            $this->calculateTotalByUniqueBooks($uniqueBooks);
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
     * @param array $books
     * @return float|int
     */
    private function getDiscountByUniqueBooks(array $books)
    {
        $count = count($books);
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
        $total = $this->getTotalByUniqueBooks($books);
        $discount = $this->getDiscountByUniqueBooks($books);
        $this->total += $total * $discount;
    }

    /**
     * @param Book $book
     */
    private function addFirstBook(Book $book)
    {
        $this->allUniqueBooks[] = [
            $book->name => $book,
        ];
    }

    /**
     * @param Book $book
     * @return bool
     */
    private function addBookToUniqueBooks(Book $book)
    {
        foreach ($this->allUniqueBooks as &$uniqueBooks) {
            if (!array_key_exists($book->name, $uniqueBooks)) {
                $uniqueBooks[$book->name] = $book;
                return true;
            }
        }
        return false;
    }

    /**
     * @return array
     */
    private function getAllUniqueBooks()
    {
        return $this->allUniqueBooks;
    }
}