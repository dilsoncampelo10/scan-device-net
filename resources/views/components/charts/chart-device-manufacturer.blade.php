<div class="card mb-4  cardChart">
    <div class="card-header">Dispositivos por fabricante</div>
    <div class="card-body">
        <canvas id="devicesByManufacturerChart"></canvas>
    </div>
</div>


@push('js')
    <script>
           const devicesByManufacturerData = @json($devicesByManufacturer);

            const ctxManufacturer = document.getElementById('devicesByManufacturerChart');
            new Chart(ctxManufacturer, {
                type: 'doughnut',
                data: {
                    labels: devicesByManufacturerData.map(d => d.manufacturer || 'Desconhecido'),
                    datasets: [{
                        label: 'Fabricantes',
                        data: devicesByManufacturerData.map(d => d.total),
                        backgroundColor: [
                            '#4bc0c0', '#ff6384', '#36a2eb', '#ffcd56', '#9966ff', '#c9cbcf'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                }
            });

    </script>
@endpush