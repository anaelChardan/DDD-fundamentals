<?php

namespace spec\SnackMachine;

use SnackMachine\Money;
use PhpSpec\ObjectBehavior;

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

    function it_shoud_be_equals_to(Money $money1, Money $result)
    {
        $money1->getOneCentCount()->willReturn(1);
        $money1->getTenCentCount()->willReturn(2);
        $money1->getQuarterCount()->willReturn(3);
        $money1->getOneDollarCount()->willReturn(4);
        $money1->getFiveDollarCount()->willReturn(5);
        $money1->getTwentyDollarCount()->willReturn(6);

        $result->getOneCentCount()->willReturn(2);
        $result->getTenCentCount()->willReturn(4);
        $result->getQuarterCount()->willReturn(6);
        $result->getOneDollarCount()->willReturn(8);
        $result->getFiveDollarCount()->willReturn(10);
        $result->getTwentyDollarCount()->willReturn(12);

        $this->addMoney($money1)->shouldBeAMoneyLike($result);
    }

    public function getMatchers()
    {
        return [
            'beAMoneyLike' => function (Money $result, Money $expected) {
                return (
                    $result->getOneCentCount() == $expected->getOneCentCount() &&
                    $result->getTenCentCount() == $expected->getTenCentCount() &&
                    $result->getQuarterCount() == $expected->getQuarterCount() &&
                    $result->getOneDollarCount() == $expected->getOneDollarCount() &&
                    $result->getFiveDollarCount() == $expected->getFiveDollarCount() &&
                    $result->getTwentyDollarCount() == $expected->getTwentyDollarCount()
                );

            },
        ];
    }
}
