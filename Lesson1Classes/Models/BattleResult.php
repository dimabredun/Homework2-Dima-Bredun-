<?php
class BattleResult
{
    public const WINNER_KEY = 'winner';
    public const LOOSER_KEY = 'looser';
    public const SHIP_OBJECT_KEY = 'ship_object';
    public const START_HEALTH_KEY = 'start_health';
    public const REMAIN_HEALTH_KEY = 'health_remain';
    public const QTY_KEY = 'qty';

    /**
     * @var bool
     */
    private bool $usedJediPower;

    /**
     * @var mixed[]
     */
   private $statistic = [];

    /**
     * BattleResult constructor.
     * @param Ship $winningShip
     * @param Ship $losingShip
     * @param int $qty1
     * @param int $qty2
     * @param int $winnerHealth
     * @param int $looserHealth
     * @param int $remainWinnerHealth
     * @param int $remainLooserHealth
     * @param bool $usedJediPower
     */
    public function __construct(
        Ship $winningShip,
        Ship $losingShip,
        int $qty1,
        int $qty2,
        int $winnerHealth,
        int $looserHealth,
        int $remainWinnerHealth,
        int $remainLooserHealth,
        bool $usedJediPower
    ) {
       $this->setStatistic(
           $winningShip,
           $losingShip,
           $qty1,
           $qty2,
           $winnerHealth,
           $looserHealth,
           $remainWinnerHealth,
           $remainLooserHealth
       );
       $this->usedJediPower = $usedJediPower;
    }

    /**
     * @param Ship $winningShip
     * @param Ship $losingShip
     * @param int $qtyW
     * @param int $qtyL
     * @param int $healthW
     * @param int $healthL
     * @param int $remainHealthW
     * @param int $remainHealthL
     *
     * @return $this
     */
    public function setStatistic(
        Ship $winningShip,
        Ship $losingShip,
        int $qtyW,
        int $qtyL,
        int $healthW,
        int $healthL,
        int $remainHealthW,
        int $remainHealthL
    ): self {
        $this->statistic = [
            self::WINNER_KEY => [
                self::SHIP_OBJECT_KEY => $winningShip,
                self::START_HEALTH_KEY => $healthW,
                self::REMAIN_HEALTH_KEY => $remainHealthW,
                self::QTY_KEY => $qtyW,
            ],
            self::LOOSER_KEY => [
                self::SHIP_OBJECT_KEY => $losingShip,
                self::START_HEALTH_KEY => $healthL,
                self::REMAIN_HEALTH_KEY => $remainHealthL,
                self::QTY_KEY => $qtyL,
            ],
        ];

        return $this;
    }

    /**
     * @param bool $isWinner
     * @return Ship|null
     */
    public function getBattleShip(bool $isWinner = true): ?Ship
    {
        if ($isWinner) {
            $key = self::WINNER_KEY;
        } else {
            $key = self::LOOSER_KEY;
        }

        return $this->statistic[$key][self::SHIP_OBJECT_KEY] ?? null;
    }

    /**
     * @return mixed[]
     */
    public function getStatistic(): array
    {
        return $this->statistic;
    }

    /**
     * @return bool
     */
    public function isUsedJediPower(): bool
    {
        return $this->usedJediPower;
    }

    /**
     * @param bool $usedJediPower
     */
    public function setUsedJediPower(bool $usedJediPower): void
    {
        $this->usedJediPower = $usedJediPower;
    }

    /**
     * @return bool
     */
    public function isHereAWinner(): bool
    {
        return $this->getBattleShip() !== null;
    }
}