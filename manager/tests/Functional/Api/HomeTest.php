<?php

declare(strict_types=1);

namespace App\Tests\Functional\Api;

use App\Tests\Functional\DbWebTestCase;
use Symfony\Component\HttpFoundation\Response;

class HomeTest extends DbWebTestCase
{
    public function testGet(): void
    {
        $this->client->request('GET', '/api');

        self::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        self::assertJson($content = $this->client->getResponse()->getContent());

        $data = json_decode($content, true);

        self::assertEquals(['name' => 'JSON API'], $data);
    }

    public function testPost(): void
    {
        $this->client->request('POST', '/api');

        self::assertEquals(Response::HTTP_METHOD_NOT_ALLOWED, $this->client->getResponse()->getStatusCode());
    }
}