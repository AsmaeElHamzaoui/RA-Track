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
                    <label for="plane_id" class="block text-sm font-medium text-gray-300 mb-1">Avion</label>
                    <select id="plane_id" name="plane_id" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        <!-- Vous devez ajouter dynamiquement les avions ici -->
                        <option value="1">Avion 1</option>
                        <option value="2">Avion 2</option>
                    </select>
                </div>
                <div>
                    <label for="departure_airport_id" class="block text-sm font-medium text-gray-300 mb-1">Aéroport Départ</label>
                    <select id="departure_airport_id" name="departure_airport_id" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        <!-- Vous devez ajouter dynamiquement les aéroports ici -->
                        <option value="1">Aéroport 1</option>
                        <option value="2">Aéroport 2</option>
                    </select>
                </div>
                <div>
                    <label for="arrival_airport_id" class="block text-sm font-medium text-gray-300 mb-1">Aéroport Arrivée</label>
                    <select id="arrival_airport_id" name="arrival_airport_id" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        <!-- Vous devez ajouter dynamiquement les aéroports ici -->
                        <option value="1">Aéroport 1</option>
                        <option value="2">Aéroport 2</option>
                    </select>
                </div>
                <div>
                    <label for="departure_time" class="block text-sm font-medium text-gray-300 mb-1">Heure Départ</label>
                    <input type="datetime-local" id="departure_time" name="departure_time" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                </div>
                <div>
                    <label for="arrival_time" class="block text-sm font-medium text-gray-300 mb-1">Heure Arrivée</label>
                    <input type="datetime-local" id="arrival_time" name="arrival_time" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-300 mb-1">Statut</label>
                    <select id="status" name="status" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        <option value="scheduled">Programmé</option>
                        <option value="in_progress">En vol</option>
                        <option value="completed">Arrivé</option>
                        <option value="delayed">Retardé</option>
                        <option value="cancelled">Annulé</option>
                    </select>
                </div>
                <div>
                    <label for="economy_class_price" class="block text-sm font-medium text-gray-300 mb-1">Prix Classe Economique</label>
                    <input type="number" id="economy_class_price" name="economy_class_price" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                </div>
                <div>
                    <label for="business_class_price" class="block text-sm font-medium text-gray-300 mb-1">Prix Classe Affaires</label>
                    <input type="number" id="business_class_price" name="business_class_price" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                </div>
                <div>
                    <label for="first_class_price" class="block text-sm font-medium text-gray-300 mb-1">Prix Première Classe</label>
                    <input type="number" id="first_class_price" name="first_class_price" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                </div>
            </div>
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" class="close-modal px-4 py-2 rounded bg-gray-600 hover:bg-gray-700 text-white">Annuler</button>
                <button type="submit" class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
