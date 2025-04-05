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

        <!-- Main Content (Map + Info Panels) -->
        <div class="flex flex-col lg:flex-row gap-6">

            <!-- Map Area (Left Column) -->
            <div class="lg:w-2/3 bg-gray-800 rounded-lg p-1 shadow-lg overflow-hidden">
                 <!-- The map container -->
                 <div id="map" class="h-96 md:h-[550px] rounded-md"></div>
                 <!-- Note: Text like "ERTEAW WORK" was part of the original image's map tiles, not easily replicable with standard layers -->
            </div>

            <!-- Info Panels (Right Column) -->
            <div class="lg:w-1/3 flex flex-col gap-6">

                <!-- Flight Information Panel -->
                <div class="bg-gray-800 p-5 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold text-yellow-400 mb-4">Informations du vol</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Départ</span>
                            <span class="font-medium">Paris (CDG)</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Arrivée</span>
                            <span class="font-medium">New York (JFK)</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Altitude</span>
                            <span class="font-medium">10,668 m</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Vitesse</span>
                            <span class="font-medium">870 km/h</span>
                        </div>
                    </div>
                </div>

                <!-- Weather Conditions Panel -->
                <div class="bg-gray-800 p-5 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold text-yellow-400 mb-4">Conditions météo</h3>
                    <div class="space-y-3 text-sm">
                         <div class="flex justify-between items-center mb-3">
                            <div class="flex items-center space-x-2">
                                <!-- Weather Icon (Partly Cloudy) -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-300" viewBox="0 0 24 24" fill="currentColor">
                                     <path d="M6.5 20q-1.875 0-3.187-1.313T2 15.5q0-1.65 1.025-2.975T6 11.1V11q.125-1.525.863-2.825T8.65 5.8q1.4-1.3 3.15-1.975T15.5 3q2.9 0 4.95 2.05T22.5 10q.825 0 1.413.588T24.5 12q0 1.05-.725 1.775T22 14.5h-1q-1.05 0-1.775.725T18.5 17q0 1.875-1.313 3.187T14 21.5H6.5q-.75 0-1.375-.3T4.2 20.3q.45-.3.725-.812T5.25 18.5q0-.425-.288-.713T4.25 17.5q-.425 0-.712.288T3.25 18.5q0 .75.413 1.375T4.8 20.75q.425.25 1.175.375T7.5 21.25q.425 0 .713-.288T8.5 20.25q0-.425-.288-.713T7.5 19.25q-.425 0-.712.288T6.5 20Zm0-2h8q1.05 0 1.775-.725T17 15.5q0-.825-.587-1.413T15 13.5q0-2.3-1.6-3.9T9.5 8q-1.7 0-3.1.988T4.25 11.5q-.075.275-.113.537T4.1 12.6q-.875.25-1.437.938T2 15.05q0 .85.625 1.475T4 17.15h2.5Z"/>
                                </svg>
                                <span>Partiellement nuageux</span>
                            </div>
                            <span class="text-2xl font-semibold">23°C</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Vent</span>
                            <span class="font-medium">15 km/h</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Visibilité</span>
                            <span class="font-medium text-green-400">Excellente</span>
                        </div>
                    </div>
                </div>

                <!-- Notifications Panel -->
                <div class="bg-gray-800 p-5 rounded-lg shadow-lg">
                     <h3 class="text-lg font-semibold text-yellow-400 mb-4">Notifications</h3>
                     <div class="space-y-3">
                        <div class="bg-gray-700/50 p-3 rounded-md flex items-center space-x-3">
                             <!-- Info Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-sm">Vol à l'heure</span>
                        </div>
                        <div class="bg-gray-700/50 p-3 rounded-md flex items-center space-x-3">
                            <!-- Warning Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <span class="text-sm">Turbulences légères prévues</span>
                        </div>
                     </div>
                </div>

            </div>
        </div>

    </main>
   
    @include('layouts.footer')

    <script>
        // --- Leaflet Map Initialization ---

        // Coordinates (Approximate)
        const cdgCoords = [49.0097, 2.5479]; // Paris CDG
        const jfkCoords = [40.6413, -73.7781]; // New York JFK
        // Estimate current position (Manually placed for visual representation)
        const planePosition = [48.5, -35]; // Slightly adjusted position
        // Calculate approximate bearing from CDG towards JFK for initial rotation
        // This is a rough estimate, true bearing changes along a great circle
        const angleRad = Math.atan2(jfkCoords[1] - cdgCoords[1], jfkCoords[0] - cdgCoords[0]);
        const angleDeg = angleRad * (180 / Math.PI);
        const planeHeading = angleDeg + 90 ; // Adjusting based on SVG orientation and desired direction


        // 1. Create Map Instance
        const map = L.map('map', {
            zoomControl: false // Optional: Hide default zoom controls if needed
        }).setView([48, -30], 3.5); // Center roughly between Paris & NY, zoom level 3.5

        // 2. Add Tile Layer (Using Esri World Imagery for colored satellite view)
        L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles © Esri — Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community',
            maxZoom: 18 // Esri might have different max zoom levels
        }).addTo(map);


        // 3. Define Airplane Icon using SVG
        // Note: RotatedMarker plugin would be better for smooth rotation updates
        const planeIcon = L.divIcon({
            html: `<svg xmlns="http://www.w3.org/2000/svg" class="plane-svg-icon" style="transform: rotate(${planeHeading}deg);" viewBox="0 0 24 24" fill="currentColor"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/></svg>`,
            className: 'dummy-transparent-bg', // Use this class to prevent default icon styling
            iconSize: [24, 24], // Match the SVG size in CSS
            iconAnchor: [12, 12] // Center the icon
        });


        // 4. Draw Curved Flight Path using Leaflet.curve
        const pathCoords = [
            'M', cdgCoords, // Move to start
            'C', // Curve command
                [52, -10], // Control point 1 (adjust for desired curve shape)
                [45, -50], // Control point 2 (adjust for desired curve shape)
                jfkCoords  // End point
        ];

        const flightPath = L.curve(pathCoords, {
            color: '#F59E0B', // Tailwind yellow-500
            weight: 2.5,       // Slightly thicker line
            opacity: 0.8,
        }).addTo(map);

        // Fit map bounds to the path slightly zoomed out
        map.fitBounds(flightPath.getBounds().pad(0.2)); // Add padding around bounds

        // 5. Add Airplane Marker
        const planeMarker = L.marker(planePosition, {
             icon: planeIcon,
             // rotationAngle: planeHeading, // Requires Leaflet.rotatedMarker
             // rotationOrigin: 'center center' // Requires Leaflet.rotatedMarker
            }).addTo(map);

        // --- Optional: Basic animation placeholder ---
        // To implement real-time updates, you would need:
        // 1. An API providing current flight position and heading.
        // 2. JavaScript `setInterval` or WebSocket connection to fetch updates.
        // 3. Update marker position: `planeMarker.setLatLng([newLat, newLng]);`
        // 4. Update marker rotation (ideally using RotatedMarker plugin or updating the divIcon's HTML style).

    </script>

</body>
</html>