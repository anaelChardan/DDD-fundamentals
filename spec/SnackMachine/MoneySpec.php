<?php

namespace spec\SnackMachine;

use SnackMachine\Money;
use PhpSpec\ObjectBehavior;

class MoneySpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(1, 2, 3, 4, 5, 6);
    }

    public function it_should_have_type()
    {
        $this->shouldBeAnInstanceOf(Money::class);
    }

    public function it_should_do_the_addition_correctly(Money $money1, Money $result)
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

    public function it_should_do_the_substraction_correctly(Money $money1, Money $result)
    {
        $money1->getOneCentCount()->willReturn(1);
        $money1->getTenCentCount()->willReturn(2);
        $money1->getQuarterCount()->willReturn(3);
        $money1->getOneDollarCount()->willReturn(4);
        $money1->getFiveDollarCount()->willReturn(5);
        $money1->getTwentyDollarCount()->willReturn(6);

        $result->getOneCentCount()->willReturn(0);
        $result->getTenCentCount()->willReturn(0);
        $result->getQuarterCount()->willReturn(0);
        $result->getOneDollarCount()->willReturn(0);
        $result->getFiveDollarCount()->willReturn(0);
        $result->getTwentyDollarCount()->willReturn(0);

        $this->substractMoney($money1)->shouldBeAMoneyLike($result);
    }

    public function it_should_throw_an_exception_during_impossible_substraction(Money $money1)
    {
        $money1->getOneCentCount()->willReturn(2);
        $money1->getTenCentCount()->willReturn(2);
        $money1->getQuarterCount()->willReturn(3);
        $money1->getOneDollarCount()->willReturn(4);
        $money1->getFiveDollarCount()->willReturn(5);
        $money1->getTwentyDollarCount()->willReturn(6);

        $this
            ->shouldThrow(
                new \InvalidArgumentException('Cannot make the substraction')
            )->during('substractMoney', [$money1]);
    }

    public function it_should_get_the_right_amount()
    {
        $this->getAmount()->shouldReturn(149.96);
    }

    public function it_is_correct_about_equal_to(Money $money1)
    {
        $money1->getOneCentCount()->willReturn(1);
        $money1->getTenCentCount()->willReturn(2);
        $money1->getQuarterCount()->willReturn(3);
        $money1->getOneDollarCount()->willReturn(4);
        $money1->getFiveDollarCount()->willReturn(5);
        $money1->getTwentyDollarCount()->willReturn(6);

        $this->isEqualTo($money1)->shouldBe(true);
    }

    public function it_say_when_two_money_are_not_equals(Money $money1)
    {
        $money1->getOneCentCount()->willReturn(1);
        $money1->getTenCentCount()->willReturn(2);
        $money1->getQuarterCount()->willReturn(3);
        $money1->getOneDollarCount()->willReturn(4);
        $money1->getFiveDollarCount()->willReturn(5);
        $money1->getTwentyDollarCount()->willReturn(7);

        $this->isEqualTo($money1)->shouldBe(false);
    }

    public function it_cannot_create_money_with_negative_value()
    {
        $this->shouldThrow(
            new \InvalidArgumentException("Negative value not allowed")
        )->during('__construct', [-1, 2, 3, 4, 5, 6]);
    }

    public function it_know_what_is_a_simple_money(Money $notASimpleMoney)
    {
        $notASimpleMoney->getOneCentCount()->willReturn(1);
        $notASimpleMoney->getTenCentCount()->willReturn(2);
        $notASimpleMoney->getQuarterCount()->willReturn(3);
        $notASimpleMoney->getOneDollarCount()->willReturn(4);
        $notASimpleMoney->getFiveDollarCount()->willReturn(5);
        $notASimpleMoney->getTwentyDollarCount()->willReturn(7);

        $this::isASimpleMoney($notASimpleMoney)->shouldReturn(false);
        $this::isASimpleMoney(Money::dollar())->shouldReturn(true);
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
