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
            Votre navigateur ne supporte pas la lecture de vidéos.
        </video>

        <!-- Overlay sombre (facultatif) -->
        <div class="overlay"></div>
        <!-- Header -->
        @include('layouts.header')
        <!-- Section 1 -->
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
    
    <!-- Services Section -->
    <section class="py-16" style="background-image: url('https://c8.alamy.com/compfr/2dcj9xh/texture-hiver-neige-blanche-arriere-plan-des-vacances-de-noel-papier-peint-de-saison-blanc-frais-couleur-neige-nature-fond-d-ecran-premier-gel-texture-brillante-et-nette-2dcj9xh.jpg'); background-size: cover; background-position: center;">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <h2 class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#162238] to-[#FFD476] font-[Figtre] text-center">
                    We Offer the Following<br>
                    Photovoltaic Services
                </h2><br>
                <p class="max-w-2xl mx-auto text-bold text-gray-600">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua.
                </p>
            </div>

            <!-- Services Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">

                <!-- Card 1: Project Planning -->
                <div class="relative pt-16">
                    <!-- Circular Image -->
                    <div class="absolute -top-2 left-1/2 transform -translate-x-1/2">
                        <div class="w-48 h-48 rounded-full overflow-hidden border-4 border-gray-100">
                            <img src="https://www.shutterstock.com/image-photo/travel-by-plane-woman-passenger-260nw-2467550689.jpg"
                                alt="Project Planning" class="w-full h-full object-cover" />
                        </div>
                    </div>

                    <!-- Card Content -->
                    <div class="rounded-lg p-6 pt-32 pb-6 text-center text-white h-full flex flex-col" style="background-color:#162238;">
                        <h3 class="text-xl font-bold mb-3" style="color:#FFD476;">Project Planning</h3>
                        <p class="text-sm mb-6 flex-grow">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore aliqua.
                        </p>
                    </div>
                </div>

                <!-- Card 2: Procurement -->
                <div class="relative pt-16">
                    <!-- Circular Image -->
                    <div class="absolute -top-2 left-1/2 transform -translate-x-1/2">
                        <div class="w-48 h-48 rounded-full overflow-hidden border-4 border-gray-100">
                            <img src="https://safer-america.com/wp-content/uploads/2024/08/1605-1024.jpg"
                                alt="Procurement" class="w-full h-full object-cover" />
                        </div>
                    </div>

                    <!-- Card Content -->
                    <div class="bg-blue-900 rounded-lg p-6 pt-32 pb-6 text-center text-white h-full flex flex-col">
                        <h3 class="text-xl font-bold mb-2" style="color:#FFD476;">Procurement</h3>
                        <p class="text-sm mb-6 flex-grow">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore aliqua.
                        </p>
                    </div>
                </div>

                <!-- Card 3: Operation -->
                <div class="relative pt-16">
                    <!-- Circular Image -->
                    <div class="absolute -top-2 left-1/2 transform -translate-x-1/2">
                        <div class="w-48 h-48 rounded-full overflow-hidden border-4 border-gray-100">
                            <img src="https://img.freepik.com/photos-premium/meilleur-lieu-voyage-au-monde_403587-15099.jpg"
                                alt="Operation" class="w-full h-full object-cover" />
                        </div>
                    </div>

                    <!-- Card Content -->
                    <div class="rounded-lg p-6 pt-32 pb-6 text-center text-white h-full flex flex-col" style="background-color:#162238;">
                        <h3 class="text-xl font-bold mb-3" style="color:#FFD476;">Operation</h3>
                        <p class="text-sm mb-6 flex-grow">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore aliqua.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    
   
</body>

</html>