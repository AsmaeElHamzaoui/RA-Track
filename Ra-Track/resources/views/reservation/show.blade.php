<!DOCTYPE html>
<html lang="fr"> {{-- Changed language to French --}}

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Add CSRF Token Meta Tag for potential future AJAX, though not used in this version --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Use the flight details for the title, dynamically --}}
    <title>AirBooking - Réservation {{ $flight->departureAirport->iata }} vers {{ $flight->arrivalAirport->iata }}</title>
    <!-- Include Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include Font Awesome via CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Styles (gardés tels quels) */
        select {
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.5rem center;
            background-size: 1.5em 1.5em;
            -webkit-appearance: none;
            appearance: none;
            padding-right: 2.5rem;
        }
        input[readonly],
        select[disabled].readonly-imitation {
            background-color: #f3f4f6;
            cursor: not-allowed;
            border-color: #d1d5db;
        }
        select[disabled].readonly-imitation {
            color: #374151;
            -webkit-appearance: none;
            appearance: none;
            background-image: none;
            padding-right: 0.5rem;
        }
        /* Style pour afficher les erreurs de validation près des champs */
        .form-error {
            color: #dc2626; /* text-red-600 */
            font-size: 0.875rem; /* text-sm */
            margin-top: 0.25rem; /* mt-1 */
        }
    </style>
</head>

