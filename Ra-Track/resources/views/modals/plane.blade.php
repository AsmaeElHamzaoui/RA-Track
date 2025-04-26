<!-- ==================== MODAL AVION ==================== -->
<div id="aircraft-modal" class="fixed inset-0 z-50 hidden items-center justify-center modal-backdrop overflow-y-auto"> {{-- Added overflow-y-auto --}}
    <div class="bg-navy-light w-full max-w-3xl p-6 rounded-lg shadow-xl m-4">
        <div class="flex justify-between items-center mb-4">
            <h4 id="aircraft-modal-title" class="text-xl font-semibold">Ajouter un Avion</h4>
            <button class="close-modal text-gray-400 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        {{-- Added data attributes to track mode and ID --}}
        <form id="aircraft-form" data-mode="add" data-plane-id="">
            {{-- Add CSRF token if your API routes are not in api.php or need it --}}
            {{-- @csrf --}}
            {{-- Add method spoofing for PUT if needed, although AJAX handles it --}}
            {{-- <input type="hidden" name="_method" value="POST"> --}}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="aircraft_tail_number" class="block text-sm font-medium text-gray-300 mb-1">Immatriculation</label>
                    {{-- Ensure name matches the expected field name in your controller/model --}}
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
                        {{-- Ensure these values match exactly what your backend expects/stores --}}
                        <option value="active">Actif</option>
                        <option value="under maintenance">En maintenance</option>
                        <option value="out of service">Retiré du service</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" class="close-modal px-4 py-2 rounded bg-gray-600 hover:bg-gray-700 text-white">Annuler</button>
                <button type="submit" id="save-aircraft-button" class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
