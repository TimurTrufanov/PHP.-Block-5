<?php

namespace Payment;

class CreditCardPayment implements PaymentMethod
{
    private string $cardNumber;
    private string $expirationDate;

    public function __construct(string $cardNumber, string $expirationDate)
    {
        $this->cardNumber = $cardNumber;
        $this->expirationDate = $expirationDate;
    }

    public function processPayment(float $amount): string
    {
        return "Processed payment of $amount using credit card: $this->cardNumber, exp: $this->expirationDate.";
    }
}