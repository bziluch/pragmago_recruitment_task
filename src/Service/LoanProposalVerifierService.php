<?php

namespace App\Service;

use App\PragmaGoTech\Model\LoanProposal;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class LoanProposalVerifierService
{
    private ConstraintViolationListInterface $violations;

    public function __construct(
        private readonly ValidatorInterface $validator
    ) {}

    public function validate(LoanProposal $loanProposal): void {
        $this->violations = $this->validator->validate($loanProposal);
    }

    public function getViolations(): array {
        $violations = [];
        /** @var ConstraintViolation $error */
        foreach ($this->violations as $violation)
        {
            $violations[$violation->getPropertyPath()] = $violation->getMessage();
        }
        return $violations;
    }

    public function hasViolations(): bool {
        return $this->violations->count() > 0;
    }

}