<!-- ==================== MODAL AVION ==================== -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Récupération des éléments du DOM
        const $modal = $('#aircraft-modal'); // Le modal (popup) contenant le formulaire
        const $form = $('#aircraft-form'); // Le formulaire pour ajouter/modifier un avion
        const $modalTitle = $('#aircraft-modal-title'); // Le titre du modal
        const $aircraftTableBody = $('#aircraft-table-body'); // Le corps du tableau contenant la liste des avions
        // Modals et boutons
        const closeModalButtons = document.querySelectorAll('.close-modal');
        // === Fonction pour ouvrir le modal en mode ajout ===
        function openAddModal() {
            // Modifier le texte et les couleurs du bouton pour refléter l'ajout
            $('#save-aircraft-button').text('Enregistrer')
                .removeClass('bg-yellow-500 hover:bg-yellow-600')
                .addClass('bg-blue-600 hover:bg-blue-700');

            // Réinitialiser le formulaire et définir les attributs de mode
            $form[0].reset();
            $modalTitle.text('Ajouter un Avion');
            $form.attr('data-mode', 'add').removeAttr('data-plane-id');

            // Afficher le modal
            $modal.removeClass('hidden').addClass('flex');
        }

        //  Fermer le modal en clicant dans le bouton Fermer
        function closeModal(modalElement) {
            if (modalElement) {
                modalElement.classList.add('hidden');
                modalElement.classList.remove('flex');
            } else {
                console.error("Tentative de fermeture d'un modal non trouvé.");
            }
        }

        // Boutons Fermer Modal 
        closeModalButtons.forEach(button => {
            button.addEventListener('click', () => {
                // MODIFIÉ: Ajout de #airport-modal au sélecteur
                const modalToClose = button.closest('#flight-modal, #user-modal, #aircraft-modal, #airport-modal');
                closeModal(modalToClose);
            });
        });

        // === Fonction pour ouvrir le modal en mode édition ===
        function openEditModal(planeId) {
            // Modifier le bouton pour indiquer l'édition
            $('#save-aircraft-button').text('Modifier')
                .removeClass('bg-blue-600 hover:bg-blue-700')
                .addClass('bg-yellow-500 hover:bg-yellow-600');

            // Récupérer les données de l'avion via AJAX
            $.ajax({
                url: `/api/planes/${planeId}`,
                type: 'GET',
                success: function(plane) {
                    // Remplir les champs du formulaire avec les données existantes
                    $form.find('#aircraft_tail_number').val(plane.registration);
                    $form.find('#aircraft_model').val(plane.model);
                    $form.find('#aircraft_manufacturer').val(plane.manufacturer);
                    $form.find('#aircraft_operator').val(plane.airline_company);
                    $form.find('#economy_capacity').val(plane.economy_class_capacity);
                    $form.find('#business_capacity').val(plane.business_class_capacity);
                    $form.find('#first_capacity').val(plane.first_class_capacity);
                    $form.find('#max_load').val(plane.maximum_load);
                    $form.find('#flight_range').val(plane.flight_range);
                    $form.find('#aircraft_status').val(plane.status);

                    // Mettre à jour le titre et les attributs du formulaire
                    $modalTitle.text('Modifier l\'Avion');
                    $form.attr('data-mode', 'edit').attr('data-plane-id', planeId);

                    // Afficher le modal
                    $modal.removeClass('hidden').addClass('flex');
                },
                error: function(xhr) {
                    // Gérer les erreurs si les données ne peuvent pas être chargées
                    alert(`Erreur : Impossible de charger les données de l'avion. ${xhr.responseJSON?.message || xhr.statusText}`);
                }
            });
        }


        // === Fonction pour recharger les avions depuis l'API et mettre à jour le tableau ===
        function refreshAircraftTable() {
            $.ajax({
                url: '/api/planes',
                type: 'GET',
                success: function(planes) {
                    $aircraftTableBody.empty(); // Vider le tableau actuel

                    // Vérifier s’il y a des avions à afficher
                    if (planes.length > 0) {
                        planes.forEach(function(plane) {
                            let statusClass = '';
                            let statusText = ucfirst(plane.status.replace('_', ' '));

                            // Choisir une couleur en fonction du statut de l'avion
                            switch (plane.status) {
                                case 'active':
                                    statusClass = 'bg-green-600 text-green-100';
                                    break;
                                case 'under maintenance':
                                    statusClass = 'bg-yellow-600 text-yellow-100';
                                    break;
                                case 'out of service':
                                    statusClass = 'bg-red-600 text-red-100';
                                    break;
                                default:
                                    statusClass = 'bg-gray-600 text-gray-100';
                            }

                            // Ajouter une ligne dans le tableau avec les données de l'avion
                            $aircraftTableBody.append(`
                            <tr class="border-b border-gray-700 hover:bg-gray-700">
                                <td class="px-4 py-3">${plane.registration}</td>
                                <td class="px-4 py-3">${plane.model}</td>
                                <td class="px-4 py-3">${plane.airline_company}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full ${statusClass}">
                                        ${statusText}
                                    </span>
                                </td>
                                <td class="px-4 py-3 flex space-x-2">
                                    <!-- Bouton de modification -->
                                    <button class="edit-aircraft-button text-yellow-400 hover:text-yellow-300" data-id="${plane.id}">
                                        <!-- Icône stylo -->
                                        ...
                                    </button>

                                    <!-- Bouton de suppression -->
                                    <button class="delete-aircraft-button text-red-500 hover:text-red-400" data-id="${plane.id}">
                                        <!-- Icône poubelle -->
                                        ...
                                    </button>
                                </td>
                            </tr>
                        `);
                        });
                    } else {
                        // Message si aucun avion trouvé
                        $aircraftTableBody.append('<tr><td colspan="5" class="text-center text-gray-400">Aucun avion trouvé.</td></tr>');
                    }
                },
                error: function() {
                    // Gérer les erreurs de récupération
                    alert('Erreur lors du rafraîchissement de la liste des avions.');
                    $aircraftTableBody.html('<tr><td colspan="5" class="text-center text-red-400">Erreur lors du chargement.</td></tr>');
                }
            });
        }

        // === Fonction pour mettre la première lettre en majuscule ===
        function ucfirst(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        // === Écouteurs d'événements ===

        // Ouvrir le modal pour ajouter un avion
        $('#open-add-aircraft-modal').on('click', openAddModal);

        // Ouvrir le modal pour modifier un avion 
        $aircraftTableBody.on('click', '.edit-aircraft-button', function() {
            openEditModal($(this).data('id'));
        });

        // Soumission du formulaire (ajout ou modification)
        $form.on('submit', function(e) {
            e.preventDefault();

            const mode = $form.attr('data-mode'); // 'add' ou 'edit'
            const planeId = $form.attr('data-plane-id'); // ID de l'avion (si édition)
            let url = '/api/planes'; // URL par défaut
            let method = 'POST'; // Méthode HTTP par défaut

            // Modifier l’URL et la méthode si c’est une édition
            if (mode === 'edit' && planeId) {
                url = `/api/planes/${planeId}`;
                method = 'POST'; // Toujours POST, on utilise _method pour faire un PUT
            }

            // Créer un FormData pour envoyer les données
            const formData = new FormData(this);
            if (mode === 'edit') formData.append('_method', 'PUT'); // Simuler un PUT

            // Désactiver le bouton pendant l’enregistrement
            $('#save-aircraft-button').prop('disabled', true).text('Enregistrement...');

            // Envoi AJAX
            $.ajax({
                url: url,
                type: method,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert(response.message || (mode === 'edit' ? 'Avion mis à jour avec succès!' : 'Avion ajouté avec succès!'));
                    closeModal(); // Fermer le modal
                    refreshAircraftTable(); // Recharger la liste
                },
                error: function(xhr) {
                    let errorMessage = xhr.responseJSON?.message || 'Une erreur est survenue.';
                    if (xhr.status === 422 && xhr.responseJSON.errors) {
                        // Afficher les messages d’erreur de validation
                        errorMessage += '\n' + Object.values(xhr.responseJSON.errors).join('\n');
                    }
                    alert(errorMessage);
                },
                complete: function() {
                    // Réactiver le bouton après l’appel AJAX
                    $('#save-aircraft-button').prop('disabled', false).text('Enregistrer');
                }
            });
        });

        // === Suppression d’un avion ===
        $aircraftTableBody.on('click', '.delete-aircraft-button', function() {
            const planeId = $(this).data('id');

            // Demande de confirmation
            if (confirm('Êtes-vous sûr de vouloir supprimer cet avion ?')) {
                $.ajax({
                    url: `/api/planes/${planeId}`,
                    type: 'POST',
                    data: {
                        _method: 'DELETE'
                    }, // Méthode simulée DELETE
                    success: function(response) {
                        alert(response.message || 'Avion supprimé avec succès!');
                        refreshAircraftTable(); // Recharger la liste
                    },
                    error: function(xhr) {
                        alert(`Erreur : Impossible de supprimer l'avion. ${xhr.responseJSON?.message || xhr.statusText}`);
                    }
                });
            }
        });

        // === Charger la liste des avions au chargement initial de la page ===

        refreshAircraftTable();

    });
</script>