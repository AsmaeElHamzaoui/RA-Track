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

        <!-- Seat, Class, Terminal -->
        <div class="flex justify-between items-baseline mt-5 mb-4 text-sm">
             <div>
                <span class="text-xs text-gray-500 block">Siège</span>
                <span class="font-medium">23A</span>
            </div>
             <div>
                <span class="text-xs text-gray-500 block">Classe</span>
                <span class="font-medium">Business</span>
            </div>
             <div class="text-right">
                <span class="text-xs text-gray-500 block">Terminal</span>
                <span class="font-medium">2F</span>
            </div>
        </div>

        <!-- Divider -->
        <hr class="border-gray-200 my-4">

        <!-- Price & Details -->
        <div class="mt-4">
            <div class="flex justify-between items-center mb-3">
                <div>
                  <span class="text-xs text-gray-500 block">Prix Total</span>
                  <span class="text-xl font-bold">1,250 €</span>
                </div>
                <!-- Paid Badge -->
                <span class="inline-flex items-center bg-green-100 text-green-700 text-xs font-medium px-2.5 py-1 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    Payé
                </span>
            </div>
            <div class="space-y-1 text-sm text-gray-600">
                <div class="flex items-center space-x-2">
                    <!-- Baggage Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                       <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" /> <!-- Simple arrow as placeholder -->
                       <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h12a2 2 0 012 2v8a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2z"/> <!-- Suitcase part -->
                    </svg>
                    <span>Bagage en soute : 23kg inclus</span>
                </div>
                <div class="flex items-center space-x-2">
                    <!-- Clock Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Embarquement : 09:30</span>
                </div>
            </div>
        </div>

        <!-- Footer Message -->
        <div class="mt-8 text-center text-sm text-gray-600">
            Merci d'avoir choisi Air France !
        </div>

        <!-- Social Icons -->
        <div class="flex justify-center space-x-4 mt-3 text-gray-500">
             <!-- Facebook Icon -->
            <a href="#" aria-label="Facebook" class="hover:text-gray-700 transition-colors">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
            </a>
             <!-- Twitter Icon -->
             <a href="#" aria-label="Twitter" class="hover:text-gray-700 transition-colors">
                 <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-.422.724-.665 1.56-.665 2.456 0 1.999 1.018 3.76 2.563 4.795-.945-.03-1.838-.29-2.617-.718v.065c0 2.794 1.988 5.124 4.623 5.658-.482.13-.994.201-1.524.201-.37 0-.73-.035-1.084-.103.732 2.292 2.866 3.967 5.394 4.015-1.976 1.548-4.47 2.471-7.192 2.471-.467 0-.928-.027-1.38-.081 2.558 1.64 5.604 2.602 8.898 2.602 10.677 0 16.523-8.84 16.523-16.525 0-.252-.006-.503-.018-.753a11.843 11.843 0 002.91-3.024z"/></svg>
            </a>
             <!-- Instagram Icon -->
             <a href="#" aria-label="Instagram" class="hover:text-gray-700 transition-colors">
                 <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.172.053 1.782.217 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.645.412 1.255.465 2.427.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.053 1.172-.218 1.782-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.645.247-1.255.412-2.427.465-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.172-.053-1.782-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.248-.645-.413-1.255-.465-2.427-.058-1.266-.07-1.646-.07-4.85s.012-3.584.07-4.85c.052-1.172.217-1.782.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.7c.645-.248 1.255-.413 2.427-.465C9.146 2.175 9.526 2.163 12 2.163m0-1.081c-3.259 0-3.667.014-4.947.072-1.28.058-2.148.248-2.914.554a6.988 6.988 0 00-2.488 1.618 6.988 6.988 0 00-1.618 2.488c-.306.766-.496 1.634-.554 2.914-.058 1.28-.072 1.688-.072 4.947s.014 3.667.072 4.947c.058 1.28.248 2.148.554 2.914a6.988 6.988 0 001.618 2.488 6.988 6.988 0 002.488 1.618c.766.306 1.634.496 2.914.554 1.28.058 1.688.072 4.947.072s3.667-.014 4.947-.072c1.28-.058 2.148-.248 2.914-.554a6.988 6.988 0 002.488-1.618 6.988 6.988 0 001.618-2.488c.306-.766.496-1.634.554-2.914.058-1.28.072-1.688.072-4.947s-.014-3.667-.072-4.947c-.058-1.28-.248-2.148-.554-2.914a6.988 6.988 0 00-1.618-2.488 6.988 6.988 0 00-2.488-1.618c-.766-.306-1.634-.496-2.914-.554C15.667 1.095 15.259 1.082 12 1.082zM12 6.865A5.135 5.135 0 1012 17.135 5.135 5.135 0 0012 6.865zm0 8.568A3.433 3.433 0 1112 8.568a3.433 3.433 0 010 6.865zM18.568 4.312a1.432 1.432 0 110 2.864 1.432 1.432 0 010-2.864z"/></svg>
            </a>
             <!-- Headset/Support Icon -->
             <a href="#" aria-label="Support" class="hover:text-gray-700 transition-colors">
                 <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636a9 9 0 010 12.728M16.243 7.757a6 6 0 010 8.486M12 13a3 3 0 100-6 3 3 0 000 6zM21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> <!-- Placeholder -->
            </a>
        </div>

    </div>

</body>
</html>