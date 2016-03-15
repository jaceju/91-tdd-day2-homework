<?php

namespace spec\BookStore;

use BookStore\Book;
use BookStore\DiscountCalculator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DiscountCalculatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DiscountCalculator::class);
    }

    function it_add_one_book_and_sum_should_be_100()
    {
        $this->addBook(new Book('哈利波特：神秘的魔法石', 100));
        $this->calculateDiscount();
        $this->getTotal()->shouldBe(100);
    }

    function it_add_two_different_books_and_sum_should_be_190()
    {
        $this->addBook(new Book('哈利波特：神秘的魔法石', 100));
        $this->addBook(new Book('哈利波特：消失的密室', 100));
        $this->calculateDiscount();
        $this->getTotal()->shouldBe(190);
    }

    function it_add_three_different_books_and_sum_should_be_270()
    {
        $this->addBook(new Book('哈利波特：神秘的魔法石', 100));
        $this->addBook(new Book('哈利波特：消失的密室', 100));
        $this->addBook(new Book('哈利波特：阿茲卡班的逃犯', 100));
        $this->calculateDiscount();
        $this->getTotal()->shouldBe(270);
    }
}
