<?php
/**
 * Class Errors
 *
 * This is the class with all the errors which might take place during the form sending
 */
class Errors
{
    public const MISSING_DATA_TYPE = 1;
    public const BAD_SHIPS_TYPE = 2;
    public const BAD_QUANTITIES_TYPE = 3;
    public const ERROR_KEY = 'error';

    /**
     * This array is a better replacement of previous switch case for errors
     *
     * @var string[]
     */
    private array $errorData = [
        self::MISSING_DATA_TYPE => 'Не забывайте выбрать корабли для битвы!',
        self::BAD_SHIPS_TYPE => 'Вы сражаетесь с кораблями с неизвестной галактики?',
        self::BAD_QUANTITIES_TYPE => 'Вы уверены в количестве кораблей дле сражения?',
    ];

    /**
     * @param string $errorType
     * @return string
     */
    public function getError(string $errorType): string
    {
        if (isset($this->errorData[$errorType])) {
            $errorMessage = $this->errorData[$errorType];
        } else {
            $errorMessage = 'Что-то с войском не так. Попробуйте снова.';
          }

       return $errorMessage;
    }
}