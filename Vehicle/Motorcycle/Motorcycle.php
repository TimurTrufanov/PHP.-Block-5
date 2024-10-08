<?php

namespace Vehicle\Motorcycle;

use Vehicle\Vehicle;

class Motorcycle extends Vehicle
{
    private float $hourlyRate;

    public function __construct(string $brand, string $model, int $year, float $hourlyRate)
    {
        parent::__construct($brand, $model, $year);
        $this->hourlyRate = $hourlyRate;
    }

    public function calculateRentalCost(int $days): float
    {
        $hours = $days * 24;
        return $this->hourlyRate * $hours;
    }
}