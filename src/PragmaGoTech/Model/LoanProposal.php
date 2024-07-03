<?php

declare(strict_types=1);

namespace App\PragmaGoTech\Model;

/**
 * A cut down version of a loan application containing
 * only the required properties for this test.
 */
class LoanProposal
{

    public function __construct(
        private readonly int $term,
        private readonly float $amount)
    {}

    /**
     * Term (loan duration) for this loan application
     * in number of months.
     */
    public function getTerm(): int
    {
        return $this->term;
    }

    /**
     * Amount requested for this loan application.
     */
    public function getAmount(): float
    {
        return $this->amount;
    }
}
