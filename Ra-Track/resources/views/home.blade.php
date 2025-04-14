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
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
        }

        .custom-bg {
            position: relative;
            width: 100%;
            height: 600px;
            overflow: hidden;
            border-radius: 0 0 40px 40px;
        }

        #background-video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 0;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient( #0f0b3d,rgba(42, 37, 82, 0.28));
            z-index: 1;
        }

        .header-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 10;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding-top: 150px;
        }

        .diamond {
            width: 10px;
            height: 10px;
            transform: rotate(45deg);
            background-color: black;
        }

        .dotted-line {
            border-top: 2px dotted #CBD5E0;
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            z-index: 0;
        }

        /* Styles for the CSS-animated carousel */
        .gallery-container {
            position: relative;
            overflow: hidden;
            width: 100%;
            /* Adjust as needed */
        }

        .gallery-track {
            display: flex;
            gap: 20px;
            animation: scroll 20s linear infinite;
            /* Adjust duration as needed */
        }

        .gallery-item {
            flex: 0 0 auto;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
        }

        @keyframes scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(calc(-270px * 5));
                /* Adjusted for 5 images including gaps within calc */
            }
        }

        /* Pause animation on hover */
        .gallery-container:hover .gallery-track {
            animation-play-state: paused;
        }

        /* Controls */
        .gallery-controls {
            position: absolute;
            top: 1900px;
            left: 0;
            right: 0;
            display: flex;
            justify-content: center;
            gap: 10px;
            z-index: 20;
        }

        .control-btn {
            background-color: rgba(255, 255, 255, 0.7);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .control-btn:hover {
            background-color: rgba(255, 255, 255, 0.9);
        }
        .inputBox {
            padding: 12px 10px 12px 10px;
            border: none;
            width: 100%;
            background-color: #162238;
            border: 1px solid rgba(255, 212, 118, 0.1);
            color: #fff;
            font-weight: 300;
            font-size: 1em;
            box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.05),
            5px 5px 15px rgba(0, 0, 0, 0.2);
            transition: 0.5s;
            outline: none;
        }
       
        .inputBox:focus {
            color: #FFF;
            border: 1px solid #FFD476;
        }

        /* End of CSS-animated carousel styles */
    </style>
</head>

