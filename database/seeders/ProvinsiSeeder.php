<?php

namespace Database\Seeders;

use App\Models\Provinsi;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ProvinsiSeeder extends Seeder
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
        $spreadsheet = $reader->load(base_path('/database/sources/Provinsi.xlsx'));
        $sheet = $spreadsheet->getSheet($spreadsheet->getFirstSheetIndex());
        $data = $sheet->toArray();
        $data1 = [];
        foreach ($data as $value) {
            array_push($data1, $value);
        }

        foreach ($data1 as $row) {
            Provinsi::create([
                'id' => $row[0],
                'kd_provinsi' => $row[1],
                'nama' => $row[2],
            ]);
        }
    }
}
