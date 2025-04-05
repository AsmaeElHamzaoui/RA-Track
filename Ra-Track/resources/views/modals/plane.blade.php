<!-- ==================== MODAL AVION ==================== -->
<div id="aircraft-modal" class="fixed inset-0 z-50 hidden items-center justify-center modal-backdrop">
            <div class="bg-navy-light w-full max-w-lg p-6 rounded-lg shadow-xl m-4">
                <div class="flex justify-between items-center mb-4">
                    <h4 id="aircraft-modal-title" class="text-xl font-semibold">Ajouter un Avion</h4>
                    <button class="close-modal text-gray-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                <form id="aircraft-form">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="aircraft_tail_number" class="block text-sm font-medium text-gray-300 mb-1">Immatriculation</label>
                            <input type="text" id="aircraft_tail_number" name="aircraft_tail_number" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="aircraft_model" class="block text-sm font-medium text-gray-300 mb-1">Modèle</label>
                            <input type="text" id="aircraft_model" name="aircraft_model" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="aircraft_operator" class="block text-sm font-medium text-gray-300 mb-1">Compagnie / Opérateur</label>
                            <input type="text" id="aircraft_operator" name="aircraft_operator" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        </div>
                         <div>
                            <label for="aircraft_capacity" class="block text-sm font-medium text-gray-300 mb-1">Capacité (sièges)</label>
                            <input type="number" id="aircraft_capacity" name="aircraft_capacity" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" min="0">
                        </div>
                        <div class="md:col-span-2"> <!-- Prend toute la largeur sur md et plus -->
                            <label for="aircraft_status" class="block text-sm font-medium text-gray-300 mb-1">Statut</label>
                            <select id="aircraft_status" name="aircraft_status" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                                <option value="Actif">Actif</option>
                                <option value="En maintenance">En maintenance</option>
                                <option value="Stocké">Stocké</option>
                                <option value="Retiré">Retiré du service</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" class="close-modal px-4 py-2 rounded bg-gray-600 hover:bg-gray-700 text-white">Annuler</button>
                        <button type="submit" class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white">Enregistrer</button>
                    </div>
                </form>
            </div>
</div>