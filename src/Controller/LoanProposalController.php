<?php

namespace App\Controller;

use App\Service\LoanProposalBuilderService;
use App\Service\LoanProposalVerifierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class LoanProposalController extends AbstractController
{
    public function create(
        LoanProposalBuilderService $builderService,
        LoanProposalVerifierService $verifierService
    ): JsonResponse {
        $obj = $builderService->getObj();
        $verifierService->validate($obj);

        //todo: calculation and return json response
    }
}