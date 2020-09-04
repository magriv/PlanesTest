<?php

namespace Tests\TestCase\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HangarControllerTest extends WebTestCase
{
    private const WRONG_HANGAR_NAME = 'test';
    private const HANGAR_NAME = 'aeroprakt';

    public function testGetPlanesNotFound(): void
    {
        $response = $this->doRequest(self::WRONG_HANGAR_NAME);
        static::assertSame(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    public function testGetPlanes(): void
    {
        $response = $this->doRequest(self::HANGAR_NAME);

        static::assertSame(Response::HTTP_OK, $response->getStatusCode());
        $planesData = \json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);

        static::assertCount(10, $planesData);
        array_walk($planesData, static function ($planeData) {
            static::assertArrayHasKey('name', $planeData);
        });
    }

    private function doRequest(string $hangar): Response
    {
        $client = static::createClient();
        $client->request(
            Request::METHOD_GET,
            $this->buildUrl($hangar)
        );
        return $client->getResponse();
    }

    private function buildUrl(string $hangar): string
    {
        return sprintf('/api/v1/hangars/%s/planes', $hangar);
    }
}