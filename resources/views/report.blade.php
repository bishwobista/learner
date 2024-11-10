<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Deck Report') }}
        </h2>
    </x-slot>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Review Report for Deck: $deckName") }}
                </div>

                <div style="width: 400px; height: 400px; margin: auto;">
                    <canvas id="reviewChart" width="400" height="400"></canvas>
                </div>
                <script>
                    const ctx = document.getElementById('reviewChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: @json($labels),
                            datasets: [{
                                data: @json($data),
                                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF']
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                    labels: {
                                        generateLabels: function(chart) {
                                            const data = chart.data;
                                            return data.labels.map((label, i) => ({
                                                text: label,
                                                fillStyle: data.datasets[0].backgroundColor[i],
                                                hidden: false,
                                                index: i
                                            }));
                                        }
                                    }
                                },
                                title: {
                                    display: true,
                                    text: 'Review Quality Distribution'
                                }
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</x-app-layout>