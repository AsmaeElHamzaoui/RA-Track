<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirControl - Tableau de Bord</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: {
                           'light': '#2A3F5F',
                           'DEFAULT': '#1E2A40',
                           'dark': '#151E2D',
                         }
                    }
                }
            }
        }
    </script>
    <!-- Optional: Link compiled CSS -->
    <!-- <link href="./dist/output.css" rel="stylesheet"> -->

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .map-placeholder {
        position: relative;
        background: url('https://via.placeholder.com/1000x500/000000/808080?text=World+Map+Placeholder') center center/cover no-repeat;
    }
    .map-placeholder::after {
         content: '';
         position: absolute;
         top: 20%; left: 15%;
         width: 70%; height: 60%;
         border: 2px dashed rgba(255, 165, 0, 0.6);
         border-radius: 50% / 10%;
         transform: rotate(-15deg);
         opacity: 0.7;
         pointer-events: none;
     }
     /* Styles pour le modal */
     .modal-backdrop {
        background-color: rgba(0,0,0,0.6);
     }
     /* Style pour le lien actif de la sidebar */
     .sidebar-link.active {
        background-color: var(--tw-color-navy-light) !important; /* Utilise la couleur navy-light définie dans la config */
        color: white !important;
     }
     /* Assurer que la couleur navy-light est disponible comme variable CSS */
     :root {
        --tw-color-navy-light: #2A3F5F;
     }
