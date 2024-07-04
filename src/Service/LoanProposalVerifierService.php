<?php

namespace App\Service;

use App\PragmaGoTech\Model\LoanProposal;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class LoanProposalVerifierService
{
    public function __construct(
        private readonly ValidatorInterface $validator
    ) {}

    public function validate(LoanProposal $loanProposal)
    {
        $errors = $this->validator->validate($loanProposal);

        if (!empty($errors)) {
            throw new BadRequestException(json_encode($errors));
        }
    }

}