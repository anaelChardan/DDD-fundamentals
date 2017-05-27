<?php

namespace SnackMachine;

class SnackMachine extends AbstractEntity implements EntityInterface
{
    /**
     * @var Money
     */
    protected $moneyInside;

    /**
     * @var Money
     */
    protected $moneyInTransaction;

    public function __construct()
    {
        parent::__construct();
        $this->moneyInside = Money::none();
        $this->moneyInTransaction = Money::none();
    }

    /**
     * @param Money $money
     */
    public function insertMoney(Money $money): void {
        if (!Money::isASimpleMoney($money))
        {
            throw new \InvalidArgumentException('You cannot insert more than one piece of money at time');
        }

        $this->moneyInTransaction = $this->moneyInTransaction->addMoney($money);
    }

    /**
     * void
     */
    public function returnMoney(): void
    {
        $this->moneyInTransaction = Money::none();
    }

    /**
     * Buy
     */
    public function buySnack()
    {
        $this->moneyInside = $this->moneyInside->addMoney($this->moneyInTransaction);
        $this->moneyInTransaction = Money::none();
    }

    /**
     * @return Money
     */
    public function getMoneyInside(): Money
    {
        return $this->moneyInside;
    }

    /**
     * @return Money
     */
    public function getMoneyInTransaction(): Money
    {
        return $this->moneyInTransaction;
    }
}