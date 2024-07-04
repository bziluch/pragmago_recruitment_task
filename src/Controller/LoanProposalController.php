<?php

namespace App\Controller;

use App\Service\LoanProposalBuilderService;
use App\Service\LoanProposalVerifierService;
use App\Util\LoanCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/loan-proposal', name: 'loan_proposal_')]
class LoanProposalController extends AbstractController
{
    #[Route('/calculate-fee', name: 'calculate_fee', methods: ['POST'])]
    public function calculateFee(
        LoanProposalBuilderService $builderService,
        LoanProposalVerifierService $verifierService
    ): JsonResponse {
        $obj = $builderService->getObj();
        $verifierService->validate($obj);

        if ($verifierService->hasViolations()) {
            return $this->json(
                ['violations' => $verifierService->getViolations()],
                Response::HTTP_BAD_REQUEST
            );
        }

        return $this->json([
            'fee' => LoanCalculator::getInstance()->calculate($obj)
        ]);
    }
}