
<h1 class="flex items-center justify-center font-bold text-orange-950 text-xl bg-walter-400  h-[3.75rem]">
    Bienvenido al menú de inicio
</h1>
<section class="flex flex-col gap-10 w-full h-full p-2">

    <div class="flex justify-center items-center h-fit w-full max-w-[900px] p-2 border border-red-500 mx-auto">
        <canvas id="lineChart"></canvas>
    </div>

    <div class="flex w-full h-fit gap-4">

        <a href="{{route('dashboard.products')}}" class="flex items-center justify-center w-full h-20  font-bold text-orange-950 bg-orange-50 drop-shadow-xl rounded">
            <p>Productos</p>
        </a>
        <a href="{{route('dashboard.categories')}}" class="flex items-center justify-center w-full h-20  font-bold text-orange-950 bg-orange-50 drop-shadow-xl rounded">
            <p>Categorias</p>
        </a>
        <a href="{{route('dashboard.tables')}}" class="flex items-center justify-center w-full h-20  font-bold text-orange-950 bg-orange-50 drop-shadow-xl rounded">
            <p>Mesas</p>
        </a>

    </div>

</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

    function getLastSevenDays()
    {
        const date = new Date();
        const days = [];
        for (let i = 0; i < 7; i++) {
            const day = date.getDate() - i;
            days.push(day);
        }
        return days;
    }

    const data =
    {
        labels: getLastSevenDays(),
        datasets: [
            {
                data: [300, 100, 50, 34, 15, 20, 30],
                tension: 0,
                fill: false,
                borderColor: '#f97316',
            }
        ]
    };

    const config = {
        type: 'line',
        data: data,
        options: {
            plugins: {
                legend: {
                    align: 'center'
                },
                customCanvasBackgroundColor: {
                    color: 'transparent',
                }
            }

        },
    };

    const ctx = document.getElementById('lineChart').getContext('2d');
    new Chart(ctx, config);
</script>

