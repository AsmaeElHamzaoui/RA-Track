<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Maintenance Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>

    <style>
        .sidebar-link.active {
            background-color: #e0f2fe;
            color: #0284c7;
            font-weight: 600;
        }

        .icon-inline {
            display: inline-block;
            vertical-align: middle;
            width: 1.25em;
            height: 1.25em;
            margin-right: 0.5em;
        }

        #maintenance-calendar-container {
            max-height: 400px;
            border: 1px solid #4b5563;
            border-radius: 0.5rem;
            padding: 0.7rem;
            background-color: rgb(93, 103, 117);
            color: #d1d5db;
        }

        #maintenance-calendar-container .fc-daygrid-day-number,
        #maintenance-calendar-container .fc-col-header-cell-cushion {
            color: #e5e7eb;
        }

        #maintenance-calendar-container .fc-day-today {
            background-color: rgb(114, 132, 158);
        }

        #maintenance-calendar-container .fc-event {
            background-color: rgb(197, 198, 198);
            border-color: #2563eb;
        }

        .modal {
            transition: opacity 0.25s ease;
        }

        body.modal-active {
            overflow-x: hidden;
            overflow-y: hidden;
        }

        .content-section {
            display: none;
        }

        .content-section.active {
            display: block;
        }

        /* Styles pour la responsivité */
        @media (max-width: 767px) {
            .sidebar {
                position: fixed;
                left: -100%;
                top: 0;
                bottom: 0;
                z-index: 40;
                transition: left 0.3s ease;
            }

            .sidebar.active {
                left: 0;
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(189, 26, 26, 0.5);
                z-index: 30;
            }

            .sidebar-overlay.active {
                display: block;
            }

            .content-section table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }

        /* Pour les écrans plus larges */
        @media (min-width: 768px) {
            .sidebar {
                position: relative;
                left: 0;
            }

            #mobile-menu-button,
            .sidebar-overlay {
                display: none;
            }
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <!-- Overlay pour mobile (ajoutez-le juste après le début du body) -->
    <div class="sidebar-overlay"></div>
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="sidebar w-64 shadow-md flex flex-col" style="background-color:#162238;">
            <!-- Logo/Marque -->
            <div class="p-6 flex items-center space-x-3">
                <img class="h-10 w-32" src="{{ asset('images/logo.png') }}" alt="">
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-2">
                <a href="#" id="nav-current-maintenance" class="sidebar-link bg-white flex items-center px-4 py-2 text-gray-700 rounded-md hover:bg-gray-100 active" data-target="current-maintenance-section">
                    <svg class="icon-inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l.471.471a1.402 1.402 0 0 1 1.982 0l3.018-3.018a1.402 1.402 0 0 1 0-1.982l-.471-.471M11.42 15.17 5.877 21m5.543-5.83L7.05 13.47l-2.54 2.541A2.652 2.652 0 0 0 2.988 21l2.889-.011m5.543-5.83.471.471a1.402 1.402 0 0 1 1.982 0l3.018-3.018a1.402 1.402 0 0 1 0-1.982l-.471-.471m0 0L13.47 7.05l2.54-2.541A2.652 2.652 0 0 0 21 2.988l-.011 2.889m-5.83 5.543-5.543 5.543" />
                    </svg>
                    en Maintenance
                </a>
                <a href="#" id="nav-maintenance-planning" class="sidebar-link bg-white flex items-center px-4 py-2 text-gray-700 rounded-md hover:bg-gray-100" data-target="maintenance-planning-section">
                    <svg class="icon-inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    Planification
                </a>
                <a href="#" id="nav-calendar-view" class="sidebar-link bg-white flex items-center px-4 py-2 text-gray-700 rounded-md hover:bg-gray-100" data-target="calendar-view-section">
                    <svg class="icon-inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                    Vue Calendrier
                </a>
            </nav>
        </aside>

        <!-- Contenu Principal -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <!-- Barre d'En-tête Supérieure -->
            <header class="p-4 flex justify-between items-center">
                <div>
                    <h1 id="main-header-title" class="text-xl font-semibold text-gray-700">Avions en Maintenance</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="relative p-2 rounded-full bg-slate-900/70 backdrop-blur-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.017 5.454 1.31M5.25 17.082l4.125 4.125M18.75 17.082l-4.125 4.125M12 21a.75.75 0 0 1-.75-.75V18a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-.75.75H12Z" />
                        </svg>
                        <span class="absolute top-1 right-1 block h-3 w-3 rounded-full bg-yellow-200 ring-2 ring-yellow-700">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-yellow-200 opacity-75"></span>
                        </span>
                    </button>
                    <img src="https://www.thoughtco.com/thmb/PJ2sFBaDHkbvJfTrxOoXd-BvkMo=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/passenger-airplane-landing-at-dusk-867657758-5c79c087c9e77c0001d19d1a.jpg" alt="User Avatar" class="w-10 h-10 rounded-full border-2 border-blue-300">
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
                <button id="mobile-menu-button" class="md:hidden text-gray-600 hover:text-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </header>

            <!-- Zone de Contenu -->
            <div class="flex-1 overflow-y-auto p-6 space-y-8">

                <!-- Section 1: Avions en Maintenance -->
                <section id="current-maintenance-section" class="content-section active">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Avions Actuellement en Maintenance</h2>
                    <div class="bg-white shadow rounded-lg overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avion (N° Immat.)</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Modèle</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Début Maintenance</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @isset($planes)
                                @foreach($planes as $plane)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $plane->registration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $plane->model }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $plane->maintenances?->first()?->start_date?->format('d/m/Y') ?? $plane->updated_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $plane->status === 'En maintenance' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                            {{ $plane->status }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-gray-500">Aucun avion en maintenance trouvé.</td>
                                </tr>
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Section 2: Planification de Maintenance -->
                <section id="maintenance-planning-section" class="content-section">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold text-gray-800">Planification des Maintenances</h2>
                        <button id="open-maintenance-modal-button" class="font-bold py-2 px-4 rounded inline-flex items-center" style="color: #162238; border: 1px solid #FFD476;background: #FFD476;
                                    box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    5px 5px 15px rgba(0, 0, 0, 0.35),
                                    inset -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    inset 5px 5px 15px rgba(0, 0, 0, 0.35);">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Ajouter Maintenance
                        </button>
                    </div>

                    <!-- Liste des Maintenances -->
                    <div class="bg-white shadow rounded-lg overflow-x-auto">
                        <h3 class="text-lg font-medium text-gray-900 p-4 border-b">Maintenances Planifiées</h3>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avion</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Début</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fin Prévue</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="maintenance-list-body">
                                @isset($maintenances)
                                @forelse($maintenances as $maintenance)
                                <tr id="maintenance-row-{{ $maintenance->id }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $maintenance->aircraft->registration ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $maintenance->maintenance_type }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($maintenance->start_date)->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($maintenance->end_date)->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <button class="text-gary-900 hover:text-yellow-400 edit-maintenance-btn"
                                            data-id="{{ $maintenance->id }}"
                                            data-aircraft-id="{{ $maintenance->aircraft_id }}"
                                            data-type="{{ $maintenance->maintenance_type }}"
                                            data-start="{{ $maintenance->start_date }}"
                                            data-end="{{ $maintenance->end_date }}">
                                            Modifier
                                        </button>
                                        <button class="text-gray-900 hover:text-yellow-400 delete-maintenance-btn" data-id="{{ $maintenance->id }}">
                                            Supprimer
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-gray-500">Aucune maintenance planifiée trouvée.</td>
                                </tr>
                                @endforelse
                                @else
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-gray-500">Variable $maintenances non définie.</td>
                                </tr>
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Section 3: Vue Calendrier -->
                <section id="calendar-view-section" class="content-section">
                    <!-- Calendrier -->
                    <div id="maintenance-calendar-container">
                        <!-- Le calendrier FullCalendar sera injecté ici par JavaScript -->
                    </div>
                </section>

            </div>
        </main>
    </div>

    <!-- modal pour ajouter une maintenance -->
    @include('modals.maintenance')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebarLinks = document.querySelectorAll('.sidebar-link');
            const contentSections = document.querySelectorAll('.content-section');
            const mainHeaderTitle = document.getElementById('main-header-title');

            // --- Navigation Sidebar ---
            sidebarLinks.forEach(link => {
                link.addEventListener('click', (event) => {
                    event.preventDefault();

                    sidebarLinks.forEach(l => l.classList.remove('active'));
                    contentSections.forEach(section => section.classList.remove('active'));

                    link.classList.add('active');
                    const targetId = link.getAttribute('data-target');
                    const targetSection = document.getElementById(targetId);
                    if (targetSection) {
                        targetSection.classList.add('active');

                        // Si on active la section calendrier, initialiser/rafraichir le calendrier
                        if (targetId === 'calendar-view-section' && calendarInstance) {
                            calendarInstance.render();
                        }
                    }

                    if (mainHeaderTitle) {
                        mainHeaderTitle.textContent = link.textContent.trim();
                    }
                });
            });

            // --- Initialisation FullCalendar ---
            const calendarEl = document.getElementById('maintenance-calendar-container');
            let calendarInstance = null;
            if (calendarEl) {
                const maintenanceEvents = (@json($maintenances ?? [])).map(maint => ({
                    id: maint.id,
                    title: `${maint.aircraft?.registration ?? 'Avion?'} - ${maint.maintenance_type}`,
                    start: maint.start_date,
                    end: maint.end_date ? new Date(new Date(maint.end_date).setDate(new Date(maint.end_date).getDate() + 1)).toISOString().split('T')[0] : null,
                    extendedProps: {
                        aircraft: maint.aircraft?.registration ?? 'N/A',
                        type: maint.maintenance_type
                    }
                }));

                calendarInstance = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: 'fr',
                    buttonText: {
                        today: "Aujourd'hui",
                        month: 'Mois',
                        week: 'Semaine',
                        day: 'Jour',
                        list: 'Liste'
                    },
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,listWeek'
                    },
                    events: maintenanceEvents,
                    editable: false,
                    eventClick: function(info) {
                        openModalForEdit(info.event.id);
                    }
                });
                calendarInstance.render();
            } else {
                console.error("Élément #maintenance-calendar-container non trouvé.");
            }

            // --- Gestion du Modal de Maintenance ---
            const modal = document.getElementById('maintenance-modal');
            const openModalButton = document.getElementById('open-maintenance-modal-button');
            const openModalButtonFromCalendar = document.getElementById('open-maintenance-modal-button-from-calendar');
            const closeModalButton = document.getElementById('close-maintenance-modal-button');
            const cancelModalButton = document.getElementById('cancel-modal-button');
            const modalOverlay = modal.querySelector('.modal-overlay');
            const modalForm = document.getElementById('maintenance-form');
            const modalTitle = document.getElementById('modal-title');
            const modalMethodInput = document.getElementById('modal-form-method');
            const maintenanceIdInput = document.getElementById('maintenance-id');
            const submitButton = document.getElementById('submit-modal-button');

            const openModal = () => {
                modal.classList.remove('opacity-0', 'pointer-events-none');
                modal.classList.add('opacity-100');
                modal.querySelector('.relative').classList.remove('scale-95');
                modal.querySelector('.relative').classList.add('scale-100');
                document.body.classList.add('modal-active');
            };

            const closeModal = () => {
                modal.querySelector('.relative').classList.add('scale-95');
                modal.querySelector('.relative').classList.remove('scale-100');
                modal.classList.add('opacity-0');
                modal.classList.remove('opacity-100');
                setTimeout(() => {
                    modal.classList.add('pointer-events-none');
                    document.body.classList.remove('modal-active');
                    resetModalForm();
                }, 300);
            };

            const resetModalForm = () => {
                modalForm.reset();
                modalTitle.textContent = "Ajouter une Maintenance";
                modalMethodInput.value = "POST";
                maintenanceIdInput.value = "";
                modalForm.action = "{{ route('maintenances.store') }}";
                submitButton.textContent = "Enregistrer";
            };

            const fillModalForm = (data) => {
                document.getElementById('modal-aircraft-select').value = data.aircraftId;
                document.getElementById('modal-maintenance-type').value = data.type;
                document.getElementById('modal-start-date').value = data.start.split('T')[0];
                document.getElementById('modal-end-date').value = data.end.split('T')[0];
                maintenanceIdInput.value = data.id;
            };

            if (openModalButton) {
                openModalButton.addEventListener('click', () => {
                    resetModalForm();
                    openModal();
                });
            }

            if (openModalButtonFromCalendar) {
                openModalButtonFromCalendar.addEventListener('click', () => {
                    resetModalForm();
                    openModal();
                });
            }

            if (closeModalButton) closeModalButton.addEventListener('click', closeModal);
            if (cancelModalButton) cancelModalButton.addEventListener('click', closeModal);
            if (modalOverlay) modalOverlay.addEventListener('click', closeModal);

            // --- Gestion des boutons Modifier/Supprimer dans la liste ---
            const maintenanceListBody = document.getElementById('maintenance-list-body');

            if (maintenanceListBody) {
                maintenanceListBody.addEventListener('click', async (event) => {
                    const target = event.target;

                    if (target.classList.contains('edit-maintenance-btn')) {
                        const maintenanceId = target.dataset.id;
                        const aircraftId = target.dataset.aircraftId;
                        const type = target.dataset.type;
                        const start = target.dataset.start;
                        const end = target.dataset.end;

                        resetModalForm();
                        modalTitle.textContent = "Modifier la Maintenance";
                        modalMethodInput.value = "PUT";
                        modalForm.action = `/maintenances/${maintenanceId}`;
                        submitButton.textContent = "Mettre à jour";

                        fillModalForm({
                            id: maintenanceId,
                            aircraftId,
                            type,
                            start,
                            end
                        });

                        openModal();
                    }

                    if (target.classList.contains('delete-maintenance-btn')) {
                        const maintenanceId = target.dataset.id;

                        if (confirm('Êtes-vous sûr de vouloir supprimer cette maintenance ?')) {
                            try {
                                const response = await fetch(`/maintenances/${maintenanceId}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                        'Accept': 'application/json'
                                    }
                                });

                                if (response.ok) {
                                    const rowToRemove = document.getElementById(`maintenance-row-${maintenanceId}`);
                                    if (rowToRemove) {
                                        rowToRemove.remove();
                                    }
                                    if (calendarInstance) {
                                        const eventToRemove = calendarInstance.getEventById(maintenanceId);
                                        if (eventToRemove) {
                                            eventToRemove.remove();
                                        }
                                    }
                                } else {
                                    const errorData = await response.json().catch(() => ({}));
                                    alert(`Erreur lors de la suppression: ${errorData.message || response.statusText}`);
                                }
                            } catch (error) {
                                console.error('Erreur réseau ou autre:', error);
                                alert('Une erreur est survenue lors de la tentative de suppression.');
                            }
                        }
                    }
                });
            }

            if (modalForm) {
                modalForm.addEventListener('submit', async (event) => {
                    event.preventDefault();

                    const formData = new FormData(modalForm);
                    const url = modalForm.action;
                    const method = modalMethodInput.value === 'PUT' ? 'POST' : modalMethodInput.value;
                    const isUpdating = modalMethodInput.value === 'PUT';

                    if (isUpdating) {
                        formData.append('_method', 'PUT');
                    }

                    try {
                        const response = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json',
                            },
                            body: formData
                        });

                        if (response.ok) {
                            const result = await response.json();
                            console.log('Succès:', result);

                            closeModal();
                            updateMaintenanceTableRow(result.maintenance, isUpdating);
                            updateCalendarEvent(result.maintenance, isUpdating);

                        } else {
                            const errorData = await response.json();
                            console.error('Erreur:', errorData);
                            alert(`Erreur: ${errorData.message || 'Vérifiez les champs du formulaire.'}`);
                        }
                    } catch (error) {
                        console.error('Erreur réseau ou autre:', error);
                        alert('Une erreur est survenue.');
                    }
                });
            }

            function updateMaintenanceTableRow(maintenance, isUpdating) {
                const tableBody = document.getElementById('maintenance-list-body');
                const existingRow = document.getElementById(`maintenance-row-${maintenance.id}`);
                const formattedStartDate = new Date(maintenance.start_date).toLocaleDateString('fr-FR');
                const formattedEndDate = new Date(maintenance.end_date).toLocaleDateString('fr-FR');

                const newRowHtml = `
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${maintenance.aircraft?.registration ?? 'N/A'}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${maintenance.maintenance_type}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${formattedStartDate}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${formattedEndDate}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <button class="text-indigo-600 hover:text-indigo-900 edit-maintenance-btn"
                                data-id="${maintenance.id}"
                                data-aircraft-id="${maintenance.aircraft_id}"
                                data-type="${maintenance.maintenance_type}"
                                data-start="${maintenance.start_date}"
                                data-end="${maintenance.end_date}">
                            Modifier
                        </button>
                        <button class="text-red-600 hover:text-red-900 delete-maintenance-btn" data-id="${maintenance.id}">
                            Supprimer
                        </button>
                    </td>
                 `;

                if (isUpdating && existingRow) {
                    existingRow.innerHTML = newRowHtml;
                } else if (!isUpdating) {
                    const newRow = tableBody.insertRow(0);
                    newRow.id = `maintenance-row-${maintenance.id}`;
                    newRow.innerHTML = newRowHtml;
                    const emptyRow = tableBody.querySelector('td[colspan="5"]');
                    if (emptyRow) emptyRow.closest('tr').remove();
                }
            }

            function updateCalendarEvent(maintenance, isUpdating) {
                if (!calendarInstance) return;

                const eventData = {
                    id: maintenance.id,
                    title: `${maintenance.aircraft?.registration ?? 'Avion?'} - ${maintenance.maintenance_type}`,
                    start: maintenance.start_date,
                    end: maintenance.end_date ? new Date(new Date(maintenance.end_date).setDate(new Date(maintenance.end_date).getDate() + 1)).toISOString().split('T')[0] : null,
                    extendedProps: {
                        aircraft: maintenance.aircraft?.registration ?? 'N/A',
                        type: maintenance.maintenance_type
                    }
                };

                const existingEvent = calendarInstance.getEventById(maintenance.id);

                if (isUpdating && existingEvent) {
                    existingEvent.setProp('title', eventData.title);
                    existingEvent.setStart(eventData.start);
                    existingEvent.setEnd(eventData.end);
                    existingEvent.setExtendedProp('aircraft', eventData.extendedProps.aircraft);
                    existingEvent.setExtendedProp('type', eventData.extendedProps.type);
                } else if (!isUpdating) {
                    calendarInstance.addEvent(eventData);
                }
            }

            function displayFormErrors(errors) {
                console.warn("Erreurs de validation:", errors);
            }

            function openModalForEdit(maintenanceId) {
                const editButton = document.querySelector(`.edit-maintenance-btn[data-id="${maintenanceId}"]`);
                if (editButton) {
                    editButton.click();
                } else {
                    console.warn(`Bouton Modifier pour l'ID ${maintenanceId} non trouvé dans la table.`);
                }
            }


            // Gestion du menu burger
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const sidebar = document.querySelector('.sidebar');
            const sidebarOverlay = document.querySelector('.sidebar-overlay');

            if (mobileMenuButton && sidebar && sidebarOverlay) {
                mobileMenuButton.addEventListener('click', () => {
                    sidebar.classList.toggle('active');
                    sidebarOverlay.classList.toggle('active');
                });

                sidebarOverlay.addEventListener('click', () => {
                    sidebar.classList.remove('active');
                    sidebarOverlay.classList.remove('active');
                });
            }

            // Fermer le sidebar quand un lien est cliqué (sur mobile)
            sidebarLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 768) {
                        sidebar.classList.remove('active');
                        sidebarOverlay.classList.remove('active');
                    }
                });
            });
        });
    </script>
</body>

</html>