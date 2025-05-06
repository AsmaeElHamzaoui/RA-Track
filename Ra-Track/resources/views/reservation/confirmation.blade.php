<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Confirmation de Paiement</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Configuration supplémentaire de Tailwind -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    boxShadow: {
                        'glow': '0 0 15px rgba(74, 222, 128, 0.5)',
                        'glow-sm': '0 0 8px rgba(74, 222, 128, 0.3)',
                        'inner-glow': 'inset 0 0 10px rgba(251, 191, 36, 0.3)',
                    }
                }
            }
        }
    </script>

    <!-- Optionnel : FontAwesome pour les icônes -->
    <script src="https://kit.fontawesome.com/your-kit-id.js" crossorigin="anonymous"></script>
</head>

<body class="bg-black text-white min-h-screen font-sans antialiased">
    <!-- Header-->
    @include('layouts.header')

    <div class="container mx-auto px-4 py-8 bg-gradient-to-br from-black via-gray-900 to-gray-800 text-white rounded-xl shadow-2xl my-6 border border-gray-700 max-w-4xl transition-all duration-300 hover:shadow-glow">
        <h1 class="text-4xl font-extrabold text-yellow-200 mb-6 text-center tracking-tight animate-pulse-slow">
            <i class="fas fa-check-circle mr-3"></i>Paiement Réussi !
        </h1>
        
        <p class="mb-8 text-lg text-center text-gray-300 leading-relaxed max-w-2xl mx-auto">
            Votre réservation a été confirmée avec succès. Vous pouvez télécharger les billets individuels ci-dessous.
        </p>

        <div class="bg-gray-800/70 p-6 rounded-xl mb-8 shadow-inner-glow border border-gray-700 backdrop-blur-sm transition-all duration-500 hover:border-gray-600">
            <h2 class="text-2xl font-bold mb-4 text-yellow-200 flex items-center">
                <i class="fas fa-receipt mr-2"></i>Détails de la Réservation
            </h2>
            <div class="grid md:grid-cols-2 gap-4">
                <p class="flex items-start">
                    <span class="font-semibold text-gray-300 min-w-[120px]">Référence :</span>
                    <span class="text-white font-medium">{{ $reservation->booking_reference }}</span>
                </p>
                <p class="flex items-start">
                    <span class="font-semibold text-gray-300 min-w-[120px]">Vol :</span>
                    <span class="text-white font-medium">{{ optional($reservation->flight)->flight_number }}</span>
                </p>
                <p class="flex items-start">
                    <span class="font-semibold text-gray-300 min-w-[120px]">Départ :</span>
                    <span class="text-white font-medium">{{ optional(optional($reservation->flight)->departureAirport)->name }} le {{ optional($reservation->flight)->departure_time ? \Carbon\Carbon::parse($reservation->flight->departure_time)->format('d/m/Y H:i') : 'N/A' }}</span>
                </p>
                <p class="flex items-start">
                    <span class="font-semibold text-gray-300 min-w-[120px]">Arrivée :</span>
                    <span class="text-white font-medium">{{ optional(optional($reservation->flight)->arrivalAirport)->name }} le {{ optional($reservation->flight)->arrival_time ? \Carbon\Carbon::parse($reservation->flight->arrival_time)->format('d/m/Y H:i') : 'N/A' }}</span>
                </p>
                <p class="flex items-start">
                    <span class="font-semibold text-gray-300 min-w-[120px]">Classe :</span>
                    <span class="text-white font-medium">{{ ucfirst($reservation->class) }}</span>
                </p>
            </div>
        </div>

        <h2 class="text-2xl font-bold mb-6 text-yellow-200 flex items-center">
            <i class="fas fa-ticket-alt mr-2"></i>Vos Billets Électroniques
        </h2>
        
        <div class="space-y-4">
            @forelse ($reservation->passengers as $passenger)
            <div class="bg-gray-800/80 hover:bg-gray-700/90 p-5 rounded-xl flex flex-col md:flex-row justify-between items-start md:items-center gap-4 shadow-md border border-gray-700 transition-all duration-300 hover:shadow-glow-sm hover:border-gray-600">
                <div class="flex-1">
                    <p class="font-bold text-lg text-white">{{ $passenger->firstname }} {{ $passenger->lastname }}</p>
                    <p class="text-sm text-gray-400 mt-1">Siège : {{ $passenger->seat_number ?? 'Assignation en cours...' }}</p>
                </div>
                @if ($passenger->seat_number)
                <a href="{{ route('ticket.download', ['passenger' => $passenger->id]) }}"
                    class="bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-black font-bold py-3 px-6 rounded-lg transition-all duration-300 ease-in-out shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex items-center whitespace-nowrap">
                    <i class="fas fa-download mr-2"></i>
                    Télécharger le Billet
                </a>
                @else
                <span class="text-sm text-yellow-400 italic bg-yellow-900/30 px-3 py-2 rounded-lg border border-yellow-800/50">
                    <i class="fas fa-clock mr-1"></i> Assignation du siège en cours...
                </span>
                @endif
            </div>
            @empty
            <div class="text-center py-8">
                <p class="text-gray-400 text-lg">
                    <i class="fas fa-user-slash mr-2"></i> Aucun passager trouvé pour cette réservation.
                </p>
            </div>
            @endforelse
        </div>
    </div>
    <!-- Footer-->
    @include('layouts.footer')
</body>

</html>