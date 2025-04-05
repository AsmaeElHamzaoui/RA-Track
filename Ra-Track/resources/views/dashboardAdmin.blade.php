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

        

        

        

        


        

    </main>

    
</div>



</body>
</html>