<?php

namespace Database\Seeders;

use App\Models\Kelurahan;
use Illuminate\Database\Seeder;

class KelurahanSeeder extends Seeder
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
        $spreadsheet = $reader->load(base_path('/database/sources/Kelurahan_Desa.xlsx'));
        $sheet = $spreadsheet->getSheet($spreadsheet->getFirstSheetIndex());
        $data = $sheet->toArray();
        $data1 = [];
        foreach ($data as $value) {
            array_push($data1, $value);
        }

        foreach ($data1 as $row) {
            Kelurahan::create([
                'id' => $row[0],
                'kecamatan_id' => $row[1],
                'kd_kelurahan' => $row[2],
                'nama' => $row[3],
            ]);
        }
    }
}
