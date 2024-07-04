<?php

namespace App\Util;

use App\PragmaGoTech\FeeCalculatorInterface;
use App\PragmaGoTech\Model\LoanProposal;

class LoanCalculator implements FeeCalculatorInterface
{
    /*
     *   We assume that fees will always be ordered by amount ascending.
     *   In case if fees will be stored in database, we can always use ORDER BY clause while retrieving them
     */

    private static array $loanFees12Months = [
        ['amount' => 1000, 'fee' => 50],
        ['amount' => 2000, 'fee' => 90],
        ['amount' => 3000, 'fee' => 90],
        ['amount' => 4000, 'fee' => 115],
        ['amount' => 5000, 'fee' => 100],
        ['amount' => 6000, 'fee' => 120],
        ['amount' => 7000, 'fee' => 140],
        ['amount' => 8000, 'fee' => 160],
        ['amount' => 9000, 'fee' => 180],
        ['amount' => 10000, 'fee' => 200],
        ['amount' => 11000, 'fee' => 220],
        ['amount' => 12000, 'fee' => 240],
        ['amount' => 13000, 'fee' => 260],
        ['amount' => 14000, 'fee' => 280],
        ['amount' => 15000, 'fee' => 300],
        ['amount' => 16000, 'fee' => 320],
        ['amount' => 17000, 'fee' => 340],
        ['amount' => 18000, 'fee' => 360],
        ['amount' => 19000, 'fee' => 380],
        ['amount' => 20000, 'fee' => 400],
    ];

    private static array $loanFees24Months = [
        ['amount' => 1000, 'fee' => 70],
        ['amount' => 2000, 'fee' => 100],
        ['amount' => 3000, 'fee' => 120],
        ['amount' => 4000, 'fee' => 160],
        ['amount' => 5000, 'fee' => 200],
        ['amount' => 6000, 'fee' => 240],
        ['amount' => 7000, 'fee' => 280],
        ['amount' => 8000, 'fee' => 320],
        ['amount' => 9000, 'fee' => 360],
        ['amount' => 10000, 'fee' => 400],
        ['amount' => 11000, 'fee' => 440],
        ['amount' => 12000, 'fee' => 480],
        ['amount' => 13000, 'fee' => 520],
        ['amount' => 14000, 'fee' => 560],
        ['amount' => 15000, 'fee' => 600],
        ['amount' => 16000, 'fee' => 640],
        ['amount' => 17000, 'fee' => 680],
        ['amount' => 18000, 'fee' => 720],
        ['amount' => 19000, 'fee' => 760],
        ['amount' => 20000, 'fee' => 800],
    ];

    private static array $instances = [];

    private function getBounds(
        int $months,
        int $amount
    ): array
    {
        $fees = $months === 24 ? self::$loanFees24Months : self::$loanFees12Months;

        $lesserValues = array_filter($fees, fn (array $fee) => $fee['amount'] <= $amount);
        $greaterValues = array_filter($fees, fn (array $fee) => $fee['amount'] >= $amount);

        return ([
            $lesserValues[array_key_last($lesserValues)],
            $greaterValues[array_key_first($greaterValues)],
        ]);
    }

    protected function __construct() {}
    protected function __clone() {}

    public static function getInstance(): FeeCalculatorInterface
    {
        $self = static::class;
        if (!isset(self::$instances[$self])) {
            self::$instances[$self] = new static();
        }
        return self::$instances[$self];
    }

    public function calculate(LoanProposal $loanProposal): float
    {
        $bounds = $this->getBounds($loanProposal->getTerm(), $loanProposal->getAmount());

        $ratio = array_sum(array_map(fn ($b) => $b['amount'], $bounds)) / array_sum(array_map(fn ($b) => $b['fee'], $bounds));

        return (float)($loanProposal->getAmount() / $ratio);
    }
}