<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LimoWide</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'navy': {
                            800: '#1a2e4c',
                        },
                    },
                }
            }
        }
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
</head>

<body class="bg-gray-100">

    <div class="custom-bg">
        <!-- Vidéo d'arrière-plan -->
        <video autoplay loop muted playsinline id="background-video">
            <source src="{{ asset('videos/Airplane.mp4') }}" type="video/mp4">
            <!-- Ajoutez d'autres formats de vidéo pour une meilleure compatibilité (webm, ogg) -->
            Votre navigateur ne supporte pas la lecture de vidéos.
        </video>

        <!-- Overlay sombre (facultatif) -->
        <div class="overlay"></div>
        <!-- Header -->
        @include('layouts.header')
        <!-- Hero Section -->
        <section class="hero-content text-white">
            <div class="container mx-auto text-center px-4">
                <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">ENJOY YOUR <span style="color:#FFD476;">INCREDIBLE</span>
                    <br> RIDE WITH US!
                </h1>
                <!-- Flight Search Form Integrated Here -->
                <div class="hero-search-form bg-slate-900/70 backdrop-blur-sm rounded-lg p-4 md:p-6 mt-8 max-w-4xl mx-auto shadow-xl">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="hero-departure" class="block text-sm text-gray-300 mb-1">Départ</label>
                            <div class="relative">
                                <select id="hero-departure" class="inputBox" required class="w-full border border-gray-700 rounded p-2 appearance-none focus:outline-none focus:ring-2 focus:ring-brand-yellow transition bg-darkblue-800 text-white">
                                  <option value="" disabled selected>Ville de départ</option>
                                  <option value="Paris (CDG)">Paris (CDG)</option>
                                  <option value="Lyon (LYS)">Lyon (LYS)</option>
                                  <option value="Marseille (MRS)">Marseille (MRS)</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="hero-arrival" class="block text-sm text-gray-300 mb-1">Arrivée</label>
                            <div class="relative">
                                <select id="hero-arrival" class="inputBox" required class="w-full border border-gray-700 rounded p-2 appearance-none focus:outline-none focus:ring-2 focus:ring-brand-yellow transition bg-darkblue-800 text-white">
                                  <option value="" disabled selected>Ville d'arrivée</option>
                                  <option value="Londres (LHR)">Londres (LHR)</option>
                                  <option value="New York (JFK)">New York (JFK)</option>
                                  <option value="Tokyo (HND)">Tokyo (HND)</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="hero-flightDate" class="block text-sm text-gray-300 mb-1">Date</label>
                            <input type="date" class="inputBox" id="hero-flightDate" required class="w-full border border-gray-700 rounded p-2 focus:outline-none focus:ring-2 focus:ring-brand-yellow transition bg-darkblue-800 text-white">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                         <div>
                            <label for="hero-class" class="block text-sm text-gray-300 mb-1">Classe</label>
                            <div class="relative">
                                <select id="hero-class" class="inputBox" class="w-full border border-gray-700 rounded p-2 appearance-none focus:outline-none focus:ring-2 focus:ring-brand-yellow transition bg-darkblue-800 text-white">
                                  <option value="Economique">Économique</option>
                                  <option value="Premium">Premium</option>
                                  <option value="Affaires">Affaires</option>
                                  <option value="Premiere">Première</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="hero-adults" class="block text-sm text-gray-300 mb-1">Passagers</label>
                            <div class="grid grid-cols-2 gap-2">
                                <div class="relative">
                                    <select id="hero-adults" class="inputBox" class="w-full border border-gray-700 rounded p-2 appearance-none focus:outline-none focus:ring-2 focus:ring-brand-yellow transition bg-darkblue-800 text-white">
                                      <option value="1">1 Adulte</option>
                                      <option value="2">2 Adultes</option>
                                      <option value="3">3 Adultes</option>
                                      <option value="4">4 Adultes</option>
                                    </select>
                                </div>
                                <div class="relative">
                                <select id="hero-children" class="inputBox" class="w-full border border-gray-700 rounded p-2 appearance-none focus:outline-none focus:ring-2 focus:ring-brand-yellow transition bg-darkblue-800 text-white">
                                    <option value="0">0 Enfant</option>
                                    <option value="1">1 Enfant</option>
                                    <option value="2">2 Enfants</option>
                                    <option value="3">3 Enfants</option>
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-end">
                            <button id="searchFlightsBtn" class="w-full text-white font-medium py-2 px-4 rounded transition" style=" color: #162238;
                                    border: 1px solid #FFD476;background: #FFD476;
                                    box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    5px 5px 15px rgba(0, 0, 0, 0.35),
                                    inset -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    inset 5px 5px 15px rgba(0, 0, 0, 0.35);">
                                Rechercher des Vols
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    
   
</body>

</html>