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

        <form id="airport-form">
            @csrf
            <input type="hidden" id="airport_id" name="airport_id">

            <div class="mb-4">
                <label for="airport_iata_code" class="block text-sm font-medium text-gray-300 mb-1">Code IATA</label>
                <input type="text" id="airport_iata_code" name="code_iata" class="w-full bg-navy border border-gray-600 rounded px-3 py-2 text-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="Ex: CDG" maxlength="3" required>
            </div>

            <div class="mb-4">
                <label for="airport_name" class="block text-sm font-medium text-gray-300 mb-1">Nom de l'aéroport</label>
                <input type="text" id="airport_name" name="name" class="w-full bg-navy border border-gray-600 rounded px-3 py-2 text-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="Ex: Paris Charles de Gaulle" required>
            </div>

            <div class="mb-4 relative">
                <label for="airport_location_autocomplete" class="block text-sm font-medium text-gray-300 mb-1">Localisation (Ville, Pays)</label>
                <input type="text" id="airport_location_autocomplete" name="location" class="w-full bg-navy border border-gray-600 rounded px-3 py-2 text-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="Commencez à taper (ex: Paris...)" required autocomplete="off">
                <div id="location-suggestions" class="absolute z-10 w-full bg-navy-light border border-gray-600 rounded-b mt-1 max-h-48 overflow-y-auto hidden"></div>
            </div>

            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-700">
                <button type="button" class="close-modal bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Annuler
                </button>
                <button type="submit" id="save-airport-button" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
<!-- ==================== FIN MODAL AÉROPORT (Autocomplete) ==================== -->

