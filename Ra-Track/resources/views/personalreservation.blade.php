<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Mes Réservations</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Configuration supplémentaire de Tailwind -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        }
                    },
                    boxShadow: {
                        'card': '0 4px 20px rgba(0, 0, 0, 0.3)',
                        'card-hover': '0 8px 25px rgba(74, 222, 128, 0.2)',
                        'glow': '0 0 15px rgba(74, 222, 128, 0.5)',
                        'inner-glow': 'inset 0 0 10px rgba(251, 191, 36, 0.3)',
                    }
                }
            }
        }
    </script>

    <!-- FontAwesome pour les icônes -->
    <script src="https://kit.fontawesome.com/your-kit-id.js" crossorigin="anonymous"></script>
</head>

<body class="bg-black text-white min-h-screen font-sans antialiased">
    <!-- Header -->
    @include('layouts.header')

    <div class="container mx-auto px-4 py-12 max-w-7xl">
        <div class="text-center mb-12 animate-fade-in">
            <h1 class="text-4xl font-bold text-green-400 mb-4 animate-pulse-slow">
                <i class="fas fa-calendar-check mr-3"></i>
                Mes Réservations
            </h1>
            <p class="text-lg text-gray-300 max-w-2xl mx-auto">
                Consultez l'historique de vos voyages et vos prochains départs
            </p>
        </div>

        <div class="bg-gray-900 rounded-xl shadow-2xl p-6 mb-8 border border-gray-700">
            @forelse($reservations as $reservation)
                <div class="card mb-8 last:mb-0 bg-gradient-to-br from-gray-800 to-gray-900 rounded-lg overflow-hidden border border-gray-700 hover:border-green-400 transition-all duration-300 hover:shadow-glow">
                    <div class="card-body p-6">
                        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4">
                            <h3 class="text-2xl font-bold text-white mb-2 md:mb-0">
                                <i class="fas fa-plane-departure text-yellow-400 mr-2"></i>
                                {{ $reservation->flight->departureAirport->name }} 
                                <i class="fas fa-arrow-right mx-2 text-gray-500"></i> 
                                {{ $reservation->flight->arrivalAirport->name }}
                            </h3>
                            <span class="bg-yellow-900/50 text-yellow-400 text-sm font-semibold px-3 py-1 rounded-full border border-yellow-800">
                                {{ ucfirst($reservation->class) }}
                            </span>
                        </div>

                        <div class="grid md:grid-cols-3 gap-6 mb-6">
                            <div class="flex items-start">
                                <div class="bg-gray-700 p-3 rounded-full mr-4 text-yellow-400">
                                    <i class="fas fa-calendar-day"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Date de départ</h4>
                                    <p class="text-lg font-medium text-white">{{ $reservation->date }}</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="bg-gray-700 p-3 rounded-full mr-4 text-yellow-400">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Heure de départ</h4>
                                    <p class="text-lg font-medium text-white">
                                        {{ \Carbon\Carbon::parse($reservation->flight->departure_time)->format('H:i') }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="bg-gray-700 p-3 rounded-full mr-4 text-yellow-400">
                                    <i class="fas fa-barcode"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Référence</h4>
                                    <p class="text-lg font-medium text-white">{{ $reservation->booking_reference }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-gray-700 pt-6">
                            <h4 class="text-lg font-semibold text-yellow-400 mb-4 flex items-center">
                                <i class="fas fa-users mr-2"></i>
                                Passagers
                            </h4>
                            <ul class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($reservation->passengers as $passenger)
                                    <li class="bg-gray-800 p-4 rounded-lg border border-gray-700 flex items-center hover:bg-gray-750 transition-colors">
                                        <div class="bg-gray-700 text-yellow-400 p-2 rounded-full mr-3">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-white">{{ $passenger->firstname }} {{ $passenger->lastname }}</p>
                                            <p class="text-sm text-gray-400">{{ $passenger->age }} ans</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-16 bg-gray-800/50 rounded-xl border-2 border-dashed border-gray-700">
                    <i class="fas fa-calendar-times text-5xl text-gray-600 mb-6"></i>
                    <h3 class="text-2xl font-semibold text-gray-300 mb-2">Aucune réservation trouvée</h3>
                    <p class="text-gray-500 max-w-md mx-auto">
                        Vous n'avez pas encore effectué de réservation. Prêt pour votre prochain voyage ?
                    </p>
                    <a href="/" class="mt-6 inline-block bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-black font-medium py-3 px-6 rounded-lg transition duration-300 shadow-lg">
                        <i class="fas fa-search mr-2"></i> Trouver un vol
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Footer -->
    @include('layouts.footer')

    <!-- Animation script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
                card.classList.add('animate-fade-in');
            });
        });
    </script>
</body>

</html>