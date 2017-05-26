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

    /**
     * @param Money $money
     */
    public function insertMoney(Money $money): void {
        $this->moneyInTransaction = $this->moneyInTransaction->addMoney($money);
    }

    /**
     * void
     */
    public function returnMoney(): void
    {
//        $this->moneyInTransaction = 0;
    }

    /**
     * Buy
     */
    public function buySnack()
    {
        $this->moneyInside = $this->moneyInside->addMoney($this->moneyInTransaction);
//        $this->moneyInTransaction = 0;
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