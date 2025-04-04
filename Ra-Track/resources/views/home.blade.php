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

</body>

</html>