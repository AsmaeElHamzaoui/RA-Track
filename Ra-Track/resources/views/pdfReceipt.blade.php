<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billet Électronique</title>
    <!-- Tailwind CSS via Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>

    <!-- E-Ticket Component -->
    <div class="bg-white max-w-sm mx-auto rounded-lg shadow-md overflow-hidden p-5 md:p-6 text-gray-900">

        <!-- Header -->
        <div class="flex justify-between items-start mb-6">
            <div class="flex items-center space-x-2">
                <!-- Plane Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transform -rotate-45" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.789 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 16.571V11.5a1 1 0 112 0v5.071a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                <h1 class="text-lg font-semibold">Billet Électronique</h1>
            </div>
            <div class="text-right">
                <span class="text-xs text-gray-500 block">Nº Billet</span>
                <div class="flex items-center justify-end space-x-1.5 mt-0.5">
                  <span class="font-semibold text-sm">AF286749</span>
                  <!-- Small Grid Icon -->
                  <div class="icon-grid text-gray-800">
                      <span></span><span></span><span></span><span></span>
                  </div>
                </div>
            </div>
        </div>

        <!-- QR Code -->
        <div class="flex justify-center my-8">
            <!-- Placeholder QR Code SVG -->
            <svg class="w-32 h-32" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
              <rect width="100" height="100" fill="#FFFFFF"/>
              <path fill="#000000" d="M0 0 H30 V30 H0 Z M70 0 H100 V30 H70 Z M0 70 H30 V100 H0 Z M10 10 H20 V20 H10 Z M80 10 H90 V20 H80 Z M10 80 H20 V90 H10 Z M40 0 H60 V10 H40 Z M0 40 H10 V60 H0 Z M40 40 H60 V60 H40 Z M70 40 H80 V50 H70 Z M90 40 H100 V50 H90 Z M40 70 H50 V80 H40 Z M60 70 H70 V80 H60 Z M80 70 H100 V90 H80 Z M40 90 H60 V100 H40 Z M70 90 H80 V100 H70 Z M15 35 h10 v10 h-10 z m10 10 h10 v10 H25 z m10 0 h10 v10 H35 z M15 55 h10 v10 h-10 z M35 55 h10 v10 h-10 z M55 15 h10 v10 H55 z M35 25 h10 v10 H35 z M45 35 h10 v10 H45 z m10 0 h10 v10 H55 z M65 25 h10 v10 H65 z M55 55 h10 v10 H55 z m10 0 h10 v10 H65 z M75 55 h10 v10 H75 z M85 55 h10 v10 H85 z M55 75 h10 v10 H55 z M45 85 h10 v10 H45 z M65 85 h10 v10 H65 z m10 0 h10 v10 H75 z"/>
            </svg>
        </div>

        <!-- Passenger & Flight Number -->
        <div class="flex justify-between items-baseline mb-5">
            <div>
                <span class="text-xs text-gray-500 block">Passager</span>
                <span class="font-semibold text-base">M. Jean Dupont</span>
            </div>
             <div class="text-right">
                <span class="text-xs text-gray-500 block">Numéro de vol</span>
                <span class="font-semibold text-base">AF 1234</span>
            </div>
        </div>

        <!-- Divider -->
        <hr class="border-gray-200 my-4">

        <!-- Departure & Arrival -->
        <div class="flex justify-between items-center my-4">
            <div class="text-left">
                <span class="text-xs text-gray-500 block">Départ</span>
                <span class="font-bold text-lg block">Paris (CDG)</span>
                <span class="text-sm text-gray-700 block">10:30</span>
                <span class="text-sm text-gray-700 block">23 Mars 2025</span>
            </div>
            <!-- Small Plane Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.789 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 16.571V11.5a1 1 0 112 0v5.071a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
            <div class="text-right">
                 <span class="text-xs text-gray-500 block">Arrivée</span>
                <span class="font-bold text-lg block">New York (JFK)</span>
                <span class="text-sm text-gray-700 block">13:45</span>
                 <span class="text-sm text-gray-700 block">23 Mars 2025</span>
            </div>
        </div>

        

    </div>

</body>
</html>