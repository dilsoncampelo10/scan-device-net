<div class="card mb-4 cardChart">
    <div class="card-header">Dispositivos por dia</div>
    <div class="card-body">
        <canvas id="devicesByDayChart"></canvas>
    </div>
</div>


@push('js')
<script>
 const devicesByDayData = @json($devicesByDayData);


    const ctxDay = document.getElementById('devicesByDayChart');
    new Chart(ctxDay, {
        type: 'line',
        data: {
            labels: devicesByDayData.map(d => d.date),
            datasets: [{
                label: 'Dispositivos por Dia',
                data: devicesByDayData.map(d => d.total),
                borderColor: 'rgba(75, 192, 192, 1)',
                tension: 0.3,
                fill: false
            }]
        },
        options: {
            responsive: true,
        }
    });
</script>
@endpush
