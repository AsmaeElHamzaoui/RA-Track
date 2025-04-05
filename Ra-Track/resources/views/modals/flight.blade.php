
<!-- Modal Ajouter/Modifier Vol -->
<div id="flight-modal" class="fixed inset-0 z-50 hidden items-center justify-center modal-backdrop">
            <div class="bg-navy-light w-full max-w-lg p-6 rounded-lg shadow-xl m-4">
                <div class="flex justify-between items-center mb-4">
                    <h4 id="flight-modal-title" class="text-xl font-semibold">Ajouter un Vol</h4>
                    <button class="close-modal text-gray-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                <form id="flight-form">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="flight_number" class="block text-sm font-medium text-gray-300 mb-1">N° Vol</label>
                            <input type="text" id="flight_number" name="flight_number" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="airline" class="block text-sm font-medium text-gray-300 mb-1">Compagnie</label>
                            <input type="text" id="airline" name="airline" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="departure_airport" class="block text-sm font-medium text-gray-300 mb-1">Aéroport Départ</label>
                            <input type="text" id="departure_airport" name="departure_airport" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="arrival_airport" class="block text-sm font-medium text-gray-300 mb-1">Aéroport Arrivée</label>
                            <input type="text" id="arrival_airport" name="arrival_airport" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        </div>
                         <div>
                            <label for="departure_time" class="block text-sm font-medium text-gray-300 mb-1">Heure Départ</label>
                            <input type="datetime-local" id="departure_time" name="departure_time" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 text-gray-400" required>
                        </div>
                         <div>
                            <label for="arrival_time" class="block text-sm font-medium text-gray-300 mb-1">Heure Arrivée</label>
                            <input type="datetime-local" id="arrival_time" name="arrival_time" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 text-gray-400" required>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-300 mb-1">Statut</label>
                            <select id="status" name="status" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                                <option value="Programmé">Programmé</option>
                                <option value="En vol">En vol</option>
                                <option value="Arrivé">Arrivé</option>
                                <option value="Retardé">Retardé</option>
                                <option value="Annulé">Annulé</option>
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