<body class="bg-gradient-to-b from-gray-900 to-indigo-900 text-gray-800 font-sans p-4 md:p-8">

    <!-- Header (gardé tel quel) -->
    <header class="container mx-auto max-w-6xl mb-8">
        <nav class="flex justify-between items-center text-white">
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                </svg>
                <span class="text-xl font-bold">AirBooking</span>
            </div>
            <div class="hidden md:flex space-x-6">
                <a href="#" class="hover:text-gray-300">Accueil</a>
                <a href="#" class="hover:text-gray-300">Vols</a>
                <a href="#" class="hover:text-gray-300">Mes Réservations</a>
                <a href="#" class="hover:text-gray-300">Contact</a>
            </div>
            <button class="md:hidden focus:outline-none text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </nav>
    </header>

    <!-- Main Content Area -->
    <main class="container mx-auto max-w-4xl bg-white rounded-lg shadow-lg p-6 md:p-8">

        {{-- Le formulaire principal englobe TOUT maintenant --}}
        <form action="{{ route('reservation') }}" method="POST" id="final-booking-form">
            @csrf
            {{-- Hidden inputs pour les infos de réservation --}}
            <input type="hidden" name="flight_id" value="{{ $flight->id }}">
            <input type="hidden" name="date" value="{{ request('date') }}">
            <input type="hidden" name="class" value="{{ request('class') }}">
            <input type="hidden" name="adults" value="{{ request('adults') }}">
            <input type="hidden" name="children" value="{{ request('children') }}">

            <!-- Flight Details Summary (gardé tel quel) -->
            <section class="border border-gray-200 rounded-lg p-4 mb-8">
                 <h2 class="text-xl font-semibold mb-4 text-gray-700">Détails du vol</h2>
                 <div class="mb-4 text-sm text-gray-600">
                     <p><strong>Compagnie :</strong> {{ $flight->airline_name }}</p>
                     <p><strong>Numéro de vol :</strong> {{ $flight->flight_number }}</p>
                     <p><strong>Prix (indicatif) :</strong> {{ $flight->price }}€</p>
                 </div>
                 <div class="flex flex-col sm:flex-row justify-between items-center text-sm gap-4">
                     <!-- Departure -->
                     <div class="flex items-center space-x-2">
                         <i class="fas fa-plane-departure text-yellow-500 text-xl"></i>
                         <div>
                             <div class="text-gray-500">Départ</div>
                             <div class="font-semibold">{{ $flight->departureAirport->name }} ({{ $flight->departureAirport->iata }})</div>
                             <div>{{ \Carbon\Carbon::parse($flight->departure_time)->format('H:i') }}</div>
                         </div>
                     </div>
                     <!-- Arrow -->
                     <div class="text-center text-gray-500 hidden sm:block">
                         <i class="fas fa-arrow-right-long text-gray-400 text-lg"></i>
                     </div>
                     <div class="sm:hidden text-center text-gray-500 text-xs my-2">▼</div>
                     <!-- Arrival -->
                     <div class="flex items-center space-x-2 text-left sm:text-right">
                         <i class="fas fa-plane-arrival text-yellow-500 text-xl sm:order-last"></i>
                         <div class="sm:order-first">
                             <div class="text-gray-500">Arrivée</div>
                             <div class="font-semibold">{{ $flight->arrivalAirport->name }} ({{ $flight->arrivalAirport->iata }})</div>
                             <div>{{ \Carbon\Carbon::parse($flight->arrival_time)->format('H:i') }}</div>
                         </div>
                     </div>
                 </div>
            </section>

            <!-- Booking Information Display (gardé tel quel) -->
            <section class="mb-8">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Informations de la réservation</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Champs readonly (gardés tels quels) -->
                    <div>
                        <label for="departure_airport" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-plane-departure text-gray-500 mr-1"></i> Aéroport de départ
                        </label>
                        <input type="text" id="departure_airport" name="departure_airport_display" value="{{ $flight->departureAirport->name }}" readonly class="w-full p-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed focus:outline-none">
                    </div>
                    <div>
                        <label for="arrival_airport" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-plane-arrival text-gray-500 mr-1"></i> Aéroport d'arrivée
                        </label>
                        <input type="text" id="arrival_airport" name="arrival_airport_display" value="{{ $flight->arrivalAirport->name }}" readonly class="w-full p-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed focus:outline-none">
                    </div>
                     <div class="relative">
                        <label for="departure_date" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-calendar-alt text-gray-500 mr-1"></i> Date de départ
                        </label>
                        <input type="text" id="departure_date" name="departure_date_display" value="{{ \Carbon\Carbon::parse(request('date'))->format('d/m/Y') }}" readonly class="w-full p-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed focus:outline-none">
                        <span class="absolute right-3 top-8 text-gray-400">
                            <i class="fas fa-calendar-day"></i>
                        </span>
                    </div>
                    <div>
                        <label for="class" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-chair text-gray-500 mr-1"></i> Classe
                        </label>
                        <input type="text" id="class" name="class_display" value="{{ ucfirst(request('class')) }}" readonly class="w-full p-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed focus:outline-none">
                    </div>
                    <div>
                        <label for="num_adults" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-user text-gray-500 mr-1"></i> Nombre d'adultes
                        </label>
                        <input type="text" id="num_adults" name="num_adults_display" value="{{ request('adults') }}" readonly class="w-full p-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed focus:outline-none">
                    </div>
                    <div>
                        <label for="num_children" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-child text-gray-500 mr-1"></i> Nombre d'enfants
                        </label>
                        <input type="text" id="num_children" name="num_children_display" value="{{ request('children') }}" readonly class="w-full p-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed focus:outline-none">
                    </div>
                </div>
            </section>

            <!-- Passenger Details Sections - MAINTENANT DANS LE FORMULAIRE PRINCIPAL -->
            @php
            $totalPassengers = (int) request('adults') + (int) request('children');
            @endphp

            @if($totalPassengers > 0)
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Informations des passagers</h2>
                {{-- Affichage global des erreurs de validation pour les passagers --}}
                @if ($errors->has('passengers') || $errors->has('passengers.*'))
                    <div class="mb-4 p-3 bg-red-100 border border-red-300 text-red-700 rounded">
                        Veuillez corriger les erreurs dans les informations des passagers ci-dessous.
                    </div>
                @endif
            @endif

            @for ($i = 0; $i < $totalPassengers; $i++) {{-- Index commence à 0 pour les tableaux --}}
                <div class="passenger-section mb-6 p-4 border border-gray-200 rounded @if($errors->has('passengers.'.$i.'.*')) border-red-400 @endif"> {{-- Highlight si erreur pour ce passager --}}
                    <h3 class="font-semibold mb-3 text-gray-600">Passager {{ $i + 1 }}</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                        {{-- Champs du formulaire avec noms en tableau --}}
                        <div>
                            {{-- Utilisation de old() pour conserver les valeurs en cas d'erreur de validation --}}
                            <label for="pass_{{ $i }}_first_name" class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
                            <input type="text"
                                   id="pass_{{ $i }}_first_name"
                                   name="passengers[{{ $i }}][firstname]"
                                   placeholder="Prénom"
                                   value="{{ old('passengers.'.$i.'.firstname') }}"
                                   required
                                   class="w-full p-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('passengers.'.$i.'.firstname') border-red-500 @enderror">
                            {{-- Affichage de l'erreur spécifique --}}
                            @error('passengers.'.$i.'.firstname')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="pass_{{ $i }}_last_name" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                            <input type="text"
                                   id="pass_{{ $i }}_last_name"
                                   name="passengers[{{ $i }}][lastname]"
                                   placeholder="Nom"
                                   value="{{ old('passengers.'.$i.'.lastname') }}"
                                   required
                                   class="w-full p-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('passengers.'.$i.'.lastname') border-red-500 @enderror">
                             @error('passengers.'.$i.'.lastname')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                             <label for="pass_{{ $i }}_gender" class="block text-sm font-medium text-gray-700 mb-1">Sexe</label>
                            <select id="pass_{{ $i }}_gender"
                                    name="passengers[{{ $i }}][gender]"
                                    required
                                    class="w-full p-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 bg-white @error('passengers.'.$i.'.gender') border-red-500 @enderror">
                                <option value="">Choisir...</option>
                                {{-- Utilisation de old() pour la sélection --}}
                                <option value="male" @selected(old('passengers.'.$i.'.gender') == 'male')>Homme</option>
                                <option value="female" @selected(old('passengers.'.$i.'.gender') == 'female')>Femme</option>
                                {{-- <option value="other" @selected(old('passengers.'.$i.'.gender') == 'other')>Autre</option> --}}
                            </select>
                             @error('passengers.'.$i.'.gender')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="pass_{{ $i }}_age" class="block text-sm font-medium text-gray-700 mb-1">Âge</label>
                            <input type="number"
                                   id="pass_{{ $i }}_age"
                                   name="passengers[{{ $i }}][age]"
                                   placeholder="Âge"
                                   value="{{ old('passengers.'.$i.'.age') }}"
                                   required
                                   class="w-full p-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('passengers.'.$i.'.age') border-red-500 @enderror"
                                   min="0">
                             @error('passengers.'.$i.'.age')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    {{-- PAS DE BOUTON "Ajouter Passager" ici --}}
                </div>
            @endfor

            <!-- Bouton final de réservation (reste au même endroit, mais soumet TOUT) -->
            <div class="mt-8 text-right">
                <button type="submit" id="submit-final-booking" class="inline-flex items-center justify-center px-6 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-check mr-2"></i> Réserver maintenant
                </button>
            </div>

        </form> {{-- Fin du formulaire principal unique --}}

    </main>

    {{-- SUPPRESSION DU BLOC SCRIPT pour l'AJAX --}}
    {{-- Pas besoin de jQuery ou du script AJAX pour cette approche --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

</body>
</html>