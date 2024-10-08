<?php

namespace Payment;

interface PaymentMethod
{
    public function processPayment(float $amount): string;
}