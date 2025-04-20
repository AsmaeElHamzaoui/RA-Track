
<div class="container text-white bg-dark p-4 rounded mt-4 mb-4"> {{-- Ajout mt-4 mb-4 pour espacement --}}
    <h2 class="mb-4">Détails de la réservation et Paiement</h2>

    {{-- Afficher les messages flash (erreurs, succès, info) --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
    @endif

    {{-- Vérifier si la réservation et le vol existent --}}
    @if ($reservation && $reservation->flight)
        <div class="mb-3">
            <strong>Référence:</strong> {{ $reservation->booking_reference }}<br>
            <strong>Date de réservation:</strong> {{ $reservation->created_at->format('d/m/Y H:i') }}<br>
            <strong>Classe:</strong> {{ ucfirst($reservation->class) }}<br>
            <strong>Status:</strong> <span class="badge bg-{{ $reservation->status === 'confirmed' ? 'success' : ($reservation->status === 'pending_authentication' ? 'warning' : 'secondary') }}">
                {{ ucfirst(str_replace('_', ' ', $reservation->status)) }}
            </span>
        </div>

        <h4>Détails du vol</h4>
        <div class="mb-3">
            <strong>Vol:</strong> {{ $reservation->flight->flight_number ?? 'N/A' }}<br>
            <strong>Départ:</strong> {{ optional($reservation->flight->departureAirport)->name }} ({{ optional($reservation->flight->departureAirport)->code }}) le {{ \Carbon\Carbon::parse($reservation->flight->departure_time)->format('d/m/Y à H:i') }}<br>
            <strong>Arrivée:</strong> {{ optional($reservation->flight->arrivalAirport)->name }} ({{ optional($reservation->flight->arrivalAirport)->code }}) le {{ \Carbon\Carbon::parse($reservation->flight->arrival_time)->format('d/m/Y à H:i') }}
        </div>

        <h4>Passagers et Tarification</h4>
        <ul class="list-group mb-3">
            @php $totalCalculatedPrice = 0; @endphp {{-- Initialise une variable pour vérifier le calcul --}}
            @forelse ($reservation->passengers as $index => $passenger)
                @php
                    // Appelle la méthode du modèle pour obtenir le prix de ce passager
                    $passengerPrice = $reservation->getPriceForPassenger($passenger);
                @endphp
                <li class="list-group-item bg-secondary text-white d-flex justify-content-between align-items-center">
                    <div>
                        <strong>Passager {{ $index + 1 }}:</strong> {{ $passenger->firstname }} {{ $passenger->lastname }}
                        ({{ $passenger->gender == 'male' ? 'Homme' : 'Femme' }}, {{ $passenger->age }} ans)
                        @if ($passenger->age <= 15)
                            <span class="badge bg-info ms-2">Tarif Enfant</span>
                        @endif
                    </div>
                    <strong class="ms-3">
                        @if ($passengerPrice !== null)
                            {{ number_format($passengerPrice, 2, ',', ' ') }} €
                            @php $totalCalculatedPrice += $passengerPrice; @endphp {{-- Ajoute au total pour vérification --}}
                        @else
                            <span class="text-danger">Prix indisponible</span>
                        @endif
                    </strong>
                </li>
            @empty
                <li class="list-group-item bg-secondary text-white">Aucun passager associé à cette réservation.</li>
            @endforelse
        </ul>

        {{-- Affichage du Total --}}
        @php
            $finalTotalPrice = $reservation->calculateTotalPrice(); // Récupère le total calculé par le modèle
        @endphp
        <div class="text-end mt-3"> {{-- Aligner à droite --}}
            <h4>Total à Payer</h4>
            @if ($finalTotalPrice !== null)
                {{-- Vérification de cohérence (optionnel, pour debug)
                @if(round($totalCalculatedPrice, 2) != $finalTotalPrice)
                    <p class="text-warning small">Note: Différence détectée entre la somme des prix affichés et le total calculé.</p>
                @endif
                --}}
                <h3 class="text-success"><strong>{{ number_format($finalTotalPrice, 2, ',', ' ') }} €</strong></h3>

                {{-- Bouton Payer (uniquement si la réservation n'est pas confirmée) --}}
                @if ($reservation->status !== 'confirmed')
                    <form action="{{ route('stripe.checkout', ['reservation' => $reservation->id]) }}" method="GET" class="mt-3">
                        {{-- Pas besoin de @csrf pour GET --}}
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-credit-card"></i> {{-- Ajout d'une icône (si Bootstrap Icons est dispo) --}}
                            Payer maintenant par Carte
                        </button>
                    </form>
                @else
                    <p class="text-success mt-3"><i class="bi bi-check-circle-fill"></i> Cette réservation est déjà confirmée et payée.</p>
                @endif

            @else
                <p class="text-danger">Impossible de calculer le montant total de la réservation.</p>
                {{-- Ne pas afficher le bouton Payer si le total est invalide --}}
            @endif
        </div>

    @else
        <div class="alert alert-warning">
            Les détails de la réservation ou du vol associé n'ont pas pu être chargés.
        </div>
    @endif

</div>