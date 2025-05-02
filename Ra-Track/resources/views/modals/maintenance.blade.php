<!-- Modal pour Ajouter/Modifier Maintenance -->
<div id="maintenance-modal" class="modal pointer-events-none fixed inset-0 z-50 flex items-center justify-center p-4 opacity-0 transition-opacity duration-300 ease-in-out">
        <div class="absolute inset-0 bg-black bg-opacity-50 modal-overlay"></div>

        <div class="relative bg-white w-full max-w-lg p-6 rounded-lg shadow-xl mx-auto z-10 transform scale-95 transition-transform duration-300 ease-in-out">
            <div class="flex justify-between items-center pb-3 border-b">
                <h3 class="text-xl font-semibold text-gray-900" id="modal-title">Ajouter une Maintenance</h3>
                <button id="close-maintenance-modal-button" class="text-gray-400 hover:text-gray-600 text-2xl font-bold">×</button>
            </div>

            <form id="maintenance-form" method="POST" action="{{ route('maintenances.store') }}" class="mt-4 space-y-4">
                @csrf
                <input type="hidden" name="_method" id="modal-form-method" value="POST">
                <input type="hidden" name="maintenance_id" id="maintenance-id" value="">

                <div>
                    <label for="modal-aircraft-select" class="block text-sm font-medium text-gray-700">Avion</label>
                    <select id="modal-aircraft-select" name="aircraft_id" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                        <option value="">Sélectionner un avion...</option>
                         @isset($planes)
                         @foreach($planes as $plane)
                         <option value="{{ $plane->id }}">{{ $plane->registration }} ({{ $plane->model }})</option>
                         @endforeach
                         @endisset
                    </select>
                </div>
                <div>
                    <label for="modal-maintenance-type" class="block text-sm font-medium text-gray-700">Type de Maintenance</label>
                    <input type="text" name="maintenance_type" id="modal-maintenance-type" required class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Ex: Check A, Réparation...">
                </div>
                <div>
                    <label for="modal-start-date" class="block text-sm font-medium text-gray-700">Date de Début</label>
                    <input type="date" name="start_date" id="modal-start-date" required class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="modal-end-date" class="block text-sm font-medium text-gray-700">Date de Fin Prévue</label>
                    <input type="date" name="end_date" id="modal-end-date" required class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="pt-4 flex justify-end space-x-2 border-t mt-4">
                     <button type="button" id="cancel-modal-button" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                         Annuler
                     </button>
                     <button type="submit" id="submit-modal-button" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                         Enregistrer
                     </button>
                 </div>
            </form>
        </div>
</div>