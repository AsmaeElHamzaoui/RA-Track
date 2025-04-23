<!-- ==================== Section Statistiques ==================== -->
<div id="stats-content" class="content-section hidden">
             <h3 class="text-xl font-semibold mb-6">Statistiques des Vols</h3>

             <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                 <!-- Statistique Clé 1 -->
                 <div class="bg-navy-light p-5 rounded-lg shadow-md">
                     <h4 class="text-sm text-gray-400 mb-2">Total Vols </h4>
                     <p class="text-3xl font-bold">1,258</p>
                     <p class="text-xs text-green-400 mt-1">+5% vs mois dernier</p>
                 </div>
                  <!-- Statistique Clé 2 -->
                 <div class="bg-navy-light p-5 rounded-lg shadow-md">
                     <h4 class="text-sm text-gray-400 mb-2">Total Avions</h4>
                     <p class="text-3xl font-bold">92.7%</p>
                     <p class="text-xs text-red-400 mt-1">-0.5% vs mois dernier</p>
                 </div>
                 <!-- Statistique Clé 3 -->
                 <div class="bg-navy-light p-5 rounded-lg shadow-md">
                     <h4 class="text-sm text-gray-400 mb-2">Airport le plus active</h4>
                     <p class="text-3xl font-bold truncate">AirFrance</p>
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
                <!-- Ajouter d'autres graphiques ou stats ici -->
             </section>
</div>


<script>
     // --- Initialisation des Graphiques Chart.js ---
     let flightStatusChartInstance = null;
    let monthlyFlightsChartInstance = null;

    function initializeCharts() {
        const flightStatusCtx = document.getElementById('flightStatusChart')?.getContext('2d');
        const monthlyFlightsCtx = document.getElementById('monthlyFlightsChart')?.getContext('2d');

        if (flightStatusChartInstance) flightStatusChartInstance.destroy();
        if (monthlyFlightsChartInstance) monthlyFlightsChartInstance.destroy();

        const flightStatusData = { /* ... données ... */
             labels: ['En vol', 'Programmé', 'Arrivé', 'Retardé', 'Annulé'],
             datasets: [{ /* ... dataset ... */
                label: 'Statut des Vols',
                data: [247, 150, 800, 8, 2], // Données exemples
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)', // Bleu
                    'rgba(255, 206, 86, 0.7)', // Jaune
                    'rgba(75, 192, 192, 0.7)', // Vert Cyan
                    'rgba(255, 99, 132, 0.7)',  // Rouge
                    'rgba(153, 102, 255, 0.7)' // Violet
                ],
                borderColor: [ /* ... borders ... */
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        };
        const monthlyFlightsData = { /* ... données ... */
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'], // Données exemples
            datasets: [{ /* ... dataset ... */
                label: 'Vols par Mois',
                data: [1100, 1050, 1200, 1150, 1258, 1300], // Données exemples
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        };
        const chartOptions = { /* ... options ... */
            maintainAspectRatio: false,
             plugins: { legend: { labels: { color: '#cbd5e1' } } },
            scales: {
                y: { beginAtZero: true, ticks: { color: '#cbd5e1' }, grid: { color: 'rgba(203, 213, 225, 0.2)' } },
                x: { ticks: { color: '#cbd5e1' }, grid: { color: 'rgba(203, 213, 225, 0.2)' } }
            }
        };
        const pieChartOptions = { /* ... options ... */
             maintainAspectRatio: false,
             plugins: { legend: { position: 'bottom', labels: { color: '#cbd5e1' } } }
        };

        if (flightStatusCtx) {
            flightStatusChartInstance = new Chart(flightStatusCtx, { type: 'doughnut', data: flightStatusData, options: pieChartOptions });
        } else {
            console.warn("Canvas 'flightStatusChart' non trouvé.");
        }
        if (monthlyFlightsCtx) {
            monthlyFlightsChartInstance = new Chart(monthlyFlightsCtx, { type: 'line', data: monthlyFlightsData, options: chartOptions });
        } else {
             console.warn("Canvas 'monthlyFlightsChart' non trouvé.");
        }
    }
</script>