


    <div class="container">
        <h2>Mes réservations</h2>
        @forelse($reservations as $reservation)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>Vol de {{ $reservation->flight->departureAirport->name }} vers {{ $reservation->flight->arrivalAirport->name }}</h5>
                    <p>Date de départ : {{ $reservation->date }}</p>
                    <p>Classe : {{ ucfirst($reservation->class) }}</p>
                    <p>Passagers :
                        <ul>
                            @foreach($reservation->passengers as $passenger)
                                <li>{{ $passenger->firstname }} {{ $passenger->lastname }} ({{ $passenger->age }} ans)</li>
                            @endforeach
                        </ul>
                    </p>
                </div>
            </div>
        @empty
            <p>Vous n'avez effectué aucune réservation pour le moment.</p>
        @endforelse
    </div>
