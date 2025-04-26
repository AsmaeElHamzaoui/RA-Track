 <!-- ==================== Section Utilisateurs ==================== -->
 <div id="reservations-content" class="content-section hidden">
     <div class="flex justify-between items-center mb-6">
         <h3 class="text-xl font-semibold">Gestion des réservations</h3>
     </div>
     <section class="bg-navy-light p-4 rounded-lg shadow-md">
         <h4 class="text-lg font-semibold mb-4">Liste des réservations</h4>
         <div class="overflow-x-auto">
             <table class="w-full text-sm text-left">
                 <thead class="text-xs text-gray-400 uppercase border-b border-gray-700">
                     <tr>
                         <th scope="col" class="px-4 py-3">Nom</th>
                         <th scope="col" class="px-4 py-3">Vol</th>
                         <th scope="col" class="px-4 py-3">Aéaroport départ</th>
                         <th scope="col" class="px-4 py-3">Aéaroport d'arrivé</th>
                         <th scope="col" class="px-4 py-3">Class</th>
                         <th scope="col" class="px-4 py-3">Temps de réservation</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach($reservations as $reservation)
                     <tr class="border-b border-gray-700 hover:bg-gray-700">
                         <td class="px-4 py-3 font-medium whitespace-nowrap flex items-center space-x-2">
                             <span>{{ $reservation->user->name }}</span>
                         </td>
                         <td class="px-4 py-3">{{ $reservation->flight->flight_number }}</td>
                         <td class="px-4 py-3">{{ $reservation->flight->departureAirport->name }}</td>
                         <td class="px-4 py-3">{{ $reservation->flight->arrivalAirport->name }}</td>
                         <td class="px-4 py-3">{{ $reservation->class }}</td>
                         <td class="px-4 py-3">{{ $reservation->created_at }}</td>
                         <td class="px-4 py-3 flex space-x-2">
                             <button class="text-yellow-400 hover:text-yellow-300" title="Modifier">
                                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                     <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                 </svg>
                             </button>
                             <button class="text-red-500 hover:text-red-400" title="Supprimer">
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