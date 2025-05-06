<!-- ==================== Section Dashboard ==================== -->
<div id="dashboard-content" class="content-section">
    <!-- KPI Cards -->
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <!-- Card 1: Active Flights -->
        <div class="bg-slate-900/70 backdrop-blur-sm p-5 rounded-lg shadow-md flex flex-col justify-between" style="border-left: 3px solid #FFD476;">
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm text-gray-400">Vols Actifs</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500 transform -rotate-45">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                </svg>
            </div>
            <p class="text-4xl font-bold">247</p>
            <p class="text-xs text-green-400 mt-1">+12% depuis hier</p>
        </div>
        <!-- Card 2: Delays -->
        <div class="bg-slate-900/70 backdrop-blur-sm p-5 rounded-lg shadow-md flex flex-col justify-between" style="border-left: 3px solid #FFD476;">
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm text-gray-400">Retards</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>
            <p class="text-4xl font-bold">8</p>
            <p class="text-xs text-red-400 mt-1">+3 dernière heure</p>
        </div>
        <!-- Card 3: Satisfaction -->
        <div class="bg-slate-900/70 backdrop-blur-sm p-5 rounded-lg shadow-md flex flex-col justify-between" style="border-left: 3px solid #FFD476;">
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm text-gray-400">Satisfaction</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                </svg>
            </div>
            <p class="text-4xl font-bold">96%</p>
            <p class="text-xs text-green-400 mt-1">+2% cette semaine</p>
        </div>
    </section>

    <!-- Live Flight Map -->
    <section id="live-map-section" class="bg-slate-900/70 backdrop-blur-sm p-4 rounded-lg shadow-md mb-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-yellow-200">Carte des Vols en Direct</h3>
            <div class="flex space-x-2">
                <button class="flex items-center space-x-1 px-3 py-1 text-xs rounded" style="color: #162238; border: 1px solid #FFD476;background: #FFD476;
                            box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
                            5px 5px 15px rgba(0, 0, 0, 0.35),
                            inset -5px -5px 15px rgba(255, 255, 255, 0.1),
                            inset 5px 5px 15px rgba(0, 0, 0, 0.35);">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                    </svg>
                    <span>Filtrer</span>
                </button>
                <button class="flex items-center space-x-1 px-3 py-1 text-xs rounded" style="color: #162238; border: 1px solid #FFD476;background: #FFD476;
                            box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
                            5px 5px 15px rgba(0, 0, 0, 0.35),
                            inset -5px -5px 15px rgba(255, 255, 255, 0.1),
                            inset 5px 5px 15px rgba(0, 0, 0, 0.35);">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9M20.25 20.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                    </svg>
                </button>
            </div>
        </div>
        <div id="map" class="h-64 md:h-96 bg-black rounded"></div>
    </section>


