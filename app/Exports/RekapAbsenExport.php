<?php

namespace App\Exports;

use App\Absen;
use App\Matkul;
use App\Mahasiswa;
use App\Dosen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RekapAbsenExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function __construct($matkulId, $dosenId, $dari, $sampai)
    {
        $this->matkulId = $matkulId;
        $this->dosenId = $dosenId;
        $this->dari = $dari;
        $this->sampai = $sampai;
    }

    public function view(): View
    {
        $matkul    = Matkul::find($this->matkulId);
        $dosen     = Dosen::where('user_id', auth()->user()->id)->first();
        $dari      = $this->dari;
        $sampai    = $this->sampai;

        $absen = Absen::whereBetween('tanggal', [$this->dari, $this->sampai])
            ->where([
                'dosen_id'  => $dosen->id,
                'matkul_id' => $matkul->id
            ])->orderBy('tanggal', 'asc')->get();
        return view('absen.absen-rekap-export', compact('matkul', 'absen', 'dosen', 'dari', 'sampai'));
    }
}
