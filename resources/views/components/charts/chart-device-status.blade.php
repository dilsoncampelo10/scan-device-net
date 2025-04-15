<div class="card mb-4 cardChart">
    <div class="card-header">Dispositivos por Status</div>
    <div class="card-body">
        <canvas id="deviceStatusChart"></canvas>
    </div>
</div>

@push('js')
<script>
const ctxStatus = document.getElementById('deviceStatusChart');

const deviceStatus = @json($deviceStatus);
new Chart(ctxStatus, {
    type: 'pie',
    data: {
        labels: ['Ativos (<5 min)', 'Recentes (5-30 min)', 'Inativos (>30 min)'],
        datasets: [{
            data: [
                deviceStatus.active,
                deviceStatus.recent,
                deviceStatus.inactive
            ],
            backgroundColor: ['#198754', '#ffc107', '#6c757d']
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});

</script>
@endpush
