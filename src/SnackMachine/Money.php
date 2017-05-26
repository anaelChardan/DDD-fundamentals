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
       int $oneCentCount,
       int $tenCentCount,
       int $quarterCount,
       int $oneDollarCount,
       int $fiveDollarCount,
       int $twentyDollarCount
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
     * @param Money $money
     *
     * @return Money
     */
    public function addMoney(Money $money)
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
    public function getOneCentCount()
    {
        return $this->oneCentCount;
    }

    /**
     * @return int
     */
    public function getTenCentCount()
    {
        return $this->tenCentCount;
    }

    /**
     * @return int
     */
    public function getQuarterCount()
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
     * @return bool
     */
    public function equals(Money $money): bool
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