<script>
document.addEventListener('DOMContentLoaded', () => {
    const locationInput = document.getElementById('airport_location_autocomplete');
    const suggestionsContainer = document.getElementById('location-suggestions');

    const locationsData = [
        "Paris, France", "London, United Kingdom", "New York, USA", "Tokyo, Japan",
        "Dubai, UAE", "Berlin, Germany", "Rome, Italy", "Madrid, Spain",
        "Los Angeles, USA", "Chicago, USA", "Singapore, Singapore", "Sydney, Australia",
        "Toronto, Canada", "Vancouver, Canada", "Mexico City, Mexico", "Sao Paulo, Brazil",
        "Buenos Aires, Argentina", "Moscow, Russia", "Beijing, China", "Shanghai, China",
        "Mumbai, India", "Delhi, India", "Cairo, Egypt", "Johannesburg, South Africa"
    ];

    if (locationInput && suggestionsContainer) {
        locationInput.addEventListener('input', function () {
            const inputText = this.value.toLowerCase().trim();
            suggestionsContainer.innerHTML = '';
            suggestionsContainer.classList.add('hidden');

            if (inputText.length > 0) {
                const filteredLocations = locationsData.filter(location =>
                    location.toLowerCase().includes(inputText)
                );

                if (filteredLocations.length > 0) {
                    filteredLocations.forEach(location => {
                        const suggestionDiv = document.createElement('div');
                        suggestionDiv.textContent = location;
                        suggestionDiv.className = 'px-3 py-2 text-sm text-gray-200 hover:bg-navy cursor-pointer';
                        suggestionDiv.addEventListener('click', () => {
                            locationInput.value = location;
                            suggestionsContainer.innerHTML = '';
                            suggestionsContainer.classList.add('hidden');
                        });
                        suggestionsContainer.appendChild(suggestionDiv);
                    });
                    suggestionsContainer.classList.remove('hidden');
                }
            }
        });

        locationInput.addEventListener('blur', () => {
            setTimeout(() => {
                suggestionsContainer.classList.add('hidden');
            }, 150);
        });
    }
});
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script>
$(document).ready(function () {
    const $modal = $('#airport-modal');
    const $form = $('#airport-form');
    const $modalTitle = $('#airport-modal-title');
    const $airportTableBody = $('#airport-table-body');

    function openAddModal() {
        $('#save-airport-button').text('Enregistrer')
            .removeClass('bg-yellow-500 hover:bg-yellow-600')
            .addClass('bg-blue-600 hover:bg-blue-700');

        $form[0].reset();
        $modalTitle.text('Ajouter un Aéroport');
        $form.attr('data-mode', 'add').removeAttr('data-airport-id');
        $modal.removeClass('hidden').addClass('flex');
    }

    function openEditModal(airportId) {
        $('#save-airport-button').text('Modifier')
            .removeClass('bg-blue-600 hover:bg-blue-700')
            .addClass('bg-yellow-500 hover:bg-yellow-600');

        $.ajax({
            url: `/api/airports/${airportId}`,
            type: 'GET',
            success: function (airport) {
                $form.find('#airport_iata_code').val(airport.code_iata);
                $form.find('#airport_name').val(airport.name);
                $form.find('#airport_location_autocomplete').val(airport.location);

                $modalTitle.text("Modifier l'Aéroport");
                $form.attr('data-mode', 'edit').attr('data-airport-id', airportId);
                $modal.removeClass('hidden').addClass('flex');
            },
            error: function (xhr) {
                alert(`Erreur : ${xhr.responseJSON?.message || xhr.statusText}`);
            }
        });
    }

    function closeModal() {
        $modal.addClass('hidden').removeClass('flex');
    }

    function refreshAirportTable() {
        $.ajax({
            url: '/api/airports',
            type: 'GET',
            success: function (airports) {
                $airportTableBody.empty();

                if (airports.length > 0) {
                    airports.forEach(function (airport) {
                        $airportTableBody.append(`
                            <tr class="border-b border-gray-700 hover:bg-gray-700">
                                <td class="px-4 py-3">${airport.code_iata}</td>
                                <td class="px-4 py-3">${airport.name}</td>
                                <td class="px-4 py-3">${airport.location}</td>
                                <td class="px-4 py-3 flex space-x-2">
                                    <button class="edit-airport-button text-yellow-400 hover:text-yellow-300" data-id="${airport.id}">✏️</button>
                                    <button class="delete-airport-button text-red-500 hover:text-red-400" data-id="${airport.id}">🗑️</button>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    $airportTableBody.append('<tr><td colspan="4" class="text-center text-gray-400">Aucun aéroport trouvé.</td></tr>');
                }
            },
            error: function () {
                alert('Erreur lors du chargement des aéroports.');
                $airportTableBody.html('<tr><td colspan="4" class="text-center text-red-400">Erreur lors du chargement.</td></tr>');
            }
        });
    }

    $('#open-add-airport-modal').on('click', openAddModal);

    $airportTableBody.on('click', '.edit-airport-button', function () {
        openEditModal($(this).data('id'));
    });

    $form.on('submit', function (e) {
        e.preventDefault();

        const mode = $form.attr('data-mode');
        const airportId = $form.attr('data-airport-id');
        let url = '/api/airports';
        let method = 'POST';

        if (mode === 'edit' && airportId) {
            url = `/api/airports/${airportId}`;
            method = 'POST';
        }

        const formData = new FormData(this);
        if (mode === 'edit') formData.append('_method', 'PUT');

        $('#save-airport-button').prop('disabled', true).text('Enregistrement...');

        $.ajax({
            url: url,
            type: method,
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                alert(response.message || 'Opération réussie !');
                closeModal();
                refreshAirportTable();
            },
            error: function (xhr) {
                let errorMessage = xhr.responseJSON?.message || 'Une erreur est survenue.';
                if (xhr.status === 422 && xhr.responseJSON.errors) {
                    errorMessage += '\n' + Object.values(xhr.responseJSON.errors).join('\n');
                }
                alert(errorMessage);
            },
            complete: function () {
                $('#save-airport-button').prop('disabled', false).text('Enregistrer');
            }
        });
    });

    $airportTableBody.on('click', '.delete-airport-button', function () {
        const airportId = $(this).data('id');
        if (confirm('Êtes-vous sûr de vouloir supprimer cet aéroport ?')) {
            $.ajax({
                url: `/api/airports/${airportId}`,
                type: 'POST',
                data: { _method: 'DELETE' },
                success: function (response) {
                    alert(response.message || 'Aéroport supprimé avec succès!');
                    refreshAirportTable();
                },
                error: function (xhr) {
                    alert(`Erreur : ${xhr.responseJSON?.message || xhr.statusText}`);
                }
            });
        }
    });

    refreshAirportTable();
});
</script> -->


<script>
$(document).ready(function() {
    // === Configuration Globale AJAX (pour inclure le token CSRF si besoin) ===
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Assure-toi d'avoir <meta name="csrf-token" content="{{ csrf_token() }}"> dans ton <head>
        }
    });

    // === Récupération des éléments du DOM pour les AÉROPORTS ===
    const $airportModal = $('#airport-modal');               // Le modal (popup) contenant le formulaire aéroport
    const $airportForm = $('#airport-form');                 // Le formulaire pour ajouter/modifier un aéroport
    const $airportModalTitle = $('#airport-modal-title');    // Le titre du modal aéroport
    const $airportTableBody = $('#airport-table-body');       // Le corps du tableau contenant la liste des aéroports
    const $locationInput = $('#airport_location_autocomplete'); // Input spécifique pour l'autocomplete (si on doit le reset)
    const $suggestionsContainer = $('#location-suggestions'); // Conteneur des suggestions

    // === Fonction pour ouvrir le modal aéroport en mode ajout ===
    function openAddAirportModal() {
        $('#save-airport-button').text('Enregistrer')
            .removeClass('bg-yellow-500 hover:bg-yellow-600') // Assure que les classes d'édition sont retirées
            .addClass('bg-blue-600 hover:bg-blue-700');

        // Réinitialiser le formulaire et définir les attributs de mode
        $airportForm[0].reset();
        $airportModalTitle.text('Ajouter un Aéroport');
        $airportForm.attr('data-mode', 'add').removeAttr('data-airport-id'); // Utilise data-airport-id
        $suggestionsContainer.addClass('hidden').empty(); // Cache les suggestions

        // Afficher le modal
        $airportModal.removeClass('hidden').addClass('flex');
    }

    // === Fonction pour ouvrir le modal aéroport en mode édition ===
    function openEditAirportModal(airportId) {
        $('#save-airport-button').text('Modifier')
            .removeClass('bg-blue-600 hover:bg-blue-700')
            .addClass('bg-yellow-500 hover:bg-yellow-600'); // Style pour l'édition

        // Récupérer les données de l'aéroport via AJAX
        $.ajax({
            url: `/api/airports/${airportId}`, // URL API pour un aéroport spécifique
            type: 'GET',
            success: function(airport) {
                // Remplir les champs du formulaire avec les données existantes
                $airportForm.find('#airport_id').val(airport.id); // Si tu as un champ caché pour l'ID
                $airportForm.find('#airport_iata_code').val(airport.code_iata);
                $airportForm.find('#airport_name').val(airport.name);
                $airportForm.find('#airport_location_autocomplete').val(airport.location); // Utilise le champ autocomplete

                // Mettre à jour le titre et les attributs du formulaire
                $airportModalTitle.text('Modifier l\'Aéroport');
                $airportForm.attr('data-mode', 'edit').attr('data-airport-id', airportId);
                $suggestionsContainer.addClass('hidden').empty(); // Cache les suggestions

                // Afficher le modal
                $airportModal.removeClass('hidden').addClass('flex');
            },
            error: function(xhr) {
                // Gérer les erreurs si les données ne peuvent pas être chargées
                alert(`Erreur : Impossible de charger les données de l'aéroport. ${xhr.responseJSON?.message || xhr.statusText}`);
            }
        });
    }

    // === Fonction pour fermer le modal aéroport ===
    function closeAirportModal() {
        $airportModal.addClass('hidden').removeClass('flex');
        $suggestionsContainer.addClass('hidden').empty(); // Assure que les suggestions sont cachées à la fermeture
    }

    // === Fonction pour recharger les aéroports depuis l'API et mettre à jour le tableau ===
    function refreshAirportTable() {
        $.ajax({
            url: '/api/airports', // URL API pour la liste des aéroports
            type: 'GET',
            success: function(airports) {
                $airportTableBody.empty(); // Vider le tableau actuel

                // Vérifier s’il y a des aéroports à afficher
                if (airports && airports.length > 0) {
                    airports.forEach(function(airport) {
                        // Ajouter une ligne dans le tableau avec les données de l'aéroport
                        // Assure-toi que les classes et data-id sont corrects sur les boutons
                        $airportTableBody.append(`
                            <tr class="bg-navy border-b border-gray-700 hover:bg-navy-light">
                                <td class="py-4 px-6 font-medium text-white whitespace-nowrap">${airport.code_iata}</td>
                                <td class="py-4 px-6">${airport.name}</td>
                                <td class="py-4 px-6">${airport.location}</td>
                                <td class="py-4 px-6 flex space-x-2">
                                    <!-- Bouton de modification -->
                                    <button class="edit-airport-button text-yellow-400 hover:text-yellow-300" title="Modifier" data-id="${airport.id}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                             <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </button>

                                    <!-- Bouton de suppression -->
                                    <button class="delete-airport-button text-red-500 hover:text-red-400" title="Supprimer" data-id="${airport.id}">
                                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    // Message si aucun aéroport trouvé
                    const numberOfColumns = $airportTableBody.closest('table').find('thead th').length;
                    $airportTableBody.append(`<tr><td colspan="${numberOfColumns}" class="text-center py-4 text-gray-400">Aucun aéroport trouvé.</td></tr>`);
                }
            },
            error: function(xhr) {
                // Gérer les erreurs de récupération
                alert('Erreur lors du rafraîchissement de la liste des aéroports.');
                const numberOfColumns = $airportTableBody.closest('table').find('thead th').length;
                $airportTableBody.html(`<tr><td colspan="${numberOfColumns}" class="text-center py-4 text-red-400">Erreur lors du chargement des données. ${xhr.statusText}</td></tr>`);
            }
        });
    }

    // === Fonction pour mettre la première lettre en majuscule (si nécessaire) ===
    // function ucfirst(string) {
    //     if (!string) return '';
    //     return string.charAt(0).toUpperCase() + string.slice(1);
    // }

    // === Écouteurs d'événements pour les AÉROPORTS ===

    // Ouvrir le modal pour ajouter un aéroport
    $('#open-add-airport-modal').on('click', openAddAirportModal);

    // Fermer le modal (pour les boutons Annuler/Croix)
    // Cible tous les éléments avec la classe 'close-modal' DANS les modals aéroport
    $airportModal.on('click', '.close-modal', closeAirportModal);
     // Fermer aussi si on clique sur le fond (backdrop)
    $airportModal.on('click', function(event) {
        if ($(event.target).is($airportModal)) {
            closeAirportModal();
        }
    });


    // Ouvrir le modal pour modifier un aéroport (utilisation de la délégation d'événement)
    $airportTableBody.on('click', '.edit-airport-button', function() {
        const airportId = $(this).data('id'); // Récupère l'ID depuis data-id du bouton
        openEditAirportModal(airportId);
    });

    // Soumission du formulaire aéroport (ajout ou modification)
    $airportForm.on('submit', function(e) {
        e.preventDefault(); // Empêche la soumission HTML classique

        const mode = $airportForm.attr('data-mode');           // 'add' ou 'edit'
        const airportId = $airportForm.attr('data-airport-id'); // ID de l'aéroport (si édition)
        let url = '/api/airports';                             // URL par défaut pour la création
        let method = 'POST';                                   // Méthode HTTP par défaut

        // Modifier l’URL et préparer la méthode si c’est une édition
        if (mode === 'edit' && airportId) {
            url = `/api/airports/${airportId}`;
            // On utilisera FormData qui inclura le champ _method=PUT
        }

        // Créer un FormData pour envoyer les données (gère aussi le token CSRF via @csrf dans le form)
        const formData = new FormData(this);
        if (mode === 'edit') {
            formData.append('_method', 'PUT'); // Simuler un PUT pour Laravel
        }

        const $saveButton = $('#save-airport-button');
        const originalButtonText = (mode === 'edit' ? 'Modifier' : 'Enregistrer');

        // Désactiver le bouton pendant l’enregistrement
        $saveButton.prop('disabled', true).text('Enregistrement...');

        // Envoi AJAX
        $.ajax({
            url: url,
            type: 'POST', // Toujours POST car on utilise FormData et _method pour PUT
            data: formData,
            processData: false, // Important pour FormData
            contentType: false, // Important pour FormData
            success: function(response) {
                // Utilise le message de la réponse si disponible, sinon un message par défaut
                alert(response.message || (mode === 'edit' ? 'Aéroport mis à jour avec succès!' : 'Aéroport ajouté avec succès!'));
                closeAirportModal();      // Fermer le modal
                refreshAirportTable();    // Recharger la liste
            },
            error: function(xhr) {
                let errorMessage = "Une erreur est survenue.";
                if (xhr.responseJSON) {
                    errorMessage = xhr.responseJSON.message || errorMessage;
                    if (xhr.status === 422 && xhr.responseJSON.errors) {
                        // Afficher les messages d’erreur de validation
                        const errors = Object.values(xhr.responseJSON.errors).map(err => `- ${err[0]}`).join('\n');
                        errorMessage += '\n\nErreurs de validation:\n' + errors;
                    }
                } else {
                    errorMessage = `Erreur ${xhr.status}: ${xhr.statusText}`;
                }
                alert(errorMessage);
            },
            complete: function() {
                // Réactiver le bouton après l’appel AJAX
                $saveButton.prop('disabled', false).text(originalButtonText);
            }
        });
    });

    // === Suppression d’un aéroport (utilisation de la délégation d'événement) ===
    $airportTableBody.on('click', '.delete-airport-button', function() {
        const airportId = $(this).data('id'); // Récupère l'ID depuis data-id du bouton
        const $row = $(this).closest('tr'); // Garde une référence à la ligne pour la supprimer visuellement si succès

        // Demande de confirmation
        if (confirm('Êtes-vous sûr de vouloir supprimer cet aéroport ?')) {
            $.ajax({
                url: `/api/airports/${airportId}`,
                type: 'POST', // Utilise POST pour envoyer _method
                data: {
                    _method: 'DELETE',
                    // Le token CSRF est géré globalement par $.ajaxSetup
                },
                success: function(response) {
                     alert(response.message || 'Aéroport supprimé avec succès!');
                    // Option 1: Recharger toute la table (plus simple)
                    refreshAirportTable();
                    // Option 2: Supprimer juste la ligne (plus rapide visuellement)
                    // $row.fadeOut(300, function() { $(this).remove(); });
                },
                error: function(xhr) {
                   alert(`Erreur : Impossible de supprimer l'aéroport. ${xhr.responseJSON?.message || xhr.statusText}`);
                }
            });
        }
    });

    // === Charger la liste des aéroports au chargement initial de la page ===
    refreshAirportTable();

});
</script>
