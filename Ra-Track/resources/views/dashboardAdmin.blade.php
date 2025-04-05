<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirControl - Tableau de Bord</title>

</head>
<body class="bg-navy text-gray-100">

<div class="flex h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-navy-dark flex-shrink-0 p-4 flex flex-col justify-between">
        <div>
            <div class="flex items-center space-x-2 p-2 mb-10">
                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-blue-400 transform -rotate-45">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                 </svg>
                <h1 class="text-xl font-bold">AirControl</h1>
            </div>

            <nav>
                <ul>
                    <li class="mb-2">
                        <a href="#" id="nav-dashboard" class="sidebar-link flex items-center space-x-3 p-2 rounded hover:bg-navy-light text-gray-400 hover:text-white active">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" /></svg>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" id="nav-flights" class="sidebar-link flex items-center space-x-3 p-2 rounded hover:bg-navy-light text-gray-400 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 transform -rotate-45"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" /></svg>
                            <span>Gestion des Vols</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" id="nav-users" class="sidebar-link flex items-center space-x-3 p-2 rounded hover:bg-navy-light text-gray-400 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
                            <span>Utilisateurs</span>
                        </a>
                    </li>
                     <li class="mb-2">
                        <a href="#" id="nav-live" class="sidebar-link flex items-center space-x-3 p-2 rounded hover:bg-navy-light text-gray-400 hover:text-white">
                           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 0 0 6-6 6 6 0 0 0-6-6m-6 6a6 6 0 0 1 6-6 6 6 0 0 1 6 6m0 0H6m6 0V6.75M6 12.75a6 6 0 0 0 6 6 6 6 0 0 0 6-6M6 12.75h12m-6 0V18.75" /></svg>
                            <span>Suivi en Direct</span> <!-- Lien existant, pourrait pointer vers le dashboard ou une section dédiée -->
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" id="nav-stats" class="sidebar-link flex items-center space-x-3 p-2 rounded hover:bg-navy-light text-gray-400 hover:text-white">
                           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75c0 .621-.504 1.125-1.125 1.125h-2.25A1.125 1.125 0 0 1 3 21v-7.875ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" /></svg>
                            <span>Statistiques</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

     <!-- Main Content -->
     <main class="flex-1 bg-navy p-6 md:p-8 overflow-y-auto relative">
         <!-- Header commun (peut être adapté par JS si besoin) -->
         <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
            <div>
                <h2 id="main-title" class="text-2xl font-semibold">Tableau de Bord</h2>
                <p class="text-gray-400 text-sm">Aujourd'hui</p> <!-- Date dynamique peut être ajoutée avec JS -->
            </div>
            <div class="flex items-center space-x-4 mt-4 md:mt-0">
                <button class="relative p-2 rounded-full hover:bg-navy-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-navy focus:ring-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.017 5.454 1.31M5.25 17.082l4.125 4.125M18.75 17.082l-4.125 4.125M12 21a.75.75 0 0 1-.75-.75V18a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-.75.75H12Z" /></svg>
                    <span class="absolute top-1 right-1 block h-3 w-3 rounded-full bg-red-500 ring-2 ring-navy">
                       <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-red-400 opacity-75"></span>
                    </span>
                </button>
                <div class="flex items-center space-x-2">
                    <img src="https://via.placeholder.com/40/FFFFFF/808080?text=JP" alt="User Avatar" class="w-10 h-10 rounded-full border-2 border-gray-500">
                    <span>John Pilot</span>
                </div>
            </div>
        </header>

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

            <!-- Recent Flights Table -->
            <section class="bg-navy-light p-4 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-4">Vols Récents (Dashboard)</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-gray-400 uppercase border-b border-gray-700">
                            <tr>
                                <th scope="col" class="px-4 py-3">N° Vol</th>
                                <th scope="col" class="px-4 py-3">Départ</th>
                                <th scope="col" class="px-4 py-3">Arrivée</th>
                                <th scope="col" class="px-4 py-3">Statut</th>
                                <th scope="col" class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Lignes de vols récents -->
                            <tr class="border-b border-gray-700 hover:bg-gray-700">
                                <td class="px-4 py-3 font-medium whitespace-nowrap">AF1234</td>
                                <td class="px-4 py-3">Paris (CDG)</td>
                                <td class="px-4 py-3">New York (JFK)</td>
                                <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-green-600 text-green-100">En vol</span></td>
                                <td class="px-4 py-3"> <button class="text-gray-400 hover:text-white"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg></button></td>
                            </tr>
                            <!-- ... autres lignes ... -->
                        </tbody>
                    </table>
                </div>
            </section>
        </div>

        <!-- ==================== Section Gestion des Vols ==================== -->
        <div id="flights-content" class="content-section hidden">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold">Gestion des Vols</h3>
                <button id="open-add-flight-modal" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                    Ajouter un Vol
                </button>
            </div>

            <section class="bg-navy-light p-4 rounded-lg shadow-md">
                <h4 class="text-lg font-semibold mb-4">Liste des Vols</h4>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-gray-400 uppercase border-b border-gray-700">
                            <tr>
                                <th scope="col" class="px-4 py-3">N° Vol</th>
                                <th scope="col" class="px-4 py-3">Départ</th>
                                <th scope="col" class="px-4 py-3">Arrivée</th>
                                <th scope="col" class="px-4 py-3">Compagnie</th>
                                <th scope="col" class="px-4 py-3">Statut</th>
                                <th scope="col" class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Exemple de ligne - Remplacer par des données réelles -->
                            <tr class="border-b border-gray-700 hover:bg-gray-700">
                                <td class="px-4 py-3 font-medium whitespace-nowrap">BA456</td>
                                <td class="px-4 py-3">Londres (LHR)</td>
                                <td class="px-4 py-3">Paris (CDG)</td>
                                <td class="px-4 py-3">British Airways</td>
                                <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-600 text-blue-100">Programmé</span></td>
                                <td class="px-4 py-3 flex space-x-2">
                                    <button class="text-yellow-400 hover:text-yellow-300" title="Modifier">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                                    </button>
                                    <button class="text-red-500 hover:text-red-400" title="Supprimer">
                                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                                    </button>
                                </td>
                            </tr>
                             <!-- Ajouter d'autres lignes ici -->
                        </tbody>
                    </table>
                </div>
            </section>
        </div>

        

        

        


        

    </main>

    
</div>



</body>
</html>