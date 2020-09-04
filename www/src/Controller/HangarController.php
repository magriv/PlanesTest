<?php

namespace App\Controller;

use App\Exception\HangarNotFoundException;
use App\Service\HangarService;
use App\Service\Response\AirplaneDTOFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class HangarController extends AbstractController
{
    private HangarService $hangarService;

    private SerializerInterface $serializerInterface;

    public function __construct(HangarService $hangarService, SerializerInterface $serializerInterface)
    {
        $this->hangarService = $hangarService;
        $this->serializerInterface = $serializerInterface;
    }

    /**
     * @Route(
     *     "api/v1/hangars/{hangar}/planes",
     *     methods={"GET"}
     * )
     *
     * @param string             $hangar
     * @param AirplaneDTOFactory $airplaneDTOFactory
     *
     * @return Response
     */
    public function getPlaneListByHangar(string $hangar, AirplaneDTOFactory $airplaneDTOFactory): Response
    {
        try {
            $airplanes = $this->hangarService->getAirplanesByHangar($hangar);
        } catch (HangarNotFoundException $e) {
            throw new NotFoundHttpException('Hangar not found');
        }

        $airplaneDTOs = $airplaneDTOFactory->createFromList($airplanes);

        return new JsonResponse($this->serializerInterface->serialize($airplaneDTOs, 'json'), Response::HTTP_OK, [], true);
    }
}
