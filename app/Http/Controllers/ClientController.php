<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientContact;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function getClients()
    {
        return Client::all();
    }

    public function getClient(Client $client)
    {
        return $client;
    }

    public function postClient(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'email' => 'required|string|email'
        ]);
        $client = Client::create($request->all());

        return response()->json($client, 201);
    }

    public function putClient(Request $request, Client $client)
    {
        $client->update($request->all());

        return response()->json($client, 200);
    }

    public function deleteClient(Client $client)
    {
        $client->delete();

        return response()->json(null, 204);
    }

    public function getClientContacts(Client $client)
    {
        return $client->contacts;
    }

    public function getClientContact(Client $client, ClientContact $clientContact)
    {
        return $clientContact;
    }

    public function postClientContact(Request $request, Client $client)
    {
        $clientContact = $client->contacts()->create($request->all());

        return response()->json($clientContact, 201);
    }

    public function putClientContact(Request $request, Client $client, ClientContact $clientContact)
    {
        $clientContact = $clientContact->update($request->all());

        return response()->json($clientContact, 200);
    }

    public function deleteClientContact(Client $client, ClientContact $clientContact)
    {
        $clientContact->delete();

        return response()->json(null, 204);
    }

}
