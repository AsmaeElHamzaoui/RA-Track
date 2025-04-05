<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirTrack - Suivi de vol AF 1234</title>
    <!-- Include Tailwind CSS via Play CDN (for easy setup) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
         integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
         crossorigin=""/>
    <!-- Include Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
         integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
         crossorigin=""></script>
    <!-- Include Leaflet.curve plugin -->
    <script src="https://cdn.jsdelivr.net/npm/leaflet-curve@0.8.2/leaflet.curve.min.js"></script>

</head>
<body class="bg-gray-900 text-white font-sans">

    <!-- Header -->
    @include('layouts.header')


    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">

        <!-- Flight Details Bar -->
        <div class="bg-gray-800 p-4 rounded-lg mb-6 flex flex-col sm:flex-row justify-between sm:items-center space-y-3 sm:space-y-0 shadow-lg">
            <div class="flex flex-wrap items-center gap-x-4 gap-y-2">
                <div class="text-center sm:text-left">
                    <span class="text-xs text-gray-400 block">Numéro de vol</span>
                    <span class="text-lg font-semibold">AF 1234</span>
                </div>
                <div class="text-center sm:text-left">
                    <span class="text-xs text-gray-400 block">Statut</span>
                    <span class="flex items-center text-green-500">
                        <span class="h-2 w-2 bg-green-500 rounded-full mr-1.5 flex-shrink-0"></span>
                        En vol
                    </span>
                </div>
                <div class="text-center sm:text-left">
                    <span class="text-xs text-gray-400 block">Heure d'arrivée estimée</span>
                    <span class="text-lg font-semibold">14:30</span>
                </div>
            </div>
            <div class="flex space-x-3 justify-center sm:justify-end flex-shrink-0">
                <button class="bg-gray-700 hover:bg-gray-600 text-sm px-3 py-1.5 rounded-md flex items-center space-x-1.5 transition-colors">
                    <!-- Bell Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span>Notifications</span>
                </button>
                 <button class="bg-gray-700 hover:bg-gray-600 text-sm px-3 py-1.5 rounded-md flex items-center space-x-1.5 transition-colors">
                    <!-- Share Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z" />
                    </svg>
                    <span>Partager</span>
                </button>
            </div>
        </div>

        

    </main>
   
   

</body>
</html>