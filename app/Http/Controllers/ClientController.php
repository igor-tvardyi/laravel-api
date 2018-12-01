<?php

namespace App\Http\Controllers;

use App\Models\Client;
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

}