<body class="bg-gray-100">

    <!-- Section de garde -->
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
                                 <!-- Boucler sur les aéroports et remplir le select -->
                                   @foreach ($airports as $airport)
                                     <option value="{{ $airport->id }}">{{ $airport->name }}</option>
                                   @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="hero-arrival" class="block text-sm text-gray-300 mb-1">Arrivée</label>
                            <div class="relative">
                                <select id="hero-arrival" class="inputBox" required class="w-full border border-gray-700 rounded p-2 appearance-none focus:outline-none focus:ring-2 focus:ring-brand-yellow transition bg-darkblue-800 text-white">
                                  <!-- Boucler sur les aéroports et remplir le select -->
                                   @foreach ($airports as $airport)
                                     <option value="{{ $airport->id }}">{{ $airport->name }}</option>
                                   @endforeach
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

     <!-- Airport Transfer Carousel Section -->
     <section class="py-12" style="background-image: url('https://img.freepik.com/photos-premium/carte-du-monde-blanche-utiliser-comme-illustration-pour-presentation_483511-3724.jpg'); background-size: cover; background-position: center;">
        <h1 class="text-5xl pt-4 font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#162238] to-[#FFD476] font-[Figtre] text-center">
          Discover Popular Destination
        </h1>
       <div class="container mx-auto mt-24 p-4">
            <div class="w-full max-w-7xl mx-auto relative rounded-lg p-8">
                <!-- Background Map Image -->

                <!-- Timeline Container -->
                <div class="relative">
                    <!-- Dotted Line -->
                    <div class="dotted-line"></div>

                    <!-- Timeline Items -->
                    <div class="flex justify-between relative">
                        <!-- Popular -->
                        <div class="flex flex-col items-center">
                            <span class="text-xs font-medium mb-2">POPULAR</span>
                            <div class="diamond" style="background-color:#FFD476;"></div>
                        </div>

                        <!-- Europe -->
                        <div class="flex flex-col items-center">
                            <span class="text-xs font-bold mb-2" style="color:#FFD476;">EUROPE</span>
                            <div class="diamond"></div>
                        </div>

                        <!-- Asia -->
                        <div class="flex flex-col items-center">
                            <span class="text-xs font-medium mb-2">ASIA</span>
                            <div class="diamond" style="background-color:#FFD476;"></div>
                        </div>

                        <!-- Africa -->
                        <div class="flex flex-col items-center">
                            <span class="text-xs font-bold mb-2" style="color:#FFD476;">AFRICA</span>
                            <div class="diamond"></div>
                        </div>

                        <!-- Australia -->
                        <div class="flex flex-col items-center">
                            <span class="text-xs font-medium mb-2">AUSTRALIA</span>
                            <div class="diamond" style="background-color:#FFD476;"></div>
                        </div>

                        <!-- America -->
                        <div class="flex flex-col items-center">
                            <span class="text-xs font-bold mb-2" style="color:#FFD476;">AMERICA</span>
                            <div class="diamond" ></div>
                        </div>

                        <!-- Oceania -->
                        <div class="flex flex-col items-center">
                            <span class="text-xs font-medium mb-2">OCEANIA</span>
                            <div class="diamond" style="background-color:#FFD476;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto p-8 flex items-center justify-center">
            <!-- CSS-Animated Carousel -->
            <div class="gallery-container">
                <div class="gallery-track" id="galleryTrack">
                    <!-- Original 5 images -->
                    <div class="gallery-item w-[250px] rounded-lg overflow-hidden shadow-md">
                        <img src="https://images.summitmedia-digital.com/spotph/images/2021/01/12/revenge-travel-640-1610450263.jpg"
                            alt="Image 1" class="w-full h-48 object-cover">
                        <div class="p-3 bg-white">
                            <h3 class="font-semibold">Image 1</h3>
                        </div>
                    </div>

                    <div class="gallery-item w-[250px] rounded-lg overflow-hidden shadow-md">
                        <img src="https://c8.alamy.com/comp/2CR2FDY/travel-places-collage-photos-of-the-best-travel-destinations-2CR2FDY.jpg"
                            alt="Image 2" class="w-full h-48 object-cover">
                        <div class="p-3 bg-white">
                            <h3 class="font-semibold">Image 2</h3>
                        </div>
                    </div>

                    <div class="gallery-item w-[250px] rounded-lg overflow-hidden shadow-md">
                        <img src="https://images.goway.com/production/hero/iStock-1919241099.jpeg"
                            alt="Image 3" class="w-full h-48 object-cover">
                        <div class="p-3 bg-white">
                            <h3 class="font-semibold">Image 3</h3>
                        </div>
                    </div>

                    <div class="gallery-item w-[250px] rounded-lg overflow-hidden shadow-md">
                        <img src="https://www.bsr.org/images/heroes/bsr-travel-hero..jpg"
                            alt="Image 4" class="w-full h-48 object-cover">
                        <div class="p-3 bg-white">
                            <h3 class="font-semibold">Image 4</h3>
                        </div>
                    </div>

                    <div class="gallery-item w-[250px] rounded-lg overflow-hidden shadow-md">
                        <img src="https://www.assahifa.com/english/wp-content/uploads/2021/03/travel-plane-wttc.jpg"
                            alt="Image 5" class="w-full h-48 object-cover">
                        <div class="p-3 bg-white">
                            <h3 class="font-semibold">Image 5</h3>
                        </div>
                    </div>

                    <!-- Duplicate images for seamless looping -->
                    <div class="gallery-item w-[250px] rounded-lg overflow-hidden shadow-md">
                        <img src="https://images.summitmedia-digital.com/spotph/images/2021/01/12/revenge-travel-640-1610450263.jpg"
                            alt="Image 1" class="w-full h-48 object-cover">
                        <div class="p-3 bg-white">
                            <h3 class="font-semibold">Image 1</h3>
                        </div>
                    </div>

                    <div class="gallery-item w-[250px] rounded-lg overflow-hidden shadow-md">
                        <img src="https://c8.alamy.com/comp/2CR2FDY/travel-places-collage-photos-of-the-best-travel-destinations-2CR2FDY.jpg"
                            alt="Image 2" class="w-full h-48 object-cover">
                        <div class="p-3 bg-white">
                            <h3 class="font-semibold">Image 2</h3>
                        </div>
                    </div>

                    <div class="gallery-item w-[250px] rounded-lg overflow-hidden shadow-md">
                        <img src="https://images.goway.com/production/hero/iStock-1919241099.jpeg"
                            alt="Image 3" class="w-full h-48 object-cover">
                        <div class="p-3 bg-white">
                            <h3 class="font-semibold">Image 3</h3>
                        </div>
                    </div>

                    <div class="gallery-item w-[250px] rounded-lg overflow-hidden shadow-md">
                        <img src="https://www.bsr.org/images/heroes/bsr-travel-hero..jpg"
                            alt="Image 4" class="w-full h-48 object-cover">
                        <div class="p-3 bg-white">
                            <h3 class="font-semibold">Image 4</h3>
                        </div>
                    </div>

                    <div class="gallery-item w-[250px] rounded-lg overflow-hidden shadow-md">
                        <img src="https://www.assahifa.com/english/wp-content/uploads/2021/03/travel-plane-wttc.jpg"
                            alt="Image 5" class="w-full h-48 object-cover">
                        <div class="p-3 bg-white">
                            <h3 class="font-semibold">Image 5</h3>
                        </div>
                    </div>
                </div>


            </div>
           
        </div>
    </section>
    
     <!-- Construction Services Section -->
     <section class="bg-white py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Rebuild Construction -->
                <div class="text-center">
                    <img src="https://thumbs.dreamstime.com/b/vector-illustration-icon-repair-installation-maintenance-construction-work-reconstruction-226213927.jpg" alt="Rebuild Construction Icon"
                        class="mx-auto h-24 w-24 object-contain mb-4">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Rebuild Construction</h3>
                    <p class="text-gray-600 mb-4">In a professional context it often happens that private or clients a
                        publication to be made and presented with the.</p>
                </div>

                <!-- Consultancy Construction -->
                <div class="text-center">
                    <img src="https://static.vecteezy.com/system/resources/previews/054/593/196/non_2x/dynamic-business-consultancy-icon-design-vector.jpg" alt="Consultancy Construction Icon"
                        class="mx-auto h-24 w-24 object-contain mb-4">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Consultancy Construction</h3>
                    <p class="text-gray-600 mb-4">In a professional context it often happens that private or corporate
                        clients corder a publication.</p>
                </div>

                <!-- Refine Construction -->
                <div class="text-center">
                    <img src="https://static.vecteezy.com/system/resources/thumbnails/043/181/243/small/color-icon-for-refine-vector.jpg" alt="Refine Construction Icon"
                        class="mx-auto h-24 w-24 object-contain mb-4">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Refine Construction</h3>
                    <p class="text-gray-600 mb-4">In a professional context it often happens that private or corporate
                        clients a publication to be made and.</p>
                </div>

                <!-- Customize Construction -->
                <div class="text-center">
                    <img src="https://www.creativefabrica.com/wp-content/uploads/2021/03/22/Configuration-customize-icon-Graphics-9858324-1-1-580x386.jpg" alt="Customize Construction Icon"
                        class="mx-auto h-24 w-24 object-contain mb-4">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Customize Construction</h3>
                    <p class="text-gray-600 mb-4">In a professional context it often happens that private or corporate
                        clients corder a publication.</p>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.footer')

    <!-- script pour la crousel -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const track = document.getElementById('galleryTrack');
            const pauseBtn = document.getElementById('pauseBtn');
            const slowBtn = document.getElementById('slowBtn');
            const fastBtn = document.getElementById('fastBtn');
            const pauseIcon = document.querySelector('.pause-icon');
            const playIcon = document.querySelector('.play-icon');

            let isPaused = false;
            let animationDuration = 20; // seconds

            // Toggle pause/play
            pauseBtn.addEventListener('click', function () {
                if (isPaused) {
                    track.style.animationPlayState = 'running';
                    pauseIcon.classList.remove('hidden');
                    playIcon.classList.add('hidden');
                } else {
                    track.style.animationPlayState = 'paused';
                    pauseIconclassList.add('hidden');
                    playIcon.classList.remove('hidden');
                }
                isPaused = !isPaused;
            });

            // Slow down animation
            slowBtn.addEventListener('click', function () {
                animationDuration += 5;
                updateAnimationSpeed();
            });

            // Speed up animation
            fastBtn.addEventListener('click', function () {
                if (animationDuration > 5) {
                    animationDuration -= 5;
                    updateAnimationSpeed();
                }
            });

            // Update animation speed
            function updateAnimationSpeed() {
                track.style.animationDuration = `${animationDuration}s`;
            }

            // Initialize
            updateAnimationSpeed();
        });
    </script>

    <!-- script pour les données du formulaire -->
    <script>
              document.addEventListener('DOMContentLoaded', function() {
          
                  // --- JS POUR LA REDIRECTION VERS BOOKING AVEC LES DONNÉES ---
                  const searchButton = document.getElementById('searchFlightsBtn');
          
                  if (searchButton) {
                      searchButton.addEventListener('click', function() {
                          // 1. Récupérer les valeurs du formulaire
                          const departure = document.getElementById('hero-departure').value;
                          const arrival = document.getElementById('hero-arrival').value;
                          const flightDate = document.getElementById('hero-flightDate').value;
                          const flightClass = document.getElementById('hero-class').value;
                          const adults = document.getElementById('hero-adults').value;
                          const children = document.getElementById('hero-children').value;
          
                          // Vérification simple (optionnelle)
                          if (!departure || !arrival || !flightDate) {
                              alert("Veuillez renseigner au moins le départ, l'arrivée et la date.");
                              return; // Arrête l'exécution si les champs requis sont vides
                          }
          
                          // 2. Construire l'objet de paramètres
                          const searchParams = new URLSearchParams();
                          searchParams.append('departure', departure);
                          searchParams.append('arrival', arrival);
                          searchParams.append('date', flightDate);
                          searchParams.append('class', flightClass);
                          searchParams.append('adults', adults);
                          searchParams.append('children', children);
          
                          // 3. Construire l'URL de destination
                          // !! Adapte le chemin vers ta page bookingAirplane !!
                          // Si elle est à la racine: '/bookingAirplane.html' ou juste '/bookingAirplane'
                          // Si elle est dans un dossier 'pages': '/pages/bookingAirplane.html'
                          const targetUrl = '/bookingAirplane?' + searchParams.toString();
                          // J'utilise '/bookingAirplane' ici, ajuste si besoin.
                          // Si tu n'utilises pas de serveur du tout et ouvres les fichiers localement,
                          // utilise un chemin relatif comme 'bookingAirplane.html'
          
                          // 4. Rediriger l'utilisateur
                          window.location.href = targetUrl;
                      });
                  } else {
                      console.error("Bouton 'searchFlightsBtn' non trouvé.");
                  }
          
              }); // Fin de DOMContentLoaded
    </script>

</body>

</html>