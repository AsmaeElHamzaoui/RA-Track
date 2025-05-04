<!-- ==================== Section Dashboard ==================== -->
<div id="dashboard-content" class="content-section">
            <!-- KPI Cards -->
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <!-- Card 1: Active Flights -->
                <div class="bg-navy-light p-5 rounded-lg shadow-md flex flex-col justify-between">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-gray-400">Vols Actifs</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500 transform -rotate-45"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" /></svg>
                    </div>
                    <p class="text-4xl font-bold">247</p>
                    <p class="text-xs text-green-400 mt-1">+12% depuis hier</p>
                </div>
                <!-- Card 2: Delays -->
                <div class="bg-navy-light p-5 rounded-lg shadow-md flex flex-col justify-between">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-gray-400">Retards</span>
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    </div>
                    <p class="text-4xl font-bold">8</p>
                    <p class="text-xs text-red-400 mt-1">+3 dernière heure</p>
                </div>
                <!-- Card 3: Satisfaction -->
                <div class="bg-navy-light p-5 rounded-lg shadow-md flex flex-col justify-between">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-gray-400">Satisfaction</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" /></svg>
                    </div>
                    <p class="text-4xl font-bold">96%</p>
                    <p class="text-xs text-green-400 mt-1">+2% cette semaine</p>
                </div>
            </section>

            <!-- Live Flight Map -->
            <section id="live-map-section" class="bg-navy-light p-4 rounded-lg shadow-md mb-6">
                 <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Carte des Vols en Direct</h3>
                    <div class="flex space-x-2">
                        <button class="flex items-center space-x-1 px-3 py-1 bg-gray-600 hover:bg-gray-500 text-xs rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" /></svg>
                            <span>Filtrer</span>
                        </button>
                         <button class="flex items-center space-x-1 px-3 py-1 bg-gray-600 hover:bg-gray-500 text-xs rounded">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9M20.25 20.25h-4.5m4.5 0v-4.5m0 4.5L15 15" /></svg>
                         </button>
                    </div>
                </div>
                <div class="h-64 md:h-96 bg-black rounded map-placeholder">
                    <!-- Map -->
                </div>
            </section>

           
</div>