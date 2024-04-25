<section class="flex flex-col gap-10 w-full h-full">
    <div class="flex flex-col justify-left items-start h-fit w-[80%] max-w-[1000px]  bg-stone-100 rounded-lg shadow-4 p-6 mt-6 m-4 ml-6">
        <span class="flex items-center gap-4 bg-orange-500 p-4 w-fit font-bold mr-auto ml-4 rounded-lg shadow-3 text-white">
            <p>
                Ventas de la semana
            </p>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
            </svg>

        </span>
        <canvas id="lineChart"></canvas>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>


    $.ajax({
        url: "/dashboard/graph/sales-of-last-7-days",
        type: 'GET',
        success: function (response) {
            // Extract labels and data from the response
            console.log(response);
            const labels = response.labels;
            console.log(labels);
            const totals = response.data;
            console.log(totals);


            const data = {
                labels: labels,
                datasets: [{
                    data: totals,
                    tension: 0,
                    fill: true,
                    backgroundColor: 'rgba(249, 115, 22, 0.2)', // Color de fondo
                    borderColor: '#f97316',
                    borderWidth: 2, // Ancho de la línea
                    pointRadius: 4, // Tamaño de los puntos
                    pointBackgroundColor: '#f97316', // Color de los puntos
                    pointBorderColor: '#ffffff', // Color del borde de los puntos
                    pointHoverRadius: 6, // Tamaño de los puntos al pasar el ratón
                    pointHoverBackgroundColor: '#f97316', // Color de los puntos al pasar el ratón
                    pointHoverBorderColor: '#ffffff', // Color del borde de los puntos al pasar el ratón
                }]
            };

            const config = {
                type: 'line',
                data: data,
                options: {
                    plugins: {
                        legend: {
                            display: false // Ocultar la leyenda
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false // Ocultar líneas de la cuadrícula en el eje X
                            }
                        },
                        y: {
                            grid: {
                                display: false,
                                color: 'rgba(0, 0, 0, 0.1)', // Color de las líneas de la cuadrícula en el eje Y
                                lineWidth: 1 // Ancho de las líneas de la cuadrícula en el eje Y
                            },
                            ticks: {
                                color: 'rgba(0, 0, 0, 0.5)', // Color de las marcas en el eje Y
                                font: {
                                    size: 14, // Tamaño de la fuente de las marcas en el eje Y (ajústalo según lo necesites)
                                    weight: 'bold' // Peso de la fuente (opcional)
                                }
                            }
                        }
                    },
                    layout: {
                        padding: {
                            top: 60,
                            right: 20,
                            bottom: 20,
                            left: 20 // Ajustar el espacio entre el gráfico y el borde del contenedor
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


    // function getLastSevenDays()
    // {
    //     const date = new Date();
    //     const days = [];
    //     for (let i = 0; i < 7; i++) {
    //         const day = date.getDate() - i;
    //         days.push(day);
    //     }
    //     days.sort();
    //     return days;
    // }



    // const data = {
    //     labels: getLastSevenDays(),
    //     datasets: [{
    //         data: [100, 150, 80, 180, 130, 160, 140],
    //         tension: 0,
    //         fill: true,
    //         backgroundColor: 'rgba(249, 115, 22, 0.2)', // Color de fondo
    //         borderColor: '#f97316',
    //         borderWidth: 2, // Ancho de la línea
    //         pointRadius: 4, // Tamaño de los puntos
    //         pointBackgroundColor: '#f97316', // Color de los puntos
    //         pointBorderColor: '#ffffff', // Color del borde de los puntos
    //         pointHoverRadius: 6, // Tamaño de los puntos al pasar el ratón
    //         pointHoverBackgroundColor: '#f97316', // Color de los puntos al pasar el ratón
    //         pointHoverBorderColor: '#ffffff', // Color del borde de los puntos al pasar el ratón
    //     }]
    // };

    // const config = {
    //     type: 'line',
    //     data: data,
    //     options: {
    //         plugins: {
    //             legend: {
    //                 display: false // Ocultar la leyenda
    //             }
    //         },
    //         scales: {
    //             x: {
    //                 grid: {
    //                     display: false // Ocultar líneas de la cuadrícula en el eje X
    //                 }
    //             },
    //             y: {
    //                 grid: {
    //                     display: false,
    //                     color: 'rgba(0, 0, 0, 0.1)', // Color de las líneas de la cuadrícula en el eje Y
    //                     lineWidth: 1 // Ancho de las líneas de la cuadrícula en el eje Y
    //                 },
    //                 ticks: {
    //                     color: 'rgba(0, 0, 0, 0.5)', // Color de las marcas en el eje Y
    //                     font: {
    //                         size: 14, // Tamaño de la fuente de las marcas en el eje Y (ajústalo según lo necesites)
    //                         weight: 'bold' // Peso de la fuente (opcional)
    //                     }
    //                 }
    //             }
    //         },
    //         layout: {
    //             padding: {
    //                 top: 60,
    //                 right: 20,
    //                 bottom: 20,
    //                 left: 20 // Ajustar el espacio entre el gráfico y el borde del contenedor
    //             }
    //         },
    //         responsive: true
    //     }
    // };


    // const ctx = document.getElementById('lineChart').getContext('2d');
    // new Chart(ctx, config);
</script>

