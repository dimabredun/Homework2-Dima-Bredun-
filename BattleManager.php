<?php
class BattleManager
{
    /**
     * Our complex fighting algorithm!
     *
     * @param Ship $ship1
     * @param int $ship1Quantity
     * @param Ship $ship2
     * @param int $ship2Quantity
     *
     * @return BattleResult|null
     * @throws Exception
     */
    public function battle(
        Ship $ship1,
        int $ship1Quantity,
        Ship $ship2,
        int $ship2Quantity
    ): ?BattleResult {
        $ship1Health = $ship1->getStrength() * $ship1Quantity;
        $ship2Health = $ship2->getStrength() * $ship2Quantity;
        $ship1FinalHealth = $ship1Health;
        $ship2FinalHealth = $ship2Health;
        $ship1UsedJediPowers = false;
        $ship2UsedJediPowers = false;

        while ($ship1FinalHealth > 0 && $ship2FinalHealth > 0) {
            if ($this->isJediDestroyShipUsingTheForce($ship1)) {
                $ship2FinalHealth = 0;
                $ship1UsedJediPowers = true;
                break;
            }
            if ($this->isJediDestroyShipUsingTheForce($ship2)) {
                $ship1FinalHealth = 0;
                $ship2UsedJediPowers = true;
                break;
            }

            $ship1FinalHealth -= ($ship2->getWeaponPower() * $ship2Quantity);
            $ship2FinalHealth -= ($ship1->getWeaponPower() * $ship1Quantity);
        }

        if ($ship1FinalHealth <= 0 && $ship2FinalHealth <= 0) {
            //@TODO implement equal
            return null;
        } elseif ($ship1FinalHealth <= 0) {
            $winningShip = $ship2;
            $losingShip = $ship1;
            $usedJediPowers = $ship2UsedJediPowers;
            $winnerQuantity = $ship2Quantity;
            $looserQuantity = $ship1Quantity;
            $winnerFinalHealth = $ship2FinalHealth;
            $looserFinalHealth = $ship1FinalHealth;
        } else {
            $winningShip = $ship1;
            $losingShip = $ship2;
            $usedJediPowers = $ship1UsedJediPowers;
            $winnerQuantity = $ship1Quantity;
            $looserQuantity = $ship2Quantity;
            $winnerFinalHealth = $ship1FinalHealth;
            $looserFinalHealth = $ship2FinalHealth;
        }

        return new BattleResult(
            $winningShip,
            $losingShip,
            $winnerQuantity,
            $looserQuantity,
            $winningShip->getStrength() * $winnerQuantity,
            $losingShip->getStrength() * $looserQuantity,
            $winnerFinalHealth,
            $looserFinalHealth,
            $usedJediPowers
        );
    }

    /**
     * @param Ship $ship
     *
     * @return bool
     * @throws Exception
     */
    private function isJediDestroyShipUsingTheForce(Ship $ship): bool
    {
        return random_int(1, 100) <= $ship->getJediFactor();
    }
}
