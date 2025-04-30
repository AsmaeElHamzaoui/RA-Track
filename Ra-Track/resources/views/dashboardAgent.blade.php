<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Supposons que vous utilisiez Laravel, sinon retirez cette ligne -->
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
    <title>Maintenance Dashboard</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Heroicons CDN (for icons) -->
    <script type="module" src="https://cdn.jsdelivr.net/npm/heroicons@2.1.1/24/outline/esm/index.js"></script>
    <script nomodule src="https://cdn.jsdelivr.net/npm/heroicons@2.1.1/24/outline/cjs/index.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <!-- <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.css' rel='stylesheet' /> -->

    <style>
        /* Style simple pour le lien actif de la barre latérale */
        .sidebar-link.active {
            background-color: #e0f2fe; /* light-blue-100 */
            color: #0284c7; /* sky-600 */
            font-weight: 600;
        }

        /* Assurer l'alignement des icônes avec le texte */
        .icon-inline {
            display: inline-block;
            vertical-align: middle;
            width: 1.25em; /* Ajuster la taille si besoin */
            height: 1.25em;
            margin-right: 0.5em;
        }

        /* Styles de base pour le conteneur du calendrier (à personnaliser) */
        #maintenance-calendar {
            min-height: 400px; /* Donne une hauteur minimale */
            border: 1px solid #e5e7eb; /* gray-200 */
            border-radius: 0.5rem; /* rounded-lg */
            padding: 1rem; /* p-4 */
            background-color: #f9fafb; /* gray-50 */
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md flex flex-col">
            <!-- Logo/Marque -->
            <div class="p-6 border-b flex items-center space-x-3">
                <!-- Icône Clé à molette (exemple) -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-600">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l.471.471a1.402 1.402 0 0 1 1.982 0l3.018-3.018a1.402 1.402 0 0 1 0-1.982l-.471-.471M11.42 15.17 5.877 21m5.543-5.83L7.05 13.47l-2.54 2.541A2.652 2.652 0 0 0 2.988 21l2.889-.011m5.543-5.83.471.471a1.402 1.402 0 0 1 1.982 0l3.018-3.018a1.402 1.402 0 0 1 0-1.982l-.471-.471m0 0L13.47 7.05l2.54-2.541A2.652 2.652 0 0 0 21 2.988l-.011 2.889m-5.83 5.543-5.543 5.543" />
                </svg>
                <span class="text-xl font-bold text-gray-800">Maintenance Hub</span>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-2">
                <a href="#" id="nav-current-maintenance" class="sidebar-link flex items-center px-4 py-2 text-gray-700 rounded-md hover:bg-gray-100 active" data-target="current-maintenance-section">
                    <!-- Icône Clé à molette -->
                     <svg class="icon-inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                       <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l.471.471a1.402 1.402 0 0 1 1.982 0l3.018-3.018a1.402 1.402 0 0 1 0-1.982l-.471-.471M11.42 15.17 5.877 21m5.543-5.83L7.05 13.47l-2.54 2.541A2.652 2.652 0 0 0 2.988 21l2.889-.011m5.543-5.83.471.471a1.402 1.402 0 0 1 1.982 0l3.018-3.018a1.402 1.402 0 0 1 0-1.982l-.471-.471m0 0L13.47 7.05l2.54-2.541A2.652 2.652 0 0 0 21 2.988l-.011 2.889m-5.83 5.543-5.543 5.543" />
                     </svg>
                    Avions en Maintenance
                </a>
                <a href="#" id="nav-maintenance-planning" class="sidebar-link flex items-center px-4 py-2 text-gray-700 rounded-md hover:bg-gray-100" data-target="maintenance-planning-section">
                   <!-- Icône Calendrier -->
                    <svg class="icon-inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                    Planification Maintenance
                </a>
            </nav>
        </aside>

        <!-- Contenu Principal -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <!-- Barre d'En-tête Supérieure -->
            <header class="bg-white shadow-sm p-4 flex justify-between items-center">
                 <!-- Peut être vide ou contenir des éléments comme le titre de la section active -->
                 <div>
                    <h1 id="main-header-title" class="text-xl font-semibold text-gray-700">Avions en Maintenance</h1>
                 </div>
                <div class="flex items-center space-x-4">
                    <!-- Notifications (exemple) -->
                    <button class="relative text-gray-600 hover:text-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                        </svg>
                        <!-- Badge de notification (exemple) -->
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full px-1.5 py-0.5">2</span>
                    </button>
                    <!-- Avatar Utilisateur (exemple) -->
                    <img src="https://via.placeholder.com/40/0ea5e9/ffffff?text=MA" alt="User Avatar" class="w-10 h-10 rounded-full border-2 border-blue-300"> <!-- MA pour Maintenance Agent -->
                </div>
            </header>

            <!-- Zone de Contenu -->
            <div class="flex-1 overflow-y-auto p-6">
                <!-- Section 1: Avions en Maintenance -->
                <section id="current-maintenance-section" class="content-section">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Avions Actuellement en Maintenance</h2>
                    <div class="bg-white shadow rounded-lg overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avion (N° Immat.)</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Modèle</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type Maintenance</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Début</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fin Prévue</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Ligne Exemple 1 -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">F-GHTY</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Boeing 737-800</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Check C</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-03-10</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-03-25</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                          En cours
                                        </span>
                                    </td>
                                </tr>
                                <!-- Ligne Exemple 2 -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">F-ABCD</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Airbus A320neo</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Réparation Moteur</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-03-18</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-03-22</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                          En cours
                                        </span>
                                    </td>
                                </tr>
                                <!-- Ligne Exemple 3 - Maintenance terminée -->
                                <!-- Vous pourriez vouloir filtrer ceux-ci ou les afficher différemment -->
                                <!--
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">F-WXYZ</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">ATR 72-600</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Check A</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-03-15</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-03-16</td>
                                     <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                          Terminé
                                        </span>
                                    </td>
                                </tr>
                                -->
                                <!-- Ajouter plus de lignes si nécessaire -->
                                <!-- Ligne si aucun avion en maintenance -->
                                <!--
                                <tr>
                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        Aucun avion actuellement en maintenance.
                                    </td>
                                </tr>
                                -->
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Section 2: Planification de Maintenance -->
                <section id="maintenance-planning-section" class="content-section hidden">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Planifier une Maintenance</h2>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Colonne Formulaire -->
                        <div class="lg:col-span-1 bg-white p-6 rounded-lg shadow">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Nouvelle Planification</h3>
                            <form id="plan-maintenance-form" class="space-y-4">
                                <div>
                                    <label for="aircraft-select" class="block text-sm font-medium text-gray-700">Avion</label>
                                    <select id="aircraft-select" name="aircraft_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                        <option>Sélectionner un avion...</option>
                                        <option value="1">F-GHTY (Boeing 737)</option>
                                        <option value="2">F-ABCD (Airbus A320)</option>
                                        <option value="3">F-WXYZ (ATR 72)</option>
                                        <!-- Ajouter dynamiquement les avions disponibles -->
                                    </select>
                                </div>
                                <div>
                                    <label for="maintenance-type" class="block text-sm font-medium text-gray-700">Type de Maintenance</label>
                                    <input type="text" name="maintenance_type" id="maintenance-type" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Ex: Check A, Réparation...">
                                </div>
                                <div>
                                    <label for="start-date" class="block text-sm font-medium text-gray-700">Date de Début</label>
                                    <input type="date" name="start_date" id="start-date" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div>
                                    <label for="end-date" class="block text-sm font-medium text-gray-700">Date de Fin Prévue</label>
                                    <input type="date" name="end_date" id="end-date" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <!-- Optionnel: Champ durée (peut être calculé ou saisi) -->
                                <!--
                                <div>
                                    <label for="duration" class="block text-sm font-medium text-gray-700">Durée (jours)</label>
                                    <input type="number" name="duration" id="duration" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" min="1">
                                </div>
                                -->
                                <div class="pt-2">
                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Planifier
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Colonne Calendrier -->
                        <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow">
                             <h3 class="text-lg font-medium text-gray-900 mb-4">Calendrier des Maintenances</h3>
                             <!-- Zone où le calendrier sera rendu par JavaScript -->
                             <div id="maintenance-calendar">
                                 <p class="text-center text-gray-500 pt-10">Le calendrier interactif sera affiché ici.</p>
                                 <p class="text-center text-gray-400 text-sm">(Nécessite une bibliothèque JavaScript comme FullCalendar)</p>
                             </div>
                        </div>
                    </div>

                </section>
              

            </div> 
            <!-- Fin Zone de Contenu -->
        </main>
        <!-- Fin Contenu Principal -->

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebarLinks = document.querySelectorAll('.sidebar-link');
            const contentSections = document.querySelectorAll('.content-section');
            const mainHeaderTitle = document.getElementById('main-header-title'); // Pour changer le titre

            // --- Navigation Sidebar ---
            sidebarLinks.forEach(link => {
                link.addEventListener('click', (event) => {
                    event.preventDefault();

                    // Désactiver tous les liens et masquer toutes les sections
                    sidebarLinks.forEach(l => l.classList.remove('active'));
                    contentSections.forEach(section => section.classList.add('hidden'));

                    // Activer le lien cliqué et afficher la section cible
                    link.classList.add('active');
                    const targetId = link.getAttribute('data-target');
                    const targetSection = document.getElementById(targetId);
                    if (targetSection) {
                        targetSection.classList.remove('hidden');
                    }

                    // Mettre à jour le titre dans l'en-tête (optionnel)
                    if (mainHeaderTitle) {
                        mainHeaderTitle.textContent = link.textContent.trim(); // Utilise le texte du lien comme titre
                    }
                });
            });

            // --- État Initial ---
            // Simuler un clic sur le premier lien au chargement pour afficher la section par défaut
            const initialLink = document.getElementById('nav-current-maintenance');
             if(initialLink){
                initialLink.click();
             }


            
           
            

        });
    </script>

</body>

</html>