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

        

    </div>

</body>
</html>