 <section id="maintenance-planning-section" class="content-section hidden">
     <h2 class="text-2xl font-semibold text-gray-800 mb-6">Planifier une Maintenance</h2>

     <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
         <!-- Colonne Formulaire -->
         <div class="lg:col-span-1 bg-white p-6 rounded-lg shadow">
             <h3 class="text-lg font-medium text-gray-900 mb-4">Nouvelle Planification</h3>
             <form id="plan-maintenance-form" method="POST" action="{{ route('maintenances.store') }}" class="space-y-4">
                @csrf
                 <div>
                     <label for="aircraft-select" class="block text-sm font-medium text-gray-700">Avion</label>
                     <select id="aircraft-select" name="aircraft_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                         @foreach($planes as $plane)
                         <option>Sélectionner un avion...</option>
                         <option value="{{ $plane->id }}">{{ $plane->registration }}</option>
                         @endforeach
                     </select>
                 </div>
                 <div>
                     <label for="maintenance-type" class="block text-sm font-medium text-gray-700">Type de Maintenance</label>
                     <input type="text" name="maintenance_type" id="maintenance-type" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Ex: Check A, Réparation...">
                 </div>
                 <div>
                     <label for="start-date" class="block text-sm font-medium text-gray-700">Date de Début</label>
                     <input type="date" name="start_date" id="start-date" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                 </div>
                 <div>
                     <label for="end-date" class="block text-sm font-medium text-gray-700">Date de Fin Prévue</label>
                     <input type="date" name="end_date" id="end-date" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                 </div>
                 <div class="pt-2">
                     <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                         Planifier
                     </button>
                 </div>
             </form>
         </div>

         <!-- Colonne Calendrier -->
         <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow">
             <h3 class="text-lg font-medium text-gray-900 mb-4">Calendrier des Maintenances</h3>
             <!-- Zone où le calendrier sera rendu par JavaScript -->
             <div id="maintenance-calendar">
             </div>
         </div>
     </div>

 </section>