<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImportController extends Controller
{

    const LIMIT = 100;

    public function postCsv(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);

        $path = $request->file('file')->getRealPath();
        $handle = fopen ( $path, 'r' );

        if ($handle === FALSE) {
            return response()->json([], 400);
        }

        $count = 0;
        $dbData = [];

        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            $row = [
                'first_name' => $data[0] ?? '',
                'email' => $data[1] ?? '',
            ];

            // todo add validation

            $dbData[] = $row;
            $count++;

            if ($count > self::LIMIT) {
                DB::table('clients')->insert($dbData);
                $count = 0;
                $dbData = [];
            }
        }
        fclose($handle);

        if (!empty($dbData)) {
            DB::table('clients')->insert($dbData);
        }

        return response()->json();
    }
}
