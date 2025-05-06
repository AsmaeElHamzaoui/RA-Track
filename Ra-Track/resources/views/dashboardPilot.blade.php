<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PilotDash</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Heroicons CDN (for icons) -->
    <script type="module" src="https://cdn.jsdelivr.net/npm/heroicons@2.1.1/24/outline/esm/index.js"></script>
    <script nomodule src="https://cdn.jsdelivr.net/npm/heroicons@2.1.1/24/outline/cjs/index.js"></script>
    <style>
        /* Simple style for active sidebar link */
        .sidebar-link.active {
            background-color: #e0f2fe;
            /* light-blue-100 */
            color: #0284c7;
            /* sky-600 */
            font-weight: 600;
        }

        /* Ensure icons align with text */
        .icon-inline {
            display: inline-block;
            vertical-align: middle;
            width: 1.25em;
            /* Adjust size as needed */
            height: 1.25em;
            margin-right: 0.5em;
        }

        /* Styles pour la sidebar responsive */
        @media (max-width: 767px) {
            aside {
                position: fixed;
                top: 0;
                left: -100%;
                height: 100vh;
                z-index: 50;
                transition: left 0.3s ease;
            }

            aside.active {
                left: 0;
            }

            /* Overlay pour le fond sombre quand la sidebar est ouverte */
            .sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 40;
                display: none;
            }

            .sidebar-overlay.active {
                display: block;
            }
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md flex flex-col">
            <!-- Logo/Brand -->
            <div class="p-4 flex items-center space-x-3" style="background-color:#162238;">
                <img class="h-10 w-32" src="{{ asset('images/logo.png') }}" alt="">

            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-2" style="background-color:#162238;">
                <a href="#" id="nav-assigned-flights" class="sidebar-link flex items-center px-4 py-2 text-gray-700 rounded-md bg-gray-100 active" data-target="assigned-flights-section">
                    <svg class="icon-inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                    </svg>
                    Assigned Flights
                </a>
                <a href="#" id="nav-flight-reports" class="sidebar-link flex items-center px-4 py-2 text-gray-700 rounded-md bg-gray-100" data-target="flight-reports-section">
                    <svg class="icon-inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25Z" />
                    </svg>
                    Flight Reports
                </a>
            </nav>
        </aside>
        <div id="sidebar-overlay" class="sidebar-overlay"></div>
        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header Bar -->
            <header class="bg-gray-100 p-4 flex justify-between items-center">
                <div></div>
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
                    <button id="sidebar-toggle" class="md:hidden text-gray-600 hover:text-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>
            </header>

            <!-- Content Area -->
            <div class="flex-1 overflow-y-auto p-6">

                <!-- Assigned Flights Section -->
                <section id="assigned-flights-section" class="content-section">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6">Assigned Flights</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse ($flights as $flight)
                        <div class="bg-white p-6 rounded-lg shadow">
                            <div class="flex justify-between items-start mb-4">
                                <span class="font-semibold text-blue-600">Flight {{ $flight->flight_number }}</span>
                                <span class="text-xs font-medium px-2 py-1 rounded-full 
                                        @if($flight->status == 'scheduled') bg-blue-100 text-blue-700
                                        @elseif($flight->status == 'in_progress') bg-yellow-100 text-yellow-700
                                        @elseif($flight->status == 'completed') bg-green-100 text-green-700
                                        @elseif($flight->status == 'cancelled') bg-red-100 text-red-700
                                        @elseif($flight->status == 'delayed') bg-orange-100 text-orange-700
                                        @endif">
                                    {{ ucfirst(str_replace('_', ' ', $flight->status)) }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <div class="text-gray-500 text-sm">
                                        {{ $flight->departureAirport->name }} ({{ $flight->departureAirport->code }})
                                    </div>
                                    <div class="text-xl font-bold text-gray-800">
                                        {{ $flight->departure_time->format('H:i') }}
                                    </div>
                                </div>
                                <div class="flex items-center text-gray-400">
                                    <span class="border-t border-gray-300 flex-grow mx-2"></span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                    </svg>
                                    <span class="border-t border-gray-300 flex-grow mx-2"></span>
                                </div>
                                <div>
                                    <div class="text-gray-500 text-sm text-right">
                                        {{ $flight->arrivalAirport->name }} ({{ $flight->arrivalAirport->code }})
                                    </div>
                                    <div class="text-xl font-bold text-gray-800 text-right">
                                        {{ $flight->arrival_time->format('H:i') }}
                                    </div>
                                </div>
                            </div>
                            <div class="text-sm text-gray-600 space-y-1">
                                <div class="flex items-center">
                                    <svg class="icon-inline text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                    </svg>
                                    {{ $flight->departure_time->format('M d, Y') }}
                                </div>
                                <div class="flex items-center">
                                    <svg class="icon-inline text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    Duration: {{ $flight->arrival_time->diff($flight->departure_time)->format('%hh %im') }}
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-2">
                            <div class="bg-white p-6 rounded-lg shadow text-center">
                                <p class="text-gray-600">No assigned flights found.</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </section>

                <!-- Flight Reports Section -->
                <section id="flight-reports-section" class="content-section hidden">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold text-gray-900">Flight Reports</h2>
                        <button id="add-report-btn" class="font-bold py-2 px-4 rounded inline-flex items-center" style="color: #162238; border: 1px solid #FFD476;background: #FFD476;
                                    box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    5px 5px 15px rgba(0, 0, 0, 0.35),
                                    inset -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    inset 5px 5px 15px rgba(0, 0, 0, 0.35);">
                            <svg class="icon-inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Add Report
                        </button>
                    </div>

                    {{-- Dans la section "Flight Reports" --}}
                    <div class="bg-white shadow rounded-lg overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Flight</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Submitted</th>
                                    {{-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th> --}} {{-- Status n'est pas dans le modèle/migration --}}
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Report File</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comment</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="reports-table-body">
                                @forelse ($reports as $report)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{-- Assurez-vous que la relation 'flight' est chargée --}}
                                        {{ $report->flight->flight_number ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $report->created_at->format('M d, Y') }}
                                    </td>
                                    {{-- <td class="px-6 py-4 whitespace-nowrap">
                                          <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                                    </td> --}}
                                    <td class="px-6 py-4">
                                        <a href="/storage/{{ $report->report_path }}" target="_blank" class="text-blue-600 hover:text-blue-800">Voir PDF</a>
                                    </td>
                                    <td class="px-6 py-4">{{ $report->comment }}</td>
                                    <td class="px-6 py-4">
                                        <button class="edit-report-btn bg-yellow-500 text-white px-2 py-1 rounded"
                                            data-id="{{ $report->id }}"
                                            data-flight-id="{{ $report->flight_id }}"
                                            data-comment="{{ $report->comment }}"
                                            data-file-name="{{ basename($report->report_path) }}">
                                            Modifier
                                        </button>
                                        <button class="delete-report-btn bg-red-500 text-white px-2 py-1 rounded" data-id="{{ $report->id }}">Supprimer</button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        No flight reports submitted yet.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Affichage des messages de succès/erreur --}}

                    @if (session('success'))
                    <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                    @endif
                    @if (session('error'))
                    <div class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                    @endif
                    @if ($errors->any())
                    <div class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded relative" role="alert">
                        <strong class="font-bold">Oops!</strong>
                        <span class="block sm:inline">There were some problems with your input.</span>
                        <ul class="list-disc pl-5 mt-2">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </section>

            </div> <!-- End Content Area -->
        </main>
        <!-- End Main Content -->

    </div>

    <!-- Add Report Modal -->
    <div id="add-report-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="relative mx-auto p-6 border w-full max-w-md shadow-lg rounded-md bg-white">
            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <h3 class="text-lg font-medium text-gray-900" id="modal-title">Add Flight Report</h3>
                <button id="close-modal-btn" class="text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Modal flight-reports -->
            @include('modals.flight-reports')
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebarLinks = document.querySelectorAll('.sidebar-link');
            const contentSections = document.querySelectorAll('.content-section');
            const addReportBtn = document.getElementById('add-report-btn');
            const modal = document.getElementById('add-report-modal');
            const closeModalBtn = document.getElementById('close-modal-btn');
            const cancelModalBtn = document.getElementById('cancel-modal-btn');
            const addReportForm = document.getElementById('add-report-form');
            const flightSelect = document.getElementById('flight-select');
            const reportsTableBody = document.getElementById('reports-table-body');

            // --- Sidebar Navigation ---
            sidebarLinks.forEach(link => {
                link.addEventListener('click', (event) => {
                    event.preventDefault();

                    // Deactivate all links and hide all sections
                    sidebarLinks.forEach(l => l.classList.remove('active'));
                    contentSections.forEach(section => section.classList.add('hidden'));

                    // Activate clicked link and show target section
                    link.classList.add('active');
                    const targetId = link.getAttribute('data-target');
                    const targetSection = document.getElementById(targetId);
                    if (targetSection) {
                        targetSection.classList.remove('hidden');
                    }
                });
            });

            // --- Modal Control ---
            function openModal() {
                // Optional: Populate flight select dynamically if needed here
                // For now, using hardcoded options in HTML
                modal.classList.remove('hidden');
            }

            function closeModal() {
                modal.classList.add('hidden');
                addReportForm.reset(); // Clear form on close
            }

            if (addReportBtn) addReportBtn.addEventListener('click', openModal);
            if (closeModalBtn) closeModalBtn.addEventListener('click', closeModal);
            if (cancelModalBtn) cancelModalBtn.addEventListener('click', closeModal);

            // Close modal if clicking outside the modal content
            modal.addEventListener('click', (event) => {
                if (event.target === modal) {
                    closeModal();
                }
            });

            // --- Initial State ---
            // Ensure the default active link and section are shown
            document.getElementById('nav-assigned-flights').click(); // Simulate click on initial load

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Éléments existants...

            // Nouveaux éléments pour la sidebar responsive
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebar = document.querySelector('aside');
            const sidebarOverlay = document.getElementById('sidebar-overlay');

            // Fonction pour basculer la sidebar
            function toggleSidebar() {
                sidebar.classList.toggle('active');
                sidebarOverlay.classList.toggle('active');
            }

            // Événements
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', toggleSidebar);
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', toggleSidebar);
            }

            // Fermer la sidebar quand un lien est cliqué (sur mobile)
            sidebarLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 768) {
                        toggleSidebar();
                    }
                });
            });

            // Le reste de votre code JavaScript existant...
        });
    </script>
</body>

</html>