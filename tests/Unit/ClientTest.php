<?php

namespace Tests\Unit;

class ClientTest extends AbstractBaseTest
{

    private static $clientId;
    private static $clientContactId;

    public function testGetClients()
    {
        $response = $this->json('GET', 'api/clients');

        $this->assertJson($response->getContent());
        $this->assertTrue($response->getStatusCode() == 200);
    }

    public function testPostClientsFailure()
    {
        $params = [
            'first_name' => 'John',
            'email' => time(),
        ];
        $response = $this->json('POST', 'api/clients', $params);

        $response->assertStatus(422);
    }

    public function testPostClientsSuccess()
    {
        $params = [
            'first_name' => 'John',
            'email' => time() . '@mail.loc',
        ];
        $response = $this->json('POST', 'api/clients', $params);

        $response->assertStatus(201);

        self::$clientId = $response->json('id');
    }

    public function testGetClient()
    {
        $response = $this->json('GET', 'api/clients/' . self::$clientId);

        $response
            ->assertStatus(200)
            ->assertJson([
                'first_name' => 'John',
            ]);
    }

    public function testPutClient()
    {
        $params = [
            'first_name' => 'Adam',
            'email' => time() . '@mail.loc',
        ];
        $response = $this->json('PUT', 'api/clients/' . self::$clientId, $params);

        $response
            ->assertStatus(200)
            ->assertJson([
                'first_name' => 'Adam',
            ]);
    }

    public function testPostClientContacts()
    {
        $params = [
            'address' => 'test address',
            'postcode' => 'test postcode'
        ];
        $response = $this->json('POST', sprintf('/api/clients/%s/contacts', self::$clientId), $params);

        $response->assertStatus(201);

        self::$clientContactId = $response->json('id');
    }

    public function testGetClientContacts()
    {
        $response = $this->json('GET', sprintf('/api/clients/%s/contacts', self::$clientId));

        $response
            ->assertStatus(200)
            ->assertJson([
                [
                    'address' => 'test address',
                    'postcode' => 'test postcode',
                ]
            ]);
    }

    public function testPutClientContacts()
    {
        $params = [
            'address' => 'test address2',
            'postcode' => 'test postcode2'
        ];
        $uri = sprintf('/api/clients/%s/contacts/%s', self::$clientId, self::$clientContactId);
        $response = $this->json('PUT', $uri, $params);

        $response->assertStatus(200);
    }

    public function testDeleteClientContacts()
    {
        $uri = sprintf('/api/clients/%s/contacts/%s', self::$clientId, self::$clientContactId);
        $response = $this->json('DELETE', $uri);

        $response->assertStatus(204);
    }

    public function testDeleteClient()
    {
        $response = $this->json('DELETE', 'api/clients/' . self::$clientId);

        $response->assertStatus(204);
    }

}
