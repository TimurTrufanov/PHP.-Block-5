<?php
namespace Vehicle;

abstract class Vehicle
{
    protected string $brand;
    protected string $model;
    protected int $year;
    protected bool $rented = false;

    public function __construct(string $brand, string $model, int $year)
    {
        $this->brand = $brand;
        $this->model = $model;
        $this->year = $year;
    }

    abstract public function calculateRentalCost(int $days): float;

    public function getInfo(): string
    {
        return "Brand: $this->brand, Model: $this->model, Year: $this->year";
    }

    public function rent(): void
    {
        $this->rented = true;
    }

    public function isRented(): bool
    {
        return $this->rented;
    }
}