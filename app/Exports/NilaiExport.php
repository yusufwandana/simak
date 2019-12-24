<?php

namespace App\Exports;

use App\ExportNilai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use \Carbon\Carbon;

class NilaiExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function __construct($jenis, $matkulId, $semesterId)
    {
        $this->jenis = $jenis;
        $this->matkulId = $matkulId;
        $this->semesterId = $semesterId;
    }
    public function view(): View
    {
        $x = ExportNilai::where([
            'jenis_nilai' => $this->jenis,
            'matkul_id' => $this->matkulId,
            'semester_id' => $this->semesterId
        ])->get();
        return view('nilai.exportnilaiuts', compact('x'));
    }
}
