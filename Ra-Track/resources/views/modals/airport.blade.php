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



