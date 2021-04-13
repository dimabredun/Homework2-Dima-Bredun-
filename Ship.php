<?php
/**
 * Class Ship
 *
 * Data model Ship which contains some Ship data and it's data modificators
 */
class Ship
{
    public const IDENTIFIER = 'identifier';
    public const NAME_KEY = 'name';
    public const WEAPON_POWER = 'weapon_power';
    public const JEDI_FACTOR = 'jedi_factor';
    public const STRENGTH = 'strength';

    /**
     * @var string
     */
    private string $identifier;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var int
     */
    private int $weaponPower;

    /**
     * @var int
     */
    private int $jediFactor;

    /**
     * @var int
     */
    private int $strength;

    /**
     * Ship constructor.
     * @param string $identifier
     * @param string $name
     * @param int $weaponPower
     * @param int $jediFactor
     * @param int $strength
     */
    public function __construct(
        string $identifier,
        string $name,
        int $weaponPower = 0,
        int $jediFactor = 0,
        int $strength = 0
    ) {
        $this->identifier = $identifier;
        $this->name = $name;
        $this->weaponPower = $weaponPower;
        $this->jediFactor = $jediFactor;
        $this->strength = $strength;
    }

    /**
     * @return int
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @param $identifier
     * @return self
     */
    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getWeaponPower(): int
    {
        return $this->weaponPower;
    }

    /**
     * @param int $weaponPower
     * @return $this
     */
    public function setWeaponPower(int $weaponPower): self
    {
        $this->weaponPower = $weaponPower;

        return $this;
    }

    /**
     * @return int
     */
    public function getJediFactor(): int
    {
        return $this->jediFactor;
    }

    /**
     * @param int $jediFactor
     * @return $this
     */
    public function setJediFactor(int $jediFactor): self
    {
        $this->jediFactor = $jediFactor;

        return $this;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return $this->strength;
    }

    /**
     * @param int $strength
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setStrength(int $strength): self
    {
        if ($strength < 0) {
            throw new InvalidArgumentException();
        }

        $this->strength = $strength;

        return $this;
    }

    /**
     * @param bool $useShortSpec
     * @return string
     */
    public function getNameAndSpecs(bool $useShortSpec = true): string
    {
        if ($useShortSpec) {
            return sprintf(
                '%s %s/%s/%s',
                $this->name,
                $this->weaponPower,
                $this->jediFactor,
                $this->strength
            );
        }

        return sprintf(
            '%s (w:%s, j:%s, s:%s)',
            $this->name,
            $this->weaponPower,
            $this->jediFactor,
            $this->strength
        );
    }
}