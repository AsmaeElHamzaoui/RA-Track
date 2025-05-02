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
            min-height: 400px;
            border: 1px solid #4b5563;
            border-radius: 0.5rem;
            padding: 1rem;
            background-color: #1f2937;
            color: #d1d5db;
        }
        
        #maintenance-calendar-container .fc-daygrid-day-number,
        #maintenance-calendar-container .fc-col-header-cell-cushion {
            color: #e5e7eb;
        }
        
        #maintenance-calendar-container .fc-day-today {
             background-color: rgba(75, 85, 99, 0.5);
        }
        
        #maintenance-calendar-container .fc-event {
            background-color: #3b82f6;
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
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md flex flex-col">
            <!-- Logo/Marque -->
            <div class="p-6 border-b flex items-center space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-600">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l.471.471a1.402 1.402 0 0 1 1.982 0l3.018-3.018a1.402 1.402 0 0 1 0-1.982l-.471-.471M11.42 15.17 5.877 21m5.543-5.83L7.05 13.47l-2.54 2.541A2.652 2.652 0 0 0 2.988 21l2.889-.011m5.543-5.83.471.471a1.402 1.402 0 0 1 1.982 0l3.018-3.018a1.402 1.402 0 0 1 0-1.982l-.471-.471m0 0L13.47 7.05l2.54-2.541A2.652 2.652 0 0 0 21 2.988l-.011 2.889m-5.83 5.543-5.543 5.543" />
                </svg>
                <span class="text-xl font-bold text-gray-800">Maintenance Hub</span>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-2">
                <a href="#" id="nav-current-maintenance" class="sidebar-link flex items-center px-4 py-2 text-gray-700 rounded-md hover:bg-gray-100 active" data-target="current-maintenance-section">
                    <svg class="icon-inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                       <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l.471.471a1.402 1.402 0 0 1 1.982 0l3.018-3.018a1.402 1.402 0 0 1 0-1.982l-.471-.471M11.42 15.17 5.877 21m5.543-5.83L7.05 13.47l-2.54 2.541A2.652 2.652 0 0 0 2.988 21l2.889-.011m5.543-5.83.471.471a1.402 1.402 0 0 1 1.982 0l3.018-3.018a1.402 1.402 0 0 1 0-1.982l-.471-.471m0 0L13.47 7.05l2.54-2.541A2.652 2.652 0 0 0 21 2.988l-.011 2.889m-5.83 5.543-5.543 5.543" />
                     </svg>
                    Avions en Maintenance
                </a>
                <a href="#" id="nav-maintenance-planning" class="sidebar-link flex items-center px-4 py-2 text-gray-700 rounded-md hover:bg-gray-100" data-target="maintenance-planning-section">
                    <svg class="icon-inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    Planification Maintenance
                </a>
                <a href="#" id="nav-calendar-view" class="sidebar-link flex items-center px-4 py-2 text-gray-700 rounded-md hover:bg-gray-100" data-target="calendar-view-section">
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
            <header class="bg-white shadow-sm p-4 flex justify-between items-center">
                 <div>
                    <h1 id="main-header-title" class="text-xl font-semibold text-gray-700">Avions en Maintenance</h1>
                 </div>
                <div class="flex items-center space-x-4">
                    <button class="relative text-gray-600 hover:text-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                        </svg>
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full px-1.5 py-0.5">2</span>
                    </button>
                    <img src="https://via.placeholder.com/40/0ea5e9/ffffff?text=MA" alt="User Avatar" class="w-10 h-10 rounded-full border-2 border-blue-300">
                </div>
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
                                <tr><td colspan="4" class="text-center py-4 text-gray-500">Aucun avion en maintenance trouvé.</td></tr>
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Section 2: Planification de Maintenance -->
                <section id="maintenance-planning-section" class="content-section">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold text-gray-800">Planification des Maintenances</h2>
                        <button id="open-maintenance-modal-button" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
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
                                            <button class="text-indigo-600 hover:text-indigo-900 edit-maintenance-btn"
                                                    data-id="{{ $maintenance->id }}"
                                                    data-aircraft-id="{{ $maintenance->aircraft_id }}"
                                                    data-type="{{ $maintenance->maintenance_type }}"
                                                    data-start="{{ $maintenance->start_date }}"
                                                    data-end="{{ $maintenance->end_date }}">
                                                Modifier
                                            </button>
                                            <button class="text-red-600 hover:text-red-900 delete-maintenance-btn" data-id="{{ $maintenance->id }}">
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
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold text-gray-800">Vue Calendrier des Maintenances</h2>
                        <button id="open-maintenance-modal-button-from-calendar" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Ajouter Maintenance
                        </button>
                    </div>

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
                        if(targetId === 'calendar-view-section' && calendarInstance) {
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
                         today:    "Aujourd'hui",
                         month:    'Mois',
                         week:     'Semaine',
                         day:      'Jour',
                         list:     'Liste'
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

                        fillModalForm({ id: maintenanceId, aircraftId, type, start, end });

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
                     if(emptyRow) emptyRow.closest('tr').remove();
                 }
        }

        
        });
    </script>
</body>
</html>