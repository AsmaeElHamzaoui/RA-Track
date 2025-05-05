 <!-- ==================== Section Utilisateurs ==================== -->
 <div id="payments-content" class="content-section hidden">
     <section class="bg-slate-900/70 backdrop-blur-sm p-4 rounded-lg shadow-md">
         <div class="flex justify-between items-center mb-6">
             <h3 class="text-xl font-semibold">Gestion des payments</h3>
         </div>
         <div class="overflow-x-auto">
             <table class="w-full text-sm text-left">
                 <thead class="text-xs text-gray-400 uppercase border-b border-gray-700">
                     <tr>
                         <th scope="col" class="px-4 py-3" style="color:#FFD476;">Nom</th>
                         <th scope="col" class="px-4 py-3" style="color:#FFD476;">Vol</th>
                         <th scope="col" class="px-4 py-3" style="color:#FFD476;">Payment method</th>
                         <th scope="col" class="px-4 py-3" style="color:#FFD476;">Payment date</th>
                         <th scope="col" class="px-4 py-3" style="color:#FFD476;">Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach($payments as $payment)
                     <tr class="border-b border-gray-700 hover:bg-gray-700">
                         <td class="px-4 py-3 font-medium whitespace-nowrap flex items-center space-x-2">
                             <span>{{ $payment->reservation->user->name }}</span>
                         </td>
                         <td class="px-4 py-3">{{ $payment->reservation->flight->flight_number }}</td>
                         <td class="px-4 py-3">{{ $payment->payment_method }}</td>
                         <td class="px-4 py-3">{{ $payment->payment_date }}</td>
                         <td class="px-4 py-3 flex space-x-2">
                             <button class="text-gray-900 hover:text-yellow-200 delete-payment"
                                 title="Supprimer"
                                 data-payment-id="{{ $payment->id }}">
                                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                     <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                 </svg>
                             </button>
                         </td>
                     </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>
     </section>
 </div>

 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

 <script>
     $(document).ready(function() {
         // Lorsque le bouton de suppression est cliqué
         $('.delete-payment').on('click', function(e) {
             e.preventDefault(); // Empêche l'action par défaut du bouton

             // Récupérer l'ID du paiement à supprimer à partir de l'élément cliqué
             var paymentId = $(this).data('payment-id');

             // Confirmer la suppression via une boîte de dialogue
             if (confirm('Êtes-vous sûr de vouloir supprimer ce paiement ?')) {
                 // Effectuer la requête AJAX pour supprimer le paiement
                 $.ajax({
                     url: '/payments/' + paymentId, // L'URL de l'API de suppression
                     type: 'DELETE',
                     data: {
                         _token: '{{ csrf_token() }}', // Assurez-vous d'ajouter le token CSRF
                     },
                     success: function(response) {
                         if (response.status === 'success') {
                             // Supprimer la ligne du tableau
                             $('tr[data-payment-id="' + paymentId + '"]').remove();
                             alert('Paiement supprimé avec succès.');
                         } else {
                             alert('Une erreur est survenue lors de la suppression du paiement.');
                         }
                     },
                     error: function(xhr, status, error) {
                         alert('Une erreur est survenue. Veuillez réessayer.');
                     }
                 });
             }
         });
     });
 </script>