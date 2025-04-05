<!-- Modal Ajouter/Modifier Utilisateur (Structure similaire au modal Vol) -->
<div id="user-modal" class="fixed inset-0 z-50 hidden items-center justify-center modal-backdrop">
             <div class="bg-navy-light w-full max-w-md p-6 rounded-lg shadow-xl m-4">
                <div class="flex justify-between items-center mb-4">
                    <h4 id="user-modal-title" class="text-xl font-semibold">Ajouter un Utilisateur</h4>
                    <button class="close-modal text-gray-400 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                 <form id="user-form">
                    <div class="space-y-4 mb-4">
                        <div>
                            <label for="user_name" class="block text-sm font-medium text-gray-300 mb-1">Nom Complet</label>
                            <input type="text" id="user_name" name="user_name" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        </div>
                         <div>
                            <label for="user_email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                            <input type="email" id="user_email" name="user_email" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        </div>
                         <div>
                            <label for="user_password" class="block text-sm font-medium text-gray-300 mb-1">Mot de passe</label>
                            <input type="password" id="user_password" name="user_password" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                            <small class="text-gray-400 text-xs">Laisser vide pour ne pas changer lors de la modification.</small>
                        </div>
                        <div>
                            <label for="user_role" class="block text-sm font-medium text-gray-300 mb-1">Rôle</label>
                            <select id="user_role" name="user_role" class="w-full p-2 rounded bg-navy border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                                <option value="Utilisateur">Utilisateur</option>
                                <option value="Admin">Admin</option>
                                <option value="Pilote">Pilote</option> <!-- Example roles -->
                                <option value="Contrôleur">Contrôleur</option>
                            </select>
                        </div>
                    </div>
                     <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" class="close-modal px-4 py-2 rounded bg-gray-600 hover:bg-gray-700 text-white">Annuler</button>
                        <button type="submit" class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white">Enregistrer</button>
                    </div>
                </form>
             </div>
</div>