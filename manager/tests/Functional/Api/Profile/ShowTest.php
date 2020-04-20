<?php

declare(strict_types=1);

namespace App\Tests\Functional\Api\Profile;

use App\Tests\Functional\DbWebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ShowTest extends DbWebTestCase
{
    private const URI = '/api/profile';

    public function testGuest(): void
    {
        $this->client->request('GET', self::URI);

        self::assertEquals(Response::HTTP_UNAUTHORIZED, $this->client->getResponse()->getStatusCode());
    }

    public function testUser()
    {
        $this->client->setServerParameters(ProfileFixture::userCredentials());
        $this->client->request('GET', self::URI);

        self::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        self::assertJson($content = $this->client->getResponse()->getContent());

        $data = json_decode($content, true);

        self::assertEquals([
            'id' => ProfileFixture::USER_ID,
            'email' => 'profile-user@app.test',
            'name' => [
                'first' => 'Profile',
                'last' => 'User',
            ],
            'networks' => [
                [
                    'name' => 'facebook',
                    'identity' => '1111',
                ]
            ],
        ], $data);
    }
}