<?php

class StatCenter
{
    public const STATISTIC_KEY = 'statistic';

    /**
     * @param BattleResult $battleResult
     *
     * @return void
     */
    public function addFightStats(BattleResult $battleResult): void
    {
        if (!isset($_SESSION[self::STATISTIC_KEY])) {
            $_SESSION[self::STATISTIC_KEY] = [];
        }

        $_SESSION[self::STATISTIC_KEY][] = $battleResult;
    }

    /**
     * @return BattleResult[]|null
     */
    public function getFightStats(): ?array
    {
        return $_SESSION[self::STATISTIC_KEY] ?? null;
    }

    /**
     * @return int
     */
    public function countBattles(): int
    {
        if (!isset($_SESSION[self::STATISTIC_KEY])) {
            return 0;
        }

        return count($_SESSION[self::STATISTIC_KEY]);
    }

    /**
     * Clear the session data
     *
     * @return void
     */
    public function clear(): void
    {
        if (isset($_SESSION[self::STATISTIC_KEY])) {
            unset($_SESSION[self::STATISTIC_KEY]);
        }
    }
}