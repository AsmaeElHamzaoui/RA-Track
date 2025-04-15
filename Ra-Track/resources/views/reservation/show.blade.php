<!DOCTYPE html>
<html lang="fr"> {{-- Changed language to French --}}
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Use the flight details for the title, dynamically --}}
    <title>AirBooking - Réservation {{ $flight->departureAirport->iata }} vers {{ $flight->arrivalAirport->iata }}</title>
    <!-- Include Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include Font Awesome via CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Optional: Add custom styles or override Tailwind defaults here */
        /* Style for the select dropdown arrow (Tailwind usually handles this well with form plugins, but basic styling here) */
        select {
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.5rem center;
            background-size: 1.5em 1.5em;
            -webkit-appearance: none;
            appearance: none;
            padding-right: 2.5rem; /* Make space for the arrow */
        }
         
        /* Style read-only fields to look like the target example */
        input[readonly], select[disabled].readonly-imitation {
             background-color: #f3f4f6; /* bg-gray-100 */
             cursor: not-allowed;
             border-color: #d1d5db; /* border-gray-300 */
        }
        /* Custom class to make disabled select look like readonly input */
        select[disabled].readonly-imitation {
            color: #374151; /* text-gray-700 */
            -webkit-appearance: none;
            appearance: none;
            background-image: none; /* Remove arrow */
            padding-right: 0.5rem; /* Reset padding */
        }

    </style>
