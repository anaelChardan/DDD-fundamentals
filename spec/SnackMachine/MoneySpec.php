<?php

namespace spec\SnackMachine;

use SnackMachine\Money;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MoneySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(1, 2, 3, 4, 5, 6);
    }

    function it_should_have_type()
    {
        $this->shouldBeAnInstanceOf(Money::class);
    }

    function it_shoud_be_equals_to(Money $money)
    {
        $money1 = new Money(1, 2, 3, 4, 5, 6);
        $money2 = new Money(2, 4, 6, 8, 10, 12);

        $money->getOneCentCount()->willReturn(2);
        $money->getTenCentCount()->willReturn(4);
        $money->getQuarterCount()->willReturn(6);
        $money->getOneDollarCount()->willReturn(8);
        $money->getFiveDollarCount()->willReturn(10);
        $money->getTwentyDollarCount()->willReturn(12);

        $this->addMoney($money1)->shouldReturn();
    }
}
