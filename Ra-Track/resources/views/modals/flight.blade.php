<!-- Modal Ajouter/Modifier Vol -->
<div id="flight-modal" class="fixed inset-0 z-50 hidden items-center justify-center modal-backdrop ">
    <div class="bg-slate-700/70 backdrop-blur-sm w-full max-w-lg p-4 rounded-lg shadow-xl m-6">
        <div class="flex justify-between items-center mb-4">
            <h4 id="flight-modal-title" class="text-xl font-semibold text-yellow-200">Ajouter un Vol</h4>
            <button class="close-modal text-yellow-200 hover:text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
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
                        <!-- Boucler sur les avions et remplir le select -->
                        @foreach ($planes as $plane)
                        <option value="{{ $plane->id }}">{{ $plane->registration }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="departure_airport_id" class="block text-sm font-medium text-gray-300 mb-1">Aéroport Départ</label>
                    <select id="departure_airport_id" name="departure_airport_id" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        <!-- Boucler sur les aéroports et remplir le select -->
                        @foreach ($airports as $airport)
                        <option value="{{ $airport->id }}">{{ $airport->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="arrival_airport_id" class="block text-sm font-medium text-gray-300 mb-1">Aéroport Arrivée</label>
                    <select id="arrival_airport_id" name="arrival_airport_id" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        <!-- Boucler sur les aéroports et remplir le select -->
                        @foreach ($airports as $airport)
                        <option value="{{ $airport->id }}">{{ $airport->name }}</option>
                        @endforeach
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
                <div>
                    <label for="pilot_id" class="block text-sm font-medium text-gray-300 mb-1">Pilote</label>
                    <select id="pilot_id" name="pilot_id" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        <!-- Boucle sur les pilotes -->
                        @foreach ($pilots as $pilot)
                        <option value="{{ $pilot->id }}">{{ $pilot->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" class="close-modal px-4 py-2 rounded" style="color: #162238; border: 1px solid #FFD476;background: #FFD476;
                                    box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    5px 5px 15px rgba(0, 0, 0, 0.35),
                                    inset -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    inset 5px 5px 15px rgba(0, 0, 0, 0.35);">Annuler</button>
                    <button type="submit" class="px-4 py-2 rounded" style="color: #162238; border: 1px solid #FFD476;background: #FFD476;
                                    box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    5px 5px 15px rgba(0, 0, 0, 0.35),
                                    inset -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    inset 5px 5px 15px rgba(0, 0, 0, 0.35);">Enregistrer</button>
                </div>
            </div>


        </form>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // --- Configuration et Sélection des éléments du DOM pour les Vols ---
        const $flightModal = $('#flight-modal'); // Le modal (popup) contenant le formulaire de vol
        const $flightForm = $('#flight-form'); // Le formulaire pour ajouter/modifier un vol
        const $flightModalTitle = $('#flight-modal-title'); // Le titre du modal de vol
        const $flightTableBody = $('#flight-table-body'); // Le corps du tableau contenant la liste des vols
        // Récupérer le bouton Enregistrer/Modifier DANS le modal de vol
        const $saveFlightButton = $flightForm.find('button[type="submit"]'); // Plus robuste que de supposer un ID spécifique

        // === Fonction pour ouvrir le modal en mode ajout de Vol ===
        function openAddFlightModal() {
            // Modifier le texte et les couleurs du bouton pour refléter l'ajout
            $saveFlightButton.text('Enregistrer')
                .removeClass('bg-yellow-500 hover:bg-yellow-600') // Supposer des classes similaires pour Modifier
                .addClass('bg-blue-600 hover:bg-blue-700');

            // Réinitialiser le formulaire et définir les attributs de mode
            $flightForm[0].reset();
            $flightModalTitle.text('Ajouter un Vol');
            $flightForm.attr('data-mode', 'add').removeAttr('data-flight-id');

            // Afficher le modal
            $flightModal.removeClass('hidden').addClass('flex');
        }

        // === Fonction pour ouvrir le modal en mode édition de Vol ===
        function openEditFlightModal(flightId) {
            // Modifier le bouton pour indiquer l'édition
            $saveFlightButton.text('Modifier')
                .removeClass('bg-blue-600 hover:bg-blue-700')
                .addClass('bg-yellow-500 hover:bg-yellow-600'); // Supposer des classes similaires

            // Récupérer les données du vol via AJAX
            $.ajax({
                url: `/api/flights/${flightId}`, // URL API pour un vol spécifique
                type: 'GET',
                success: function(flight) {
                    // Remplir les champs du formulaire avec les données existantes
                    // Attention au format des dates/heures pour datetime-local
                    const departureTime = flight.departure_time ? flight.departure_time.replace(' ', 'T').substring(0, 16) : '';
                    const arrivalTime = flight.arrival_time ? flight.arrival_time.replace(' ', 'T').substring(0, 16) : '';

                    $flightForm.find('#flight_number').val(flight.flight_number);
                    $flightForm.find('#plane_id').val(flight.plane_id); // Assurez-vous que l'ID de l'avion est bien passé
                    $flightForm.find('#departure_airport_id').val(flight.departure_airport_id); // ID aéroport départ
                    $flightForm.find('#arrival_airport_id').val(flight.arrival_airport_id); // ID aéroport arrivée
                    $flightForm.find('#departure_time').val(departureTime);
                    $flightForm.find('#arrival_time').val(arrivalTime);
                    $flightForm.find('#status').val(flight.status);
                    $flightForm.find('#economy_class_price').val(flight.economy_class_price);
                    $flightForm.find('#business_class_price').val(flight.business_class_price);
                    $flightForm.find('#first_class_price').val(flight.first_class_price);

                    // Mettre à jour le titre et les attributs du formulaire
                    $flightModalTitle.text('Modifier le Vol');
                    $flightForm.attr('data-mode', 'edit').attr('data-flight-id', flightId);

                    // Afficher le modal
                    $flightModal.removeClass('hidden').addClass('flex');
                },
                error: function(xhr) {
                    // Gérer les erreurs si les données ne peuvent pas être chargées
                    alert(`Erreur : Impossible de charger les données du vol. ${xhr.responseJSON?.message || xhr.statusText}`);
                }
            });
        }

        // === Fonction pour fermer le modal de Vol ===
        function closeFlightModal() {
            $flightModal.addClass('hidden').removeClass('flex');
        }

        // === Fonction pour recharger les vols depuis l'API et mettre à jour le tableau ===
        function refreshFlightTable() {
            $.ajax({
                url: '/api/flights', // URL API pour la liste des vols
                type: 'GET',
                success: function(flights) {
                    $flightTableBody.empty(); // Vider le tableau actuel

                    // Vérifier s’il y a des vols à afficher
                    if (flights.length > 0) {
                        flights.forEach(function(flight) {
                            let statusClass = '';
                            // Adapter la fonction ucfirst si nécessaire ou utiliser directement les valeurs
                            let statusText = flight.status ? flight.status.replace('_', ' ') : 'N/A';
                            statusText = statusText.charAt(0).toUpperCase() + statusText.slice(1); // Simple ucfirst

                            // Choisir une couleur en fonction du statut du vol (adaptez selon vos besoins)
                            switch (flight.status) {
                                case 'scheduled':
                                    statusClass = 'bg-blue-600 text-blue-100';
                                    break;
                                case 'in_progress':
                                    statusClass = 'bg-teal-600 text-teal-100';
                                    break;
                                case 'completed':
                                    statusClass = 'bg-green-600 text-green-100';
                                    break;
                                case 'delayed':
                                    statusClass = 'bg-yellow-600 text-yellow-100';
                                    break;
                                case 'cancelled':
                                    statusClass = 'bg-red-600 text-red-100';
                                    break;
                                default:
                                    statusClass = 'bg-gray-600 text-gray-100';
                            }

                            // Ajouter une ligne dans le tableau avec les données du vol
                            // Adaptez les colonnes affichées selon vos besoins
                            $flightTableBody.append(`
                            <tr class="border-b border-gray-700 hover:bg-gray-700">
                                <td class="px-4 py-3">${flight.flight_number}</td>
                                <td class="px-4 py-3">${flight.departure_airport?.iata_code || 'N/A'} -> ${flight.arrival_airport?.iata_code || 'N/A'}</td> {/* Assurez-vous que les relations sont chargées */}
                                <td class="px-4 py-3">${flight.departure_time ? new Date(flight.departure_time).toLocaleString() : 'N/A'}</td>
                                <td class="px-4 py-3">${flight.plane?.registration || 'N/A'}</td> {/* Assurez-vous que la relation est chargée */}
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full ${statusClass}">
                                        ${statusText}
                                    </span>
                                </td>
                                <td class="px-4 py-3 flex space-x-2">
                                    <!-- Bouton de modification -->
                                    <button class="edit-flight-button text-gray-900 hover:text-yellow-200" data-id="${flight.id}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                                    </button>

                                    <!-- Bouton de suppression -->
                                    <button class="delete-flight-button text-gray-900 hover:text-yellow-200" data-id="${flight.id}">
                                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                                    </button>
                                </td>
                            </tr>
                        `);
                        });
                    } else {
                        // Message si aucun vol trouvé
                        $flightTableBody.append('<tr><td colspan="6" class="text-center py-4 text-gray-400">Aucun vol trouvé.</td></tr>'); // Ajustez colspan
                    }
                },
                error: function() {
                    // Gérer les erreurs de récupération
                    alert('Erreur lors du rafraîchissement de la liste des vols.');
                    $flightTableBody.html('<tr><td colspan="6" class="text-center py-4 text-red-400">Erreur lors du chargement.</td></tr>'); // Ajustez colspan
                }
            });
        }

        // === Écouteurs d'événements ===

        // Ouvrir le modal pour ajouter un vol
        $('#open-add-flight-modal').on('click', openAddFlightModal); // Assurez-vous que ce bouton existe

        // Fermer le modal (bouton 'X' et bouton 'Annuler')
        $flightModal.find('.close-modal').on('click', closeFlightModal);

        // Ouvrir le modal pour modifier un vol (via délégation d'événement sur le corps du tableau)
        $flightTableBody.on('click', '.edit-flight-button', function() {
            openEditFlightModal($(this).data('id'));
        });

        // Soumission du formulaire (ajout ou modification de vol)
        $flightForm.on('submit', function(e) {
            e.preventDefault();

            const mode = $flightForm.attr('data-mode'); // 'add' ou 'edit'
            const flightId = $flightForm.attr('data-flight-id'); // ID du vol (si édition)
            let url = '/api/flights'; // URL par défaut pour l'ajout
            let method = 'POST'; // Méthode HTTP par défaut

            // Modifier l’URL et la méthode si c’est une édition
            if (mode === 'edit' && flightId) {
                url = `/api/flights/${flightId}`;
                method = 'POST'; // Toujours POST, utiliser _method pour simuler PUT/PATCH
            }

            // Créer un FormData pour envoyer les données (gère aussi les fichiers si besoin)
            const formData = new FormData(this);
            if (mode === 'edit') {
                formData.append('_method', 'PUT'); // Simuler une requête PUT pour la mise à jour
            }

            // Désactiver le bouton pendant l’enregistrement
            $saveFlightButton.prop('disabled', true).text(mode === 'edit' ? 'Modification...' : 'Enregistrement...');

            // Envoi AJAX
            $.ajax({
                url: url,
                type: method,
                data: formData,
                processData: false, // Nécessaire pour FormData
                contentType: false, // Nécessaire pour FormData
                headers: { // Important pour Laravel avec AJAX / FormData
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Assurez-vous d'avoir la meta tag CSRF dans votre <head>
                },
                success: function(response) {
                    alert(response.message || (mode === 'edit' ? 'Vol mis à jour avec succès!' : 'Vol ajouté avec succès!'));
                    closeFlightModal(); // Fermer le modal
                    refreshFlightTable(); // Recharger la liste des vols
                },
                error: function(xhr) {
                    let errorMessage = 'Une erreur est survenue.';
                    if (xhr.responseJSON) {
                        errorMessage = xhr.responseJSON.message || errorMessage;
                        if (xhr.status === 422 && xhr.responseJSON.errors) {
                            // Afficher les messages d’erreur de validation plus en détail
                            let errors = Object.values(xhr.responseJSON.errors).map(err => `- ${err.join('\n  ')}`).join('\n');
                            errorMessage += '\n\nErreurs de validation:\n' + errors;
                        }
                    } else {
                        errorMessage = `Erreur ${xhr.status}: ${xhr.statusText}`;
                    }
                    alert(errorMessage);
                },
                complete: function() {
                    // Réactiver le bouton après l’appel AJAX et restaurer le texte initial
                    const buttonText = (mode === 'edit' ? 'Modifier' : 'Enregistrer');
                    $saveFlightButton.prop('disabled', false).text(buttonText);
                }
            });
        });

        // === Suppression d’un vol (via délégation d'événement sur le corps du tableau) ===
        $flightTableBody.on('click', '.delete-flight-button', function() {
            const flightId = $(this).data('id');

            // Demande de confirmation
            if (confirm('Êtes-vous sûr de vouloir supprimer ce vol ?')) {
                $.ajax({
                    url: `/api/flights/${flightId}`,
                    type: 'POST', // Utiliser POST pour envoyer _method=DELETE
                    data: {
                        _method: 'DELETE' // Méthode simulée DELETE
                    },
                    headers: { // CSRF Token nécessaire pour les requêtes POST/PUT/DELETE
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message || 'Vol supprimé avec succès!');
                        refreshFlightTable(); // Recharger la liste des vols
                    },
                    error: function(xhr) {
                        alert(`Erreur : Impossible de supprimer le vol. ${xhr.responseJSON?.message || xhr.statusText}`);
                    }
                });
            }
        });

        // === Charger la liste des vols au chargement initial de la page ===
        refreshFlightTable();

    });
</script>