</head>
<body class="bg-gradient-to-b from-gray-900 to-indigo-900 text-gray-800 font-sans p-4 md:p-8">

    <!-- Header -->
    <header class="container mx-auto max-w-6xl mb-8">
        <nav class="flex justify-between items-center text-white">
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                  </svg>
                <span class="text-xl font-bold">AirBooking</span>
            </div>
            <div class="hidden md:flex space-x-6">
                <a href="#" class="hover:text-gray-300">Accueil</a> {{-- Changed to French --}}
                <a href="#" class="hover:text-gray-300">Vols</a> {{-- Changed to French --}}
                <a href="#" class="hover:text-gray-300">Mes Réservations</a> {{-- Changed to French --}}
                <a href="#" class="hover:text-gray-300">Contact</a>
            </div>
            <!-- Mobile Menu Button (Optional) -->
            <button class="md:hidden focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </nav>
    </header>

    <!-- Main Content Area -->
    <main class="container mx-auto max-w-4xl bg-white rounded-lg shadow-lg p-6 md:p-8">

        <form action="{{ route('reservation.submit') }}" method="POST">
            @csrf
             {{-- Hidden inputs to pass flight and booking details if needed by the controller --}}
             <input type="hidden" name="flight_id" value="{{ $flight->id }}">
             <input type="hidden" name="date" value="{{ request('date') }}">
             <input type="hidden" name="class" value="{{ request('class') }}">
             <input type="hidden" name="adults" value="{{ request('adults') }}">
             <input type="hidden" name="children" value="{{ request('children') }}">

            <!-- Flight Details Summary -->
            <section class="border border-gray-200 rounded-lg p-4 mb-8">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Détails du vol</h2> {{-- Changed to French --}}
                {{-- Add Airline and Flight Number --}}
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
                            <div class="text-gray-500">Départ</div> {{-- Changed to French --}}
                            <div class="font-semibold">{{ $flight->departureAirport->name }} ({{ $flight->departureAirport->iata }})</div>
                            <div>{{ \Carbon\Carbon::parse($flight->departure_time)->format('H:i') }}</div>
                        </div>
                    </div>

                    <!-- Duration Placeholder (Calculate if possible/needed) -->
                    <div class="text-center text-gray-500 hidden sm:block"> {{-- Hide on small screens if cramped --}}
                        {{-- Calculation needed: $duration = \Carbon\Carbon::parse($flight->arrival_time)->diff(\Carbon\Carbon::parse($flight->departure_time)); --}}
                        {{-- <div class="w-16 h-px bg-gray-300 my-1 relative">
                             <div class="absolute left-0 top-1/2 w-full h-px border-t border-dashed border-gray-400"></div>
                        </div> --}}
                         <i class="fas fa-arrow-right-long text-gray-400 text-lg"></i>
                        {{-- <div>{{ $duration->format('%Hh %Im') }}</div> --}}
                    </div>
                     <div class="sm:hidden text-center text-gray-500 text-xs my-2">▼</div> {{-- Down arrow on small screens --}}

                    <!-- Arrival -->
                    <div class="flex items-center space-x-2 text-left sm:text-right">
                         <i class="fas fa-plane-arrival text-yellow-500 text-xl sm:order-last"></i>
                         <div class="sm:order-first">
                            <div class="text-gray-500">Arrivée</div> {{-- Changed to French --}}
                            <div class="font-semibold">{{ $flight->arrivalAirport->name }} ({{ $flight->arrivalAirport->iata }})</div>
                            <div>{{ \Carbon\Carbon::parse($flight->arrival_time)->format('H:i') }}</div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Booking Information Display -->
            <section class="mb-8">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Informations de la réservation</h2> {{-- Changed to French --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Departure Airport (Readonly) -->
                    <div>
                        <label for="departure_airport" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-plane-departure text-gray-500 mr-1"></i> Aéroport de départ {{-- Changed to French --}}
                        </label>
                        <input type="text" id="departure_airport" name="departure_airport_display" value="{{ $flight->departureAirport->name }}" readonly class="w-full p-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed focus:outline-none">
                    </div>

                    <!-- Arrival Airport (Readonly) -->
                    <div>
                        <label for="arrival_airport" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-plane-arrival text-gray-500 mr-1"></i> Aéroport d'arrivée {{-- Changed to French --}}
                        </label>
                        <input type="text" id="arrival_airport" name="arrival_airport_display" value="{{ $flight->arrivalAirport->name }}" readonly class="w-full p-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed focus:outline-none">
                    </div>

                    <!-- Departure Date (Readonly) -->
                    <div class="relative">
                        <label for="departure_date" class="block text-sm font-medium text-gray-700 mb-1">
                           <i class="fas fa-calendar-alt text-gray-500 mr-1"></i> Date de départ {{-- Changed to French --}}
                        </label>
                        {{-- Displaying date from request, assuming 'Y-m-d' format from search, converting to 'd/m/Y' --}}
                        <input type="text" id="departure_date" name="departure_date_display" value="{{ \Carbon\Carbon::parse(request('date'))->format('d/m/Y') }}" readonly class="w-full p-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed focus:outline-none">
                         <span class="absolute right-3 top-8 text-gray-400">
                             <i class="fas fa-calendar-day"></i>
                         </span>
                    </div>

                    <!-- Class (Readonly) -->
                    <div>
                        <label for="class" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-chair text-gray-500 mr-1"></i> Classe {{-- Changed to French --}}
                        </label>
                        {{-- Using a readonly input to display the chosen class --}}
                        <input type="text" id="class" name="class_display" value="{{ ucfirst(request('class')) }}" readonly class="w-full p-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed focus:outline-none">
                    </div>

                    <!-- Number of Adults (Readonly) -->
                    <div>
                        <label for="num_adults" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-user text-gray-500 mr-1"></i> Nombre d'adultes {{-- Changed to French --}}
                        </label>
                         {{-- Using a readonly input to display the number --}}
                        <input type="text" id="num_adults" name="num_adults_display" value="{{ request('adults') }}" readonly class="w-full p-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed focus:outline-none">
                    </div>

                     <!-- Number of Children (Readonly) -->
                     <div>
                        <label for="num_children" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-child text-gray-500 mr-1"></i> Nombre d'enfants {{-- Changed to French --}}
                        </label>
                        {{-- Using a readonly input to display the number --}}
                        <input type="text" id="num_children" name="num_children_display" value="{{ request('children') }}" readonly class="w-full p-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed focus:outline-none">
                    </div>
                </div>
            </section>

            <!-- Passenger Details Sections -->
            @php
                $totalPassengers = (int) request('adults') + (int) request('children');
                $numAdults = (int) request('adults');
            @endphp

            @if($totalPassengers > 0)
                 <h2 class="text-xl font-semibold mb-4 text-gray-700">Informations des passagers</h2> {{-- Changed to French --}}
            @endif

            @for ($i = 1; $i <= $totalPassengers; $i++)
                @php
                    // Determine if the current passenger is an adult or child for the title
                    $passengerType = ($i <= $numAdults) ? 'Adulte' : 'Enfant';
                    $passengerIndex = ($i <= $numAdults) ? $i : $i - $numAdults;
                @endphp
                <section class="mb-8 border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700"> {{-- Changed h2 to h3 for hierarchy --}}
                        {{-- Using appropriate icons based on type --}}
                        @if($passengerType == 'Adulte')
                            <i class="fas fa-user mr-2 text-indigo-600"></i>Passager {{ $passengerType }} {{ $passengerIndex }}
                        @else
                            <i class="fas fa-child mr-2 text-indigo-600"></i>Passager {{ $passengerType }} {{ $passengerIndex }}
                        @endif
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                        <!-- Last Name (Nom) -->
                        <div>
                            <label for="passenger_{{ $i }}_last_name" class="block text-sm font-medium text-gray-700 mb-1">Nom</label> {{-- Changed to French --}}
                            <input type="text" id="passenger_{{ $i }}_last_name" name="passengers[{{ $i }}][nom]" placeholder="Nom de famille" required class="w-full p-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"> {{-- Added required, changed placeholder --}}
                        </div>
                        <!-- First Name (Prénom) -->
                        <div>
                            <label for="passenger_{{ $i }}_first_name" class="block text-sm font-medium text-gray-700 mb-1">Prénom</label> {{-- Changed to French --}}
                            <input type="text" id="passenger_{{ $i }}_first_name" name="passengers[{{ $i }}][prenom]" placeholder="Prénom" required class="w-full p-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"> {{-- Added required --}}
                        </div>
                         <!-- Gender (Sexe) -->
                         <div class="md:col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Sexe</label> {{-- Changed to French --}}
                            <div class="flex items-center space-x-4 mt-1">
                                <label class="flex items-center space-x-1 cursor-pointer">
                                    {{-- Use the same name attribute structure --}}
                                    <input type="radio" name="passengers[{{ $i }}][sexe]" value="Homme" required class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"> {{-- Added required --}}
                                    <span class="text-sm text-gray-700">Homme</span> {{-- Changed to French --}}
                                </label>
                                <label class="flex items-center space-x-1 cursor-pointer">
                                    <input type="radio" name="passengers[{{ $i }}][sexe]" value="Femme" required class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"> {{-- Added required --}}
                                    <span class="text-sm text-gray-700">Femme</span> {{-- Changed to French --}}
                                </label>
                            </div>
                        </div>
                        <!-- Age -->
                        <div>
                            <label for="passenger_{{ $i }}_age" class="block text-sm font-medium text-gray-700 mb-1">Âge</label> {{-- Changed to French --}}
                            <input type="number" id="passenger_{{ $i }}_age" name="passengers[{{ $i }}][age]" placeholder="Âge" required min="0" class="w-full p-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"> {{-- Added required, min=0 --}}
                        </div>
                    </div>
                </section>
            @endfor


            <!-- Book Now Button -->
            <div class="mt-8 text-right">
                <button type="submit" class="inline-flex items-center justify-center px-6 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-check mr-2"></i> Réserver maintenant {{-- Changed to French --}}
                </button>
            </div>

        </form> {{-- End Form --}}

    </main>

    <!-- JavaScript (Optional - for potential future enhancements like date pickers or dynamic passenger forms) -->
    <script>
        // Example: You could add JavaScript here for things like:
        // - Initializing a date picker for the departure date if it were editable.
        // - Dynamically adding/removing passenger form sections if the number of passengers could be changed on this page.
        // - Form validation before submission.

        // The simple show/hide logic from the original example isn't directly applicable
        // here because the number of passengers is determined by the request parameters
        // and rendered by the Blade loop.
    </script>

</body>
</html>