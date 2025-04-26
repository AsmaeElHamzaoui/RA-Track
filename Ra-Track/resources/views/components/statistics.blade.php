<!-- ==================== Section Statistiques ==================== -->
<div id="stats-content" class="content-section hidden">
             <h3 class="text-xl font-semibold mb-6">Statistiques des Vols</h3>

             <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                 <!-- Statistique Clé 1 -->
                 <div class="bg-navy-light p-5 rounded-lg shadow-md">
                     <h4 class="text-sm text-gray-400 mb-2">Total Vols </h4>
                     <p class="text-3xl font-bold">{{ $totalFlights }}</p>
                     <p class="text-xs text-green-400 mt-1">+5% vs mois dernier</p>
                 </div>
                  <!-- Statistique Clé 2 -->
                 <div class="bg-navy-light p-5 rounded-lg shadow-md">
                     <h4 class="text-sm text-gray-400 mb-2">Total Avions</h4>
                     <p class="text-3xl font-bold">{{ $totalPlanes }}</p>
                     <p class="text-xs text-red-400 mt-1">-0.5% vs mois dernier</p>
                 </div>
                 <!-- Statistique Clé 3 -->
                 <div class="bg-navy-light p-5 rounded-lg shadow-md">
                     <h4 class="text-sm text-gray-400 mb-2">Airport le plus active</h4>
                     <p class="text-3xl font-bold truncate">{{ $activeAirportName }}</p>
                     <p class="text-xs text-gray-400 mt-1">350 vols ce mois</p>
                 </div>
             </section>

             <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                 <!-- Graphique 1: Vols par Statut -->
                <div class="bg-navy-light p-4 rounded-lg shadow-md">
                    <h4 class="text-lg font-semibold mb-3">Répartition des Statuts de Vol</h4>
                    <div class="h-64"> <!-- Hauteur fixe pour le canvas -->
                         <canvas id="flightStatusChart"></canvas>
                    </div>
                </div>

                <!-- Graphique 2: Vols par Mois -->
                <div class="bg-navy-light p-4 rounded-lg shadow-md">
                    <h4 class="text-lg font-semibold mb-3">Nombre de Vols par Mois</h4>
                     <div class="h-64">
                        <canvas id="monthlyFlightsChart"></canvas>
                    </div>
                </div>
             </section>


              <!-- Section pour les Nouveaux Graphiques -->
    <section class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-navy-light p-4 rounded-lg shadow-md">
            <h4 class="text-lg font-semibold mb-3">Paiements vs Réservations (6 derniers mois)</h4>
             <div class="h-80"> <!-- Hauteur légèrement augmentée pour les barres -->
                <canvas id="monthlyRevenueVsReservationsChart"></canvas>
            </div>
        </div>

        <div class="bg-navy-light p-4 rounded-lg shadow-md">
            <h4 class="text-lg font-semibold mb-3">Top 6 Vols les Plus Réservés</h4>
             <div class="h-80">
                <canvas id="topFlightsChart"></canvas>
            </div>
        </div>
    </section>

</div>

