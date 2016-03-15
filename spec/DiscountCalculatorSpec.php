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
}
