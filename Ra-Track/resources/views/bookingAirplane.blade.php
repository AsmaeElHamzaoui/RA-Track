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
    body {
      background-color: #121826;
      color: white;
    }

    input[type="range"] {
      -webkit-appearance: none;
      appearance: none;
      background: #2d3748;
      height: 4px;
      border-radius: 2px;
      outline: none;
    }

    input[type="range"]::-webkit-slider-thumb {
      -webkit-appearance: none;
      appearance: none;
      width: 16px;
      height: 16px;
      background: #3b82f6;
      border-radius: 50%;
      cursor: pointer;
    }

    input[type="range"]::-moz-range-thumb {
      width: 16px;
      height: 16px;
      background: #3b82f6;
      border-radius: 50%;
      cursor: pointer;
      border: none;
    }

    input[type="checkbox"] {
      appearance: none;
      -webkit-appearance: none;
      width: 16px;
      height: 16px;
      border: 1px solid #4a5568;
      border-radius: 3px;
      background-color: #121826;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
    }

    input[type="checkbox"]:checked {
      background-color: #3b82f6;
      border-color: #3b82f6;
    }

    input[type="checkbox"]:checked::after {
      content: "";
      width: 6px;
      height: 6px;
      display: block;
      background-color: white;
      border-radius: 1px;
    }

    input[type="date"] {
      color-scheme: dark;
    }

    select {
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%239ca3af' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 0.5rem center;
      background-size: 1.5em 1.5em;
      padding-right: 2.5rem;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
    }
  </style>
