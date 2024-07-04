<?php

declare(strict_types=1);

namespace App\PragmaGoTech\Model;

use App\Model\ApiObject;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A cut down version of a loan application containing
 * only the required properties for this test.
 */
class LoanProposal extends ApiObject
{
    #[Assert\Choice([12, 24])]
    private int $term;

    #[Assert\Range(
        min: 1000,
        max: 20000
    )]
    private float $amount;

    public function __construct(
        int $term,
        float $amount
    ) {
        $this->term = $term;
        $this->amount = $amount;
    }

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
