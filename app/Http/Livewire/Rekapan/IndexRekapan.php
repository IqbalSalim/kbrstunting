<?php

namespace App\Http\Livewire\Rekapan;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Keluarga;
use App\Models\Provinsi;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class IndexRekapan extends Component
{
    public $baduta, $balita, $pusHamil, $pus, $anakTidakSekolah, $tidakMemilikiSumberPenghasilan, $lantaiTanah, $tidakMakan, $praSejahtera, $tidakMemilikiSumberAir, $tidakMemilikiJamban, $tidakMemilikiRumah, $pendidikanDibawah, $terlaluMuda, $terlaluTua, $terlaluDekat, $terlaluBanyak, $kbrStunting;
    public $item;
    public $paginate = 5, $search;
    protected $queryString = ['search'];
    public $provinces, $province, $districts, $district, $subDistricts, $subDistrict;

    public function mount()
    {
        $this->provinces = Provinsi::all();
    }

    public function render()
    {
        return view('livewire.rekapan.index-rekapan');
    }

    public function getDistrict()
    {
        $this->districts = Kabupaten::where('provinsi_id', $this->province)->get();
    }

    public function getSubDistrict()
    {
        $this->subDistricts = Kecamatan::where('kabupaten_id', $this->district)->get();
    }

    public function hidrate()
    {
        return $this->dispatchBrowserEvent('chartChanged', ['item' => $this->item]);
    }

    public function updated()
    {
        $this->runningChart();
    }

    public function runningChart()
    {
        $this->chekCheklist();

        $item['categories'] = Keluarga::select('desa_kelurahan')->whereProvince($this->province)->whereDistrict($this->district)->whereSubDistrict($this->subDistrict)
            ->baduta($this->baduta)
            ->balita($this->balita)
            ->pusHamil($this->pusHamil)
            ->pus($this->pus)
            ->anakTidakSekolah($this->anakTidakSekolah)
            ->tidakMemilikiSumberPenghasilan($this->tidakMemilikiSumberPenghasilan)
            ->lantaiTanah($this->lantaiTanah)
            ->tidakMakan($this->tidakMakan)
            ->praSejahtera($this->praSejahtera)
            ->tidakMemilikiSumberAir($this->tidakMemilikiSumberAir)
            ->tidakMemilikiJamban($this->tidakMemilikiJamban)
            ->tidakMemilikiRumah($this->tidakMemilikiRumah)
            ->pendidikanDibawah($this->pendidikanDibawah)
            ->terlaluMuda($this->terlaluMuda)
            ->terlaluTua($this->terlaluTua)
            ->terlaluDekat($this->terlaluDekat)
            ->terlaluBanyak($this->terlaluBanyak)
            ->kbrStunting($this->kbrStunting)
            ->groupByRaw('desa_kelurahan')->pluck('desa_kelurahan')->toArray();


        $item['data'] = Keluarga::select(DB::raw('COUNT(desa_kelurahan) as jumlah'))->whereProvince($this->province)->whereDistrict($this->district)->whereSubDistrict($this->subDistrict)
            ->baduta($this->baduta)
            ->balita($this->balita)
            ->pusHamil($this->pusHamil)
            ->pus($this->pus)
            ->anakTidakSekolah($this->anakTidakSekolah)
            ->tidakMemilikiSumberPenghasilan($this->tidakMemilikiSumberPenghasilan)
            ->lantaiTanah($this->lantaiTanah)
            ->tidakMakan($this->tidakMakan)
            ->praSejahtera($this->praSejahtera)
            ->tidakMemilikiSumberAir($this->tidakMemilikiSumberAir)
            ->tidakMemilikiJamban($this->tidakMemilikiJamban)
            ->tidakMemilikiRumah($this->tidakMemilikiRumah)
            ->pendidikanDibawah($this->pendidikanDibawah)
            ->terlaluMuda($this->terlaluMuda)
            ->terlaluTua($this->terlaluTua)
            ->terlaluDekat($this->terlaluDekat)
            ->terlaluBanyak($this->terlaluBanyak)
            ->kbrStunting($this->kbrStunting)
            ->groupByRaw('desa_kelurahan')->pluck('jumlah')->toArray();



        $this->dispatchBrowserEvent('chartChanged', ['item' => $item]);
    }

    public function chekCheklist()
    {
        if ($this->praSejahtera) {
            $this->anakTidakSekolah = false;
            $this->tidakMemilikiSumberPenghasilan = false;
            $this->lantaiTanah = false;
            $this->tidakMakan = false;
        }

        if ($this->kbrStunting) {
            $this->baduta = false;
            $this->balita = false;
            $this->pus = false;
            $this->pusHamil = false;
            $this->anakTidakSekolah = false;
            $this->tidakMemilikiSumberPenghasilan = false;
            $this->lantaiTanah = false;
            $this->tidakMakan = false;
            $this->praSejahtera = false;
            $this->tidakMemilikiSumberAir = false;
            $this->tidakMemilikiJamban = false;
            $this->tidakMemilikiRumah = false;
            $this->pendidikanDibawah = false;
            $this->terlaluMuda = false;
            $this->terlaluTua = false;
            $this->terlaluDekat = false;
            $this->terlaluBanyak = false;
        }
    }
}
