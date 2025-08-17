<?php

namespace App\Mail;

use App\Models\Entretien;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EntretienPlanifie extends Mailable
{
    use Queueable, SerializesModels;

    public $entretien;

    public function __construct(Entretien $entretien)
    {
        $this->entretien = $entretien;
    }

    public function build()
    {
        return $this->subject('Planification de votre entretien')
            ->view('emails.entretien_planifie');
    }
}
