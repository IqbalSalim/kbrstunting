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
use Livewire\WithPagination;

class IndexRekapan extends Component
{
    use WithPagination;

    public $baduta = false, $balita = false, $pusHamil = false, $pus = false, $anakTidakSekolah = false, $tidakMemilikiSumberPenghasilan = false, $lantaiTanah = false, $tidakMakan = false, $praSejahtera = false, $tidakMemilikiSumberAir = false, $tidakMemilikiJamban = false, $tidakMemilikiRumah = false, $pendidikanDibawah = false, $terlaluMuda = false, $terlaluTua = false, $terlaluDekat = false, $terlaluBanyak = false, $kbrStunting = false;
    public $item, $export = [];
    public $paginate = 10, $search;
    protected $queryString = ['search'];
    public $provinces, $province, $districts, $district, $subDistricts, $subDistrict, $provinceFilter, $districtFilter, $subDistrictFilter;
    public $cekFilter = false;

    public function mount()
    {
        $this->provinces = Provinsi::all();
        $this->setExport();
    }


    public function render()
    {

        return view('livewire.rekapan.index-rekapan', [
            'keluarga' => ($this->cekFilter) ? Keluarga::whereProvince($this->province)->whereDistrict($this->district)->whereSubDistrict($this->subDistrict)
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
                ->orderBy('provinsi')
                ->orderBy('kabupaten_kota')
                ->orderBy('kecamatan')
                ->orderBy('desa_kelurahan')
                ->orderBy('nama_kk')
                ->paginate($this->paginate) :
                null,
        ]);
    }

    public function filter()
    {
        $this->cekFilter = true;
        $this->province = $this->provinceFilter;
        $this->district = $this->districtFilter;
        $this->subDistrict = $this->subDistrictFilter;
        $this->resetPage();
        $this->runningChart();
    }


    public function getDistrict()
    {
        $this->districts = Kabupaten::where('provinsi_id', $this->provinceFilter)->get();
    }

    public function getSubDistrict()
    {
        $this->subDistricts = Kecamatan::where('kabupaten_id', $this->districtFilter)->get();
    }

    public function runningChart()
    {
        $this->chekCheklist();
        $satuanWilayah = null;

        if ($this->subDistrict !== null && $this->subDistrict !== '') {
            $satuanWilayah = 'desa_kelurahan';
        } else if ($this->district !== null && $this->district !== '') {
            $satuanWilayah = 'kecamatan';
        } else if ($this->province !== null && $this->province !== '') {
            $satuanWilayah = 'kabupaten_kota';
        } else {
            $satuanWilayah = 'provinsi';
        }

        $item['categories'] = Keluarga::select($satuanWilayah)->whereProvince($this->province)->whereDistrict($this->district)->whereSubDistrict($this->subDistrict)
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
            ->groupByRaw($satuanWilayah)->pluck($satuanWilayah)->toArray();


        $item['data'] = Keluarga::select(DB::raw('COUNT(' . $satuanWilayah . ') as jumlah'))->whereProvince($this->province)->whereDistrict($this->district)->whereSubDistrict($this->subDistrict)
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
            ->groupByRaw($satuanWilayah)->pluck('jumlah')->toArray();
        $this->dispatchBrowserEvent('chartChanged', ['item' => $item]);
        $this->setExport();
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

    public function setExport()
    {
        $export = [
            'baduta' => $this->baduta,
            'balita' => $this->balita,
            'pusHamil' => $this->pusHamil,
            'pus' => $this->pus,
            'anakTidakSekolah' => $this->anakTidakSekolah,
            'tidakMemilikiSumberPenghasilan' => $this->tidakMemilikiSumberPenghasilan,
            'lantaiTanah' => $this->lantaiTanah,
            'tidakMakan' => $this->tidakMakan,
            'praSejahtera' => $this->praSejahtera,
            'tidakMemilikiSumberAir' => $this->tidakMemilikiSumberAir,
            'tidakMemilikiJamban' => $this->tidakMemilikiJamban,
            'tidakMemilikiRumah' => $this->tidakMemilikiRumah,
            'pendidikanDibawah' => $this->pendidikanDibawah,
            'terlaluMuda' => $this->terlaluMuda,
            'terlaluTua' => $this->terlaluTua,
            'terlaluDekat' => $this->terlaluDekat,
            'terlaluBanyak' => $this->terlaluBanyak,
            'kbrStunting' => $this->kbrStunting,
            'province' => $this->province,
            'district' => $this->district,
            'subDistrict' => $this->subDistrict,
        ];

        $this->export = json_encode($export);
    }

    public function optionChanged()
    {
        if ($this->cekFilter) {
            $this->runningChart();
        }
    }
}
