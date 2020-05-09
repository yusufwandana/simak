<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class JadwalEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->nama     = $data['nama'];
        $this->mulai    = $data['mulai'];
        $this->selesai    = $data['selesai'];
        $this->event    = $data['event'];
        $this->matkul   = $data['matkul'];
        $this->semester = $data['semester'];
        $this->ruangan  = $data['ruangan'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('simakwikrama@gmail.com')->view('jadwal.myEmail')
                    ->subject('Jadwal Kuliah Wikrama')
                    ->with([
                        'nama'     => $this->nama,
                        'event'    => $this->event,
                        'mulai'    => $this->mulai,
                        'selesai'    => $this->selesai,
                        'matkul'   => $this->matkul,
                        'semester' => $this->semester,
                        'ruangan'  => $this->ruangan
                    ]);
    }
}
