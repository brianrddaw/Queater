
<h1 class="flex items-center justify-center font-bold text-orange-950 text-xl bg-walter-400  h-[3.75rem]">
    Bienvenido al menú de inicio
</h1>
<section class="flex flex-col gap-2 w-full h-fit p-2">
    <div class="chart-container h-fit">

        <div class="flex justify-center items-center h-fit w-full p-2">
            <canvas id="myChart"></canvas>

        </div>
        {{-- <table class="charts-css bar h-fit">
            <tr class="border border-green-500">
                <td style="--start: 0; --end: 0.3; --color: #f97316">
                    <span class="data border border-blue-500"> $ 40K </span>
                </td>
            </tr>
            <tr>
                <td style="--start: 0.3; --end: 1;">
                    <span class="data "> $ 30K </span>
                </td>
            </tr>
        </table> --}}

    </div>

    <div class="flex flex-col w-full h-fit gap-4">

            <a  class="flex items-center w-full h-20 pl-2 font-bold text-orange-950 bg-orange-100 drop-shadow-xl rounded">
                <p>Productos</p>
            </a>
            <a class="flex items-center w-full h-20 pl-2 font-bold text-orange-950 bg-orange-100 drop-shadow-xl rounded">
                <p>Categorias</p>
            </a>
            <a class="flex items-center w-full h-20 pl-2 font-bold text-orange-950 bg-orange-100 drop-shadow-xl rounded">
                <p>Mesas</p>
            </a>

    </div>

</section>

<style>

    label{

    }

</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const data = {
        labels: [
            'Hamburguesas',
            'Ensaladas',
            'Batidos',
            'Perkins',
            'Pepes',
        ],

        datasets: [{
            data: [300, 100, 50, 34, 15],
            backgroundColor: [
                '#f97316',
                '#ffa04d',
                '#ffc686',
                '#ffdabf',
                '#ffedd9',
            ],
            hoverOffset: 4,
            spacing: 8,
            borderRadius: 3
        }]
    };

    const plugin = {
        id: 'customCanvasBackgroundColor',
        beforeDraw: (chart, args, options) => {
            const {ctx} = chart;
            ctx.save();
            ctx.globalCompositeOperation = 'destination-over';
            ctx.fillStyle = options.color || '#19ffff';
            ctx.fillRect(0, 0, chart.width, chart.height);
            ctx.restore();
        }
    };

    const config = {
        type: 'doughnut',
        data: data,
        options: {
            plugins: {
                legend: {

                    align: 'start' // Establecer la alineación de los labels a la izquierda

                },
                customCanvasBackgroundColor: {
                    color: 'transparent',
                }
            }
        },
        plugins: [plugin],
    };

    // Renderizar el gráfico
    const ctx = document.getElementById('myChart').getContext('2d');
    new Chart(ctx, config);
</script>

