<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirTrack - Paiement Sécurisé</title>
    <!-- Include Tailwind CSS via Play CDN (for easy setup) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-200 font-sans antialiased">

    <!-- Header -->
    @include('layouts.header')

    <!-- Main Content -->
    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        <h1 class="text-2xl md:text-3xl font-semibold text-center text-white mb-4">Paiement Sécurisé</h1>
        <!-- Payment Method Icons -->
        <div class="flex justify-center items-center space-x-2 mb-8 md:mb-10">
            <span class="payment-icon">VISA</span>
            <span class="payment-icon">MC</span> <!-- Placeholder for Mastercard -->
            <span class="payment-icon">PayPal</span>
        </div>

        <!-- Form and Summary Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">

            <!-- Payment Information Form -->
            <div class="bg-slate-800 p-6 md:p-8 rounded-xl shadow-xl">
                 <h2 class="flex items-center space-x-3 mb-6 text-lg font-semibold text-white">
                    <!-- Credit Card Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M4 4a2 2 0 00-2 2v4h16V6a2 2 0 00-2-2H4z" />
                        <path fill-rule="evenodd" d="M18 12H2v4a2 2 0 002 2h12a2 2 0 002-2v-4z" clip-rule="evenodd" />
                    </svg>
                    <span>Informations de Paiement</span>
                </h2>

                <form action="#" method="POST" class="space-y-5">
                    <div>
                        <label for="cardholder-name" class="block text-sm font-medium text-slate-300 mb-1">Nom du titulaire</label>
                        <input type="text" name="cardholder-name" id="cardholder-name" placeholder="Nom complet" class="w-full bg-slate-700 border border-slate-600 rounded-md px-3 py-2.5 text-sm text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    </div>

                    <div>
                        <label for="card-number" class="block text-sm font-medium text-slate-300 mb-1">Numéro de carte</label>
                        <div class="relative">
                            <input type="text" name="card-number" id="card-number" inputmode="numeric" pattern="[0-9\s]{13,19}" autocomplete="cc-number" maxlength="19" placeholder="1234 5678 9012 3456" class="w-full bg-slate-700 border border-slate-600 rounded-md px-3 py-2.5 pr-10 text-sm text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            <!-- Placeholder for Card Brand Icon -->
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                               <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                                  <path d="M4 4a2 2 0 00-2 2v4h16V6a2 2 0 00-2-2H4z" />
                                  <path fill-rule="evenodd" d="M18 12H2v4a2 2 0 002 2h12a2 2 0 002-2v-4z" clip-rule="evenodd" />
                               </svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-5 sm:space-y-0">
                        <div class="flex-1">
                             <label for="expiry-date" class="block text-sm font-medium text-slate-300 mb-1">Date d'expiration</label>
                            <input type="text" name="expiry-date" id="expiry-date" placeholder="MM/AA" autocomplete="cc-exp" maxlength="5" class="w-full bg-slate-700 border border-slate-600 rounded-md px-3 py-2.5 text-sm text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        </div>
                         <div class="flex-1">
                             <label for="cvv" class="block text-sm font-medium text-slate-300 mb-1">CVV</label>
                            <input type="text" name="cvv" id="cvv" placeholder="123" inputmode="numeric" autocomplete="cc-csc" maxlength="4" class="w-full bg-slate-700 border border-slate-600 rounded-md px-3 py-2.5 text-sm text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        </div>
                    </div>

                    <div>
                         <button type="submit" class="w-full mt-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg flex items-center justify-center space-x-2 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-800 focus:ring-blue-500">
                            <!-- Lock Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                               <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v7a2 2 0 002 2h10a2 2 0 002-2v-7a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                            </svg>
                            <span>Payer 299,99 €</span>
                        </button>
                    </div>
                </form>
            </div>

            

        </div>

    </main>

  

</body>
</html>