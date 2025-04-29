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
            background-color: #e0f2fe; /* light-blue-100 */
            color: #0284c7; /* sky-600 */
            font-weight: 600;
        }
        /* Ensure icons align with text */
        .icon-inline {
            display: inline-block;
            vertical-align: middle;
            width: 1.25em; /* Adjust size as needed */
            height: 1.25em;
            margin-right: 0.5em;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md flex flex-col">
            <!-- Logo/Brand -->
            <div class="p-6 border-b flex items-center space-x-3">
                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                  </svg>
                <span class="text-xl font-bold text-gray-800">PilotDash</span>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-2">
                <a href="#" id="nav-assigned-flights" class="sidebar-link flex items-center px-4 py-2 text-gray-700 rounded-md hover:bg-gray-100 active" data-target="assigned-flights-section">
                    <svg class="icon-inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" /></svg>
                    Assigned Flights
                </a>
                <a href="#" id="nav-flight-reports" class="sidebar-link flex items-center px-4 py-2 text-gray-700 rounded-md hover:bg-gray-100" data-target="flight-reports-section">
                     <svg class="icon-inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25Z" /></svg>
                    Flight Reports
                </a>
            </nav>

            <!-- Footer (Optional) -->
            <div class="p-4 border-t">
                {/* <!-- Can add user info or logout here --> */}
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header Bar -->
            <header class="bg-white shadow-sm p-4 flex justify-between items-center">
                <div>
                    {/* <!-- Placeholder for potential breadcrumbs or search --> */}
                </div>
                <div class="flex items-center space-x-4">
                    <button class="relative text-gray-600 hover:text-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                        </svg>
                         <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full px-1.5 py-0.5">3</span>
                    </button>
                    <img src="https://via.placeholder.com/40" alt="User Avatar" class="w-10 h-10 rounded-full border-2 border-blue-300">
                </div>
            </header>

            <!-- Content Area -->
            <div class="flex-1 overflow-y-auto p-6">

                <!-- Assigned Flights Section -->
                <section id="assigned-flights-section" class="content-section">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Assigned Flights</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Flight Card 1 -->
                        <div class="bg-white p-6 rounded-lg shadow">
                            <div class="flex justify-between items-start mb-4">
                                <span class="font-semibold text-blue-600">Flight AF1234</span>
                                <span class="text-xs font-medium bg-green-100 text-green-700 px-2 py-1 rounded-full">Upcoming</span>
                            </div>
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <div class="text-gray-500 text-sm">Paris (CDG)</div>
                                    <div class="text-xl font-bold text-gray-800">09:00</div>
                                </div>
                                <div class="flex items-center text-gray-400">
                                    <span class="border-t border-gray-300 flex-grow mx-2"></span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                    </svg>
                                    <span class="border-t border-gray-300 flex-grow mx-2"></span>
                                </div>
                                <div>
                                    <div class="text-gray-500 text-sm text-right">New York (JFK)</div>
                                    <div class="text-xl font-bold text-gray-800 text-right">15:30</div>
                                </div>
                            </div>
                            <div class="text-sm text-gray-600 space-y-1">
                                <div class="flex items-center">
                                    <svg class="icon-inline text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" /></svg>
                                    April 28, 2025
                                </div>
                                <div class="flex items-center">
                                    <svg class="icon-inline text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                                    Duration: 8h 30m
                                </div>
                            </div>
                        </div>

                        <!-- Flight Card 2 -->
                         <div class="bg-white p-6 rounded-lg shadow">
                            <div class="flex justify-between items-start mb-4">
                                <span class="font-semibold text-blue-600">Flight AF5678</span>
                                <span class="text-xs font-medium bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full">Tomorrow</span>
                            </div>
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <div class="text-gray-500 text-sm">London (LHR)</div>
                                    <div class="text-xl font-bold text-gray-800">14:00</div>
                                </div>
                                 <div class="flex items-center text-gray-400">
                                    <span class="border-t border-gray-300 flex-grow mx-2"></span>
                                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                    </svg>
                                    <span class="border-t border-gray-300 flex-grow mx-2"></span>
                                </div>
                                <div>
                                    <div class="text-gray-500 text-sm text-right">Dubai (DXB)</div>
                                    <div class="text-xl font-bold text-gray-800 text-right">00:30</div>
                                </div>
                            </div>
                            <div class="text-sm text-gray-600 space-y-1">
                                <div class="flex items-center">
                                    <svg class="icon-inline text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" /></svg>
                                    April 29, 2025
                                </div>
                                <div class="flex items-center">
                                    <svg class="icon-inline text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                                    Duration: 6h 30m
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Flight Reports Section -->
                <section id="flight-reports-section" class="content-section hidden">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold text-gray-800">Flight Reports</h2>
                        <button id="add-report-btn" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                            <svg class="icon-inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                            Add Report
                        </button>
                    </div>

                    <div class="bg-white shadow rounded-lg overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Flight</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Report</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="reports-table-body">
                                <!-- Example Row (Add more dynamically or from backend) -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">AF1234</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Apr 25, 2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <a href="#" class="text-blue-600 hover:text-blue-800 inline-flex items-center">
                                            <svg class="icon-inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                                            Report.pdf
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900 inline-flex items-center">
                                             <svg class="icon-inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639l4.443-7.447A1 1 0 0 1 7.28 4.006h9.44a1 1 0 0 1 .798.43l4.442 7.447a1.012 1.012 0 0 1 0 .638l-4.443 7.447A1 1 0 0 1 16.72 20H7.28a1 1 0 0 1-.798-.43L2.036 12.322Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                                            View
                                        </a>
                                    </td>
                                </tr>
                                <!-- More rows -->
                            </tbody>
                        </table>
                    </div>
                </section>

            </div> <!-- End Content Area -->
        </main> <!-- End Main Content -->

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



</body>
</html>