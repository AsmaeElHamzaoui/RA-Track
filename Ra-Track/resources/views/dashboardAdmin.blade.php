<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <!-- ==================== NOUVEAU LIEN SIDEBAR AÉROPORTS ==================== -->
                    <li class="mb-2">
                        <a href="#" id="nav-airports" class="sidebar-link flex items-center space-x-3 p-2 rounded hover:bg-navy-light text-gray-400 hover:text-white">
                            <!-- Icône Aéroport (Exemple: Bâtiment ou Tour) -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M8.25 21h7.5M12 3v18m0 0v-6.75m0 6.75H9.75m2.25 0h2.25m-2.25 0V12m0 9V9.75M12 9.75h-2.25m2.25 0h2.25M12 9.75V6m0 3.75v-1.5m0 1.5V3" />
                            </svg>
                            <span>Gestion des Aéroports</span>
                        </a>
                    </li>
                    <!-- ==================== FIN NOUVEAU LIEN SIDEBAR AÉROPORTS ==================== -->
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

        <!-- ==================== SECTION GESTION DES AÉROPORTS ==================== -->
        @include('components.airport')

        <!-- ==================== Section Gestion des Vols ==================== -->
        @include('components.Flight')

        <!-- ==================== SECTION GESTION DES AVIONS ==================== -->
        @include('components.plane')


        <!-- ==================== Section Utilisateurs ==================== -->
        @include('components.user')

        <!-- ==================== Section Statistiques ==================== -->
        @include('components.statistics')

        <!-- ==================== MODALS ==================== -->

        <!-- ==================== MODAL AÉROPORT ==================== -->
        @include('modals.airport')

        <!-- Modal Ajouter/Modifier Vol -->
        @include('modals.flight')

        <!-- ==================== MODAL AVION ==================== -->
        @include('modals.plane')


        <!-- Modal Ajouter/Modifier Utilisateur (Structure similaire au modal Vol) -->
        @include('modals.user')


    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const sidebarLinks = document.querySelectorAll('.sidebar-link');
    const contentSections = document.querySelectorAll('.content-section');
    const mainTitle = document.getElementById('main-title');
    // const liveMapSection = document.getElementById('live-map-section'); // Commenté car la carte est dans dashboard-content

    // Modals et boutons
    const flightModal = document.getElementById('flight-modal');
    const userModal = document.getElementById('user-modal');
    const aircraftModal = document.getElementById('aircraft-modal');
    const airportModal = document.getElementById('airport-modal'); // NOUVEAU: Référence au modal aéroport
    const openAddFlightButton = document.getElementById('open-add-flight-modal');
    const openAddUserButton = document.getElementById('open-add-user-modal');
    const openAddAircraftButton = document.getElementById('open-add-aircraft-modal');
    const openAddAirportButton = document.getElementById('open-add-airport-modal'); // NOUVEAU: Référence au bouton ajouter aéroport
    const closeModalButtons = document.querySelectorAll('.close-modal');

    // --- Gestion de la navigation par section ---
    sidebarLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();

            // Gestion des ID plus robuste
            let targetId = '';
            let targetTitle = "Tableau de Bord"; // Default title

            if (link.id.startsWith('nav-')) {
                const sectionName = link.id.substring(4); // e.g., 'dashboard', 'flights', 'airports'
                 if (sectionName === 'live') {
                     targetId = 'dashboard-content'; // "Suivi en direct" pointe vers le dashboard
                 } else {
                     targetId = sectionName + '-content'; // e.g., 'flights-content', 'airports-content'
                 }
            }
             // Utilise textContent du span pour le titre, plus fiable
            const span = link.querySelector('span');
            if (span) {
                targetTitle = span.textContent;
            }


            // Cacher toutes les sections
            contentSections.forEach(section => {
                section.classList.add('hidden');
            });

            // Afficher la section cible
            const targetSection = document.getElementById(targetId);
            if (targetSection) {
                targetSection.classList.remove('hidden');
                mainTitle.textContent = targetTitle; // Mettre à jour le titre principal

                // Initialiser les graphiques si on est dans la section Stats
                if (targetId === 'stats-content') {
                    initializeCharts();
                }

            } else {
                // Fallback ou avertissement si la section n'est pas trouvée
                if (targetId !== 'dashboard-content') { // Ne pas avertir pour 'live' si dashboard est manquant
                    console.warn(`Section content not found for ID: ${targetId}`);
                }
                // Essayer d'afficher le dashboard par défaut si la cible est manquante
                const dashboardSection = document.getElementById('dashboard-content');
                if(dashboardSection) {
                    dashboardSection.classList.remove('hidden');
                    mainTitle.textContent = "Tableau de Bord";
                } else {
                    console.error("Fallback dashboard section not found.");
                }
            }

            // Mettre à jour le style actif du lien sidebar
            sidebarLinks.forEach(s_link => s_link.classList.remove('active', 'bg-navy-light', 'text-white'));
            sidebarLinks.forEach(s_link => {
                 if (!s_link.classList.contains('active')) {
                     s_link.classList.add('text-gray-400');
                 }
            });
            link.classList.add('active', 'bg-navy-light', 'text-white');
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
            const modalTitle = document.getElementById('flight-modal-title');
            const form = document.getElementById('flight-form');
            if(modalTitle) modalTitle.textContent = 'Ajouter un Vol';
            if(form) form.reset();
            // Clear potential hidden ID field if used for editing
            const flightIdInput = document.getElementById('flight_id');
            if(flightIdInput) flightIdInput.value = '';
            openModal(flightModal);
        });
    }

    // Bouton Ajouter Utilisateur
    if (openAddUserButton) {
         openAddUserButton.addEventListener('click', () => {
             const modalTitle = document.getElementById('user-modal-title');
             const form = document.getElementById('user-form');
             if(modalTitle) modalTitle.textContent = 'Ajouter un Utilisateur';
             if(form) form.reset();
             const userIdInput = document.getElementById('user_id');
             if(userIdInput) userIdInput.value = '';
             openModal(userModal);
        });
    }

    // Bouton Ajouter Avion
    if (openAddAircraftButton) {
         openAddAircraftButton.addEventListener('click', () => {
             const modalTitle = document.getElementById('aircraft-modal-title');
             const form = document.getElementById('aircraft-form');
             if(modalTitle) modalTitle.textContent = 'Ajouter un Avion';
             if(form) form.reset();
             const aircraftIdInput = document.getElementById('aircraft_id'); // Assurez-vous que cet ID existe si vous gérez l'édition
             if(aircraftIdInput) aircraftIdInput.value = '';
             openModal(aircraftModal);
        });
    }

    // NOUVEAU: Bouton Ajouter Aéroport
    if (openAddAirportButton) {
         openAddAirportButton.addEventListener('click', () => {
             const modalTitle = document.getElementById('airport-modal-title');
             const form = document.getElementById('airport-form');
             if(modalTitle) modalTitle.textContent = 'Ajouter un Aéroport';
             if(form) form.reset();
             const airportIdInput = document.getElementById('airport_id'); // Champ caché pour ID
             if(airportIdInput) airportIdInput.value = '';
             openModal(airportModal);
        });
    }

    // Boutons Fermer Modal (commun à tous les modals)
    closeModalButtons.forEach(button => {
        button.addEventListener('click', () => {
            // MODIFIÉ: Ajout de #airport-modal au sélecteur
            const modalToClose = button.closest('#flight-modal, #user-modal, #aircraft-modal, #airport-modal');
            closeModal(modalToClose);
        });
    });

    // Fermer le modal en cliquant sur le fond (backdrop)
    // MODIFIÉ: Ajout de airportModal à la liste
    [flightModal, userModal, aircraftModal, airportModal].forEach(modal => {
        if(modal) {
            modal.addEventListener('click', (event) => {
                // Si le clic est directement sur le backdrop (pas sur le contenu du modal)
                if (event.target === modal) {
                    closeModal(modal);
                }
            });
        }
    });

    // --- Logique pour les boutons Modifier/Supprimer (Placeholders et Simulation) ---
    // Utilisation de la délégation d'événements pour plus de robustesse (fonctionne aussi pour lignes ajoutées dynamiquement)

    function handleTableActions(event, sectionId, modalElement, modalTitleElementId, formElementId, entityName) {
        const target = event.target;
        const modifyButton = target.closest('button[title="Modifier"]');
        const deleteButton = target.closest('button[title="Supprimer"]');

        if (modifyButton) {
            console.log(`Modifier ${entityName} cliqué dans ${sectionId}`);
            const modalTitle = document.getElementById(modalTitleElementId);
            if(modalTitle) modalTitle.textContent = `Modifier ${entityName === 'Utilisateur' ? "l'" : "l'"} ${entityName}`;

            const row = modifyButton.closest('tr');
            const form = document.getElementById(formElementId);
            if (form && row) {
                // Pré-remplissage (exemple générique, à adapter pour chaque entité)
                const cells = row.querySelectorAll('td');
                 console.log(`Pré-remplissage pour ${entityName} depuis la ligne.`);
                 // --- Logique de pré-remplissage spécifique ---
                 if (entityName === 'Vol' && cells.length >= 5) {
                     const numInput = form.querySelector('#flight_number');
                     const depInput = form.querySelector('#departure_airport');
                     const arrInput = form.querySelector('#arrival_airport');
                     const airlineInput = form.querySelector('#airline');
                     const statusInput = form.querySelector('#status'); // Attention, la valeur doit correspondre au `value` de l'option
                     if(numInput) numInput.value = cells[0].textContent.trim();
                     if(depInput) depInput.value = cells[1].textContent.trim();
                     if(arrInput) arrInput.value = cells[2].textContent.trim();
                     if(airlineInput) airlineInput.value = cells[3].textContent.trim();
                     // Pour le statut, c'est plus complexe, il faut mapper le texte à la valeur
                     // if(statusInput) statusInput.value = cells[4].textContent.trim(); // Simple mais peut échouer
                 } else if (entityName === 'Avion' && cells.length >= 4) {
                     const tailInput = form.querySelector('#aircraft_tail_number');
                     const modelInput = form.querySelector('#aircraft_model');
                     const opInput = form.querySelector('#aircraft_operator');
                     const statusInput = form.querySelector('#aircraft_status');
                     const statusBadge = cells[3].querySelector('span');
                     if(tailInput) tailInput.value = cells[0].textContent.trim();
                     if(modelInput) modelInput.value = cells[1].textContent.trim();
                     if(opInput) opInput.value = cells[2].textContent.trim();
                     if(statusInput && statusBadge) statusInput.value = statusBadge.textContent.trim(); // Suppose que le texte du badge = la valeur de l'option
                 } else if (entityName === 'Aéroport' && cells.length >= 4) { // NOUVELLE CONDITION
                     const iataInput = form.querySelector('#airport_iata_code');
                     const nameInput = form.querySelector('#airport_name');
                     const cityInput = form.querySelector('#airport_city');
                     const countryInput = form.querySelector('#airport_country');
                     const idInput = form.querySelector('#airport_id');
                     // const icaoInput = form.querySelector('#airport_icao_code');
                     if(iataInput) iataInput.value = cells[0].textContent.trim();
                     if(nameInput) nameInput.value = cells[1].textContent.trim();
                     if(cityInput) cityInput.value = cells[2].textContent.trim();
                     if(countryInput) countryInput.value = cells[3].textContent.trim();
                     if(idInput) idInput.value = row.dataset.airportId || ''; // Utilisation de data attribute pour l'ID
                     // if(icaoInput) icaoInput.value = ... ;
                 } else if (entityName === 'Utilisateur') {
                      // Ajouter la logique de pré-remplissage pour l'utilisateur si nécessaire
                      console.warn(`Pré-remplissage pour ${entityName} non implémenté dans cet exemple.`);
                      form.reset(); // Reset par défaut
                 } else {
                      console.warn(`Impossible de pré-remplir le formulaire ${entityName} : nombre de cellules insuffisant ou type inconnu.`);
                      form.reset();
                 }
            } else {
                console.error(`Formulaire ${formElementId} ou ligne non trouvés pour modification.`);
            }
            openModal(modalElement);
        } else if (deleteButton) {
            if (confirm(`Êtes-vous sûr de vouloir supprimer cet ${entityName === 'Utilisateur' ? '' : 'e'} ${entityName.toLowerCase()} ?`)) {
                console.log(`Supprimer ${entityName} cliqué dans ${sectionId}`);
                const row = deleteButton.closest('tr');
                // --- Ici, ajouter l'appel AJAX pour supprimer sur le serveur ---
                // Exemple: deleteEntityOnServer(entityName, row.dataset.id);
                row.remove(); // Supprime la ligne de l'interface (simulation)
            }
        }
    }

    // Appliquer la délégation aux différentes sections
    const flightsContent = document.getElementById('flights-content');
    if (flightsContent) flightsContent.addEventListener('click', (e) => handleTableActions(e, 'flights-content', flightModal, 'flight-modal-title', 'flight-form', 'Vol'));

    const aircraftContent = document.getElementById('aircraft-content');
    if (aircraftContent) aircraftContent.addEventListener('click', (e) => handleTableActions(e, 'aircraft-content', aircraftModal, 'aircraft-modal-title', 'aircraft-form', 'Avion'));

    // NOUVEAU: Délégation pour les Aéroports
    const airportsContent = document.getElementById('airports-content');
    if (airportsContent) airportsContent.addEventListener('click', (e) => handleTableActions(e, 'airports-content', airportModal, 'airport-modal-title', 'airport-form', 'Aéroport'));

    const usersContent = document.getElementById('users-content');
    if (usersContent) usersContent.addEventListener('click', (e) => handleTableActions(e, 'users-content', userModal, 'user-modal-title', 'user-form', 'Utilisateur'));


    // --- Gestion Soumission Formulaires (Simulation) ---

    function handleFormSubmit(event, modalElement, entityName) {
        event.preventDefault(); // Empêche la soumission classique
        const form = event.target;
        const formData = new FormData(form);
        // Essayer de récupérer un ID (pour déterminer si c'est ajout ou modif)
        // Suppose que le champ ID a un name se terminant par '_id' (ex: flight_id, user_id, airport_id)
        let entityId = null;
        for (let [key, value] of formData.entries()) {
            if (key.endsWith('_id') && value) {
                entityId = value;
                break;
            }
        }
        const isUpdating = !!entityId;

        console.log(`Soumission formulaire ${entityName} (${isUpdating ? 'Modification ID: '+entityId : 'Ajout'})`);
        console.log("Données:", Object.fromEntries(formData.entries()));

        // --- Ici, ajouter l'appel AJAX pour sauvegarder sur le serveur ---
        // Exemple: saveEntityToServer(entityName, Object.fromEntries(formData.entries()), isUpdating);
        // Après succès AJAX : Mettre à jour le tableau si nécessaire (ajouter/modifier ligne)

        closeModal(modalElement); // Fermer le modal après la simulation/l'appel AJAX
        alert(`Formulaire ${entityName} soumis (simulation). Vérifiez la console.`);
    }

    // Attacher le gestionnaire aux formulaires
    const flightForm = document.getElementById('flight-form');
    if(flightForm) flightForm.addEventListener('submit', (e) => handleFormSubmit(e, flightModal, 'Vol'));

    const aircraftForm = document.getElementById('aircraft-form');
    if(aircraftForm) aircraftForm.addEventListener('submit', (e) => handleFormSubmit(e, aircraftModal, 'Avion'));

    // NOUVEAU: Gestionnaire pour le formulaire Aéroport
    const airportForm = document.getElementById('airport-form');
    if(airportForm) airportForm.addEventListener('submit', (e) => handleFormSubmit(e, airportModal, 'Aéroport'));

    const userForm = document.getElementById('user-form');
    if(userForm) userForm.addEventListener('submit', (e) => handleFormSubmit(e, userModal, 'Utilisateur'));


   

     // Initialiser le dashboard au chargement
     const initialLink = document.querySelector('.sidebar-link.active');
     if (initialLink) {
         initialLink.click(); // Simuler un clic pour afficher la section initiale et définir le titre/graphiques
     } else { // Fallback si aucun lien n'est actif par défaut
        const dashboardLink = document.getElementById('nav-dashboard');
        if(dashboardLink) {
            dashboardLink.click(); // Tenter de cliquer sur le lien du dashboard
        } else {
             // Si même le lien dashboard n'existe pas, afficher la section directement
            const dashboardSection = document.getElementById('dashboard-content');
            if (dashboardSection) {
                contentSections.forEach(section => section.classList.add('hidden')); // Cacher les autres
                dashboardSection.classList.remove('hidden');
                mainTitle.textContent = "Tableau de Bord";
            } else {
                console.error("Impossible d'initialiser une section par défaut.");
            }
        }
     }

});
</script>

</body>
</html>