</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let map;
    let activeFlightsLayer = L.layerGroup();
    let flightDataStore = {}; // Stocke les marqueurs et données par ID de vol
    let updateInterval;
    let selectedPath = null; // Garde la trace du chemin sélectionné et affiché
    let allFlightsData = []; // Variable globale pour stocker les données chargées du JSON

    // --- Données Statiques des Aéroports ---
    const staticAirports = {
        'CDG': { name: 'Paris Charles de Gaulle', lat: 49.0097, lng: 2.5479 },
        'JFK': { name: 'New York John F. Kennedy', lat: 40.6413, lng: -73.7781 },
        'LHR': { name: 'Londres Heathrow', lat: 51.4700, lng: -0.4543 },
        'LAX': { name: 'Los Angeles International', lat: 33.9416, lng: -118.4085 },
        'DXB': { name: 'Dubaï International', lat: 25.2532, lng: 55.3657 },
        'HND': { name: 'Tokyo Haneda', lat: 35.5494, lng: 139.7798 },
        'AMS': { name: 'Amsterdam Schiphol', lat: 52.3105, lng: 4.7683 },
        'FRA': { name: 'Francfort Airport', lat: 50.0379, lng: 8.5622 },
        'SIN': { name: 'Singapour Changi', lat: 1.3644, lng: 103.9915 },
        'SYD': { name: 'Sydney Kingsford Smith', lat: -33.9399, lng: 151.1753 },
        'HKG': { name: 'Hong Kong International', lat: 22.3080, lng: 113.9185 },
        'DOH': { name: 'Doha Hamad International', lat: 25.2731, lng: 51.6081 },
        'IST': { name: 'Istanbul Airport', lat: 41.2753, lng: 28.7519 },
        'NRT': { name: 'Tokyo Narita', lat: 35.7719, lng: 140.3928 },
        'AUH': { name: 'Abu Dhabi International', lat: 24.4330, lng: 54.6511 },
        'DFW': { name: 'Dallas/Fort Worth International', lat: 32.8998, lng: -97.0403 },
        'ORD': { name: 'Chicago O\'Hare International', lat: 41.9742, lng: -87.9073 },
        'ATL': { name: 'Hartsfield-Jackson Atlanta', lat: 33.6407, lng: -84.4277 },
        'LAS': { name: 'Las Vegas McCarran', lat: 36.0840, lng: -115.1537 },
        'SFO': { name: 'San Francisco International', lat: 37.6213, lng: -122.3790 },
        'PEK': { name: 'Beijing Capital International', lat: 40.0799, lng: 116.6031 },
        'PVG': { name: 'Shanghai Pudong International', lat: 31.1444, lng: 121.8053 },
        'CAN': { name: 'Guangzhou Baiyun International', lat: 23.3924, lng: 113.2988 },
        'ICN': { name: 'Seoul Incheon International', lat: 37.4602, lng: 126.4407 },
        'MIA': { name: 'Miami International', lat: 25.7959, lng: -80.2871 },
        'ACC': { name: 'Accra Kotoka International', lat: 5.6052, lng: -0.1667 },
        'LOS': { name: 'Lagos Murtala Muhammed', lat: 6.5774, lng: 3.3210 },
        'GRU': { name: 'São Paulo/Guarulhos International', lat: -23.4319, lng: -46.4731 },
        'EZE': { name: 'Buenos Aires Ministro Pistarini', lat: -34.8222, lng: -58.5358 },
        'EWR': { name: 'Newark Liberty International', lat: 40.6925, lng: -74.1687 },
        'BOM': { name: 'Mumbai Chhatrapati Shivaji', lat: 19.0896, lng: 72.8656 },
        'BOS': { name: 'Boston Logan International', lat: 42.3656, lng: -71.0096 },
        'JNB': { name: 'Johannesburg O.R. Tambo', lat: -26.1392, lng: 28.2460 },
        'SCL': { name: 'Santiago Arturo Merino Benítez', lat: -33.3928, lng: -70.7900 },
        'YYZ': { name: 'Toronto Pearson International', lat: 43.6777, lng: -79.6248 }
    };

    // --- Fonctions Utilitaires ---
    function toRadians(degrees) { return degrees * Math.PI / 180; }
    function toDegrees(radians) { return radians * 180 / Math.PI; }
    function hoursToMs(h) { return h * 60 * 60 * 1000; }

    function parseRelativeTime(timeString, nowMs) {
        if (typeof timeString !== 'string') return nowMs;

        const parts = timeString.split('_');
        if (parts.length !== 2) {
            console.warn(`Format de temps invalide: ${timeString}`);
            return nowMs;
        }

        const direction = parts[0].toUpperCase();
        const valuePart = parts[1].replace('H', '');
        const hours = parseFloat(valuePart);

        if (isNaN(hours)) {
             console.warn(`Valeur de temps invalide: ${timeString}`);
             return nowMs;
        }

        if (direction === 'PAST') {
            return nowMs - hoursToMs(hours);
        } else if (direction === 'FUTURE') {
            return nowMs + hoursToMs(hours);
        }

        console.warn(`Direction de temps inconnue: ${timeString}`);
        return nowMs;
    }

    // --- Initialisation Carte ---
    function initializeMap() {
        try {
             map = L.map('map', { zoomControl: true }).setView([25, 10], 3);
             L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
                 attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors © <a href="https://carto.com/attributions">CARTO</a>',
                 subdomains: 'abcd', maxZoom: 19
             }).addTo(map);
             activeFlightsLayer.addTo(map);

             const recenterBtn = document.getElementById('recenter-map-btn');
             if (recenterBtn) {
                 recenterBtn.addEventListener('click', () => map.setView([25, 10], 3));
             }
         } catch (e) {
             console.error("Erreur lors de l'initialisation de la carte Leaflet:", e);
              const mapDiv = document.getElementById('map');
              if(mapDiv) mapDiv.innerHTML = '<p class="text-red-500 p-4">Impossible d\'initialiser la carte.</p>';
         }
    }

   

    // --- Lancement ---
    loadAndStartSimulation();
});
</script>