</style>

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
                    <!-- ==================== NOUVEAU LIEN SIDEBAR AVIONS ==================== -->
                    <li class="mb-2">
                        <a href="#" id="nav-aircraft" class="sidebar-link flex items-center space-x-3 p-2 rounded hover:bg-navy-light text-gray-400 hover:text-white">
                            <!-- Icône Avion (peut être changée si souhaité) -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h17.5" />
                            </svg>
                            <span>Gestion des Avions</span>
                        </a>
                    </li>
                    <!-- ==================== FIN NOUVEAU LIEN SIDEBAR AVIONS ==================== -->
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
        @include('components.Dashboard')


        <!-- ==================== Section Gestion des Vols ==================== -->
        @include('components.Flight')

        <!-- ==================== SECTION GESTION DES AVIONS ==================== -->
        @include('components.plane')


        <!-- ==================== Section Utilisateurs ==================== -->
        <div id="users-content" class="content-section hidden">
             <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold">Gestion des Utilisateurs</h3>
                <button id="open-add-user-modal" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                    Ajouter un Utilisateur
                </button>
            </div>

             <section class="bg-navy-light p-4 rounded-lg shadow-md">
                <h4 class="text-lg font-semibold mb-4">Liste des Utilisateurs</h4>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-gray-400 uppercase border-b border-gray-700">
                            <tr>
                                <th scope="col" class="px-4 py-3">Nom</th>
                                <th scope="col" class="px-4 py-3">Email</th>
                                <th scope="col" class="px-4 py-3">Rôle</th>
                                <th scope="col" class="px-4 py-3">Date d'ajout</th>
                                <th scope="col" class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Exemple de ligne -->
                             <tr class="border-b border-gray-700 hover:bg-gray-700">
                                <td class="px-4 py-3 font-medium whitespace-nowrap flex items-center space-x-2">
                                     <img src="https://via.placeholder.com/32/FFFFFF/808080?text=JP" alt="Avatar" class="w-8 h-8 rounded-full">
                                     <span>John Pilot</span>
                                </td>
                                <td class="px-4 py-3">john.pilot@example.com</td>
                                <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-purple-600 text-purple-100">Admin</span></td>
                                <td class="px-4 py-3">2024-01-15</td>
                                <td class="px-4 py-3 flex space-x-2">
                                    <button class="text-yellow-400 hover:text-yellow-300" title="Modifier">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                                    </button>
                                    <button class="text-red-500 hover:text-red-400" title="Supprimer">
                                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                                    </button>
                                </td>
                            </tr>
                            <!-- Ajouter d'autres lignes -->
                        </tbody>
                    </table>
                </div>
             </section>
        </div>

        <!-- ==================== Section Statistiques ==================== -->
        <div id="stats-content" class="content-section hidden">
             <h3 class="text-xl font-semibold mb-6">Statistiques des Vols</h3>

             <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                 <!-- Statistique Clé 1 -->
                 <div class="bg-navy-light p-5 rounded-lg shadow-md">
                     <h4 class="text-sm text-gray-400 mb-2">Total Vols (Mois)</h4>
                     <p class="text-3xl font-bold">1,258</p>
                     <p class="text-xs text-green-400 mt-1">+5% vs mois dernier</p>
                 </div>
                  <!-- Statistique Clé 2 -->
                 <div class="bg-navy-light p-5 rounded-lg shadow-md">
                     <h4 class="text-sm text-gray-400 mb-2">Taux de ponctualité</h4>
                     <p class="text-3xl font-bold">92.7%</p>
                     <p class="text-xs text-red-400 mt-1">-0.5% vs mois dernier</p>
                 </div>
                 <!-- Statistique Clé 3 -->
                 <div class="bg-navy-light p-5 rounded-lg shadow-md">
                     <h4 class="text-sm text-gray-400 mb-2">Compagnie la plus active</h4>
                     <p class="text-3xl font-bold truncate">AirFrance</p>
                     <p class="text-xs text-gray-400 mt-1">350 vols ce mois</p>
                 </div>
             </section>

             <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                 <!-- Graphique 1: Vols par Statut -->
                <div class="bg-navy-light p-4 rounded-lg shadow-md">
                    <h4 class="text-lg font-semibold mb-3">Répartition des Statuts de Vol</h4>
                    <div class="h-64"> <!-- Hauteur fixe pour le canvas -->
                         <canvas id="flightStatusChart"></canvas>
                    </div>
                </div>

                <!-- Graphique 2: Vols par Mois -->
                <div class="bg-navy-light p-4 rounded-lg shadow-md">
                    <h4 class="text-lg font-semibold mb-3">Nombre de Vols par Mois</h4>
                     <div class="h-64">
                        <canvas id="monthlyFlightsChart"></canvas>
                    </div>
                </div>
                <!-- Ajouter d'autres graphiques ou stats ici -->
             </section>
        </div>

        <!-- ==================== MODALS ==================== -->

        <!-- Modal Ajouter/Modifier Vol -->
        <div id="flight-modal" class="fixed inset-0 z-50 hidden items-center justify-center modal-backdrop">
            <div class="bg-navy-light w-full max-w-lg p-6 rounded-lg shadow-xl m-4">
                <div class="flex justify-between items-center mb-4">
                    <h4 id="flight-modal-title" class="text-xl font-semibold">Ajouter un Vol</h4>
                    <button class="close-modal text-gray-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                <form id="flight-form">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="flight_number" class="block text-sm font-medium text-gray-300 mb-1">N° Vol</label>
                            <input type="text" id="flight_number" name="flight_number" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="airline" class="block text-sm font-medium text-gray-300 mb-1">Compagnie</label>
                            <input type="text" id="airline" name="airline" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="departure_airport" class="block text-sm font-medium text-gray-300 mb-1">Aéroport Départ</label>
                            <input type="text" id="departure_airport" name="departure_airport" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="arrival_airport" class="block text-sm font-medium text-gray-300 mb-1">Aéroport Arrivée</label>
                            <input type="text" id="arrival_airport" name="arrival_airport" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        </div>
                         <div>
                            <label for="departure_time" class="block text-sm font-medium text-gray-300 mb-1">Heure Départ</label>
                            <input type="datetime-local" id="departure_time" name="departure_time" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 text-gray-400" required>
                        </div>
                         <div>
                            <label for="arrival_time" class="block text-sm font-medium text-gray-300 mb-1">Heure Arrivée</label>
                            <input type="datetime-local" id="arrival_time" name="arrival_time" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 text-gray-400" required>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-300 mb-1">Statut</label>
                            <select id="status" name="status" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                                <option value="Programmé">Programmé</option>
                                <option value="En vol">En vol</option>
                                <option value="Arrivé">Arrivé</option>
                                <option value="Retardé">Retardé</option>
                                <option value="Annulé">Annulé</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" class="close-modal px-4 py-2 rounded bg-gray-600 hover:bg-gray-700 text-white">Annuler</button>
                        <button type="submit" class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ==================== MODAL AVION ==================== -->
        <div id="aircraft-modal" class="fixed inset-0 z-50 hidden items-center justify-center modal-backdrop">
            <div class="bg-navy-light w-full max-w-lg p-6 rounded-lg shadow-xl m-4">
                <div class="flex justify-between items-center mb-4">
                    <h4 id="aircraft-modal-title" class="text-xl font-semibold">Ajouter un Avion</h4>
                    <button class="close-modal text-gray-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                <form id="aircraft-form">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="aircraft_tail_number" class="block text-sm font-medium text-gray-300 mb-1">Immatriculation</label>
                            <input type="text" id="aircraft_tail_number" name="aircraft_tail_number" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="aircraft_model" class="block text-sm font-medium text-gray-300 mb-1">Modèle</label>
                            <input type="text" id="aircraft_model" name="aircraft_model" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="aircraft_operator" class="block text-sm font-medium text-gray-300 mb-1">Compagnie / Opérateur</label>
                            <input type="text" id="aircraft_operator" name="aircraft_operator" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        </div>
                         <div>
                            <label for="aircraft_capacity" class="block text-sm font-medium text-gray-300 mb-1">Capacité (sièges)</label>
                            <input type="number" id="aircraft_capacity" name="aircraft_capacity" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" min="0">
                        </div>
                        <div class="md:col-span-2"> <!-- Prend toute la largeur sur md et plus -->
                            <label for="aircraft_status" class="block text-sm font-medium text-gray-300 mb-1">Statut</label>
                            <select id="aircraft_status" name="aircraft_status" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                                <option value="Actif">Actif</option>
                                <option value="En maintenance">En maintenance</option>
                                <option value="Stocké">Stocké</option>
                                <option value="Retiré">Retiré du service</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" class="close-modal px-4 py-2 rounded bg-gray-600 hover:bg-gray-700 text-white">Annuler</button>
                        <button type="submit" class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- ==================== FIN MODAL AVION ==================== -->


        <!-- Modal Ajouter/Modifier Utilisateur (Structure similaire au modal Vol) -->
        <div id="user-modal" class="fixed inset-0 z-50 hidden items-center justify-center modal-backdrop">
             <div class="bg-navy-light w-full max-w-md p-6 rounded-lg shadow-xl m-4">
                <div class="flex justify-between items-center mb-4">
                    <h4 id="user-modal-title" class="text-xl font-semibold">Ajouter un Utilisateur</h4>
                    <button class="close-modal text-gray-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                 <form id="user-form">
                    <div class="space-y-4 mb-4">
                        <div>
                            <label for="user_name" class="block text-sm font-medium text-gray-300 mb-1">Nom Complet</label>
                            <input type="text" id="user_name" name="user_name" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        </div>
                         <div>
                            <label for="user_email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                            <input type="email" id="user_email" name="user_email" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        </div>
                         <div>
                            <label for="user_password" class="block text-sm font-medium text-gray-300 mb-1">Mot de passe</label>
                            <input type="password" id="user_password" name="user_password" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                            <small class="text-gray-400 text-xs">Laisser vide pour ne pas changer lors de la modification.</small>
                        </div>
                        <div>
                            <label for="user_role" class="block text-sm font-medium text-gray-300 mb-1">Rôle</label>
                            <select id="user_role" name="user_role" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                                <option value="Utilisateur">Utilisateur</option>
                                <option value="Admin">Admin</option>
                                <option value="Pilote">Pilote</option> <!-- Example roles -->
                                <option value="Contrôleur">Contrôleur</option>
                            </select>
                        </div>
                    </div>
                     <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" class="close-modal px-4 py-2 rounded bg-gray-600 hover:bg-gray-700 text-white">Annuler</button>
                        <button type="submit" class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white">Enregistrer</button>
                    </div>
                </form>
             </div>
        </div>

    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const sidebarLinks = document.querySelectorAll('.sidebar-link');
    const contentSections = document.querySelectorAll('.content-section');
    const mainTitle = document.getElementById('main-title');
    const liveMapSection = document.getElementById('live-map-section'); // Pour le cacher hors Dashboard

    // Modals et boutons
    const flightModal = document.getElementById('flight-modal');
    const userModal = document.getElementById('user-modal');
    const aircraftModal = document.getElementById('aircraft-modal'); // NOUVEAU: Référence au modal avion
    const openAddFlightButton = document.getElementById('open-add-flight-modal');
    const openAddUserButton = document.getElementById('open-add-user-modal');
    const openAddAircraftButton = document.getElementById('open-add-aircraft-modal'); // NOUVEAU: Référence au bouton ajouter avion
    const closeModalButtons = document.querySelectorAll('.close-modal');

    // --- Gestion de la navigation par section ---
    sidebarLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();

            // NOUVELLE GESTION DES ID (plus générique)
            let targetId = '';
            if (link.id.startsWith('nav-')) {
                targetId = link.id.substring(4) + '-content'; // e.g., 'nav-flights' -> 'flights-content'
            }
            const targetTitle = link.querySelector('span').textContent;

            // Cacher toutes les sections
            contentSections.forEach(section => {
                section.classList.add('hidden');
            });

            // Afficher la section cible
            const targetSection = document.getElementById(targetId);
            if (targetSection) {
                targetSection.classList.remove('hidden');
                mainTitle.textContent = targetTitle; // Mettre à jour le titre principal

                 // Cacher/Afficher la carte Live Map (seulement sur le dashboard)
                 // La carte est DANS la section dashboard, donc pas besoin de la gérer séparément ici
                 // (le code original la cachait/montrait en plus de la section, ce qui n'est pas nécessaire)
                 // if (liveMapSection) { // S'assurer que liveMapSection existe
                 //    if (targetId === 'dashboard-content') {
                 //       liveMapSection.classList.remove('hidden');
                 //    } else {
                 //       liveMapSection.classList.add('hidden');
                 //    }
                 // }

                // Initialiser les graphiques si on est dans la section Stats
                if (targetId === 'stats-content') {
                    initializeCharts();
                }

            } else if (link.id === 'nav-live') { // Cas spécial pour "Suivi en Direct" qui pointe vers le dashboard
                 const dashboardSection = document.getElementById('dashboard-content');
                 if(dashboardSection) dashboardSection.classList.remove('hidden');
                 mainTitle.textContent = "Tableau de Bord"; // Ou "Suivi en Direct" si vous préférez
                 // if (liveMapSection) liveMapSection.classList.remove('hidden'); // La carte est dans dashboard-content
            } else {
                console.warn(`Section content not found for ID: ${targetId}`); // Aide au débogage
            }

            // Mettre à jour le style actif du lien sidebar
            sidebarLinks.forEach(s_link => s_link.classList.remove('active', 'bg-navy-light', 'text-white')); // Retire toutes les classes actives
            sidebarLinks.forEach(s_link => { // Remet les classes par défaut
                 if (!s_link.classList.contains('active')) {
                     s_link.classList.add('text-gray-400');
                 }
            });
            link.classList.add('active', 'bg-navy-light', 'text-white'); // Ajoute les classes actives au lien cliqué
            link.classList.remove('text-gray-400');

        });
    });

    // --- Gestion des Modals ---
    function openModal(modalElement) {
        if (modalElement) {
            modalElement.classList.remove('hidden');
            modalElement.classList.add('flex'); // Utiliser flex pour centrer
        } else {
            console.error("Tentative d'ouverture d'un modal non trouvé.");
        }
    }

    function closeModal(modalElement) {
         if (modalElement) {
            modalElement.classList.add('hidden');
            modalElement.classList.remove('flex');
        } else {
             console.error("Tentative de fermeture d'un modal non trouvé.");
        }
    }

    // Bouton Ajouter Vol
    if (openAddFlightButton) {
        openAddFlightButton.addEventListener('click', () => {
            document.getElementById('flight-modal-title').textContent = 'Ajouter un Vol';
            document.getElementById('flight-form').reset();
            openModal(flightModal);
        });
    }

    // Bouton Ajouter Utilisateur
    if (openAddUserButton) {
         openAddUserButton.addEventListener('click', () => {
             document.getElementById('user-modal-title').textContent = 'Ajouter un Utilisateur';
            document.getElementById('user-form').reset();
            openModal(userModal);
        });
    }

    // NOUVEAU: Bouton Ajouter Avion
    if (openAddAircraftButton) {
         openAddAircraftButton.addEventListener('click', () => {
             document.getElementById('aircraft-modal-title').textContent = 'Ajouter un Avion';
            document.getElementById('aircraft-form').reset();
            openModal(aircraftModal);
        });
    }

    // Boutons Fermer Modal (commun à tous les modals)
    closeModalButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Trouve le modal parent le plus proche et le ferme
            const modalToClose = button.closest('#flight-modal, #user-modal, #aircraft-modal'); // NOUVEAU: Ajout de #aircraft-modal
            closeModal(modalToClose);
        });
    });

    // Fermer le modal en cliquant sur le fond (backdrop)
    // NOUVEAU: Ajout de aircraftModal à la liste
    [flightModal, userModal, aircraftModal].forEach(modal => {
        if(modal) {
            modal.addEventListener('click', (event) => {
                // Si le clic est directement sur le backdrop (pas sur le contenu du modal)
                if (event.target === modal) {
                    closeModal(modal);
                }
            });
        }
    });

    // --- Logique pour les boutons Modifier/Supprimer (Placeholders) ---

    // >> Pour les Vols
    document.querySelectorAll('#flights-content table button[title="Modifier"]').forEach(btn => {
        btn.addEventListener('click', () => {
            console.log("Modifier vol cliqué");
            document.getElementById('flight-modal-title').textContent = 'Modifier le Vol';
            // Simuler le pré-remplissage
            const row = btn.closest('tr');
            const cells = row.querySelectorAll('td');
            if(cells.length >= 5) { // S'assurer qu'il y a assez de cellules
                document.getElementById('flight_number').value = cells[0].textContent.trim();
                document.getElementById('departure_airport').value = cells[1].textContent.trim();
                document.getElementById('arrival_airport').value = cells[2].textContent.trim();
                document.getElementById('airline').value = cells[3].textContent.trim();
                // Pour le statut, il faudrait trouver l'option correspondante dans le select
                // document.getElementById('status').value = 'Programmé'; // Exemple simple
            }
            openModal(flightModal);
        });
    });
     document.querySelectorAll('#flights-content table button[title="Supprimer"]').forEach(btn => {
        btn.addEventListener('click', () => {
            if (confirm('Êtes-vous sûr de vouloir supprimer ce vol ?')) {
                console.log("Supprimer vol cliqué");
                 btn.closest('tr').remove();
            }
        });
    });

    // >> NOUVEAU: Pour les Avions
    document.querySelectorAll('#aircraft-content table button[title="Modifier"]').forEach(btn => {
        btn.addEventListener('click', () => {
            console.log("Modifier avion cliqué");
            document.getElementById('aircraft-modal-title').textContent = 'Modifier l\'Avion';
            // Simuler le pré-remplissage
             const row = btn.closest('tr');
            const cells = row.querySelectorAll('td');
             if(cells.length >= 4) { // S'assurer qu'il y a assez de cellules
                document.getElementById('aircraft_tail_number').value = cells[0].textContent.trim();
                document.getElementById('aircraft_model').value = cells[1].textContent.trim();
                document.getElementById('aircraft_operator').value = cells[2].textContent.trim();
                // Pour le statut (badge -> select value)
                const statusText = cells[3].querySelector('span').textContent.trim();
                document.getElementById('aircraft_status').value = statusText; // Fonctionne si le textContent correspond à la value
             }
            openModal(aircraftModal);
        });
    });
     document.querySelectorAll('#aircraft-content table button[title="Supprimer"]').forEach(btn => {
        btn.addEventListener('click', () => {
            if (confirm('Êtes-vous sûr de vouloir supprimer cet avion ?')) {
                console.log("Supprimer avion cliqué");
                 btn.closest('tr').remove();
            }
        });
    });

     // >> Pour les Utilisateurs (existant, juste pour la complétude)
    document.querySelectorAll('#users-content table button[title="Modifier"]').forEach(btn => {
        btn.addEventListener('click', () => {
            console.log("Modifier utilisateur cliqué");
            document.getElementById('user-modal-title').textContent = 'Modifier l\'Utilisateur';
            // Pré-remplir le formulaire utilisateur...
            openModal(userModal);
        });
    });
     document.querySelectorAll('#users-content table button[title="Supprimer"]').forEach(btn => {
        btn.addEventListener('click', () => {
            if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
                console.log("Supprimer utilisateur cliqué");
                btn.closest('tr').remove();
            }
        });
    });


    // --- Initialisation des Graphiques Chart.js ---
    let flightStatusChartInstance = null;
    let monthlyFlightsChartInstance = null;

    function initializeCharts() {
        const flightStatusCtx = document.getElementById('flightStatusChart')?.getContext('2d');
        const monthlyFlightsCtx = document.getElementById('monthlyFlightsChart')?.getContext('2d');

        if (flightStatusChartInstance) flightStatusChartInstance.destroy();
        if (monthlyFlightsChartInstance) monthlyFlightsChartInstance.destroy();

        const flightStatusData = { /* ... données ... */
             labels: ['En vol', 'Programmé', 'Arrivé', 'Retardé', 'Annulé'],
             datasets: [{ /* ... dataset ... */
                label: 'Statut des Vols',
                data: [247, 150, 800, 8, 2],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)', // Bleu
                    'rgba(255, 206, 86, 0.7)', // Jaune
                    'rgba(75, 192, 192, 0.7)', // Vert Cyan
                    'rgba(255, 99, 132, 0.7)',  // Rouge
                    'rgba(153, 102, 255, 0.7)' // Violet
                ],
                borderColor: [ /* ... borders ... */
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        };
        const monthlyFlightsData = { /* ... données ... */
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
            datasets: [{ /* ... dataset ... */
                label: 'Vols par Mois',
                data: [1100, 1050, 1200, 1150, 1258, 1300],
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        };
        const chartOptions = { /* ... options ... */
            maintainAspectRatio: false,
             plugins: { legend: { labels: { color: '#cbd5e1' } } },
            scales: {
                y: { beginAtZero: true, ticks: { color: '#cbd5e1' }, grid: { color: 'rgba(203, 213, 225, 0.2)' } },
                x: { ticks: { color: '#cbd5e1' }, grid: { color: 'rgba(203, 213, 225, 0.2)' } }
            }
        };
        const pieChartOptions = { /* ... options ... */
             maintainAspectRatio: false,
             plugins: { legend: { position: 'bottom', labels: { color: '#cbd5e1' } } }
        };

        if (flightStatusCtx) {
            flightStatusChartInstance = new Chart(flightStatusCtx, { type: 'doughnut', data: flightStatusData, options: pieChartOptions });
        }
        if (monthlyFlightsCtx) {
            monthlyFlightsChartInstance = new Chart(monthlyFlightsCtx, { type: 'line', data: monthlyFlightsData, options: chartOptions });
        }
    }

     // Initialiser le dashboard au chargement
     const initialLink = document.querySelector('.sidebar-link.active'); // Trouver le lien actif initial
     if (initialLink) {
         initialLink.click(); // Simuler un clic pour afficher la section initiale et définir le titre
     } else { // Fallback si aucun lien n'est actif par défaut
        const dashboardSection = document.getElementById('dashboard-content');
        if (dashboardSection) {
            dashboardSection.classList.remove('hidden');
            mainTitle.textContent = "Tableau de Bord";
        }
     }

});
</script>

</body>
</html>