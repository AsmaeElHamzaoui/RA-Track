<!-- ==================== MODAL AVION ==================== -->

<div id="aircraft-modal" class="fixed inset-0 z-50 hidden items-center justify-center modal-backdrop">
    <div class="bg-navy-light w-full max-w-3xl p-6 rounded-lg shadow-xl m-4">
        <div class="flex justify-between items-center mb-4">
            <h4 id="aircraft-modal-title" class="text-xl font-semibold">Ajouter un Avion</h4>
            <button class="close-modal text-gray-400 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form id="aircraft-form">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="aircraft_tail_number" class="block text-sm font-medium text-gray-300 mb-1">Immatriculation</label>
                    <input type="text" id="aircraft_tail_number" name="registration" class="w-full p-2 rounded bg-navy border border-gray-600" required>
                </div>
                <div>
                    <label for="aircraft_model" class="block text-sm font-medium text-gray-300 mb-1">Modèle</label>
                    <input type="text" id="aircraft_model" name="model" class="w-full p-2 rounded bg-navy border border-gray-600" required>
                </div>
                <div>
                    <label for="aircraft_manufacturer" class="block text-sm font-medium text-gray-300 mb-1">Constructeur</label>
                    <input type="text" id="aircraft_manufacturer" name="manufacturer" class="w-full p-2 rounded bg-navy border border-gray-600" required>
                </div>
                <div>
                    <label for="aircraft_operator" class="block text-sm font-medium text-gray-300 mb-1">Compagnie</label>
                    <input type="text" id="aircraft_operator" name="airline_company" class="w-full p-2 rounded bg-navy border border-gray-600" required>
                </div>
                <div>
                    <label for="economy_capacity" class="block text-sm font-medium text-gray-300 mb-1">Capacité classe éco</label>
                    <input type="number" id="economy_capacity" name="economy_class_capacity" min="0" class="w-full p-2 rounded bg-navy border border-gray-600" required>
                </div>
                <div>
                    <label for="business_capacity" class="block text-sm font-medium text-gray-300 mb-1">Capacité classe business</label>
                    <input type="number" id="business_capacity" name="business_class_capacity" min="0" class="w-full p-2 rounded bg-navy border border-gray-600" required>
                </div>
                <div>
                    <label for="first_capacity" class="block text-sm font-medium text-gray-300 mb-1">Capacité première classe</label>
                    <input type="number" id="first_capacity" name="first_class_capacity" min="0" class="w-full p-2 rounded bg-navy border border-gray-600" required>
                </div>
                <div>
                    <label for="max_load" class="block text-sm font-medium text-gray-300 mb-1">Charge maximale (kg)</label>
                    <input type="number" step="0.01" id="max_load" name="maximum_load" min="0" class="w-full p-2 rounded bg-navy border border-gray-600" required>
                </div>
                <div>
                    <label for="flight_range" class="block text-sm font-medium text-gray-300 mb-1">Portée (km)</label>
                    <input type="number" id="flight_range" name="flight_range" min="0" class="w-full p-2 rounded bg-navy border border-gray-600" required>
                </div>
                <div class="md:col-span-2">
                    <label for="aircraft_status" class="block text-sm font-medium text-gray-300 mb-1">Statut</label>
                    <select id="aircraft_status" name="status" class="w-full p-2 rounded bg-navy border border-gray-600" required>
                        <option value="active">Actif</option>
                        <option value="under maintenance">En maintenance</option>
                        <option value="out of service">Retiré du service</option>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    $(document).ready(function() {
        $('#aircraft-form').on('submit', function(e) {
            e.preventDefault(); // Empêche la soumission normale du formulaire

            // Récupérer les données du formulaire
            var formData = new FormData(this);

            // Effectuer la requête AJAX
            $.ajax({
                url: '/api/planes', // URL de l'API
                type: 'POST',
                data: formData,
                processData: false, // Ne pas traiter les données
                contentType: false, // Ne pas définir le contentType
                success: function(response) {
                    // En cas de succès, fermer la modale et afficher un message
                    alert(response.message); // Afficher un message de succès
                    $('#aircraft-modal').addClass('hidden'); // Fermer la modale
                },
                error: function(xhr, status, error) {
                    // En cas d'erreur, afficher un message d'erreur
                    alert('Erreur : ' + xhr.responseJSON.message);
                }
            });
        });

        // Pour fermer la modale si le bouton "annuler" est cliqué
        $('.close-modal').on('click', function() {
            $('#aircraft-modal').addClass('hidden');
        });
    });
</script>

