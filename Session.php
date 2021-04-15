<?php

class Session
{
    public function __construct()
    {
        session_start();
    }

    public function addFightStats(BattleResult $battleResult): void
    {
        $_SESSION['fight'][] = $battleResult;

        if (!isset ($_SESSION['fight'])) {
            $_SESSION['fight'] = [];
        }

        $_SESSION['fight'][] = [
            'winner' => [
        'ship_object' => $battleResult->getWinningShip(),
        'start_healsth' => $battleResult->getShip1Health(),
        'health_remain' => $battleResult->getShip1FinalHealth()
            ],
            'looser' => [
        'shipObject' => $battleResult->getLosingShip(),
        'start_health' => $battleResult->getShip2Health(),
        'health_remain' => $battleResult->getShip2FinalHealth()
            ]
        ];
    }

    public function getFightStats()
    {
        return $_SESSION['fight'] ?? null;
    }
}