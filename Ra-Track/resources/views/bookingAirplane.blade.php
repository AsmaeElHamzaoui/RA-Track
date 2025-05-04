<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AirTrack - Réservation de vols</title>
  <!-- Tailwind CSS via CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            darkblue: {
              900: '#121826',
              800: '#1a2235',
              700: '#1e293b',
            }
          }
        }
      }
    }
  </script>
  <style>
    /* Styles CSS inchangés */
    body { background-color: #121826; color: white; }
    input[type="range"] { -webkit-appearance: none; appearance: none; background: #2d3748; height: 4px; border-radius: 2px; outline: none; }
    input[type="range"]::-webkit-slider-thumb { -webkit-appearance: none; appearance: none; width: 16px; height: 16px; background: #3b82f6; border-radius: 50%; cursor: pointer; }
    input[type="range"]::-moz-range-thumb { width: 16px; height: 16px; background: #3b82f6; border-radius: 50%; cursor: pointer; border: none; }
    input[type="checkbox"] { appearance: none; -webkit-appearance: none; width: 16px; height: 16px; border: 1px solid #4a5568; border-radius: 3px; background-color: #121826; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; }
    input[type="checkbox"]:checked { background-color: #3b82f6; border-color: #3b82f6; }
    input[type="checkbox"]:checked::after { content: ""; width: 6px; height: 6px; display: block; background-color: white; border-radius: 1px; }
    input[type="date"] { color-scheme: dark; }
    select { background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%239ca3af' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 0.5rem center; background-size: 1.5em 1.5em; padding-right: 2.5rem; -webkit-appearance: none; -moz-appearance: none; appearance: none; }
  </style>
</head>

<body class="min-h-screen text-white" style="background: linear-gradient(to bottom,rgb(22, 34, 56),#F1F0E9);">
  <!-- Header -->
  @include('layouts.header')
  <!-- Main Content -->
  <div class="p-4 md:p-8">
    <div class="max-w-6xl mx-auto">
      <h1 class="text-2xl font-bold mb-2">Réservez votre vol</h1>
      <p class="text-gray-400 text-sm mb-6">Sélectionnez votre vol, vos passagers et effectuez votre réservation.</p>

      <!-- Search Form -->
      <div class="bg-darkblue-800 rounded-lg p-4 mb-6">
        {{-- Le formulaire pointe vers la route 'booking' avec la méthode GET --}}
        <form method="GET" action="{{ route('booking') }}">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <div>
                <label for="booking-departure" class="block text-sm text-gray-400 mb-1">Départ</label>
                <div class="relative">
                  {{-- Le name="departure" sera utilisé dans le contrôleur --}}
                  <select id="booking-departure" name="departure" class="w-full bg-darkblue-900 border border-gray-700 rounded p-2 appearance-none">
                    <option value="">Ville de départ</option> {{-- Option par défaut --}}
                    {{-- Boucle sur les aéroports fournis par le contrôleur --}}
                    @foreach ($airports as $airport)
                      {{-- Sélectionne l'option si son ID correspond à la valeur 'departure' de la requête précédente --}}
                      <option value="{{ $airport->id }}" {{ request('departure') == $airport->id ? 'selected' : '' }}>
                        {{ $airport->name }} {{-- Affiche le nom de l'aéroport --}}
                      </option>
                    @endforeach
                  </select>
                </div>
            </div>
            <div>
              <label for="booking-arrival" class="block text-sm text-gray-400 mb-1">Arrivée</label>
              <div class="relative">
                 {{-- Le name="arrival" sera utilisé dans le contrôleur --}}
                <select id="booking-arrival" name="arrival" class="w-full bg-darkblue-900 border border-gray-700 rounded p-2 appearance-none">
                  <option value="">Ville d'arrivée</option> {{-- Option par défaut --}}
                   {{-- Boucle sur les aéroports fournis par le contrôleur --}}
                  @foreach ($airports as $airport)
                     {{-- Sélectionne l'option si son ID correspond à la valeur 'arrival' de la requête précédente --}}
                    <option value="{{ $airport->id }}" {{ request('arrival') == $airport->id ? 'selected' : '' }}>
                      {{ $airport->name }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
            <div>
              <label for="booking-flightDate" class="block text-sm text-gray-400 mb-1">Date</label>
              {{-- Le name="date" sera utilisé dans le contrôleur --}}
              {{-- La valeur est pré-remplie avec la date de la requête précédente --}}
              <input
                type="date"
                id="booking-flightDate"
                name="date"
                value="{{ request('date') }}"
                class="w-full bg-darkblue-900 border border-gray-700 rounded p-2" />
            </div>
          </div>
          {{-- Garde les champs Classe et Passagers pour la cohérence de l'interface --}}
          {{-- Leurs valeurs seront aussi conservées après soumission grâce à request() --}}
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
             <div>
                <label for="booking-class" class="block text-sm text-gray-400 mb-1">Classe</label>
                <div class="relative">
                  <select id="booking-class" name="class" class="w-full bg-darkblue-900 border border-gray-700 rounded p-2 appearance-none">
                    <option value="Economique" {{ request('class') == 'Economique' ? 'selected' : '' }}>Économique</option>
                    <option value="economy" {{ request('class') == 'economy' ? 'selected' : '' }}>Economy</option>
                    <option value="business" {{ request('class') == 'business' ? 'selected' : '' }}>Business</option>
                    <option value="first" {{ request('class') == 'first' ? 'selected' : '' }}>First</option>
                  </select>
                </div>
              </div>
             <div>
                <label class="block text-sm text-gray-400 mb-1">Passagers</label>
                <div class="grid grid-cols-2 gap-2">
                  <div class="relative">
                    <select id="booking-adults" name="adults" class="w-full bg-darkblue-900 border border-gray-700 rounded p-2 appearance-none">
                      {{-- Utilise 1 comme valeur par défaut si 'adults' n'est pas dans la requête --}}
                      <option value="1" {{ request('adults', '1') == '1' ? 'selected' : '' }}>1 Adulte</option>
                      <option value="2" {{ request('adults') == '2' ? 'selected' : '' }}>2 Adultes</option>
                      <option value="3" {{ request('adults') == '3' ? 'selected' : '' }}>3 Adultes</option>
                      <option value="4" {{ request('adults') == '4' ? 'selected' : '' }}>4 Adultes</option>
                    </select>
                  </div>
                  <div class="relative">
                    <select id="booking-children" name="children" class="w-full bg-darkblue-900 border border-gray-700 rounded p-2 appearance-none">
                       {{-- Utilise 0 comme valeur par défaut si 'children' n'est pas dans la requête --}}
                      <option value="0" {{ request('children', '0') == '0' ? 'selected' : '' }}>0 Enfant</option>
                      <option value="1" {{ request('children') == '1' ? 'selected' : '' }}>1 Enfant</option>
                      <option value="2" {{ request('children') == '2' ? 'selected' : '' }}>2 Enfants</option>
                      <option value="3" {{ request('children') == '3' ? 'selected' : '' }}>3 Enfants</option>
                    </select>
                  </div>
                </div>
              </div>
            <div class="flex items-end">
              {{-- Le bouton de type submit déclenche l'envoi du formulaire --}}
              <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded transition">
                Rechercher des Vols
              </button>
            </div>
          </div>
        </form> {{-- Fin du formulaire --}}
      </div>


      <!-- Results Section -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Filters (Partie Filtres - inchangée et non fonctionnelle pour le moment) -->
        <div class="bg-darkblue-800 rounded-lg p-4">
          <h2 class="font-bold mb-4">Filtres</h2>

          <div class="mb-4">
            <label class="block text-sm text-gray-400 mb-1">Prix maximum</label>
            <input type="range" min="0" max="1000" step="10" value="500" id="priceRange" class="w-full" />
            <div class="flex justify-between text-sm text-gray-400">
              <span>0€</span>
              <span id="priceValue">500€</span> {{-- Initialement à 500€, sera mis à jour par JS si présent --}}
            </div>
          </div>

          <div class="mb-4">
            <h3 class="text-sm font-medium mb-2">Heure de départ</h3>
            <div class="space-y-2 text-sm">
              <label class="flex items-center"><input type="checkbox" class="mr-2" /><span>Matin (6h-12h)</span></label>
              <label class="flex items-center"><input type="checkbox" class="mr-2" /><span>Après-midi (12h-18h)</span></label>
              <label class="flex items-center"><input type="checkbox" class="mr-2" /><span>Soir (18h-00h)</span></label>
            </div>
          </div>

          <div>
            <h3 class="text-sm font-medium mb-2">Compagnies</h3>
            <div class="space-y-2 text-sm">
              <label class="flex items-center"><input type="checkbox" class="mr-2" checked /><span>Air France</span></label>
              <label class="flex items-center"><input type="checkbox" class="mr-2" /><span>KLM</span></label>
              <label class="flex items-center"><input type="checkbox" class="mr-2" /><span>Lufthansa</span></label>
            </div>
          </div>
        </div>

        <!-- Flight Results -->
        <div class="md:col-span-3">
          {{-- Utilisation de @forelse pour boucler sur les vols ou afficher un message si la collection est vide --}}
          {{-- La variable $flights doit être passée par le contrôleur --}}
          @forelse ($flights as $flight)
            {{-- Début de la structure HTML pour UN résultat de vol (identique à ton exemple statique) --}}
            <div class="bg-darkblue-800 rounded-lg p-4 mb-4">
              <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                <div class="flex items-center mb-2 md:mb-0">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 mr-2">
                    <path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path>
                    <polygon points="12 15 17 21 7 21 12 15"></polygon>
                  </svg>
                  <div>
                    {{-- Afficher le nom de la compagnie (adapte 'airline_name' si le nom de ta colonne est différent) --}}
                    <div class="font-medium">{{ $flight->airline_name ?? 'Compagnie Aérienne' }}</div>
                    {{-- Afficher le numéro de vol (adapte 'flight_number') --}}
                    <div class="text-xs text-gray-400">{{ $flight->flight_number ?? 'N/A' }}</div>
                  </div>
                </div>
                 {{-- Afficher le prix (adapte 'price') --}}
                <div class="text-xl font-bold">{{ $flight->price ?? 'N/A' }}€</div>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                  <div class="text-sm text-gray-400">Départ</div>
                   {{-- Formater l'heure de départ (adapte 'departure_time') --}}
                   {{-- Assure-toi que Carbon est disponible, sinon utilise date() de PHP --}}
                  <div class="text-xl font-medium">{{ \Carbon\Carbon::parse($flight->departure_time)->format('H:i') }}</div>
                  {{-- Afficher le nom de l'aéroport de départ via la relation Eloquent --}}
                  {{-- Assure-toi que la relation 'departureAirport' existe dans ton modèle Flight --}}
                  <div class="text-sm">{{ $flight->departureAirport->name ?? 'Aéroport Départ' }}</div>
                </div>

                <div class="flex flex-col items-center justify-center">
                  {{-- Calculer et afficher la durée du vol --}}
                  <div class="text-xs text-gray-400">
                     {{ \Carbon\Carbon::parse($flight->departure_time)->diff(\Carbon\Carbon::parse($flight->arrival_time))->format('%hh %im') }}
                  </div>
                  <div class="w-full h-px bg-gray-700 my-2 relative">
                    <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-2 h-2 rounded-full bg-blue-500"></div>
                    <div class="absolute right-0 top-1/2 transform -translate-y-1/2 w-2 h-2 rounded-full bg-blue-500"></div>
                  </div>
                   {{-- Tu peux ajouter une logique ici pour 'Direct' ou 'Escale' si tu as l'info --}}
                  <div class="text-xs text-gray-400">Direct</div>
                </div>

                <div>
                  <div class="text-sm text-gray-400">Arrivée</div>
                  {{-- Formater l'heure d'arrivée (adapte 'arrival_time') --}}
                  <div class="text-xl font-medium">{{ \Carbon\Carbon::parse($flight->arrival_time)->format('H:i') }}</div>
                  {{-- Afficher le nom de l'aéroport d'arrivée via la relation Eloquent --}}
                  {{-- Assure-toi que la relation 'arrivalAirport' existe dans ton modèle Flight --}}
                  <div class="text-sm">{{ $flight->arrivalAirport->name ?? 'Aéroport Arrivée' }}</div>
                </div>
              </div>

              <div class="mt-4 flex justify-end">
              <form method="GET" action="{{ route('reservation.show', ['flight' => $flight->id]) }}">
                 <input type="hidden" name="departure" value="{{ request('departure') }}">
                 <input type="hidden" name="arrival" value="{{ request('arrival') }}">
                 <input type="hidden" name="date" value="{{ request('date') }}">
                 <input type="hidden" name="class" value="{{ request('class') }}">
                 <input type="hidden" name="adults" value="{{ request('adults') }}">
                 <input type="hidden" name="children" value="{{ request('children') }}">
                 <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-1 px-3 rounded">Sélectionner</button>
              </form>
              <a href="{{ route('flights.show', ['id' => $flight->id]) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-1 px-3 rounded ml-2"> {{-- Ajout de ml-2 pour l'espacement --}}
                    Détail
              </a>
              </div>
            </div>
          @empty
            <div class="bg-darkblue-800 rounded-lg p-4 text-center text-gray-400">
              Aucun vol trouvé correspondant à vos critères de recherche.
            </div>
          @endforelse
        </div>
      </div>

    </div>
  </div>

   @include('layouts.footer')

  <script>
    // Script pour initialiser et gérer le slider de prix (inchangé, mais non connecté au filtre PHP pour l'instant)
    document.addEventListener('DOMContentLoaded', function() {
      const priceRange = document.getElementById('priceRange');
      const priceValue = document.getElementById('priceValue');
      if (priceRange && priceValue) {
        // Initialiser la valeur affichée basée sur la valeur initiale du range
        priceValue.textContent = priceRange.value + '€';
        // Mettre à jour la valeur affichée lorsque le slider est bougé
        priceRange.addEventListener('input', function() {
          priceValue.textContent = this.value + '€';
        });
      }
    });
  </script>

</body>
</html>