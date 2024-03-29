<?php

declare(strict_types=1);

namespace App\Tests\Functional\Api\Work\Tasks;

use App\Tests\Functional\AuthFixture;
use App\Tests\Functional\DbWebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ShowTest extends DbWebTestCase
{
    private const URI = '/api/work/tasks/%s';

    public function testAdmin(): void
    {
        $this->client->setServerParameters(AuthFixture::adminCredentials());
        $this->client->request('GET', sprintf(self::URI, TaskFixture::TASK_IN_PROJECT_WITH_USER));

        self::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        self::assertJson($content = $this->client->getResponse()->getContent());
        $data = json_decode($content, true);

        self::assertArraySubset([
            'id' => TaskFixture::TASK_IN_PROJECT_WITH_USER,
            'name' => 'Task',
        ], $data);
    }

    public function testMember(): void
    {
        $this->client->setServerParameters(AuthFixture::userCredentials());
        $this->client->request('GET', sprintf(self::URI, TaskFixture::TASK_IN_PROJECT_WITH_USER));

        self::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        self::assertJson($content = $this->client->getResponse()->getContent());
        $data = json_decode($content, true);

        self::assertArraySubset([
            'id' => TaskFixture::TASK_IN_PROJECT_WITH_USER,
            'name' => 'Task',
        ], $data);
    }

    public function testNotMember(): void
    {
        $this->client->setServerParameters(AuthFixture::userCredentials());
        $this->client->request('GET', sprintf(self::URI, TaskFixture::TASK_IN_PROJECT_WITHOUT_USER));

        self::assertEquals(Response::HTTP_FORBIDDEN, $this->client->getResponse()->getStatusCode());
    }
}