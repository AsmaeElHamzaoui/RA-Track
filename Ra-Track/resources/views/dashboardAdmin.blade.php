<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
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
    <!-- Include Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin="" />
    <!-- Include Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
    <!-- Include Leaflet.curve plugin -->
    <script src="https://cdn.jsdelivr.net/npm/leaflet-curve@0.8.2/leaflet.curve.min.js"></script>
    <script src="https://unpkg.com/leaflet.curve"></script>
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
            top: 20%;
            left: 15%;
            width: 70%;
            height: 60%;
            border: 2px dashed rgba(255, 165, 0, 0.6);
            border-radius: 50% / 10%;
            transform: rotate(-15deg);
            opacity: 0.7;
            pointer-events: none;
        }

        /* Styles pour le modal */
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.6);
        }

        /* Style pour le lien actif de la sidebar */
        .sidebar-link.active {
            background-color: var(--tw-color-navy-light) !important;
            /* Utilise la couleur navy-light définie dans la config */
            color: white !important;
        }

        /* Assurer que la couleur navy-light est disponible comme variable CSS */

        /* Styles pour le menu burger */
        .burger-menu {
            display: none;
            cursor: pointer;
            padding: 0.5rem;
        }

        @media (max-width: 768px) {
            .burger-menu {
                display: block;
            }

            aside {
                position: fixed;
                left: -100%;
                top: 0;
                bottom: 0;
                z-index: 50;
                transition: left 0.3s ease;
            }

            aside.active {
                left: 0;
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 40;
            }

            .overlay.active {
                display: block;
            }
        }

        .plane-svg-icon {
            width: 28px;
            /* Ajustez si besoin */
            height: 28px;
            fill: #F59E0B;
            /* Couleur avion */
            filter: drop-shadow(0px 0px 2px rgba(0, 0, 0, 0.7));
            /* Ombre légère */
            transition: transform 0.3s linear;
            /* Animation rotation */
        }

        /* Enlever fond/bordure par défaut Leaflet */
        .dummy-transparent-bg {
            background-color: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }

        /* Centrer l'icône SVG */
        .leaflet-marker-icon {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Style pour le tooltip au survol */
        .leaflet-tooltip {
            background-color: rgba(22, 34, 56, 0.9) !important;
            border: 1px solid #FFD476 !important;
            color: #E2E8F0 !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.4) !important;
            border-radius: 4px !important;
            padding: 6px 10px !important;
            font-size: 11px !important;
            white-space: nowrap !important;
        }

        .leaflet-tooltip-top::before {
            /* Flèche du tooltip */
            border-top-color: rgba(22, 34, 56, 0.9) !important;
        }
    </style>

</head>

<body class="text-gray-100">

    <div class="flex h-screen">

        <!-- Sidebar -->
        <aside class="w-64 flex-shrink-0 p-4 flex flex-col justify-between" style="background-color:rgb(22, 34, 56); border-right: 1px solid #FFD476;box-shadow: 0 4px 8px rgb(254, 254, 254);">
            <div>
                <div class="flex items-center space-x-2 p-2 mb-10">
                    <img src="{{ asset('images/logo.png') }}" alt="LimoWide Logo" class="h-6 md:h-8">
                </div>

                <nav>
                    <ul>
                        <li class="mb-2">
                            <a href="#" id="nav-dashboard" class="sidebar-link bg-slate-900/70 backdrop-blur-sm flex items-center space-x-3 p-2 rounded active" style="color: #162238; border: 1px solid #FFD476;
                                    box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    5px 5px 15px rgba(0, 0, 0, 0.35),
                                    inset -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    inset 5px 5px 15px rgba(0, 0, 0, 0.35);">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" style="color:#FFD476">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                                </svg>
                                <span>Suivi en Direct</span>
                            </a>
                        </li>
                        <!-- ==================== NOUVEAU LIEN SIDEBAR AÉROPORTS ==================== -->
                        <li class="mb-2">
                            <a href="#" id="nav-airports" class="sidebar-link flex items-center space-x-3 p-2 rounded bg-slate-900/70 backdrop-blur-sm text-white" style="border: 1px solid #FFD476;
                                    box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    5px 5px 15px rgba(0, 0, 0, 0.35),
                                    inset -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    inset 5px 5px 15px rgba(0, 0, 0, 0.35);">
                                <!-- Icône Aéroport (Exemple: Bâtiment ou Tour) -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" style="color:#FFD476">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M8.25 21h7.5M12 3v18m0 0v-6.75m0 6.75H9.75m2.25 0h2.25m-2.25 0V12m0 9V9.75M12 9.75h-2.25m2.25 0h2.25M12 9.75V6m0 3.75v-1.5m0 1.5V3" />
                                </svg>
                                <span>Gestion des Aéroports</span>
                            </a>
                        </li>
                        <!-- ==================== FIN NOUVEAU LIEN SIDEBAR AÉROPORTS ==================== -->
                        <li class="mb-2">
                            <a href="#" id="nav-flights" class="sidebar-link flex items-center space-x-3 p-2 rounded bg-slate-900/70 backdrop-blur-sm text-white" style="border: 1px solid #FFD476;
                                    box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    5px 5px 15px rgba(0, 0, 0, 0.35),
                                    inset -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    inset 5px 5px 15px rgba(0, 0, 0, 0.35);">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 transform -rotate-45" style="color:#FFD476">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                </svg>
                                <span>Gestion des Vols</span>
                            </a>
                        </li>
                        <!-- ==================== NOUVEAU LIEN SIDEBAR AVIONS ==================== -->
                        <li class="mb-2">
                            <a href="#" id="nav-aircraft" class="sidebar-link flex items-center space-x-3 p-2 rounded bg-slate-900/70 backdrop-blur-sm text-white" style="border: 1px solid #FFD476;
                                    box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    5px 5px 15px rgba(0, 0, 0, 0.35),
                                    inset -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    inset 5px 5px 15px rgba(0, 0, 0, 0.35);">
                                <!-- Icône Avion (peut être changée si souhaité) -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" style="color:#FFD476">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h17.5" />
                                </svg>
                                <span>Gestion des Avions</span>
                            </a>
                        </li>
                        <!-- ==================== FIN NOUVEAU LIEN SIDEBAR AVIONS ==================== -->
                        <li class="mb-2">
                            <a href="#" id="nav-users" class="sidebar-link flex items-center space-x-3 p-2 rounded bg-slate-900/70 backdrop-blur-sm text-white" style="border: 1px solid #FFD476;
                                    box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    5px 5px 15px rgba(0, 0, 0, 0.35),
                                    inset -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    inset 5px 5px 15px rgba(0, 0, 0, 0.35);">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" style="color:#FFD476">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg>
                                <span>Utilisateurs</span>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" id="nav-reservations" class="sidebar-link flex items-center space-x-3 p-2 rounded bg-slate-900/70 backdrop-blur-sm text-white" style="border: 1px solid #FFD476;
                                    box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    5px 5px 15px rgba(0, 0, 0, 0.35),
                                    inset -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    inset 5px 5px 15px rgba(0, 0, 0, 0.35);">
                                <!-- Icône Calendrier (Exemple) -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" style="color:#FFD476">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0h18M12 12.75h.008v.008H12v-.008Z" />
                                </svg>
                                <span>Réservations</span>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" id="nav-payments" class="sidebar-link flex items-center space-x-3 p-2 rounded bg-slate-900/70 backdrop-blur-sm text-white" style="border: 1px solid #FFD476;
                                    box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    5px 5px 15px rgba(0, 0, 0, 0.35),
                                    inset -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    inset 5px 5px 15px rgba(0, 0, 0, 0.35);">
                                <!-- Icône Calendrier (Exemple) -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" style="color:#FFD476">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0h18M12 12.75h.008v.008H12v-.008Z" />
                                </svg>
                                <span>Payments</span>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" id="nav-stats" class="sidebar-link flex items-center space-x-3 p-2 rounded bg-slate-900/70 backdrop-blur-sm text-white" style="border: 1px solid #FFD476;
                                    box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    5px 5px 15px rgba(0, 0, 0, 0.35),
                                    inset -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    inset 5px 5px 15px rgba(0, 0, 0, 0.35);">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" style="color:#FFD476">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75c0 .621-.504 1.125-1.125 1.125h-2.25A1.125 1.125 0 0 1 3 21v-7.875ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                                </svg>
                                <span>Statistiques</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="overlay"></div>
        <!-- Main Content -->
        <main class="flex-1 p-6 md:p-8 overflow-y-auto relative" style="background: linear-gradient(to right,rgb(22, 34, 56),rgba(22, 34, 56, 0.71),#F1F0E9);">

            <!-- Header commun (peut être adapté par JS si besoin) -->
            <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                <div></div>
                <div class="flex items-center space-x-4 mt-4 md:mt-0">
                    <button class="burger-menu md:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" style="color:#FFD476">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                    <button class="relative p-2 rounded-full bg-slate-900/70 backdrop-blur-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.017 5.454 1.31M5.25 17.082l4.125 4.125M18.75 17.082l-4.125 4.125M12 21a.75.75 0 0 1-.75-.75V18a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-.75.75H12Z" />
                        </svg>
                        <span class="absolute top-1 right-1 block h-3 w-3 rounded-full bg-yellow-200 ring-2 ring-yellow-700">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-yellow-200 opacity-75"></span>
                        </span>
                    </button>
                    <div class="flex items-center space-x-2">
                        <img src="https://www.thoughtco.com/thmb/PJ2sFBaDHkbvJfTrxOoXd-BvkMo=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/passenger-airplane-landing-at-dusk-867657758-5c79c087c9e77c0001d19d1a.jpg" alt="User Avatar" class="w-10 h-10 rounded-full border-2 border-gray-500">
                        <form method="POST" action="/logout" class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-900/70 backdrop-blur-sm text-yellow-200"> 
                            @csrf
                            <button>
                            <!-- Icône logout -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10v1m0 4v2" />
                            </svg>
                            </button>
                        </form>
                        

                    </div>
                </div>
            </header>

            <!-- ==================== Début des Sections ==================== -->
            <!--  Suivi du vol  -->
            @include('components.Dashboard')

            <!--  gestion des aéroports -->
            @include('components.airport')

            <!-- gestion des Vols  -->
            @include('components.Flight')

            <!-- gestion des avions -->
            @include('components.plane')

            <!-- gestion des réservations -->
            @include('components.reservations')

            <!-- gestion des  utilisateurs -->
            @include('components.user')

            <!-- gestion des paiements -->
            @include('components.payments')

            <!-- gestion des statistiques -->
            @include('components.statistics')
            <!-- ====================  Fin des Sections  ==================== -->

            <!-- ====================  Début des modals  ==================== -->
            <!--  MODAL AÉROPORT  -->
            @include('modals.airport')

            <!-- Modal  Vol -->
            @include('modals.flight')

            <!--  MODAL AVION -->
            @include('modals.plane')
            <!-- ====================  Fin des modals   ==================== -->
        </main>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebarLinks = document.querySelectorAll('.sidebar-link');
            const contentSections = document.querySelectorAll('.content-section');
            const mainTitle = document.getElementById('main-title');

            //  Gestion de la navigation par section 
            sidebarLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();

                    // Gestion des ID plus robuste
                    let targetId = '';
                    let targetTitle = "Tableau de Bord"; // Default title

                    if (link.id.startsWith('nav-')) {
                        const sectionName = link.id.substring(4); //  'dashboard', 'flights', 'airports'
                        if (sectionName === 'live') {
                            targetId = 'dashboard-content'; // "Suivi en direct" pointe vers le dashboard
                        } else {
                            targetId = sectionName + '-content'; // 'flights-content', 'airports-content'
                        }
                    }

                    // Utilisation de textContent du span pour le titre
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
                        if (dashboardSection) {
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

            // Initialiser le dashboard au chargement
            const initialLink = document.querySelector('.sidebar-link.active');
            if (initialLink) {
                initialLink.click(); // Simuler un clic pour afficher la section initiale et définir le titre/graphiques
            } else { // Fallback si aucun lien n'est actif par défaut
                const dashboardLink = document.getElementById('nav-dashboard');
                if (dashboardLink) {
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
    <script>
        // Gestion du menu burger
        document.addEventListener('DOMContentLoaded', () => {
            const burgerMenu = document.querySelector('.burger-menu');
            const sidebar = document.querySelector('aside');
            const overlay = document.querySelector('.overlay');

            burgerMenu.addEventListener('click', () => {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            });

            overlay.addEventListener('click', () => {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });
        });
    </script>
</body>

</html>