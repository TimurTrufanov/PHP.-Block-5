<?php

spl_autoload_register(function (string $class): void {
    $path = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
});

use Payment\BankTransferPayment;
use Payment\PayPalPayment;
use Vehicle\Car\Car;
use Vehicle\Motorcycle\Motorcycle;
use Rental\RentalSystem;
use Payment\CreditCardPayment;
use Rental\VehicleNotFoundException;
use Rental\PaymentProcessingException;

$rentalSystem = new RentalSystem();

$car1 = new Car("Toyota", "Corolla", 2020, 50);
$car2 = new Car("BMW", "X5", 2021, 100);
$motorcycle1 = new Motorcycle("Audi", "10R", 2024, 15);
$motorcycle2 = new Motorcycle("Forte", "FT-300-R1", 2021, 10);

$rentalSystem->addVehicle($car1);
$rentalSystem->addVehicle($car2);
$rentalSystem->addVehicle($motorcycle1);
$rentalSystem->addVehicle($motorcycle2);

$creditCardPayment = new CreditCardPayment("1234-5678-91234-5678", "12/25");

try {
    echo $rentalSystem->rentVehicle(0, 5, $creditCardPayment) . '<br>';
} catch (VehicleNotFoundException | PaymentProcessingException $e) {
    echo "Error: " . $e->getMessage() . '<br>';
}

try {
    echo $rentalSystem->rentVehicle(2, 3, $creditCardPayment) . '<br>';
} catch (VehicleNotFoundException | PaymentProcessingException $e) {
    echo "Error: " . $e->getMessage() . '<br>';
}

try {
    echo $rentalSystem->rentVehicle(0, 5, $creditCardPayment) . '<br>';
} catch (VehicleNotFoundException | PaymentProcessingException $e) {
    echo "Error: " . $e->getMessage() . '<br>';
}

$paypalPayment = new PayPalPayment("test@test.test");

try {
    echo $rentalSystem->rentVehicle(1, 2, $paypalPayment) . '<br>';
} catch (VehicleNotFoundException | PaymentProcessingException $e) {
    echo "Error: " . $e->getMessage() . '<br>';
}

$bankTransferPayment = new BankTransferPayment("1234567890");

try {
    echo $rentalSystem->rentVehicle(2, 3, $bankTransferPayment) . '<br>';
} catch (VehicleNotFoundException | PaymentProcessingException $e) {
    echo "Error: " . $e->getMessage() . '<br>';
}

try {
    echo $rentalSystem->rentVehicle(3, 1, $bankTransferPayment) . '<br>';
} catch (VehicleNotFoundException | PaymentProcessingException $e) {
    echo "Error: " . $e->getMessage() . '<br>';
}