<?php

namespace App\Http\Livewire\Import;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Keluarga;
use App\Models\Kelurahan;
use App\Models\Provinsi;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class IndexImport extends Component
{
    use WithFileUploads;

    public $file;
    public $name, $desaKelurahan, $kecamatan, $kabupatenKota, $provinsi;

    protected $listeners = [
        'delete'
    ];

    public function render()
    {
        return view('livewire.import.index-import', [
            'keluarga' => Keluarga::select('desa_kelurahan', 'kecamatan', 'kabupaten_kota', 'provinsi')->distinct('desa_kelurahan')->get(),
        ]);
    }

    public function store()
    {
        $this->validate(
            [
                'file' => 'required|file'
            ],
            [],
            [
                'file' => 'File Import'
            ]
        );

        $nameFile = $this->file->store('files', 'public');

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load(public_path('storage/' . $nameFile));
        $sheet = $spreadsheet->getSheet($spreadsheet->getFirstSheetIndex());
        $data = $sheet->toArray();

        $rt = $data[3][4];
        $dusunRw = $data[5][4];
        $data1 = [];


        foreach ($data as $key => $value) {
            if ($key >= 15) {
                array_push($data1, $value);
            }
        }

        foreach ($data1 as $row) {
            $provinsi_id = Provinsi::where('kd_provinsi', substr($row[1], 0, 2))->first()->id;
            $provinsiNama = Provinsi::find($provinsi_id)->nama;
            $kabupatens = Kabupaten::where('provinsi_id', $provinsi_id)->get();
            foreach ($kabupatens as $value) {
                if ($value->kd_kabupaten == substr($row[1], 2, 2)) {
                    $kecamatans = Kecamatan::where('kabupaten_id', $value->id)->get();
                    $kabupatenNama = $value->nama;
                }
            }

            foreach ($kecamatans as $value) {
                if ($value->kd_kecamatan == substr($row[1], 4, 2)) {
                    $kelurahans = Kelurahan::where('kecamatan_id', $value->id)->get();
                    $kecamatanNama = $value->nama;
                }
            }


            foreach ($kelurahans as $value) {
                if ($value->kd_kelurahan == substr($row[1], 6, 4)) {
                    $kelurahan_id = $value->id;
                    $kelurahanNama = $value->nama;
                }
            }


            Keluarga::create([
                'kelurahan_id' => $kelurahan_id,
                'kd_kelurahan' => $row[0],
                'kode_keluarga' => $row[1],
                'nik_kk' => $row[5],
                'nama_kk' => $row[6],
                'baduta' => $row[8] == 'V' ? 1 : 0,
                'balita' => $row[9] == 'V' ? 1 : 0,
                'pus' => $row[10] == 'V' ? 1 : 0,
                'pus_hamil' => $row[11] == 'V' ? 1 : 0,
                'anak_tidak_sekolah' => $row[12] == 'V' ? 1 : 0,
                'tidak_memiliki_sumber_penghasilan' => $row[13] == 'V' ? 1 : 0,
                'lantai_tanah' => $row[14] == 'V' ? 1 : 0,
                'tidak_makan' => $row[15] == 'V' ? 1 : 0,
                'pra_sejahtera' => $row[16] == 'V' ? 1 : 0,
                'tidak_memiliki_sumber_air' => $row[17] == 'V' ? 1 : 0,
                'tidak_memiliki_jamban' => $row[18] == 'V' ? 1 : 0,
                'tidak_memiliki_rumah' => $row[19] == 'V' ? 1 : 0,
                'pendidikan_ibu_dibawah_sltp' => $row[20] == 'V' ? 1 : 0,
                'terlalu_muda' => $row[21] == 'V' ? 1 : 0,
                'terlalu_tua' => $row[22] == 'V' ? 1 : 0,
                'terlalu_dekat' => $row[23] == 'V' ? 1 : 0,
                'terlalu_banyak' => $row[24] == 'V' ? 1 : 0,
                'kbr_stunting' => $row[25] == 'V' ? 1 : 0,
                'rt' => $rt,
                'dusun_rw' => $dusunRw,
                'desa_kelurahan' => $kelurahanNama,
                'kecamatan' => $kecamatanNama,
                'kabupaten_kota' => $kabupatenNama,
                'provinsi' => $provinsiNama,
            ]);
        }

        if (Storage::exists($nameFile)) {
            Storage::delete($nameFile);
        }

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Data Keluarga Berhasil Diimport!',
            'text' => 'ini telah disimpan di tabel Keluarga.'
        ]);

        $this->file = null;
    }

    public function alertConfirm($desaKelurahan, $kecamatan, $kabupatenKota, $provinsi)
    {
        $this->desaKelurahan = $desaKelurahan;
        $this->kecamatan = $kecamatan;
        $this->kabupatenKota = $kabupatenKota;
        $this->provinsi = $provinsi;

        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'message' => 'Apakah Anda Yakin?',
            'text' => 'Jika dihapus, Anda tidak akan dapat mengembalikan data ini!'
        ]);
    }

    public function delete()
    {
        Keluarga::where('desa_kelurahan', $this->desaKelurahan)->where('kecamatan', $this->kecamatan)->where('kabupaten_kota', $this->kabupatenKota)->where('provinsi', $this->provinsi)->delete();
    }
}
