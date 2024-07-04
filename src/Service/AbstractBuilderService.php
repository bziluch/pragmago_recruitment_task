<?php

namespace App\Service;

use App\Model\ApiObject;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

abstract class AbstractBuilderService
{
    protected Request $request;
    protected ApiObject $obj;

    public function __construct(
        private readonly RequestStack $requestStack
    ) {
        $this->request = $this->requestStack->getCurrentRequest();
        $this->buildObj();
    }

    abstract protected function buildObj(): void;
    abstract public function getObj(): ApiObject;
}