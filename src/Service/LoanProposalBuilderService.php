<?php

namespace App\Service;

use App\PragmaGoTech\Model\LoanProposal;

class LoanProposalBuilderService extends AbstractBuilderService
{
    function buildObj(): void
    {
        $this->obj = new LoanProposal(
            (int)$this->request->get('term'),
            (float)$this->request->get('amount')
        );
    }

    public function getObj(): LoanProposal
    {
        return $this->obj;
    }
}