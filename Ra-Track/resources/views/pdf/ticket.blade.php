{{-- resources/views/pdf/ticket.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Billet Électronique - {{ $passenger->lastname }}</title>
    <style>
        /* Styles SIMPLES pour dompdf - Évite les flexbox/grid complexes */
        @page { margin: 15mm; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 10px; line-height: 1.4; }
        .ticket-container { border: 2px solid black; padding: 10mm; }
        .header { text-align: center; margin-bottom: 10mm; border-bottom: 1px dashed #ccc; padding-bottom: 5mm;}
        .header h1 { margin: 0; font-size: 16px; }
        .section { margin-bottom: 7mm; }
        .section h2 { font-size: 12px; margin-bottom: 2mm; border-bottom: 1px solid #eee; padding-bottom: 1mm; }
        .inline-details p { display: inline-block; margin-right: 5mm; margin-bottom: 1mm; }
        .flight-info td { padding: 2mm 3mm; vertical-align: top; }
        .qr-code { text-align: center; margin-top: 5mm;}
        strong { font-weight: bold; }
        .seat-info { font-size: 18px; font-weight: bold; text-align: center; border: 1px solid #555; padding: 3mm; margin-top: 5mm; }
        .barcode-stub { border-left: 2px dashed black; padding-left: 10mm; margin-left: 10mm; /* Simulacre de souche */ }
    </style>
</head>
<body>
    <div class="ticket-container">
        <div class="header">
            <h1>CARTE D'EMBARQUEMENT / BOARDING PASS</h1>
            <p>[Nom de ta compagnie]</p>
        </div>

        <div class="section inline-details">
            <p><strong>NOM DU PASSAGER / PASSENGER NAME:</strong><br> {{ strtoupper($passenger->lastname) }} / {{ strtoupper($passenger->firstname) }}</p>
            <p><strong>RÉFÉRENCE RÉSERVATION / BOOKING REF:</strong><br> {{ $passenger->reservation->booking_reference }}</p>
        </div>

        @if($passenger->reservation->flight)
        <div class="section">
            <h2>VOL / FLIGHT</h2>
            <table class="flight-info" width="100%">
                <tr>
                    <td width="50%">
                        <strong>DE / FROM:</strong><br>
                        {{ optional($passenger->reservation->flight->departureAirport)->name }} ({{ optional($passenger->reservation->flight->departureAirport)->code }})
                    </td>
                    <td width="50%">
                        <strong>VERS / TO:</strong><br>
                        {{ optional($passenger->reservation->flight->arrivalAirport)->name }} ({{ optional($passenger->reservation->flight->arrivalAirport)->code }})
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>VOL N° / FLIGHT NO:</strong><br>
                         {{ $passenger->reservation->flight->flight_number }}
                    </td>
                    <td>
                        <strong>DATE:</strong><br>
                        {{ \Carbon\Carbon::parse($passenger->reservation->flight->departure_time)->format('d M Y') }}
                    </td>
                </tr>
                 <tr>
                    <td>
                        <strong>DÉPART PRÉVU / SCHEDULED DEPARTURE:</strong><br>
                         {{ \Carbon\Carbon::parse($passenger->reservation->flight->departure_time)->format('H:i') }}
                    </td>
                    <td>
                         <strong>EMBARQUEMENT / BOARDING TIME:</strong><br>
                          {{ \Carbon\Carbon::parse($passenger->reservation->flight->departure_time)->subMinutes(45)->format('H:i') }} (Estimé)
                    </td>
                </tr>
            </table>
        </div>
        @endif

        <div class="section inline-details">
             <p><strong>CLASSE / CLASS:</strong><br> {{ ucfirst($passenger->reservation->class) }}</p>
             <p><strong>SIÈGE / SEAT:</strong><br> <strong style="font-size: 14px;">{{ $passenger->seat_number }}</strong></p>
             {{-- Ajouter Porte (Gate) et Séquence si tu gères ces infos plus tard --}}
             {{-- <p><strong>PORTE / GATE:</strong><br> A12</p> --}}
             {{-- <p><strong>SEQ N°:</strong><br> 0042</p> --}}
        </div>

        {{-- QR Code Section --}}
        <div class="qr-code">
            @if($passenger->seat_number)
                {{-- Génère le QR Code contenant le numéro de siège --}}
                {!! QrCode::size(80)->generate($passenger->seat_number); !!}
                 <p style="font-size: 8px; margin-top: 1mm;">Scan pour informations siège</p>
            @else
                <p>QR Code indisponible (Siège non assigné)</p>
            @endif
        </div>

        <div class="section">
             <p style="font-size: 9px; text-align: center; margin-top: 10mm; border-top: 1px dashed #ccc; padding-top: 5mm;">
                Veuillez vous présenter à la porte d'embarquement au moins 30 minutes avant le départ. Pièce d'identité requise. Bon voyage !<br>
                Please be at the boarding gate at least 30 minutes before departure. ID required. Have a nice flight!
             </p>
        </div>

         {{-- Optionnel: Simuler la souche détachable --}}
         {{-- <div class="barcode-stub"> ... infos répétées ou code-barres ... </div> --}}

    </div>
</body>
</html>