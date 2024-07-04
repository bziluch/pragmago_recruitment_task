<?php

declare(strict_types=1);

namespace App\PragmaGoTech;

use App\PragmaGoTech\Model\LoanProposal;

interface FeeCalculatorInterface
{
    /**
     * @return float The calculated total fee.
     */
    public function calculate(LoanProposal $loanProposal): float;
}
