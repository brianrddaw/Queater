<section class="flex flex-col w-full h-full overflow-y-scroll gap-6 pb-2">
    <div class="flex flex-col justify-left items-start h-fit w-[80%] max-w-[1000px] bg-stone-100 rounded-lg shadow-4 p-6 mt-2">
        <span class="flex items-center gap-4 bg-slate-800 p-4 w-fit font-bold mr-auto ml-4 rounded-lg shadow-3 text-white">
            <p>
                Ventas de la semana
            </p>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
            </svg>

        </span>
        <canvas id="lineChart"></canvas>
    </div>
    <div class="flex flex-col justify-left items-start h-fit w-[80%] max-w-[500px]  bg-stone-100 rounded-lg shadow-4 p-6 mt-2">
        <span class="flex items-center gap-4 bg-slate-800 p-4 w-fit font-bold mr-auto ml-4 mb-6 rounded-lg shadow-3 text-white">
            <p>
                Top 5 productos más vendidos
            </p>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M22.775 8C22.9242 8.65461 23 9.32542 23 10H14V1C14.6746 1 15.3454 1.07584 16 1.22504C16.4923 1.33724 16.9754 1.49094 17.4442 1.68508C18.5361 2.13738 19.5282 2.80031 20.364 3.63604C21.1997 4.47177 21.8626 5.46392 22.3149 6.55585C22.5091 7.02455 22.6628 7.5077 22.775 8ZM20.7082 8C20.6397 7.77018 20.5593 7.54361 20.4672 7.32122C20.1154 6.47194 19.5998 5.70026 18.9497 5.05025C18.2997 4.40024 17.5281 3.88463 16.6788 3.53284C16.4564 3.44073 16.2298 3.36031 16 3.2918V8H20.7082Z" fill="currentColor" />
                <path fill-rule="evenodd" clip-rule="evenodd" d="M1 14C1 9.02944 5.02944 5 10 5C10.6746 5 11.3454 5.07584 12 5.22504V12H18.775C18.9242 12.6546 19 13.3254 19 14C19 18.9706 14.9706 23 10 23C5.02944 23 1 18.9706 1 14ZM16.8035 14H10V7.19648C6.24252 7.19648 3.19648 10.2425 3.19648 14C3.19648 17.7575 6.24252 20.8035 10 20.8035C13.7575 20.8035 16.8035 17.7575 16.8035 14Z" fill="currentColor" />
            </svg>

        </span>
        <canvas id="dogChart"></canvas>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $.ajax({
        url: "/dashboard/graph/sales-of-last-7-days",
        type: 'GET',
        success: function (response) {
            const labels = response.labels;
            const totals = response.data;

            const data = {
                labels: labels,
                datasets: [{
                    data: totals,
                    tension: 0,
                    fill: true,
                    backgroundColor: 'rgba(249, 115, 22, 0.2)',
                    borderColor: '#f97316',
                    borderWidth: 2,
                    pointRadius: 4,
                    pointBackgroundColor: '#f97316',
                    pointBorderColor: '#ffffff',
                    pointHoverRadius: 6,
                    pointHoverBackgroundColor: '#f97316',
                    pointHoverBorderColor: '#ffffff',
                }]
            };

            const config = {
                type: 'line',
                data: data,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: true
                            }
                        },
                        y: {
                            grid: {
                                display: true,
                                color: 'rgba(0, 0, 0, 0.1)',
                                lineWidth: 1
                            },
                            ticks: {
                                color: 'rgba(0, 0, 0, 0.5)',
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                },
                                callback: function (value, index, values) {
                                    return  value + ' €' ;
                                },
                            }
                        }
                    },
                    layout: {
                        padding: {
                            top: 60,
                            right: 20,
                            bottom: 20,
                            left: 20
                        }
                    },
                    responsive: true
                }
            };
            const ctx = document.getElementById('lineChart').getContext('2d');
            new Chart(ctx, config);

        },
        error: function (error) {
            console.log(error);
        }
    });

    $.ajax({
        url: "/dashboard/graph/top-5-in-week",
        type: 'GET',
        success: function (response) {
            if (response.length > 0) {
                printTop5SoldProducts(response);
            }
        },
        error: function (error) {
            console.error(error);
        }
    });

    function printTop5SoldProducts($productsData)
    {
        const data = {
            labels: $productsData.map(product => product.name),
            datasets: [{
                data: $productsData.map(product => product.total),
                backgroundColor: [
                '#f97316',
                '#ffa366',
                '#ffbb99',
                '#ffd8b2 ',
                '#fff5e6',
                ],
                hoverOffset: 4
            }]
        };

        const config = {
            type: 'doughnut',
            data: data,
            options: {
                plugins: {
                    legend: {
                    display: false
                    }
                }
            }
        };

        const ctx = document.getElementById('dogChart').getContext('2d');
        new Chart(ctx, config);
    };

</script>

