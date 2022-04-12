<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use alhimik1986\PhpExcelTemplator\params\CallbackParam;

use alhimik1986\PhpExcelTemplator\setters\CellSetterArrayValueSpecial;

use alhimik1986\PhpExcelTemplator\PhpExcelTemplator;
use alhimik1986\PhpExcelTemplator\params\ExcelParam;
use alhimik1986\PhpExcelTemplator\setters\CellSetterStringValue;
use alhimik1986\PhpExcelTemplator\setters\CellSetterArrayValue;
use alhimik1986\PhpExcelTemplator\setters\CellSetterArray2DValue;

use App\Models\Keluarga;
use DateTime;

class ExportKeluargaController extends Controller
{
    public $standarSelect = ['kd_kelurahan', 'kode_keluarga', 'nik_kk', 'nama_kk'];
    public $requestSelect = [];

    public function index(Request $request)
    {
        $result = [];
        $kdKelurahan = [];
        $kodeKeluarga = [];
        $nikKK = [];
        $namaKK = [];
        $kelurahan = [];
        $kecamatan = [];
        $kabupaten = [];
        $provinsi = [];

        $item = json_decode($request->export);
        $select = $this->addSelect($item);

        $query = Keluarga::whereProvince($item->province)->whereDistrict($item->district)->whereSubDistrict($item->subDistrict)
            ->baduta($item->baduta)
            ->balita($item->balita)
            ->pusHamil($item->pusHamil)
            ->pus($item->pus)
            ->anakTidakSekolah($item->anakTidakSekolah)
            ->tidakMemilikiSumberPenghasilan($item->tidakMemilikiSumberPenghasilan)
            ->lantaiTanah($item->lantaiTanah)
            ->tidakMakan($item->tidakMakan)
            ->praSejahtera($item->praSejahtera)
            ->tidakMemilikiSumberAir($item->tidakMemilikiSumberAir)
            ->tidakMemilikiJamban($item->tidakMemilikiJamban)
            ->tidakMemilikiRumah($item->tidakMemilikiRumah)
            ->pendidikanDibawah($item->pendidikanDibawah)
            ->terlaluMuda($item->terlaluMuda)
            ->terlaluTua($item->terlaluTua)
            ->terlaluDekat($item->terlaluDekat)
            ->terlaluBanyak($item->terlaluBanyak)
            ->kbrStunting($item->kbrStunting)
            ->get();


        foreach ($query as $sel) {
            array_push($result, []);
        }
        for ($i = 0; $i < count($query); $i++) {
            for ($j = 0; $j < count($this->requestSelect); $j++) {
                array_push($result[$i], $query[$i][$this->requestSelect[$j]]);
            }
            array_push($kdKelurahan, $query[$i]['kd_kelurahan']);
            array_push($kodeKeluarga, $query[$i]['kode_keluarga']);
            array_push($nikKK, $query[$i]['nik_kk']);
            array_push($namaKK, $query[$i]['nama_kk']);
            array_push($kelurahan, $query[$i]->kelurahan->nama);
            array_push($kecamatan, $query[$i]->kelurahan->kecamatan->nama);
            array_push($kabupaten, $query[$i]->kelurahan->kecamatan->kabupaten->nama);
            array_push($provinsi, $query[$i]->kelurahan->kecamatan->kabupaten->provinsi->nama);
        }


        $templateFile = 'templates/template_KBRS.xlsx';
        $fileName = 'exported_KBRS.xlsx';


        $header = $this->addHeader($item);

        $params = [
            '[kd_kelurahan]' => new ExcelParam(CellSetterArrayValueSpecial::class, $kdKelurahan),
            '[kode_keluarga]' => new ExcelParam(CellSetterArrayValueSpecial::class, $kodeKeluarga),
            '[nik_kk]' => new ExcelParam(CellSetterArrayValueSpecial::class, $nikKK),
            '[nama_kk]' => new ExcelParam(CellSetterArrayValueSpecial::class, $namaKK),
            '[kelurahan]' => new ExcelParam(CellSetterArrayValueSpecial::class, $kelurahan),
            '[kecamatan]' => new ExcelParam(CellSetterArrayValueSpecial::class, $kecamatan),
            '[kabupaten]' => new ExcelParam(CellSetterArrayValueSpecial::class, $kabupaten),
            '[provinsi]' => new ExcelParam(CellSetterArrayValueSpecial::class, $provinsi),
            '[[header]]' => new ExcelParam(CellSetterArray2DValue::class, $header),
            '[[body]]' => new ExcelParam(CellSetterArray2DValue::class, $result, function (CallbackParam $param) {
                $sheet = $param->sheet;
                $row_index = $param->row_index;
                $col_index = $param->col_index;
                $cell_coordinate = $param->coordinate;

                // $sheet->getStyle($cell_coordinate)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFB5FFA8');
                $sheet->getStyle($cell_coordinate)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM)->getColor()->setARGB('B5C0FF');
            }),

        ];
        PhpExcelTemplator::outputToFile($templateFile, $fileName, $params);
    }

    public function addSelect($item)
    {
        $item->baduta == true ?  array_push($this->requestSelect, 'baduta') : false;
        $item->balita == true ?  array_push($this->requestSelect, 'balita') : false;
        $item->pusHamil == true ?  array_push($this->requestSelect, 'pus') : false;
        $item->pus == true ?  array_push($this->requestSelect, 'pus_hamil') : false;
        $item->anakTidakSekolah == true ?  array_push($this->requestSelect, 'anak_tidak_sekolah') : false;
        $item->tidakMemilikiSumberPenghasilan == true ?  array_push($this->requestSelect, 'tidak_memiliki_sumber_penghasilan') : false;
        $item->lantaiTanah == true ?  array_push($this->requestSelect, 'lantai_tanah') : false;
        $item->tidakMakan == true ?  array_push($this->requestSelect, 'tidak_makan') : false;
        $item->praSejahtera == true ?  array_push($this->requestSelect, 'pra_sejahtera') : false;
        $item->tidakMemilikiSumberAir == true ?  array_push($this->requestSelect, 'tidak_memiliki_sumber_air') : false;
        $item->tidakMemilikiJamban == true ?  array_push($this->requestSelect, 'tidak_memiliki_jamban') : false;
        $item->tidakMemilikiRumah == true ?  array_push($this->requestSelect, 'tidak_memiliki_rumah') : false;
        $item->pendidikanDibawah == true ?  array_push($this->requestSelect, 'pendidikan_ibu_dibawah_sltp') : false;
        $item->terlaluMuda == true ?  array_push($this->requestSelect, 'terlalu_muda') : false;
        $item->terlaluTua == true ?  array_push($this->requestSelect, 'terlalu_tua') : false;
        $item->terlaluDekat == true ?  array_push($this->requestSelect, 'terlalu_dekat') : false;
        $item->terlaluBanyak == true ?  array_push($this->requestSelect, 'terlalu_banyak') : false;
        $item->kbrStunting == true ?  array_push($this->requestSelect, 'kbr_stunting') : false;

        $select = [];

        foreach ($this->standarSelect as $row) {
            array_push($select, $row);
        }
        foreach ($this->requestSelect as $row) {
            array_push($select, $row);
        }

        return $select;
    }

    public function addHeader($item)
    {
        $header = [
            [],
        ];
        $item->baduta == true ?  array_push($header[0], 'BADUTA') : false;
        $item->balita == true ?  array_push($header[0], 'BALITA') : false;
        $item->pusHamil == true ?  array_push($header[0], 'PUS') : false;
        $item->pus == true ?  array_push($header[0], 'PUS HAMIL') : false;
        $item->anakTidakSekolah == true ?  array_push($header[0], 'ADA ANAK 7-15 TAHUN TIDAK SEKOLAH') : false;
        $item->tidakMemilikiSumberPenghasilan == true ?  array_push($header[0], 'TIDAK ADA ANGGOTA KELUARGA MEMILIKI SUMBER PENGHASILAN UNTUK MEMENUHI KEBUTUHAN POKOK PER BULAN') : false;
        $item->lantaiTanah == true ?  array_push($header[0], 'JENIS LANTAI TANAH') : false;
        $item->tidakMakan == true ?  array_push($header[0], 'TIDAK SETIAP ANGGOTA KELUARGA MAKAN “MAKANAN BERAGAM” PALING SEDIKIT 2 (DUA) KALI SEHARI') : false;
        $item->praSejahtera == true ?  array_push($header[0], 'KELUARGA PRA SEJAHTERA') : false;
        $item->tidakMemilikiSumberAir == true ?  array_push($header[0], 'KELUARGA TIDAK MEMPUNYAI SUMBER AIR MINUM UTAMA YANG  LAYAK') : false;
        $item->tidakMemilikiJamban == true ?  array_push($header[0], 'KELUARGA TIDAK MEMPUNYAI JAMBAN YANG LAYAK') : false;
        $item->tidakMemilikiRumah == true ?  array_push($header[0], 'KELUARGA TIDAK MEMPUNYAI RUMAH LAYAK HUNI') : false;
        $item->pendidikanDibawah == true ?  array_push($header[0], 'PENDIDIKAN TERAKHIR IBU') : false;
        $item->terlaluMuda == true ?  array_push($header[0], 'TERLALU MUDA (UMUR ISTRI < 20 TAHUN)') : false;
        $item->terlaluTua == true ?  array_push($header[0], 'TERLALU TUA (UMUR ISTRI > 35 TAHUN)') : false;
        $item->terlaluDekat == true ?  array_push($header[0], 'TERLALU DEKAT (< 2 TAHUN)') : false;
        $item->terlaluBanyak == true ?  array_push($header[0], 'TERLALU BANYAK (≥ 3 ANAK)') : false;
        $item->kbrStunting == true ?  array_push($header[0], 'KATEGORI KELUARGA BERPOTENSI RISIKO STUNTING') : false;
        return $header;
    }

    public function kaseAman()
    {
        $now = new DateTime();
        $dateArr = [
            '01-06-2018',
            '02-06-2018',
            '03-06-2018',
            '04-06-2018',
            '05-06-2018',
        ];
        $codeArr = [
            '0001543',
            '0003274',
            '000726',
            '0012553',
            '0008245',
        ];
        $managerArr = [
            'Adams D.',
            'Baker A.',
            'Clark H.',
            'Davis O.',
            'Evans P.',
        ];
        $salesAmountArr = [
            '10 230 $',
            '45 100 $',
            '70 500 $',
            '362 180 $',
            '5 900 $',
        ];
        $salesManagerArr = [
            'Nalty A.',
            'Ochoa S.',
            'Patel O.',
        ];
        $hoursArr = [
            ['01', '02', '03', '04', '05', '06', '07', '08'],
        ];
        $numOfSalesByHours = [
            ['100', '200', '300', '400', '500', '600', '700', '800'],
            ['1000', '2000', '3000', '4000', '5000', '6000', '7000', '8000'],
            ['10000', '20000', '30000', '40000', '50000', '60000', '70000', '80000'],
            ['10000', '20000', '30000', '40000', '50000', '60000', '70000', '80000'],
            ['10000', '20000', '30000', '40000', '50000', '60000', '70000', '80000'],
            ['10000', '20000', '30000', '40000', '50000', '60000', '70000', '80000'],
        ];

        // $params = [
        //     '{current_date}' => new ExcelParam(CellSetterStringValue::class, $now->format('d-m-Y')),
        //     '{department}' => new ExcelParam(CellSetterStringValue::class, 'Sales department'),

        //     '[date]' => new ExcelParam(CellSetterArrayValue::class, $dateArr),
        //     '[code]' => new ExcelParam(CellSetterArrayValue::class, $codeArr),
        //     '[manager]' => new ExcelParam(CellSetterArrayValue::class, $managerArr),
        //     '[sales_amount]' => new ExcelParam(CellSetterArrayValue::class, $salesAmountArr),

        //     '[sales_manager]' => new ExcelParam(CellSetterArrayValue::class, $salesManagerArr),
        //     '[[hours]]' => new ExcelParam(CellSetterArray2DValue::class, $hoursArr),
        //     '[[sales_amount_by_hours]]' => new ExcelParam(CellSetterArray2DValue::class, $numOfSalesByHours),
        // ];
        // PhpExcelTemplator::outputToFile($templateFile, $fileName, $params);
    }
}