</head>
<body class="min-h-screen bg-darkblue-900 text-white">
  <!-- Header -->
  <header class="bg-darkblue-800 py-3 px-4 md:px-8 flex items-center justify-between border-b border-gray-800">
    <div class="flex items-center">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 mr-1 rotate-45">
        <path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path>
        <polygon points="12 15 17 21 7 21 12 15"></polygon>
      </svg>
      <span class="font-bold text-lg">AirTrack</span>
    </div>
    <nav class="hidden md:flex space-x-6 text-sm">
      <a href="#" class="text-gray-400 hover:text-white">Accueil</a>
      <a href="#" class="text-gray-400 hover:text-white">Réservations</a>
      <a href="#" class="text-white font-medium">Suivi des vols</a>
      <a href="#" class="text-gray-400 hover:text-white">Contact</a>
    </nav>
    <button class="p-2 rounded-full bg-gray-800 md:hidden">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="3" y1="12" x2="21" y2="12"></line>
        <line x1="3" y1="6" x2="21" y2="6"></line>
        <line x1="3" y1="18" x2="21" y2="18"></line>
      </svg>
    </button>
  </header>

  <!-- Main Content -->
  <div class="p-4 md:p-8">
    <div class="max-w-6xl mx-auto">
      <h1 class="text-2xl font-bold mb-2">Réservez votre vol</h1>
      <p class="text-gray-400 text-sm mb-6">Sélectionnez votre vol, vos passagers et effectuez votre réservation.</p>

      <!-- Search Form -->
      <div class="bg-darkblue-800 rounded-lg p-4 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
          <div>
            <label class="block text-sm text-gray-400 mb-1">Départ</label>
            <div class="relative">
              <select id="booking-departure" name="departure" class="w-full bg-darkblue-900 border border-gray-700 rounded p-2 appearance-none">
                <option value="" disabled selected>Ville de départ</option>
                <option value="Paris (CDG)">Paris (CDG)</option>
                <option value="Lyon (LYS)">Lyon (LYS)</option>
                <option value="Marseille (MRS)">Marseille (MRS)</option>
              </select>
            </div>
          </div>
          <div>
            <label class="block text-sm text-gray-400 mb-1">Arrivée</label>
            <div class="relative">
              <select id="booking-arrival" name="arrival" class="w-full bg-darkblue-900 border border-gray-700 rounded p-2 appearance-none">
                <option value="" disabled selected>Ville d'arrivée</option>
                <option value="Londres (LHR)">Londres (LHR)</option>
                <option value="New York (JFK)">New York (JFK)</option>
                <option value="Tokyo (HND)">Tokyo (HND)</option>
              </select>
            </div>
          </div>
          <div>
            <label class="block text-sm text-gray-400 mb-1">Date</label>
            <input
              type="date"
              id="booking-flightDate"
              name="date"
              class="w-full bg-darkblue-900 border border-gray-700 rounded p-2"
            />
          </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
          <div>
            <label class="block text-sm text-gray-400 mb-1">Classe</label>
            <div class="relative">
              <select id="booking-class" name="class" class="w-full bg-darkblue-900 border border-gray-700 rounded p-2 appearance-none">
                <option value="Economique">Économique</option>
                <option value="Premium">Premium</option>
                <option value="Affaires">Affaires</option>
                <option value="Premiere">Première</option>
              </select>
            </div>
          </div>
          <div>
            <label class="block text-sm text-gray-400 mb-1">Passagers</label>
            <div class="grid grid-cols-2 gap-2">
              <div class="relative">
                <select id="booking-adults" name="adults" class="w-full bg-darkblue-900 border border-gray-700 rounded p-2 appearance-none">
                  <option value="1">1 Adulte</option>
                  <option value="2">2 Adultes</option>
                  <option value="3">3 Adultes</option>
                  <option value="4">4 Adultes</option>
                </select>
              </div>
              <div class="relative">
                <select id="booking-children" name="children" class="w-full bg-darkblue-900 border border-gray-700 rounded p-2 appearance-none">
                  <option value="0">0 Enfant</option>
                  <option value="1">1 Enfant</option>
                  <option value="2">2 Enfants</option>
                  <option value="3">3 Enfants</option>
                </select>
              </div>
            </div>
          </div>
          <div class="flex items-end">
            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded transition">
              Rechercher des Vols
            </button>
          </div>
        </div>
      </div>

   
     <!-- Results Section -->
     <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Filters -->
        <div class="bg-darkblue-800 rounded-lg p-4">
          <h2 class="font-bold mb-4">Filtres</h2>
          
          <div class="mb-4">
            <label class="block text-sm text-gray-400 mb-1">Prix maximum</label>
            <input 
              type="range" 
              min="0" 
              max="1000" 
              step="10"
              value="50"
              id="priceRange"
              class="w-full"
            />
            <div class="flex justify-between text-sm text-gray-400">
              <span>0€</span>
              <span id="priceValue">50€</span>
            </div>
          </div>
          
          <div class="mb-4">
            <h3 class="text-sm font-medium mb-2">Heure de départ</h3>
            <div class="space-y-2 text-sm">
              <label class="flex items-center">
                <input type="checkbox" class="mr-2" />
                <span>Matin (6h-12h)</span>
              </label>
              <label class="flex items-center">
                <input type="checkbox" class="mr-2" />
                <span>Après-midi (12h-18h)</span>
              </label>
              <label class="flex items-center">
                <input type="checkbox" class="mr-2" />
                <span>Soir (18h-00h)</span>
              </label>
            </div>
          </div>
          
          <div>
            <h3 class="text-sm font-medium mb-2">Compagnies</h3>
            <div class="space-y-2 text-sm">
              <label class="flex items-center">
                <input type="checkbox" class="mr-2" checked />
                <span>Air France</span>
              </label>
              <label class="flex items-center">
                <input type="checkbox" class="mr-2" />
                <span>KLM</span>
              </label>
              <label class="flex items-center">
                <input type="checkbox" class="mr-2" />
                <span>Lufthansa</span>
              </label>
            </div>
          </div>
        </div>
        
        <!-- Flight Results -->
        <div class="md:col-span-3">
          <div class="bg-darkblue-800 rounded-lg p-4 mb-4">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
              <div class="flex items-center mb-2 md:mb-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 mr-2">
                  <path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path>
                  <polygon points="12 15 17 21 7 21 12 15"></polygon>
                </svg>
                <div>
                  <div class="font-medium">Air France</div>
                  <div class="text-xs text-gray-400">AF1234</div>
                </div>
              </div>
              <div class="text-xl font-bold">459€</div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>
                <div class="text-sm text-gray-400">Départ</div>
                <div class="text-xl font-medium">08:00</div>
                <div class="text-sm">Paris (CDG)</div>
              </div>
              
              <div class="flex flex-col items-center justify-center">
                <div class="text-xs text-gray-400">2h 15m</div>
                <div class="w-full h-px bg-gray-700 my-2 relative">
                  <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-2 h-2 rounded-full bg-blue-500"></div>
                  <div class="absolute right-0 top-1/2 transform -translate-y-1/2 w-2 h-2 rounded-full bg-blue-500"></div>
                </div>
                <div class="text-xs text-gray-400">Direct</div>
              </div>
              
              <div>
                <div class="text-sm text-gray-400">Arrivée</div>
                <div class="text-xl font-medium">10:15</div>
                <div class="text-sm">Londres (LHR)</div>
              </div>
            </div>
            
            <div class="mt-4 flex justify-end">
              <button class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-1.5 px-4 rounded text-sm transition">
                Sélectionner
              </button>
            </div>
          </div>
        </div>
      </div>
      

    </div>
  </div>

  @include('layouts.footer')

  <script>
    // Initialiser la date à aujourd'hui
    document.addEventListener('DOMContentLoaded', function() {
      const today = new Date();
      const formattedDate = today.toISOString().split('T')[0];
      document.getElementById('flightDate').value = formattedDate;
      
      // Gérer le changement de prix
      const priceRange = document.getElementById('priceRange');
      const priceValue = document.getElementById('priceValue');
      
      priceRange.addEventListener('input', function() {
        priceValue.textContent = this.value + '€';
      });
    });
  </script>
  
  <script>
    // Script pour initialiser le slider de prix (si tu le gardes)
    document.addEventListener('DOMContentLoaded', function() {
      const priceRange = document.getElementById('priceRange');
      const priceValue = document.getElementById('priceValue');
      if(priceRange && priceValue) {
          priceValue.textContent = priceRange.value + '€';
          priceRange.addEventListener('input', function() { priceValue.textContent = this.value + '€'; });
      }

      // --- JS POUR LIRE LES PARAMÈTRES URL ET REMPLIR LE FORMULAIRE ---
      const params = new URLSearchParams(window.location.search);

      // Récupérer les valeurs depuis les paramètres URL
      const departure = params.get('departure');
      const arrival = params.get('arrival');
      const date = params.get('date');
      const flightClass = params.get('class');
      const adults = params.get('adults');
      const children = params.get('children');

      // Fonction sécurisée pour définir la valeur d'un champ
      function setFieldValue(elementId, value) {
          const element = document.getElementById(elementId);
          // Vérifie si l'élément existe ET si la valeur n'est pas nulle/vide
          if (element && value) {
              element.value = value;
          } else if (element) {
             // Optionnel: laisser la valeur par défaut ou mettre une indication
             // console.log(`Valeur manquante pour ${elementId}`);
          } else {
             console.error(`Élément avec ID '${elementId}' non trouvé.`);
          }
      }

      // Appliquer les valeurs aux champs du formulaire de cette page
      setFieldValue('booking-departure', departure);
      setFieldValue('booking-arrival', arrival);
      setFieldValue('booking-flightDate', date);
      setFieldValue('booking-class', flightClass);
      setFieldValue('booking-adults', adults);
      setFieldValue('booking-children', children);

      // Optionnel: Afficher un message de confirmation des critères
      const resultsInfo = document.getElementById('flightResultsInfo');
      if(resultsInfo && departure && arrival && date){
          // Formatter la date pour l'affichage (simple)
           let displayDate = date;
           try {
               displayDate = new Date(date).toLocaleDateString('fr-FR', { day: 'numeric', month: 'long', year: 'numeric' });
           } catch (e) { /* Garder la date brute si le formatage échoue */ }

          resultsInfo.innerHTML = `Affichage des vols pour : <strong>${departure}</strong> vers <strong>${arrival}</strong> le <strong>${displayDate}</strong>`;
      } else if(resultsInfo) {
          resultsInfo.textContent = "Veuillez spécifier vos critères de recherche.";
      }

    }); // Fin de DOMContentLoaded
  </script>
</body>
</html>