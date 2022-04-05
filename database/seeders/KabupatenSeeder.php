<?php

namespace Database\Seeders;

use App\Models\Kabupaten;
use Illuminate\Database\Seeder;

class KabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load(base_path('/database/sources/Kabupaten.xlsx'));
        $sheet = $spreadsheet->getSheet($spreadsheet->getFirstSheetIndex());
        $data = $sheet->toArray();
        $data1 = [];
        foreach ($data as $value) {
            array_push($data1, $value);
        }

        foreach ($data1 as $row) {
            Kabupaten::create([
                'id' => $row[0],
                'provinsi_id' => $row[1],
                'kd_kabupaten' => $row[2],
                'nama' => $row[3],
            ]);
        }
    }
}
