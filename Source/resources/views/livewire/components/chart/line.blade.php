<div>
    <div class="w-full bg-white p-2 rounded-lg ring-2 ring-gray-200">
        <canvas id="{{ $chartId }}"></canvas>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx_{{ $chartId }} = document.getElementById('{{ $chartId }}').getContext('2d');
            const Chart_{{ $chartId }} = new Chart(ctx_{{ $chartId }}, {
                type: 'line',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: '{{ $label }}',
                        data: @json($data),
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.4,
                        fill: true,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)'
                    }]
                },
                options: {}
            });
        });
    </script>
</div>
