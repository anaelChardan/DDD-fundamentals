<?php

namespace spec\SnackMachine;

use PhpSpec\ObjectBehavior;
use SnackMachine\Money;
use SnackMachine\SnackMachine;

class SnackMachineSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith();
    }

    public function it_should_have_type()
    {
        $this->shouldBeAnInstanceOf(SnackMachine::class);
    }

    public function it_contains_no_money_at_the_beginnning()
    {
        $this->getMoneyInTransaction()->shouldBeAMoneyLike(Money::none());
        $this->getMoneyInside()->shouldBeAMoneyLike(Money::none());
    }

    public function it_returns_empty_moneys_in_transaction(Money $money)
    {
        $money->getOneCentCount()->willReturn(1);
        $money->getTenCentCount()->willReturn(0);
        $money->getQuarterCount()->willReturn(0);
        $money->getOneDollarCount()->willReturn(0);
        $money->getFiveDollarCount()->willReturn(0);
        $money->getTwentyDollarCount()->willReturn(0);

        $this->insertMoney($money);
        $this->getMoneyInTransaction()->shouldBeAMoneyLike($money);
    }

    public function it_returns_money_correctly(Money $money, Money $result)
    {
        $money->getOneCentCount()->willReturn(1);
        $money->getTenCentCount()->willReturn(0);
        $money->getQuarterCount()->willReturn(0);
        $money->getOneDollarCount()->willReturn(0);
        $money->getFiveDollarCount()->willReturn(0);
        $money->getTwentyDollarCount()->willReturn(0);

        $result->getOneCentCount()->willReturn(0);
        $result->getTenCentCount()->willReturn(0);
        $result->getQuarterCount()->willReturn(0);
        $result->getOneDollarCount()->willReturn(0);
        $result->getFiveDollarCount()->willReturn(0);
        $result->getTwentyDollarCount()->willReturn(0);

        $this->insertMoney($money);
        $this->returnMoney();
        $this->getMoneyInTransaction()->shouldBeAMoneyLike($result);
    }

    public function it_accept_only_one_coin_or_note_at_a_time(Money $valid, Money $invalid)
    {
        $valid->getOneCentCount()->willReturn(1);
        $valid->getTenCentCount()->willReturn(0);
        $valid->getQuarterCount()->willReturn(0);
        $valid->getOneDollarCount()->willReturn(0);
        $valid->getFiveDollarCount()->willReturn(0);
        $valid->getTwentyDollarCount()->willReturn(0);

        $invalid->getOneCentCount()->willReturn(1);
        $invalid->getTenCentCount()->willReturn(1);
        $invalid->getQuarterCount()->willReturn(0);
        $invalid->getOneDollarCount()->willReturn(0);
        $invalid->getFiveDollarCount()->willReturn(0);
        $invalid->getTwentyDollarCount()->willReturn(0);

        $this->insertMoney($valid);
        $this->getMoneyInTransaction()->shouldBeAMoneyLike($valid);

        $this
            ->shouldThrow(new \InvalidArgumentException('You cannot insert more than one piece of money at time'))
            ->during('insertMoney', [$invalid])
        ;
    }

    public function it_put_money_in_transaction_to_money_inside_when_we_buy_snack()
    {
        $moneyResult = new Money(0, 0, 0, 2);
        $this->insertMoney(Money::dollar());
        $this->insertMoney(Money::dollar());
        $this->getMoneyInTransaction()->shouldBeAMoneyLike($moneyResult);
        $this->buySnack();
        $this->getMoneyInTransaction()->shouldBeAMoneyLike(Money::none());
        $this->getMoneyInside()->shouldBeAMoneyLike($moneyResult);
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