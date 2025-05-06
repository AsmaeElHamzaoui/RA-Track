<!-- Modal pour Ajouter/Modifier Maintenance -->
<div id="maintenance-modal" class="modal pointer-events-none fixed inset-0 z-50 flex items-center justify-center p-4 opacity-0 transition-opacity duration-300 ease-in-out">
        <div class="absolute inset-0 bg-black bg-opacity-50 modal-overlay"></div>

        <div class="relative bg-slate-900/70 backdrop-blur-sm w-full max-w-lg p-6 rounded-lg shadow-xl mx-auto z-10 transform scale-95 transition-transform duration-300 ease-in-out">
            <div class="flex justify-between items-center pb-3 border-b">
                <h3 class="text-xl font-semibold text-yellow-200" id="modal-title">Ajouter une Maintenance</h3>
                <button id="close-maintenance-modal-button" class="text-gray-400 hover:text-gray-600 text-2xl font-bold">×</button>
            </div>

            <form id="maintenance-form" method="POST" action="{{ route('maintenances.store') }}" class="mt-4 space-y-4">
                @csrf
                <input type="hidden" name="_method" id="modal-form-method" value="POST">
                <input type="hidden" name="maintenance_id" id="maintenance-id" value="">

                <div>
                    <label for="modal-aircraft-select" class="block text-sm font-medium text-white">Avion</label>
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
                    <label for="modal-maintenance-type" class="block text-sm font-medium text-white">Type de Maintenance</label>
                    <input type="text" name="maintenance_type" id="modal-maintenance-type" required class="mt-1 py-2 px-2 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Ex: Check A, Réparation...">
                </div>
                <div>
                    <label for="modal-start-date" class="block text-sm font-medium text-white">Date de Début</label>
                    <input type="date" name="start_date" id="modal-start-date" required class="mt-1 py-2 px-2 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="modal-end-date" class="block text-sm font-medium text-white">Date de Fin Prévue</label>
                    <input type="date" name="end_date" id="modal-end-date" required class="mt-1 py-2 px-2 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="pt-4 flex justify-end space-x-2 border-t mt-4">
                     <button type="button" id="cancel-modal-button" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md" style="color: #162238; border: 1px solid #FFD476;background: #FFD476;
                                    box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    5px 5px 15px rgba(0, 0, 0, 0.35),
                                    inset -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    inset 5px 5px 15px rgba(0, 0, 0, 0.35);">
                         Annuler
                     </button>
                     <button type="submit" id="submit-modal-button" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white" style="color: #162238; border: 1px solid #FFD476;background: #FFD476;
                                    box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    5px 5px 15px rgba(0, 0, 0, 0.35),
                                    inset -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    inset 5px 5px 15px rgba(0, 0, 0, 0.35);">
                         Enregistrer
                     </button>
                 </div>
            </form>
        </div>
</div>