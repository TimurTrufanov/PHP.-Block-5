<?php

namespace Rental;

use Exception;
use Vehicle\Vehicle;
use Payment\PaymentMethod;

class VehicleNotFoundException extends Exception {}
class PaymentProcessingException extends Exception {}

class RentalSystem
{
    private array $vehicles = [];

    public function addVehicle(Vehicle $vehicle): void
    {
        $this->vehicles[] = $vehicle;
    }


    /**
     * @throws VehicleNotFoundException
     * @throws PaymentProcessingException
     */
    public function rentVehicle(int $index, int $days, PaymentMethod $paymentMethod): string
    {
        if (!isset($this->vehicles[$index])) {
            throw new VehicleNotFoundException("Vehicle not found at index $index.");
        }

        $vehicle = $this->vehicles[$index];

        if ($vehicle->isRented()) {
            throw new VehicleNotFoundException("Vehicle at index $index is already rented.");
        }

        $cost = $vehicle->calculateRentalCost($days);

        try {
            $paymentResult = $paymentMethod->processPayment($cost);
        } catch (Exception $e) {
            throw new PaymentProcessingException("Error processing payment: " . $e->getMessage());
        }

        $vehicle->rent();

        return "Rental successful. " . $vehicle->getInfo() . " Cost: $cost. " . $paymentResult;
    }

    public function listVehicles(): array
    {
        $vehicleInfo = [];
        foreach ($this->vehicles as $index => $vehicle) {
            $rentedStatus = $vehicle->isRented() ? " (rented)" : "";
            $vehicleInfo[$index] = $vehicle->getInfo() . $rentedStatus;
        }
        return $vehicleInfo;
    }

    /**
     * @throws VehicleNotFoundException
     */
    public function removeVehicle(int $index): void
    {
        if (!isset($this->vehicles[$index])) {
            throw new VehicleNotFoundException("Vehicle not found at index $index.");
        }
        unset($this->vehicles[$index]);
    }

    /**
     * @throws VehicleNotFoundException
     */
    public function updateVehicle(int $index, Vehicle $newVehicle): void
    {
        if (!isset($this->vehicles[$index])) {
            throw new VehicleNotFoundException("Vehicle not found at index $index.");
        }
        $this->vehicles[$index] = $newVehicle;
    }
}