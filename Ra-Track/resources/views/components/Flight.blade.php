<!-- ==================== SECTION GESTION DES VOLS ==================== -->
<div id="flights-content" class="content-section hidden">
   
    <section class="bg-slate-900/70 backdrop-blur-sm p-4 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-semibold">Gestion des Vols</h3>
        {{-- Bouton pour ouvrir le modal d'ajout de vol --}}
        <button id="open-add-flight-modal" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center" style="color: #162238; border: 1px solid #FFD476;background: #FFD476;
                                    box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    5px 5px 15px rgba(0, 0, 0, 0.35),
                                    inset -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    inset 5px 5px 15px rgba(0, 0, 0, 0.35);">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Ajouter un Vol
        </button>
    </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-400 uppercase border-b border-gray-700">
                    <tr>
                        <th scope="col" class="px-4 py-3" style="color:#FFD476;">N° Vol</th>
                        <th scope="col" class="px-4 py-3" style="color:#FFD476;">Départ</th>
                        <th scope="col" class="px-4 py-3" style="color:#FFD476;">Arrivée</th>
                        <th scope="col" class="px-4 py-3" style="color:#FFD476;">Avion</th>
                        <th scope="col" class="px-4 py-3" style="color:#FFD476;">Statut</th>
                        <th scope="col" class="px-4 py-3" style="color:#FFD476;">Actions</th>
                    </tr>
                </thead>
                <tbody id="flight-table-body"> {{-- ID est toujours nécessaire pour les màj AJAX --}}
                    @forelse($flights as $flight)
                        <tr class="border-b border-gray-700 hover:bg-gray-700">
                            <td class="px-4 py-3 font-medium whitespace-nowrap">{{ $flight->flight_number }}</td>
                            <td class="px-4 py-3">
                                {{-- Affiche le code IATA de l'aéroport de départ et l'heure formatée --}}
                                {{ $flight->departureAirport?->iata_code ?? 'N/A' }}
                                @if($flight->departure_time)
                                    ({{ \Carbon\Carbon::parse($flight->departure_time)->format('d/m/y H:i') }})
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                {{-- Affiche le code IATA de l'aéroport d'arrivée et l'heure formatée --}}
                                {{ $flight->arrivalAirport?->iata_code ?? 'N/A' }}
                                @if($flight->arrival_time)
                                    ({{ \Carbon\Carbon::parse($flight->arrival_time)->format('d/m/y H:i') }})
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                {{-- Affiche l'immatriculation de l'avion --}}
                                {{ $flight->plane?->registration ?? 'N/A' }}
                            </td>
                            <td class="px-4 py-3">
                                {{-- Affiche le statut avec un badge coloré --}}
                                <span class="px-2 py-1 text-xs font-medium rounded-full whitespace-nowrap
                                    @switch($flight->status)
                                        @case('scheduled') bg-blue-600 text-blue-100 @break
                                        @case('in_progress') bg-teal-600 text-teal-100 @break
                                        @case('completed') bg-green-600 text-green-100 @break
                                        @case('delayed') bg-yellow-600 text-yellow-100 @break
                                        @case('cancelled') bg-red-600 text-red-100 @break
                                        @default bg-gray-600 text-gray-100 @break
                                    @endswitch
                                ">
                                    {{ ucfirst(str_replace('_', ' ', $flight->status ?? 'Inconnu')) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 flex space-x-2">
                                {{-- Bouton Modifier avec classe et data-id pour JS --}}
                                <button class="edit-flight-button text-yellow-400 hover:text-yellow-200" title="Modifier" data-id="{{ $flight->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </button>
                                {{-- Bouton Supprimer avec classe et data-id pour JS --}}
                                <button class="delete-flight-button text-red-500 hover:text-red-400" title="Supprimer" data-id="{{ $flight->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        {{-- Message si aucun vol n'est trouvé --}}
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-400">Aucun vol trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
<!-- ==================== FIN SECTION GESTION DES VOLS ==================== -->