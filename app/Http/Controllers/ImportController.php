<?php

namespace App\Http\Controllers;

use Validator;
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

        $limitCount = 0;
        $imported = 0;
        $skipped = 0;
        $dbData = [];

        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            $row = [
                'first_name' => $data[0] ?? '',
                'email' => $data[1] ?? '',
            ];

            $validator = Validator::make($row, [
                'first_name' => 'required|string',
                'email' => 'required|email',
            ]);

            if ($validator->fails()) {
                $skipped++;
                continue;
            }

            $dbData[] = $row;
            $imported++;
            $limitCount++;

            if ($limitCount > self::LIMIT) {
                DB::table('clients')->insert($dbData);
                $limitCount = 0;
                $dbData = [];
            }
        }
        fclose($handle);

        if (!empty($dbData)) {
            DB::table('clients')->insert($dbData);
        }

        return response()->json(['imported' => $imported, 'skipped' => $skipped]);
    }
}
