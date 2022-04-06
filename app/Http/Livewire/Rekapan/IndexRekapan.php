<?php

namespace App\Http\Livewire\Rekapan;

use App\Models\Keluarga;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class IndexRekapan extends Component
{
    public $baduta, $balita, $pusHamil, $pus, $anakTidakSekolah, $tidakMemilikiSumberPenghasilan, $lantaiTanah, $tidakMakan, $praSejahtera, $tidakMemilikiSumberAir, $tidakMemilikiJamban, $tidakMemilikiRumah, $pendidikanDibawah, $terlaluMuda, $terlaluTua, $terlaluDekat, $terlaluBanyak, $kbrStunting;
    public $item;

    public function mount()
    {
    }

    public function render()
    {
        return view('livewire.rekapan.index-rekapan');
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
        $item['categories'] = Keluarga::select('desa_kelurahan')->where('kecamatan', 'batudaa')
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


        $item['data'] = Keluarga::select(DB::raw('COUNT(desa_kelurahan) as jumlah'))->where('kecamatan', 'asparaga')
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
}
