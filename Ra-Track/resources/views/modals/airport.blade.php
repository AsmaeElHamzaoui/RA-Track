<!-- ==================== MODAL AÉROPORT (Autocomplete) ==================== -->
<div id="airport-modal" class="fixed inset-0 z-50 hidden items-center justify-center overflow-y-auto modal-backdrop">
    <div class="bg-navy-dark rounded-lg shadow-xl w-full max-w-lg p-6 mx-4">
        <div class="flex justify-between items-center border-b border-gray-700 pb-3 mb-4">
            <h3 id="airport-modal-title" class="text-lg font-semibold text-white">Ajouter un Aéroport</h3>
            <button class="close-modal text-gray-400 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Formulaire Aéroport avec Autocomplete -->
        <form id="airport-form">
            @csrf <!-- Important si vous utilisez Laravel/CSRF -->
            <input type="hidden" id="airport_id" name="airport_id"> <!-- Pour la modification -->

            <div class="mb-4">
                <label for="airport_iata_code" class="block text-sm font-medium text-gray-300 mb-1">Code IATA</label>
                <input type="text" id="airport_iata_code" name="iata_code" class="w-full bg-navy border border-gray-600 rounded px-3 py-2 text-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="Ex: CDG" maxlength="3" required>
            </div>

            <div class="mb-4">
                <label for="airport_name" class="block text-sm font-medium text-gray-300 mb-1">Nom de l'aéroport</label>
                <input type="text" id="airport_name" name="name" class="w-full bg-navy border border-gray-600 rounded px-3 py-2 text-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="Ex: Paris Charles de Gaulle" required>
            </div>

            <!-- Champ Localisation avec Autocomplete -->
            <div class="mb-4 relative">
                <label for="airport_location_autocomplete" class="block text-sm font-medium text-gray-300 mb-1">Localisation (Ville, Pays)</label>
                <input type="text" id="airport_location_autocomplete" name="location" class="w-full bg-navy border border-gray-600 rounded px-3 py-2 text-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="Commencez à taper (ex: Paris...)" required autocomplete="off">
                <div id="location-suggestions" class="absolute z-10 w-full bg-navy-light border border-gray-600 rounded-b mt-1 max-h-48 overflow-y-auto hidden">
                </div>
            </div>

            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-700">
                <button type="button" class="close-modal bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Annuler
                </button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Sauvegarder
                </button>
            </div>
        </form>
    </div>
</div>
<!-- ==================== FIN MODAL AÉROPORT (Autocomplete) ==================== -->

