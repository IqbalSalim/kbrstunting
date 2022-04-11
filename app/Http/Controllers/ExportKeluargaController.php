<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use alhimik1986\PhpExcelTemplator\PhpExcelTemplator;
use alhimik1986\PhpExcelTemplator\params\ExcelParam;
use alhimik1986\PhpExcelTemplator\params\CallbackParam;
use alhimik1986\PhpExcelTemplator\setters\CellSetterArrayValue;
use alhimik1986\PhpExcelTemplator\setters\CellSetterStringValue;
use alhimik1986\PhpExcelTemplator\setters\CellSetterArrayValueSpecial;
use App\Models\Keluarga;

class ExportKeluargaController extends Controller
{
    public function index(Request $request)
    {
        $item = json_decode($request->export);
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

        dd($query);
    }
}
