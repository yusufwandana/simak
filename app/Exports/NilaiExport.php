<?php

namespace App\Exports;

use App\ExportNilai;
use App\Mahasiswa;
use App\Nilai;
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

    public function __construct($matkulId, $semesterId)
    {
        $this->matkulId = $matkulId;
        $this->semesterId = $semesterId;
    }
    public function view(): View
    {
        $x = Mahasiswa::orderBy('nim')->where('semester_id', $this->semesterId)->with('Nilai')->get();
        $mid = $this->matkulId;
        return view('nilai.exportnilai', compact('x', 'mid'));
    }
}
