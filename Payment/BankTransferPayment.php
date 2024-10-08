<?php

namespace Payment;

class BankTransferPayment implements PaymentMethod {
    private string $bankAccount;

    public function __construct(string $bankAccount)
    {
        $this->bankAccount = $bankAccount;
    }

    public function processPayment(float $amount): string
    {
        return "Processed bank transfer of $amount to account: $this->bankAccount.";
    }
}