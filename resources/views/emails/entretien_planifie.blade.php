<h2>Bonjour {{ $entretien->candidat->name }},</h2>

<p>Nous vous informons que votre entretien pour le poste <strong>{{ $entretien->candidature->offre->titre }}</strong> est planifié.</p>

<p>
    <strong>Date :</strong> {{ $entretien->date_entretien->format('d/m/Y à H:i') }} <br>
    <strong>Lieu :</strong> {{ $entretien->lieu ?? 'En visioconférence' }} <br>
    @if($entretien->message)
        <strong>Message :</strong> {{ $entretien->message }} <br>
    @endif
</p>

<p>Merci et à bientôt,</p>
<p>L’équipe RH</p>
