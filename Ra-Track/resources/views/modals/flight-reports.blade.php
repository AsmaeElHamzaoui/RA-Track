 <!-- Modal Body/Form -->
 <form id="add-report-form" action="{{ route('flight-reports.store') }}" method="POST">
     <div class="mb-4">
         <label for="flight-select" class="block text-sm font-medium text-gray-700 mb-1">Assigned Flight</label>
         <select id="flight-select" name="flight_id" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
             <option value="">Select a flight...</option>
             @foreach($flightsREs as $flightRE)
             <option value="{{ $flightRE->id }}">{{ $flightRE->flight_number }}</option>
             @endforeach
         </select>
     </div>
     <div class="mb-4">
         <label for="report-comment" class="block text-sm font-medium text-gray-700 mb-1">Comment</label>
         <textarea id="report-comment" name="comment" rows="3" required class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Add any relevant comments..."></textarea>
     </div>
     <div class="mb-6">
         <label for="report-file" class="block text-sm font-medium text-gray-700 mb-1">Upload Report (PDF)</label>
         <input type="file" id="report-file" name="reportFile" required accept=".pdf" class="mt-1 block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-md file:border-0
                        file:text-sm file:font-semibold
                        file:bg-blue-50 file:text-blue-700
                        hover:file:bg-blue-100
                        focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500
                     " />
         <p class="mt-1 text-xs text-gray-500">Only PDF files are accepted.</p>
     </div>
     
     <div class="flex justify-end space-x-3 border-t pt-4">
         <button type="button" id="cancel-modal-btn" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">Cancel</button>
         <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save Report</button>
     </div>
 </form>
 <div id="reports-list" class="space-y-4 mt-4">
</div>
<script>
$(document).ready(function () {
    // Configuration CSRF pour Laravel
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // 🔁 Fonction pour recharger les rapports
    function loadReports() {
        $.get('/flight-reports', function (data) {
            $('#reports-list').html('');
            data.reports.forEach(report => {
                $('#reports-list').append(`
                    <div class="bg-white p-4 rounded shadow flex justify-between items-center">
                        <div>
                            <p><strong>Vol:</strong> ${report.flight_number}</p>
                            <p><strong>Commentaire:</strong> ${report.comment}</p>
                            <p><a href="/storage/${report.report_path}" target="_blank" class="text-blue-600 underline">Voir PDF</a></p>
                        </div>
                        <div class="flex space-x-2">
                            <button class="edit-btn bg-yellow-400 px-3 py-1 rounded text-white" data-id="${report.id}">Modifier</button>
                            <button class="delete-btn bg-red-500 px-3 py-1 rounded text-white" data-id="${report.id}">Supprimer</button>
                        </div>
                    </div>
                `);
            });
        });
    }

    // 🟢 Soumission du formulaire d'ajout
    $('#add-report-form').on('submit', function (e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: '/flight-reports',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function () {
                alert('Rapport ajouté !');
                $('#add-report-form')[0].reset();
                $('#modal-id').hide(); // adapte à ton ID de modal
                loadReports();
            },
            error: function (xhr) {
                alert('Erreur lors de l’ajout');
                console.error(xhr.responseText);
            }
        });
    });

    // 🔴 Suppression d’un rapport
    $(document).on('click', '.delete-btn', function () {
        if (!confirm('Voulez-vous vraiment supprimer ce rapport ?')) return;

        const id = $(this).data('id');
        $.ajax({
            url: `/flight-reports/${id}`,
            type: 'DELETE',
            success: function () {
                alert('Rapport supprimé !');
                loadReports();
            },
            error: function (xhr) {
                alert('Erreur lors de la suppression');
                console.error(xhr.responseText);
            }
        });
    });

    // ✏️ Chargement des données pour modification
    $(document).on('click', '.edit-btn', function () {
        const id = $(this).data('id');
        $.get(`/flight-reports/${id}`, function (data) {
            $('#flight-select').val(data.flight_id);
            $('#report-comment').val(data.comment);
            $('#add-report-form').attr('action', `/flight-reports/${id}`);
            $('#add-report-form').attr('method', 'POST');
            $('#add-report-form').append('<input type="hidden" name="_method" value="PUT">');
            $('#modal-id').show(); // adapte à ton ID modal
        });
    });

    // 🌀 Initialisation
    loadReports();
});
</script>



