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

   

      

    </div>
  </div>

  
</body>
</html>