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
        @include('components.user')

        <!-- ==================== Section Statistiques ==================== -->
        @include('components.statistics')

        <!-- ==================== MODALS ==================== -->

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