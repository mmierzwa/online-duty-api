<?php

namespace App\Controller;

use App\Repository\OnlineDuty;
use App\Repository\OnlineDutyRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    private OnlineDutyRepository $repository;

    /**
     * DefaultController constructor.
     * @param OnlineDutyRepository $repository
     */
    public function __construct(OnlineDutyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/", name="default")
     */
    public function all(): JsonResponse
    {
        $duties = $this->repository->getAll();
        usort($duties, function (OnlineDuty $dutyA, OnlineDuty $dutyB) {
            return new DateTime($dutyA->getFrom() <=> $dutyB->getFrom());
        });
        $data = [];

        foreach ($duties as $duty) {
            $data[] = [
                'from' => $duty->getFrom()->format(DateTime::ISO8601),
                'to' => $duty->getTo()->format(DateTime::ISO8601)
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }
}
