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

        

    </main>

  

</body>
</html>