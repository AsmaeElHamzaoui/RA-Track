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
                <input type="text" id="airport_iata_code" name="code_iata" class="w-full bg-navy border border-gray-600 rounded px-3 py-2 text-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="Ex: CDG" maxlength="3" required>
            </div>

            <div class="mb-4">
                <label for="airport_name" class="block text-sm font-medium text-gray-300 mb-1">Nom de l'aéroport</label>
                <input type="text" id="airport_name" name="name" class="w-full bg-navy border border-gray-600 rounded px-3 py-2 text-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="Ex: Paris Charles de Gaulle" required>
            </div>

            <!-- Champ Localisation avec Autocomplete -->
            <div class="mb-4 relative">
                <label for="airport_location_autocomplete" class="block text-sm font-medium text-gray-300 mb-1">Localisation (Ville, Pays)</label>
                <input type="text" id="airport_location_autocomplete" name="location" class="w-full bg-navy border border-gray-600 rounded px-3 py-2 text-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="Commencez à taper (ex: Paris...)" required autocomplete="off">
                <div id="location-suggestions" class="absolute z-10 w-full bg-navy-light border border-gray-600 rounded-b mt-1 max-h-48 overflow-y-auto hidden"></div>
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


<script>
    document.addEventListener('DOMContentLoaded', () => {
    // --- Airport Location Autocomplete Script ---

    const locationInput = document.getElementById('airport_location_autocomplete');
    const suggestionsContainer = document.getElementById('location-suggestions');

    // !! Autocomplete Data Source (Example) !!
    // Replace with dynamic data fetching (API/Backend) in a real application.
    const locationsData = [
        "Paris, France", "London, United Kingdom", "New York, USA", "Tokyo, Japan",
        "Dubai, UAE", "Berlin, Germany", "Rome, Italy", "Madrid, Spain",
        "Los Angeles, USA", "Chicago, USA", "Singapore, Singapore", "Sydney, Australia",
        "Toronto, Canada", "Vancouver, Canada", "Mexico City, Mexico", "Sao Paulo, Brazil",
        "Buenos Aires, Argentina", "Moscow, Russia", "Beijing, China", "Shanghai, China",
        "Mumbai, India", "Delhi, India", "Cairo, Egypt", "Johannesburg, South Africa"
        // Add more relevant locations
    ];

    if (locationInput && suggestionsContainer) {
        // Event listener for typing in the input field
        locationInput.addEventListener('input', function() {
            const inputText = this.value.toLowerCase().trim();
            suggestionsContainer.innerHTML = ''; // Clear previous suggestions
            suggestionsContainer.classList.add('hidden'); // Hide by default

            if (inputText.length > 0) { // Start suggesting after at least one character
                // Filter the data based on the input text
                const filteredLocations = locationsData.filter(location =>
                    location.toLowerCase().includes(inputText)
                );

                // Display filtered suggestions
                if (filteredLocations.length > 0) {
                    filteredLocations.forEach(location => {
                        const suggestionDiv = document.createElement('div');
                        suggestionDiv.textContent = location;
                        // Apply Tailwind classes for styling suggestions
                        suggestionDiv.className = 'px-3 py-2 text-sm text-gray-200 hover:bg-navy cursor-pointer';

                        // Event listener for clicking on a suggestion
                        suggestionDiv.addEventListener('click', () => {
                            locationInput.value = location; // Fill input with selected suggestion
                            suggestionsContainer.innerHTML = ''; // Clear suggestions
                            suggestionsContainer.classList.add('hidden'); // Hide container
                        });

                        suggestionsContainer.appendChild(suggestionDiv);
                    });
                    suggestionsContainer.classList.remove('hidden'); // Show container if there are suggestions
                }
            }
        });

        // Event listener to hide suggestions when the input loses focus
        locationInput.addEventListener('blur', () => {
            // Use a short delay to allow click event on suggestion to register first
            setTimeout(() => {
                suggestionsContainer.classList.add('hidden');
            }, 150); // Adjust delay if needed
        });

    } else {
        // Log a warning if the required HTML elements are not found
        console.warn("Autocomplete elements not found (#airport_location_autocomplete or #location-suggestions). Autocomplete will not function.");
    }

    // --- End Airport Location Autocomplete Script ---
});
</script>


<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script>
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
          $form.find('#airport_code').val(airport.code);
          $form.find('#airport_name').val(airport.name);
          $form.find('#airport_city').val(airport.city);
          $form.find('#airport_country').val(airport.country);
          $form.find('#airport_status').val(airport.status);

          $modalTitle.text('Modifier l\'Aéroport');
          $form.attr('data-mode', 'edit').attr('data-airport-id', airportId);
          $modal.removeClass('hidden').addClass('flex');
        },
        error: function (xhr) {
          alert(`Erreur : Impossible de charger les données de l'aéroport. ${xhr.responseJSON?.message || xhr.statusText}`);
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
              let statusClass = '';
              let statusText = ucfirst(airport.status.replace('_', ' '));

              switch (airport.status) {
                case 'open':
                  statusClass = 'bg-green-600 text-green-100';
                  break;
                case 'closed':
                  statusClass = 'bg-red-600 text-red-100';
                  break;
                default:
                  statusClass = 'bg-gray-600 text-gray-100';
              }

              $airportTableBody.append(`
                <tr class="border-b border-gray-700 hover:bg-gray-700">
                  <td class="px-4 py-3">${airport.code}</td>
                  <td class="px-4 py-3">${airport.name}</td>
                  <td class="px-4 py-3">${airport.city}, ${airport.country}</td>
                  <td class="px-4 py-3">
                    <span class="px-2 py-1 text-xs font-medium rounded-full ${statusClass}">
                      ${statusText}
                    </span>
                  </td>
                  <td class="px-4 py-3 flex space-x-2">
                    <button class="edit-airport-button text-yellow-400 hover:text-yellow-300" data-id="${airport.id}">✏️</button>
                    <button class="delete-airport-button text-red-500 hover:text-red-400" data-id="${airport.id}">🗑️</button>
                  </td>
                </tr>
              `);
            });
          } else {
            $airportTableBody.append('<tr><td colspan="5" class="text-center text-gray-400">Aucun aéroport trouvé.</td></tr>');
          }
        },
        error: function () {
          alert('Erreur lors du rafraîchissement de la liste des aéroports.');
          $airportTableBody.html('<tr><td colspan="5" class="text-center text-red-400">Erreur lors du chargement.</td></tr>');
        }
      });
    }

    function ucfirst(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
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
</script>
