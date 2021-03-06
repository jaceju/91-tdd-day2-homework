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

    function it_add_four_different_books_and_sum_should_be_320()
    {
        $this->addBook(new Book('哈利波特：神秘的魔法石', 100));
        $this->addBook(new Book('哈利波特：消失的密室', 100));
        $this->addBook(new Book('哈利波特：阿茲卡班的逃犯', 100));
        $this->addBook(new Book('哈利波特：火盃的考驗', 100));
        $this->calculateDiscount();
        $this->getTotal()->shouldBe(320);
    }

    function it_add_five_different_books_and_sum_should_be_375()
    {
        $this->addBook(new Book('哈利波特：神秘的魔法石', 100));
        $this->addBook(new Book('哈利波特：消失的密室', 100));
        $this->addBook(new Book('哈利波特：阿茲卡班的逃犯', 100));
        $this->addBook(new Book('哈利波特：火盃的考驗', 100));
        $this->addBook(new Book('哈利波特：鳳凰會的密令', 100));
        $this->calculateDiscount();
        $this->getTotal()->shouldBe(375);
    }

    function it_add_three_different_books_and_one_same_book_and_sum_should_be_370()
    {
        $this->addBook(new Book('哈利波特：神秘的魔法石', 100));
        $this->addBook(new Book('哈利波特：消失的密室', 100));
        $this->addBook(new Book('哈利波特：阿茲卡班的逃犯', 100));
        $this->addBook(new Book('哈利波特：阿茲卡班的逃犯', 100));
        $this->calculateDiscount();
        $this->getTotal()->shouldBe(370);
    }

    function it_add_three_different_books_and_two_same_books_and_sum_should_be_460()
    {
        $this->addBook(new Book('哈利波特：神秘的魔法石', 100));
        $this->addBook(new Book('哈利波特：消失的密室', 100));
        $this->addBook(new Book('哈利波特：消失的密室', 100));
        $this->addBook(new Book('哈利波特：阿茲卡班的逃犯', 100));
        $this->addBook(new Book('哈利波特：阿茲卡班的逃犯', 100));
        $this->calculateDiscount();
        $this->getTotal()->shouldBe(460);
    }
}
