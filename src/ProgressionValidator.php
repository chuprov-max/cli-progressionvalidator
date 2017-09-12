<?php

namespace src;

use Exception;

class ProgressionValidator
{
    const PROGRESSION_ARITHMETIC = 1;
    const PROGRESSION_GEOMETRIC = 2;

    /**
     * @var string 
     */
    public $inputString;

    /**
     * @var [] 
     */
    private $numbers;

    /**
     * @var int|float 
     */
    private $difference;

    /**
     * @var int|float 
     */
    private $denominator;

    /**
     * @param string $inputString
     */
    public function __construct($inputString)
    {
        $this->inputString = $inputString;
        $this->numbers = explode(',', $this->inputString);
    }

    public function validate()
    {
        $this->validateArithmetic();
        echo PHP_EOL;
        $this->validateGeometric();
    }

    public function validateArithmetic()
    {
        if (count($this->numbers) < 2) {
            return $this->errorResponse();
        }
        try {
            $this->calculateDifference();

            for ($i = 1; $i < count($this->numbers); $i++) {
                $currentDifference = $this->formatNumeric($this->numbers[$i]) - $this->formatNumeric($this->numbers[$i - 1]);
                if (abs($currentDifference - $this->difference) >= 0.0001) {
                    return $this->errorResponse();
                }
            }
        } catch (Exception $e) {
            return $this->errorResponse();
        }

        return $this->successResponse();
    }

    public function validateGeometric()
    {
        if ((count($this->numbers) < 2) || ($this->numbers[0] === 0) || ($this->numbers[1] === 0)) {
            return $this->errorResponse(self::PROGRESSION_GEOMETRIC);
        }
        try {
            $this->calculateDenominator();

            for ($i = 1; $i < count($this->numbers); $i++) {
                $currentDenominator = $this->formatNumeric($this->numbers[$i]) / $this->formatNumeric($this->numbers[$i - 1]);
                if (abs($currentDenominator - $this->denominator) >= 0.0001) {
                    return $this->errorResponse(self::PROGRESSION_GEOMETRIC);
                }
            }
        } catch (Exception $e) {
            return $this->errorResponse(self::PROGRESSION_GEOMETRIC);
        }

        return $this->successResponse(self::PROGRESSION_GEOMETRIC);
    }

    protected function calculateDifference()
    {
        $this->difference = $this->formatNumeric($this->numbers[1]) - $this->formatNumeric($this->numbers[0]);
    }

    protected function calculateDenominator()
    {
        $this->denominator = $this->formatNumeric($this->numbers[1]) / $this->formatNumeric($this->numbers[0]);
    }

    /**
     * @param string $element
     * @return float
     * @throws Exception
     */
    protected function formatNumeric($element)
    {
        if (is_numeric($element)) {
            return floatval($element);
        }
        throw new Exception('Element is not numeric');
    }

    /**
     * @param string $type
     */
    protected function successResponse($type = self::PROGRESSION_ARITHMETIC)
    {
        if ($type == self::PROGRESSION_ARITHMETIC) {
            echo 'This is an arithmetic progression with difference = ' . $this->difference;
        } elseif ($type == self::PROGRESSION_GEOMETRIC) {
            echo 'This is an geometric progression with denominator = ' . $this->denominator;
        }
    }

    /**
     * @param string $type
     */
    protected function errorResponse($type = self::PROGRESSION_ARITHMETIC)
    {
        if ($type == self::PROGRESSION_ARITHMETIC) {
            echo 'This is not an arithmetical progression';
        } elseif ($type == self::PROGRESSION_GEOMETRIC) {
            echo 'This is not an geometric progression';
        }
    }
}
