<?php

namespace Payment;

class PayPalPayment implements PaymentMethod
{
    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function processPayment(float $amount): string
    {
        return "Processed payment of $amount using PayPal account: $this->email.";
    }
}