<!-- ==================== SECTION GESTION DES AÉROPORTS ==================== -->
<div id="airports-content" class="content-section hidden bg-slate-900/70 backdrop-blur-sm p-6 rounded-lg shadow-lg">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-semibold text-white">Gestion des Aéroports</h3>
        {{-- Bouton pour ouvrir le modal d'ajout d'aéroport --}}
        <button id="open-add-airport-modal" class="font-bold py-2 px-4 rounded inline-flex items-center" style="color: #162238; border: 1px solid #FFD476;background: #FFD476;
                                    box-shadow: -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    5px 5px 15px rgba(0, 0, 0, 0.35),
                                    inset -5px -5px 15px rgba(255, 255, 255, 0.1),
                                    inset 5px 5px 15px rgba(0, 0, 0, 0.35);">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Ajouter un Aéroport
        </button>
    </div>

    <section>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-400">
                <thead class="text-xs text-gray-300 uppercase">
                    <tr>
                        <th scope="col" class="py-3 px-6" style="color:#FFD476;">Code IATA</th>
                        <th scope="col" class="py-3 px-6" style="color:#FFD476;">Nom Aéroport</th>
                        <th scope="col" class="py-3 px-6" style="color:#FFD476;">Localisation</th>
                        <th scope="col" class="py-3 px-6" style="color:#FFD476;">Actions</th>
                    </tr>
                </thead>
                {{-- ID crucial pour que le script jQuery puisse rafraîchir le contenu --}}
                <tbody id="airport-table-body">
                    {{-- Boucle pour afficher les aéroports chargés initialement côté serveur --}}
                    {{-- Sera remplacé/mis à jour par le script jQuery lors des opérations CRUD --}}
                    @isset($airports) {{-- Vérifie si la variable $airports existe --}}
                        @forelse($airports as $airport)
                            <tr class="">
                                <td class="py-4 px-6 font-medium text-white whitespace-nowrap">{{ $airport->code_iata }}</td>
                                <td class="py-4 px-6 text-white">{{ $airport->name }}</td>
                                <td class="py-4 px-6 text-white">{{ $airport->location }}</td>
                                <td class="py-4 px-6 flex space-x-2">
                                    {{-- Bouton Modifier - La classe et data-id sont utilisés par jQuery --}}
                                    <button class="edit-airport-button text-yellow-400 hover:text-yellow-300" title="Modifier" data-id="{{ $airport->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </button>
                                    {{-- Bouton Supprimer - La classe et data-id sont utilisés par jQuery --}}
                                    <button class="delete-airport-button text-red-500 hover:text-red-400" title="Supprimer" data-id="{{ $airport->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            {{-- Message si aucun aéroport n'est chargé initialement --}}
                            <tr>
                                <td colspan="4" class="text-center py-4 text-gray-500">Aucun aéroport trouvé pour le moment.</td>
                            </tr>
                        @endforelse
                    @else
                         {{-- Message si la variable $airports n'est pas passée à la vue --}}
                         <tr>
                              <td colspan="4" class="text-center py-4 text-gray-500">Chargement des aéroports...</td>
                         </tr>
                    @endisset
                </tbody>
            </table>
        </div>
    </section>
</div>
<!-- ==================== FIN SECTION GESTION DES AÉROPORTS ==================== -->