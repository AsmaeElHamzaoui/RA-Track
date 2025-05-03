<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Confirmation de Paiement</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Optionnel : FontAwesome pour les icônes -->
    <script src="https://kit.fontawesome.com/your-kit-id.js" crossorigin="anonymous"></script>
</head>

<body class="bg-black text-white min-h-screen ">
    <!-- Header-->
    @include('layouts.header')

    <div class="container mx-auto px-4 py-8 bg-gradient-to-b from-black via-gray-900 to-gray-800 text-white rounded-lg shadow-2xl my-6">
        <h1 class="text-3xl font-bold text-green-400 mb-4">Paiement Réussi !</h1>
        <p class="mb-6">Votre réservation a été confirmée avec succès. Vous pouvez télécharger les billets individuels ci-dessous.</p>

        <div class="bg-gray-700 p-5 rounded-lg mb-6 shadow-inner">
            <h2 class="text-xl font-semibold mb-3 text-yellow-400">Détails de la Réservation</h2>
            <p><span class="font-semibold text-white">Référence :</span> {{ $reservation->booking_reference }}</p>
            <p><span class="font-semibold text-white">Vol :</span> {{ optional($reservation->flight)->flight_number }}</p>
            <p><span class="font-semibold text-white">Départ :</span> {{ optional(optional($reservation->flight)->departureAirport)->name }} le {{ optional($reservation->flight)->departure_time ? \Carbon\Carbon::parse($reservation->flight->departure_time)->format('d/m/Y H:i') : 'N/A' }}</p>
            <p><span class="font-semibold text-white">Arrivée :</span> {{ optional(optional($reservation->flight)->arrivalAirport)->name }} le {{ optional($reservation->flight)->arrival_time ? \Carbon\Carbon::parse($reservation->flight->arrival_time)->format('d/m/Y H:i') : 'N/A' }}</p>
            <p><span class="font-semibold text-white">Classe :</span> {{ ucfirst($reservation->class) }}</p>
        </div>

        <h2 class="text-xl font-semibold mb-3 text-yellow-400">Vos Billets Électroniques</h2>
        <div class="space-y-3">
            @forelse ($reservation->passengers as $passenger)
            <div class="bg-gray-700 p-4 rounded-lg flex justify-between items-center shadow">
                <div>
                    <p class="font-medium text-white">{{ $passenger->firstname }} {{ $passenger->lastname }}</p>
                    <p class="text-sm text-gray-400">Siège : {{ $passenger->seat_number ?? 'Assignation en cours...' }}</p>
                </div>
                @if ($passenger->seat_number)
                <a href="{{ route('ticket.download', ['passenger' => $passenger->id]) }}"
                    class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-4 rounded-md transition duration-300 ease-in-out text-sm shadow">
                    <i class="fas fa-download mr-2"></i>
                    Télécharger le Billet
                </a>
                @else
                <span class="text-sm text-yellow-500 italic">Assignation du siège en cours...</span>
                @endif
            </div>
            @empty
            <p class="text-gray-400">Aucun passager trouvé pour cette réservation.</p>
            @endforelse
        </div>
    </div>
    <!-- Footer-->
    @include('layouts.footer')
</body>

</html>