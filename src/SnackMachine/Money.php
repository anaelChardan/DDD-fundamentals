<?php

namespace SnackMachine;


class Money implements ValueObjectInterface
{
    /**
     * @var int
     */
    protected $oneCentCount = 0;

    /**
     * @var int
     */
    protected $tenCentCount = 0;

    /**
     * @var int
     */
    protected $quarterCount = 0;

    /**
     * @var int
     */
    protected $oneDollarCount = 0;

    /**
     * @var int
     */
    protected $fiveDollarCount = 0;

    /**
     * @var int
     */
    protected $twentyDollarCount = 0;

    /**
     * @param int $oneCentCount
     * @param int $tenCentCount
     * @param int $quarterCount
     * @param int $oneDollarCount
     * @param int $fiveDollarCount
     * @param int $twentyDollarCount
     */
    public function __construct(
        int $oneCentCount = 0,
        int $tenCentCount = 0,
        int $quarterCount = 0,
        int $oneDollarCount = 0,
        int $fiveDollarCount = 0,
        int $twentyDollarCount = 0
    ) {
        if (
            $oneCentCount < 0 ||
            $tenCentCount < 0 ||
            $quarterCount < 0 ||
            $oneDollarCount < 0 ||
            $fiveDollarCount < 0 ||
            $twentyDollarCount < 0
        ) {
            throw new \InvalidArgumentException("Negative value not allowed");
        }

        $this->oneCentCount = $oneCentCount;
        $this->tenCentCount = $tenCentCount;
        $this->quarterCount = $quarterCount;
        $this->oneDollarCount = $oneDollarCount;
        $this->fiveDollarCount = $fiveDollarCount;
        $this->twentyDollarCount = $twentyDollarCount;
    }

    /**
     * @return Money
     */
    public static function none(): Money
    {
        return new Money();
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return (
            $this->oneCentCount / 100 +
            $this->tenCentCount / 100 * 10 +
            $this->quarterCount / 100 * 25 +
            $this->oneDollarCount +
            $this->fiveDollarCount * 5 +
            $this->twentyDollarCount * 20
        );
    }

    /**
     * @param Money $money
     *
     * @return Money
     */
    public function addMoney(Money $money): Money
    {
        return new Money(
            $this->oneCentCount + $money->getOneCentCount(),
            $this->tenCentCount + $money->getTenCentCount(),
            $this->quarterCount + $money->getQuarterCount(),
            $this->oneDollarCount + $money->getOneDollarCount(),
            $this->fiveDollarCount + $money->getFiveDollarCount(),
            $this->twentyDollarCount + $money->getTwentyDollarCount()
        );
    }

    /**
     * @return int
     */
    public function getOneCentCount(): int
    {
        return $this->oneCentCount;
    }

    /**
     * @return int
     */
    public function getTenCentCount(): int
    {
        return $this->tenCentCount;
    }

    /**
     * @return int
     */
    public function getQuarterCount(): int
    {
        return $this->quarterCount;
    }

    /**
     * @return int
     */
    public function getOneDollarCount(): int
    {
        return $this->oneDollarCount;
    }

    /**
     * @return int
     */
    public function getFiveDollarCount(): int
    {
        return $this->fiveDollarCount;
    }

    /**
     * @return int
     */
    public function getTwentyDollarCount(): int
    {
        return $this->twentyDollarCount;
    }

    /**
     * @param Money $money
     *
     * @return Money
     */
    public function substractMoney(Money $money): Money
    {
        if (
            $this->oneCentCount < $money->getOneCentCount() ||
            $this->tenCentCount < $money->getTenCentCount() ||
            $this->quarterCount < $money->getQuarterCount() ||
            $this->oneDollarCount < $money->getOneDollarCount() ||
            $this->fiveDollarCount < $money->getFiveDollarCount() ||
            $this->twentyDollarCount < $money->getTwentyDollarCount()
        ) {
            throw new \InvalidArgumentException('Cannot make the substraction');
        }
        return new Money(
            $this->oneCentCount - $money->getOneCentCount(),
            $this->tenCentCount - $money->getTenCentCount(),
            $this->quarterCount - $money->getQuarterCount(),
            $this->oneDollarCount - $money->getOneDollarCount(),
            $this->fiveDollarCount - $money->getFiveDollarCount(),
            $this->twentyDollarCount - $money->getTwentyDollarCount()
        );
    }

    /**
     * @param Money $money
     *
     * @return bool
     */
    public static function isASimpleMoney(Money $money): bool
    {
        $singleMoney = [
            Money::cent(),
            Money::tenCent(),
            Money::quarter(),
            Money::dollar(),
            Money::fiveDollar(),
            Money::twentyDollar()
        ];

        return false !== Collection($singleMoney)->first(function (Money $current) use ($money) {
                return $current->isEqualTo($money);
            });
    }

    /**
     * @return Money
     */
    public static function cent(): Money
    {
        return new Money(1);
    }

    /**
     * @return Money
     */
    public static function tenCent(): Money
    {
        return new Money(0, 1);
    }

    /**
     * @return Money
     */
    public static function quarter(): Money
    {
        return new Money(0, 0, 1);
    }

    /**
     * @return Money
     */
    public static function dollar(): Money
    {
        return new Money(0, 0, 0, 1);
    }

    public static function fiveDollar(): Money
    {
        return new Money(0, 0, 0, 0, 1);
    }

    public static function twentyDollar(): Money
    {
        return new Money(0, 0, 0, 0, 0, 1);
    }

    /**
     * @param Money $money
     *
     * @return bool
     */
    public function isEqualTo(Money $money): bool
    {
        return (
            $this->oneCentCount == $money->getOneCentCount() &&
            $this->tenCentCount == $money->getTenCentCount() &&
            $this->quarterCount == $money->getQuarterCount() &&
            $this->oneDollarCount == $money->getOneDollarCount() &&
            $this->fiveDollarCount == $money->getFiveDollarCount() &&
            $this->twentyDollarCount == $money->getTwentyDollarCount()
        );
    }
}
