<?php
/**
 * Class Shipyard
 *
 * This class creates ship objects by a multi array of data with keys: name, weapon_power, jedi_factor, strength
 */
class Shipyard
{
    /**
     * @var mixed[][]
     */
    private array $shipData;

    /**
     * Shipyard constructor.
     * @param mixed[][] $shipData
     */
    public function __construct(array $shipData)
    {
        $this->shipData = $shipData;
    }

    /**
     * This function is making a complete ship from the array data
     *
     * @return Ship[]
     */
    public function getShips(): array
    {
        $shipsArray = [];

        foreach ($this->shipData as $shipKey => $shipInfo) {
                $shipObject = $this->createShip(
                    $shipKey,
                    $shipInfo[Ship::NAME_KEY],
                    $shipInfo[Ship::WEAPON_POWER] ?? 0,
                    $shipInfo[Ship::JEDI_FACTOR] ?? 0,
                    $shipInfo[Ship::STRENGTH] ?? 0
                );
                $shipsArray[$shipKey] = $shipObject;
            }

        return $shipsArray;
    }

    /**
     * this function might be useful in future if we will decide to create new ships
     * apart those which we have in our basic array
     *
     * @param mixed[][] $shipData
     * @return $this
     */
    public function setShipData(array $shipData): self
    {
        $this->shipData = $shipData;

        return $this;
    }

    /**
     * This functuon creating a new ship from 5 parameters of class Ship for the future use of getShip function
     *
     * @param string $identifier
     * @param string $name
     * @param int $weaponPower
     * @param int $jediFactor
     * @param int $strength
     * @return Ship
     */
    public function createShip(
        string $identifier,
        string $name,
        int $weaponPower,
        int $jediFactor,
        int $strength
    ): Ship {
        return new Ship($identifier, $name, $weaponPower, $jediFactor, $strength);
    }
}