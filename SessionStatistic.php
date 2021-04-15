<?php

class SessionStatistic
{
    private const STATISTIC_KEY = 'statistic';

    /**
     * Session constructor.
     */
    public function __construct()
    {
        $this->start();
    }

    /**
     * @return void
     */
    private function start(): void
    {
        if (!$this->isSessionExists()) {
            session_start();
        }
    }

    /**
     * Does a session exist
     *
     * @return bool
     */
    private function isSessionExists(): bool
    {
        if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
            return false;
        }
        return true;
    }

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