<script>
    let flightStatusChartInstance = null;
    let monthlyFlightsChartInstance = null;
    let monthlyRevenueChartInstance = null; 
    let topFlightsChartInstance = null;     

    function initializeCharts() {
        const flightStatusCtx = document.getElementById('flightStatusChart')?.getContext('2d');
        const monthlyFlightsCtx = document.getElementById('monthlyFlightsChart')?.getContext('2d');
        const monthlyRevenueCtx = document.getElementById('monthlyRevenueVsReservationsChart')?.getContext('2d'); 
        const topFlightsCtx = document.getElementById('topFlightsChart')?.getContext('2d');                     


        if (flightStatusChartInstance) flightStatusChartInstance.destroy();
        if (monthlyFlightsChartInstance) monthlyFlightsChartInstance.destroy();
        if (monthlyRevenueChartInstance) monthlyRevenueChartInstance.destroy(); 
        if (topFlightsChartInstance) topFlightsChartInstance.destroy();   

        const statusData = @json($statusDistribution);
        const monthlyData = @json($monthlyFlights);
        const monthLabels = @json($monthLabels);
        const paymentData = @json($paymentData);
        const reservationData = @json($reservationData);
        const topFlightsLabels = @json($topFlightsLabels);
        const topFlightsCounts = @json($topFlightsCounts);


        const flightStatusData = {
            labels: Object.keys(statusData),
            datasets: [{
                label: 'Statut des Vols',
                data: Object.values(statusData),
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',   // Bleu
                    'rgba(255, 206, 86, 0.7)',   // Jaune
                    'rgba(255, 99, 132, 0.7)',   // Rouge
                    'rgba(153, 102, 255, 0.7)',  // Violet
                    'rgba(75, 192, 192, 0.7)'    // Vert Cyan
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        };

        const monthlyFlightsData = {
            labels: Object.keys(monthlyData),
            datasets: [{
                label: 'Vols par Mois',
                data: Object.values(monthlyData),
                fill: false,
                borderColor: '#FFD700', // Gold
                backgroundColor: '#FFD700',
                tension: 0.3
            }]
        };

        // Configuration Graphique Colonnes (Paiements vs Réservations)
        const monthlyRevenueVsReservationsData = {
            labels: monthLabels, // Labels des mois (passés par le contrôleur)
            datasets: [
                {
                    label: 'Total Paiements (€)', // Assurez-vous que l'unité est correcte
                    data: paymentData,         // Données des paiements (passées par le contrôleur)
                    backgroundColor: 'rgba(75, 192, 192, 0.7)', // Vert/Cyan
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Nombre Réservations',
                    data: reservationData,     // Données des réservations (passées par le contrôleur)
                    backgroundColor: 'rgba(255, 206, 86, 0.7)', // Jaune
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                }
            ]
        };

        // Configuration Graphique Cercle (Top 6 Vols)
        const topFlightsData = {
            labels: topFlightsLabels, // Labels des vols (passés par le contrôleur)
            datasets: [{
                label: 'Top 6 Vols Réservés',
                data: topFlightsCounts,    // Données des réservations (passées par le contrôleur)
                backgroundColor: [        // Palette de 6 couleurs distinctes
                    'rgba(255, 99, 132, 0.7)',  // Rouge
                    'rgba(54, 162, 235, 0.7)',  // Bleu
                    'rgba(255, 206, 86, 0.7)', // Jaune
                    'rgba(75, 192, 192, 0.7)',  // Vert Cyan
                    'rgba(153, 102, 255, 0.7)', // Violet
                    'rgba(255, 159, 64, 0.7)'   // Orange
                ],
                 borderColor: [             // Couleurs des bordures correspondantes
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        };

        const commonChartOptions = { // Renommé pour clarté
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: { color: '#fff' }
                }
            },
            scales: { // Applicable aux graphiques Barre et Ligne
                y: {
                    beginAtZero: true,
                    ticks: { color: '#fff' },
                    grid: { color: 'rgba(255, 255, 255, 0.1)' }
                },
                x: {
                    ticks: { color: '#fff' },
                    grid: { color: 'rgba(255, 255, 255, 0.1)' }
                }
            }
        };

        const pieDoughnutOptions = { // Renommé pour clarté
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { color: '#fff' }
                },
                tooltip: { // Optionnel: Améliorer l'affichage des tooltips pour les pourcentages
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed !== null) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((context.parsed / total) * 100).toFixed(1) + '%';
                                label += context.formattedValue + ' (' + percentage + ')';
                            }
                            return label;
                        }
                    }
                }
            }
        };


        // --- Instanciation des graphiques ---
        if (flightStatusCtx) {
            flightStatusChartInstance = new Chart(flightStatusCtx, {
                type: 'doughnut',
                data: flightStatusData,
                options: pieDoughnutOptions // Utilisation des options spécifiques Pie/Doughnut
            });
        }

        if (monthlyFlightsCtx) {
            monthlyFlightsChartInstance = new Chart(monthlyFlightsCtx, {
                type: 'line',
                data: monthlyFlightsData,
                options: commonChartOptions // Utilisation des options communes (avec axes)
            });
        }

        if (monthlyRevenueCtx) {
             monthlyRevenueChartInstance = new Chart(monthlyRevenueCtx, {
                type: 'bar', // Type 'bar' pour les colonnes
                data: monthlyRevenueVsReservationsData,
                options: commonChartOptions // Utilisation des options communes (avec axes)
             });
        }

        if (topFlightsCtx) {
            topFlightsChartInstance = new Chart(topFlightsCtx, {
                type: 'pie', // Type 'doughnut' ou 'pie' pour le cercle
                data: topFlightsData,
                options: pieDoughnutOptions // Utilisation des options spécifiques Pie/Doughnut
            });
        }
    }

    // Exécuter dès que la page est prête
    window.addEventListener('DOMContentLoaded', initializeCharts);

    // Exemple avec Intersection Observer (plus moderne que de vérifier le style)
    const statsSection = document.getElementById('stats-content');
    if (statsSection) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                // Si la section devient visible et n'a pas encore été initialisée (ou si on veut réinitialiser à chaque fois)
                if (entry.isIntersecting) {
                   // Décommenter si vous voulez re-initialiser à chaque fois que ça devient visible
                   // console.log("Stats section visible, initializing charts...");
                   // initializeCharts();
                   // observer.unobserve(statsSection); // Optionnel: arrêter d'observer une fois initialisé
                }
            });
        }, { threshold: 0.1 }); // Déclenche quand 10% est visible

        observer.observe(statsSection);
    }

</script>

