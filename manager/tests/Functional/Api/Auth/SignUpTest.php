<?php

declare(strict_types=1);

namespace App\Tests\Functional\Api\Auth;

use App\Tests\Functional\DbWebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SignUpTest extends DbWebTestCase
{
    private const URI = '/api/auth/signup';

    public function testGet(): void
    {
        $this->client->request('GET', self::URI);

        self::assertEquals(Response::HTTP_METHOD_NOT_ALLOWED, $this->client->getResponse()->getStatusCode());
    }

    public function testSuccess(): void
    {
        $this->client->request(
            'POST',
            self::URI, [], [],
            ['CONTENT_TYPE' => 'application/json'], json_encode([
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'test-john@app.test',
                'password' => 'password'
        ]));

        self::assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());
        self::assertJson($content = $this->client->getResponse()->getContent());

        $data = json_decode($content, true);

        self::assertEquals([], $data);
    }

    public function testNotValid(): void
    {
        $this->client->request(
            'POST',
            self::URI, [], [],
            ['CONTENT_TYPE' => 'application/json'], json_encode([
            'first_name' => '',
            'last_name' => '',
            'email' => 'not-email',
            'password' => 'short'
        ]));

        self::assertEquals(Response::HTTP_BAD_REQUEST, $this->client->getResponse()->getStatusCode());
        self::assertJson($content = $this->client->getResponse()->getContent());

        $data = json_decode($content, true);

        self::assertArraySubset([
            'violations' => [
                ['propertyPath' => 'first_name', 'title' => 'This value should not be blank.'],
                ['propertyPath' => 'last_name', 'title' => 'This value should not be blank.'],
                ['propertyPath' => 'email', 'title' => 'This value is not a valid email address.'],
                ['propertyPath' => 'password', 'title' => 'This value is too short. It should have 6 characters or more.'],
            ]
        ], $data);
    }

    public function testExists(): void
    {
        $this->client->request(
            'POST',
            self::URI, [], [],
            ['CONTENT_TYPE' => 'application/json'], json_encode([
            'first_name' => 'Tom',
            'last_name' => 'Bent',
            'email' => 'existing-user@app.test',
            'password' => 'password'
        ]));

        self::assertEquals(Response::HTTP_BAD_REQUEST, $this->client->getResponse()->getStatusCode());
        self::assertJson($content = $this->client->getResponse()->getContent());

        $data = json_decode($content, true);

        self::assertArraySubset([
            'message' => 'User already exists.'
        ], $data);
    }
}