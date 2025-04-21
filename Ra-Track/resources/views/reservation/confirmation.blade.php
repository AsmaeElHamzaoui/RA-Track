
<div class="container mx-auto px-4 py-8 bg-gray-800 text-white rounded-lg shadow-lg my-6">
    <h1 class="text-3xl font-bold text-green-400 mb-4">Paiement Réussi !</h1>
    <p class="mb-6">Votre réservation a été confirmée avec succès. Vous pouvez télécharger les billets individuels ci-dessous.</p>

    <div class="bg-gray-700 p-4 rounded mb-6">
        <h2 class="text-xl font-semibold mb-3 text-yellow-400">Détails de la Réservation</h2>
        <p><strong>Référence :</strong> {{ $reservation->booking_reference }}</p>
        <p><strong>Vol :</strong> {{ optional($reservation->flight)->flight_number }}</p>
        <p><strong>Départ :</strong> {{ optional(optional($reservation->flight)->departureAirport)->name }} le {{ optional($reservation->flight)->departure_time ? \Carbon\Carbon::parse($reservation->flight->departure_time)->format('d/m/Y H:i') : 'N/A' }}</p>
        <p><strong>Arrivée :</strong> {{ optional(optional($reservation->flight)->arrivalAirport)->name }} le {{ optional($reservation->flight)->arrival_time ? \Carbon\Carbon::parse($reservation->flight->arrival_time)->format('d/m/Y H:i') : 'N/A' }}</p>
        <p><strong>Classe :</strong> {{ ucfirst($reservation->class) }}</p>
    </div>

    <h2 class="text-xl font-semibold mb-3 text-yellow-400">Vos Billets Électroniques</h2>
    <div class="space-y-3">
        @forelse ($reservation->passengers as $passenger)
            <div class="bg-gray-700 p-4 rounded flex justify-between items-center">
                <div>
                    <p class="font-medium">{{ $passenger->firstname }} {{ $passenger->lastname }}</p>
                    <p class="text-sm text-gray-400">Siège : {{ $passenger->seat_number ?? 'Assignation en cours...' }}</p>
                </div>
                @if ($passenger->seat_number)
                    <a href="{{ route('ticket.download', ['passenger' => $passenger->id]) }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out text-sm">
                       <i class="fas fa-download mr-2"></i> {{-- Si tu utilises FontAwesome --}}
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