<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails Réservation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-b from-black via-gray-800 to-gray-900 text-white min-h-screen">
    <!-- Header-->
    @include('layouts.header')

    <div class="max-w-4xl mx-auto bg-gray-900 rounded-xl shadow-lg p-4 sm:p-6">
        <h2 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6">Détails de la réservation et Paiement</h2>

        <!-- Messages flash -->
        @if(session('success'))
        <div class="bg-green-500 text-white px-4 py-2 rounded mb-4 text-sm sm:text-base">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="bg-red-500 text-white px-4 py-2 rounded mb-4 text-sm sm:text-base">{{ session('error') }}</div>
        @endif
        @if(session('info'))
        <div class="bg-blue-500 text-white px-4 py-2 rounded mb-4 text-sm sm:text-base">{{ session('info') }}</div>
        @endif

        @if ($reservation && $reservation->flight)
        <div class="mb-4 sm:mb-6 space-y-2">
            <p class="text-sm sm:text-base"><strong>Référence:</strong> {{ $reservation->booking_reference }}</p>
            <p class="text-sm sm:text-base"><strong>Date de réservation:</strong> {{ $reservation->created_at->format('d/m/Y H:i') }}</p>
            <p class="text-sm sm:text-base"><strong>Classe:</strong> {{ ucfirst($reservation->class) }}</p>
            <p class="text-sm sm:text-base"><strong>Status:</strong>
                <span class="px-2 py-1 rounded text-xs sm:text-sm
                        @if($reservation->status === 'confirmed') bg-green-600 
                        @elseif($reservation->status === 'pending_authentication') bg-yellow-500 
                        @else bg-gray-600 
                        @endif
                    ">
                    {{ ucfirst(str_replace('_', ' ', $reservation->status)) }}
                </span>
            </p>
        </div>

        <h3 class="text-lg sm:text-xl font-semibold mb-2">Détails du vol</h3>
        <div class="mb-4 sm:mb-6 space-y-2">
            <p class="text-sm sm:text-base"><strong>Vol:</strong> {{ $reservation->flight->flight_number ?? 'N/A' }}</p>
            <p class="text-sm sm:text-base"><strong>Départ:</strong> {{ optional($reservation->flight->departureAirport)->name }} ({{ optional($reservation->flight->departureAirport)->code }}) le {{ \Carbon\Carbon::parse($reservation->flight->departure_time)->format('d/m/Y à H:i') }}</p>
            <p class="text-sm sm:text-base"><strong>Arrivée:</strong> {{ optional($reservation->flight->arrivalAirport)->name }} ({{ optional($reservation->flight->arrivalAirport)->code }}) le {{ \Carbon\Carbon::parse($reservation->flight->arrival_time)->format('d/m/Y à H:i') }}</p>
        </div>

        <h3 class="text-lg sm:text-xl font-semibold mb-2">Passagers et Tarification</h3>
        <ul class="space-y-2 sm:space-y-3 mb-4 sm:mb-6">
            @php $totalCalculatedPrice = 0; @endphp
            @forelse ($reservation->passengers as $index => $passenger)
            @php $passengerPrice = $reservation->getPriceForPassenger($passenger); @endphp
            <li class="flex flex-col sm:flex-row justify-between items-start sm:items-center bg-gray-800 p-3 sm:p-4 rounded gap-2">
                <div class="flex-1">
                    <p class="text-sm sm:text-base"><strong>Passager {{ $index + 1 }}:</strong> {{ $passenger->firstname }} {{ $passenger->lastname }}
                        ({{ $passenger->gender == 'male' ? 'Homme' : 'Femme' }}, {{ $passenger->age }} ans)
                        @if ($passenger->age <= 15)
                            <span class="ml-2 bg-blue-400 text-black px-1 sm:px-2 py-0.5 sm:py-1 rounded text-xs sm:text-sm">Tarif Enfant</span>
                            @endif
                    </p>
                </div>
                <div class="sm:text-right">
                    @if ($passengerPrice !== null)
                    <strong class="text-sm sm:text-base">{{ number_format($passengerPrice, 2, ',', ' ') }} €</strong>
                    @php $totalCalculatedPrice += $passengerPrice; @endphp
                    @else
                    <span class="text-red-400 text-sm sm:text-base">Prix indisponible</span>
                    @endif
                </div>
            </li>
            @empty
            <li class="bg-gray-800 p-3 sm:p-4 rounded text-sm sm:text-base">Aucun passager associé à cette réservation.</li>
            @endforelse
        </ul>

        @php $finalTotalPrice = $reservation->calculateTotalPrice(); @endphp

        <div class="text-right mt-4">
            <h4 class="text-lg sm:text-xl font-semibold">Total à Payer</h4>
            @if ($finalTotalPrice !== null)
            <h3 class="text-green-400 text-2xl sm:text-3xl font-bold mt-1 sm:mt-2">{{ number_format($finalTotalPrice, 2, ',', ' ') }} €</h3>

            @if ($reservation->status !== 'confirmed')
            <form action="{{ route('stripe.checkout', ['reservation' => $reservation->id]) }}" method="GET" class="mt-4 sm:mt-6">
                <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-2 sm:py-3 px-4 sm:px-6 rounded text-base sm:text-lg transition duration-300 ease-in-out w-full sm:w-auto">
                    💳 Payer maintenant par Carte
                </button>
            </form>
            @else
            <p class="text-green-400 mt-2 sm:mt-4 text-sm sm:text-base">✔️ Cette réservation est déjà confirmée et payée.</p>
            @endif
            @else
            <p class="text-red-400 mt-1 sm:mt-2 text-sm sm:text-base">Impossible de calculer le montant total de la réservation.</p>
            @endif
        </div>
        @else
        <div class="bg-yellow-500 text-black px-4 py-3 rounded text-sm sm:text-base">
            Les détails de la réservation ou du vol associé n'ont pas pu être chargés.
        </div>
        @endif
    </div>

    <!-- Footer-->
    @include('layouts.footer')
</body>

</html>