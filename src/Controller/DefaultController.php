<?php

namespace App\Controller;

use App\Service\ScheduleService;
use DateTime;
use Exception;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    private ScheduleService $service;

    private LoggerInterface $log;

    /**
     * DefaultController constructor.
     * @param ScheduleService $service
     * @param LoggerInterface $log
     */
    public function __construct(ScheduleService $service, LoggerInterface $log)
    {
        $this->service = $service;
        $this->log = $log;
    }

    /**
     * @Route("/", name="default")
     */
    public function all(): JsonResponse
    {
        try {
            $duties = $this->service->getAll();
            $data = [];

            foreach ($duties as $duty) {
                $data[] = [
                    'from' => $duty->getFrom()->format(DateTime::ISO8601),
                    'to' => $duty->getTo()->format(DateTime::ISO8601)
                ];
            }

            return new JsonResponse($data, Response::HTTP_OK);
        } catch (Exception $ex) {
            $this->log->error('cannot retrieve schedule', [
                'errorMessage' => $ex->getMessage(),
                'stack' => $ex->getTraceAsString()
            ]);
            return new JsonResponse('cannot retrieve online duties', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
