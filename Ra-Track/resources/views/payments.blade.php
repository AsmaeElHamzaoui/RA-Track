
<div class="container text-white bg-dark p-4 rounded">
    <h2 class="mb-4">Détails de la réservation</h2>

    <div class="mb-3">
        <strong>Référence:</strong> {{ $reservation->booking_reference }}<br>
        <strong>Date:</strong> {{ $reservation->date }}<br>
        <strong>Classe:</strong> {{ ucfirst($reservation->class) }}<br>
        <strong>Status:</strong> {{ $reservation->status }}
    </div>

    <h4>Détails du vol</h4>
    <div class="mb-3">
        <strong>Vol:</strong> {{ $reservation->flight->id }}<br>
        <strong>Départ:</strong> {{ $reservation->flight->departure_airport }} à {{ $reservation->flight->departure_time }}<br>
        <strong>Arrivée:</strong> {{ $reservation->flight->arrival_airport }} à {{ $reservation->flight->arrival_time }}
    </div>

    <h4>Passagers</h4>
    <ul class="list-group mb-3">
        @foreach ($reservation->passengers as $index => $passenger)
            <li class="list-group-item bg-secondary text-white">
                <strong>Passager {{ $index + 1 }}:</strong> {{ $passenger->firstname }} {{ $passenger->lastname }},
                {{ $passenger->gender }}, {{ $passenger->age }} ans
            </li>
        @endforeach
    </ul>

    <form action="{{ route('stripe.checkout', ['reservation' => $reservation->id]) }}" method="GET">
        @csrf
        <button type="submit" class="btn btn-success">Payer avec Stripe</button>
    </form>
</div>
