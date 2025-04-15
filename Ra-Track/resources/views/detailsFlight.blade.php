<!DOCTYPE html>
<html lang="fr"> {{-- Changé lang="en" en lang="fr" pour correspondre au contenu --}}
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Utiliser le titre dynamique si possible, sinon un titre générique --}}
    <title>AirBooking - Détails du Vol {{ $flight->flight_number }}</title>
    <!-- Link to your compiled Tailwind CSS file (IMPORTANT: Assurez-vous que ce chemin est correct) -->
    {{-- <link href="/path/to/your/tailwind.css" rel="stylesheet"> --}}
    {{-- Ou utilisez le CDN pour des tests rapides --}}
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <style>
        /* Optional: Add custom base styles if needed */
        body {
            /* Apply a default sans-serif font if Tailwind doesn't */
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }
        /* Ajout pour styliser la ligne de durée personnalisée */
        .duration-line::before,
        .duration-line::after {
            content: '';
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 0.5rem; /* 8px */
            height: 0.5rem; /* 8px */
            border-radius: 9999px; /* rounded-full */
            background-color: currentColor; /* Inherits text color, set below */
        }
        .duration-line::before { left: 0; }
        .duration-line::after { right: 0; }
    </style>
</head>
<body class="bg-slate-900 text-gray-200 p-6 md:p-10">

    <div class="max-w-6xl mx-auto">

        <!-- Header Navigation (Optionnel, basé sur le style du fichier 1) -->
        <nav class="flex justify-between items-center mb-8">
            <div class="text-2xl font-bold flex items-center text-white">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 mr-2 text-yellow-500 transform -rotate-45">
                  <path d="M12.378 1.602a.75.75 0 0 0-.756 0L3 6.632l9 5.25 9-5.25-8.622-5.03ZM21.75 7.93l-9 5.25v9l8.628-5.032a.75.75 0 0 0 .372-.648V7.93ZM11.25 22.18v-9l-9-5.25v8.57a.75.75 0 0 0 .372.648l8.628 5.03ZM11.25 13.18l-9-5.25L3 6.632l9 5.25 9-5.25 1.125 1.298-9 5.25Z" />
                </svg>
                AirBooking {{-- Ou le nom de votre application --}}
            </div>
            {{-- Vous pouvez ajouter les liens de navigation ici si nécessaire --}}
            {{-- <ul class="hidden md:flex space-x-8 text-sm font-medium text-gray-300"> ... </ul> --}}
        </nav>

        {{-- Titre principal de la page --}}
        <h1 class="text-3xl font-bold mb-6 text-white text-center md:text-left">Détails du Vol {{ $flight->flight_number }}</h1>

        {{-- Carte principale contenant les détails du vol --}}
        <div class="bg-slate-800 rounded-lg shadow-lg p-6 text-gray-200">

            {{-- Section Informations Générales --}}
            <h2 class="text-xl font-semibold mb-4 border-b border-slate-700 pb-2 text-white flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-gray-400"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" /></svg>
                Informations Générales
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-3 mb-6 text-sm">
                 <div class="flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400 transform -rotate-45 flex-shrink-0">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                    </svg>
                    <span class="text-gray-400 font-medium w-28">Numéro de Vol:</span>
                    <span class="text-gray-100">{{ $flight->flight_number }}</span>
                 </div>
                 <div class="flex items-center space-x-3">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400 flex-shrink-0">
                       <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                     </svg>
                    <span class="text-gray-400 font-medium w-28">Statut:</span>
                    <span class="font-medium {{ $flight->status === 'completed' ? 'text-green-500' : ($flight->status === 'cancelled' || $flight->status === 'delayed' ? 'text-red-400' : 'text-blue-400') }}">{{ ucfirst($flight->status) }}</span>
                 </div>
                 <div class="flex items-center space-x-3">
                     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-gray-400 flex-shrink-0">
                       <path d="M4.5 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM14.25 8.625a3.375 3.375 0 1 1 6.75 0 3.375 3.375 0 0 1-6.75 0ZM1.5 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.12v-.003ZM12.375 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.12v-.003Z" />
                     </svg> {{-- Icône générique pour compagnie/avion --}}
                     <span class="text-gray-400 font-medium w-28">Compagnie:</span>
                    <span class="text-gray-100">{{ $flight->plane->airline->name ?? ($flight->plane->airline_name ?? 'Non spécifié') }}</span>
                 </div>
                 <div class="flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-gray-400 flex-shrink-0 transform -rotate-45">
                      <path d="M3.478 2.404a.75.75 0 0 0-.926.941l2.432 7.905H13.5a.75.75 0 0 1 0 1.5H4.984l-2.432 7.905a.75.75 0 0 0 .926.94 60.519 60.519 0 0 0 18.445-8.986.75.75 0 0 0 0-1.218A60.517 60.517 0 0 0 3.478 2.404Z" />
                    </svg>
                    <span class="text-gray-400 font-medium w-28">Avion:</span>
                    <span class="text-gray-100">{{ $flight->plane->model ?? 'Non spécifié' }} (ID: {{ $flight->plane_id }})</span>
                 </div>
            </div>

            {{-- Section Trajet et Horaires --}}
            <h2 class="text-xl font-semibold mb-4 border-b border-slate-700 pb-2 text-white flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-gray-400"> <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /> </svg>
                Trajet et Horaires
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 items-center">
                {{-- Départ --}}
                <div class="text-center md:text-left">
                    <p class="font-semibold text-lg text-white mb-1">Départ</p>
                    <p class="text-gray-300 text-sm">{{ $flight->departureAirport->name ?? 'N/A' }} (<strong class="font-medium">{{ $flight->departureAirport->code ?? 'N/A' }}</strong>)</p>
                    <p class="text-gray-400 text-xs">Ville : {{ $flight->departureAirport->city ?? 'N/A' }}</p>
                    <p class="text-gray-300 text-sm mt-2">
                        <span class="font-medium">{{ \Carbon\Carbon::parse($flight->departure_time)->format('d/m/Y') }}</span>
                        à <span class="font-medium">{{ \Carbon\Carbon::parse($flight->departure_time)->format('H:i') }}</span>
                    </p>
                </div>
                {{-- Durée --}}
                <div class="text-center self-center px-4">
                     <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Durée du vol</p>
                     <p class="text-xl font-bold text-yellow-500 mb-2">{{ \Carbon\Carbon::parse($flight->departure_time)->diff(\Carbon\Carbon::parse($flight->arrival_time))->format('%hh %im') }}</p>
                     <div class="w-full h-px bg-slate-600 my-1 relative duration-line text-yellow-500">
                         {{-- Les points sont ajoutés via CSS (:before, :after) --}}
                     </div>
                     <p class="text-xs text-gray-400 mt-1">(Vol Direct)</p> {{-- Ou logique pour afficher 'Escale' si applicable --}}
                </div>
                 {{-- Arrivée --}}
                <div class="text-center md:text-right">
                    <p class="font-semibold text-lg text-white mb-1">Arrivée</p>
                    <p class="text-gray-300 text-sm">{{ $flight->arrivalAirport->name ?? 'N/A' }} (<strong class="font-medium">{{ $flight->arrivalAirport->code ?? 'N/A' }}</strong>)</p>
                    <p class="text-gray-400 text-xs">Ville : {{ $flight->arrivalAirport->city ?? 'N/A' }}</p>
                     <p class="text-gray-300 text-sm mt-2">
                        <span class="font-medium">{{ \Carbon\Carbon::parse($flight->arrival_time)->format('d/m/Y') }}</span>
                        à <span class="font-medium">{{ \Carbon\Carbon::parse($flight->arrival_time)->format('H:i') }}</span>
                    </p>
                </div>
            </div>

             {{-- Section Tarifs par Classe --}}
            <h2 class="text-xl font-semibold mb-4 border-b border-slate-700 pb-2 text-white flex items-center">
                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-gray-400"> <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" /> </svg>
                Tarifs par Classe (indicatif)
            </h2>
            {{-- Affichage similaire aux cartes de prix, mais plus simple --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 text-center">
                <div class="bg-slate-700 p-4 rounded-lg">
                    <p class="text-sm font-medium text-gray-300">Économique</p>
                    <p class="text-xl font-bold text-yellow-500 mt-1">{{ number_format($flight->economy_class_price, 2, ',', ' ') }} €</p>
                    <p class="text-sm text-gray-400">Basic comfort</p>
                    <br>
                    <ul class="space-y-2 text-sm text-gray-300 mb-6 flex-grow">
                       <li class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-2 text-green-500"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" /></svg>Standard seat</li>
                       <li class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-2 text-green-500"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" /></svg>1 hand baggage</li>
                       <li class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-2 text-green-500"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" /></svg>Meal included</li>
                    </ul>
                </div>
                 <div class="bg-slate-700 p-4 rounded-lg">
                    <p class="text-sm font-medium text-gray-300">Affaires</p>
                    <p class="text-xl font-bold text-yellow-500 mt-1">{{ number_format($flight->business_class_price, 2, ',', ' ') }} €</p>
                    <p class="text-sm text-gray-400">Premium comfort</p>
                    <br>
                    <ul class="space-y-2 text-sm text-gray-300 mb-6 flex-grow">
                     <li class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-2 text-green-500"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" /></svg>Premium seat</li>
                     <li class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-2 text-green-500"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" /></svg>2 hand baggage</li>
                     <li class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-2 text-green-500"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" /></svg>Premium meals</li>
                    </ul>
                </div>
                 <div class="bg-slate-700 p-4 rounded-lg">
                    <p class="text-sm font-medium text-gray-300">Première</p>
                    <p class="text-xl font-bold text-yellow-500 mt-1">{{ number_format($flight->first_class_price, 2, ',', ' ') }} €</p>
                    <p class="text-sm text-gray-400">Ultimate luxury</p>
                    <br>
                    <ul class="space-y-2 text-sm text-gray-300 mb-6 flex-grow">
                      <li class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-2 text-green-500"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" /></svg>Luxury suite</li>
                      <li class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-2 text-green-500"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" /></svg>3 hand baggage</li>
                      <li class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-2 text-green-500"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" /></svg>Gourmet dining</li>
                    </ul>  
                </div>
            </div>

            {{-- Section Autres Informations --}}
            <h2 class="text-xl font-semibold mb-4 border-b border-slate-700 pb-2 text-white flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-gray-400"> <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /> </svg>
                Autres Informations
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-3 mb-6 text-sm">
                <div class="flex items-start space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400 mt-0.5 flex-shrink-0"> <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" /> </svg>
                    <div>
                        <span class="text-gray-400 font-medium">ID Vol:</span>
                        <span class="text-gray-100 ml-2">{{ $flight->id }}</span>
                    </div>
                </div>
                 <div class="flex items-start space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400 mt-0.5 flex-shrink-0"> <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /> </svg>
                     <div>
                        <span class="text-gray-400 font-medium">Créé le:</span>
                        <span class="text-gray-100 ml-2">{{ $flight->created_at->format('d/m/Y à H:i') }}</span>
                     </div>
                 </div>
                 <div class="flex items-start space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400 mt-0.5 flex-shrink-0"> <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 11.667 0l3.181-3.183m-4.991-4.992-3.182-3.182a8.25 8.25 0 0 0-11.667 0L2.985 14.652Z" /> </svg>
                     <div>
                        <span class="text-gray-400 font-medium">Dernière MàJ:</span>
                        <span class="text-gray-100 ml-2">{{ $flight->updated_at->format('d/m/Y à H:i') }}</span>
                    </div>
                 </div>
                {{-- Ajoute ici toute autre information pertinente --}}
            </div>

            {{-- Boutons d'action en bas --}}
            <div class="mt-8 flex flex-col sm:flex-row justify-between items-center gap-4 pt-6 border-t border-slate-700">
                <a href="{{ url()->previous() }}" class="w-full sm:w-auto bg-slate-600 hover:bg-slate-500 text-white font-semibold py-2 px-6 rounded-full transition-colors text-center">
                    ← Retour
                </a>
                 {{-- Bouton Sélectionner (si applicable) --}}
                 {{-- Décommentez et adaptez si nécessaire --}}
                 {{-- <form method="GET" action="{{ route('reservation.create', ['flight' => $flight->id]) }}" class="w-full sm:w-auto"> --}}
                     {{-- Inclure les champs cachés nécessaires (ex: passagers, dates si déjà connus) --}}
                     {{-- <input type="hidden" name="passengers" value="{{ request('passengers', 1) }}"> --}}
                     {{-- <button type="submit" class="w-full bg-yellow-500 text-slate-900 font-semibold py-2 px-6 rounded-full hover:bg-yellow-600 transition-colors">
                        Sélectionner ce vol →
                     </button> --}}
                 {{-- </form> --}}
            </div>

        </div> {{-- Fin de la carte principale --}}

    </div> {{-- End Max Width Container --}}

</body>
</html>