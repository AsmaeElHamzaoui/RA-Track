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
    // Initialize the map when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        // Coordinates (Approximate)
        const cdgCoords = [49.0097, 2.5479]; // Paris CDG
        const jfkCoords = [40.6413, -73.7781]; // New York JFK
        // Estimate current position (Manually placed for visual representation)
        const planePosition = [48.5, -35]; // Slightly adjusted position
        // Calculate approximate bearing from CDG towards JFK for initial rotation
        const angleRad = Math.atan2(jfkCoords[1] - cdgCoords[1], jfkCoords[0] - cdgCoords[0]);
        const angleDeg = angleRad * (180 / Math.PI);
        const planeHeading = angleDeg + 90; // Adjusting based on SVG orientation

        // 1. Create Map Instance
        const map = L.map('map', {
            zoomControl: false // Hide default zoom controls
        }).setView([48, -30], 3.5); // Center roughly between Paris & NY, zoom level 3.5

        // 2. Add Tile Layer (Using Esri World Imagery for colored satellite view)
        L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles © Esri — Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community',
            maxZoom: 18
        }).addTo(map);

        // 3. Define Airplane Icon using SVG
        const planeIcon = L.divIcon({
            html: `<svg xmlns="http://www.w3.org/2000/svg" class="plane-svg-icon" style="transform: rotate(${planeHeading}deg);" viewBox="0 0 24 24" fill="currentColor"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/></svg>`,
            className: 'dummy-transparent-bg',
            iconSize: [24, 24],
            iconAnchor: [12, 12]
        });

        // 4. Draw Curved Flight Path using Leaflet.curve
        const pathCoords = [
            'M', cdgCoords, // Move to start
            'C', // Curve command
            [52, -10], // Control point 1
            [45, -50], // Control point 2
            jfkCoords // End point
        ];

        const flightPath = L.curve(pathCoords, {
            color: '#F59E0B', // Tailwind yellow-500
            weight: 2.5,
            opacity: 0.8,
        }).addTo(map);

        // Fit map bounds to the path slightly zoomed out
        map.fitBounds(flightPath.getBounds().pad(0.2));

        // 5. Add Airplane Marker
        const planeMarker = L.marker(planePosition, {
            icon: planeIcon
        }).addTo(map);

        // Optional: You could add multiple flight paths and markers here
        // to show multiple flights on the dashboard map
    });
</script>