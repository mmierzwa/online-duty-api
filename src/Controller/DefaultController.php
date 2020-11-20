<?php

namespace App\Controller;

use App\Service\ScheduleService;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    private ScheduleService $service;

    /**
     * DefaultController constructor.
     * @param ScheduleService $service
     */
    public function __construct(ScheduleService $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/", name="default")
     */
    public function all(): JsonResponse
    {
        $duties = $this->service->getAll();
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
