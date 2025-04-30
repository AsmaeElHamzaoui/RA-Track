<!-- Modal Body/Form -->
<form id="formAddReport" action="{{ route('flight-reports.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="_method" id="form-method" value="POST">
    
    <div class="mb-4">
        <label for="flight-select" class="block text-sm font-medium text-gray-700 mb-1">Assigned Flight</label>
        <select id="flight-select" name="flight_id" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value="">Select a flight...</option>
            @foreach($flights as $flight)
                <option value="{{ $flight->id }}">{{ $flight->flight_number }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="mb-4">
        <label for="report-comment" class="block text-sm font-medium text-gray-700 mb-1">Comment</label>
        <textarea id="report-comment" name="comment" rows="3" required class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Add any relevant comments..."></textarea>
    </div>
    
    <div class="mb-6">
        <label for="report-file" class="block text-sm font-medium text-gray-700 mb-1">Upload Report (PDF)</label>
        <input type="file" id="report-file" name="reportFile" accept=".pdf" class="mt-1 block w-full text-sm text-gray-500
            file:mr-4 file:py-2 file:px-4
            file:rounded-md file:border-0
            file:text-sm file:font-semibold
            file:bg-blue-50 file:text-blue-700
            hover:file:bg-blue-100
            focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        <p class="mt-1 text-xs text-gray-500" id="file-help-text">Only PDF files are accepted.</p>
        <div id="current-file" class="mt-1 text-xs text-blue-600 hidden">
            Current file: <span id="current-file-name"></span>
        </div>
    </div>

    <div class="flex justify-end space-x-3 border-t pt-4">
        <button type="button" id="cancel-modal-btn" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">Cancel</button>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700" id="submit-btn">Save Report</button>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Gestion du modal
    function resetForm() {
        $('#formAddReport')[0].reset();
        $('#formAddReport').attr('action', '{{ route("flight-reports.store") }}');
        $('#form-method').val('POST');
        $('#submit-btn').text('Save Report');
        $('#modal-title').text('Add Flight Report');
        $('#current-file').addClass('hidden');
        $('#report-file').prop('required', true);
        $('#file-help-text').show();
    }
    
    
    // Ouvrir le modal pour ajout
    $('#add-report-btn').click(function() {
        resetForm();
        $('#add-report-modal').removeClass('hidden');
    });

    // Ouvrir le modal pour modification
    $(document).on('click', '.edit-report-btn', function() {
        const reportId = $(this).data('id');
        const flightId = $(this).data('flight-id');
        const comment = $(this).data('comment');
        const fileName = $(this).data('file-name');

        // Préremplir le formulaire
        $('#flight-select').val(flightId);
        $('#report-comment').val(comment);
        
        // Mettre à jour l'action et la méthode du formulaire
        $('#formAddReport').attr('action', '/flight-reports/' + reportId);
        $('#form-method').val('PUT');
        $('#submit-btn').text('Update Report');
        $('#modal-title').text('Edit Flight Report');
        
        // Afficher le fichier actuel
        if (fileName) {
            $('#current-file').removeClass('hidden');
            $('#current-file-name').text(fileName);
            $('#report-file').prop('required', false);
            $('#file-help-text').hide();
        }
        
        // Ouvrir le modal
        $('#add-report-modal').removeClass('hidden');
    });

    // Fermer le modal
    $('#close-modal-btn, #cancel-modal-btn').click(function() {
        $('#add-report-modal').addClass('hidden');
    });
     
    // Soumission du formulaire (AJAX)
    $('#formAddReport').on('submit', function(e) {
        e.preventDefault();
        
        let form = $(this)[0];
        let formData = new FormData(form);
        let url = form.action;
        let method = $('#form-method').val();
        
        $.ajax({
            url: url,
            type: method === 'PUT' ? 'POST' : 'POST', // Laravel nécessite POST avec _method=PUT
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert(response.message);
                $('#add-report-modal').addClass('hidden');
                location.reload(); // Rafraîchir la page pour voir les changements
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                let errorMessages = [];
                
                for (let field in errors) {
                    errorMessages.push(errors[field][0]);
                }
                
                alert("Error: " + errorMessages.join("\n"));
            }
        });
    });

    
    
  });
</script>
 