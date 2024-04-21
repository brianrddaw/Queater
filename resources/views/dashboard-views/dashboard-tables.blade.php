@extends('dashboard-views.dashboard')

@section('dashboard-content')

    <main class="w-full h-full min-h-[calc(100vh-3.5rem)] p-4  flex flex-col gap-6">

        <section class="flex flex-col gap-4">
            <button onclick="generateQr()" class="flex justify-center items-center gap-4 bg-stone-200 min-w-fit w-fit h-fit p-4 mt-4 rounded-lg  active:bg-walter-300 font-bold shadow-4" onclick="showAddCategoryForm()">
                <p class="text-orange-950 uppercase" >
                    Generar QR para mesa
                </p>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </button>

            <div id="qrs-container" class="flex flex-wrap gap-4 p-8 w-full h-fit bg-stone-100 rounded-lg shadow-4">

                @foreach ($tables as $table)
                    <div class="qrCard flex flex-col items-center justify-between w-36 h-fit rounded-lg py-2 bg-stone-200 shadow-4">
                        <div class="bg-orange-950 p-3 rounded">
                            <img src="/storage/qrcodes_images/table_{{ $table->number }}.svg" alt="Imagen SVG" class="svg-to-print" id="svg-{{ $table->number }}">
                        </div>
                            <p class="font-bold my-2">MESA: {{ $table->number }}</p>
                        <div class="flex flex-col gap-2 font-bold">
                            <button class="p-2 bg-green-400 w-32 text-green-800 rounded" onclick="printSVG('svg-{{ $table->number }}')">Imprimir</button>
                            <a href="{{ url('/download-qr-code/'.$table->number) }}" class="p-2 bg-red-500 w-32 rounded text-red-800">Descargar QR</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function printSVG(svgId)
        {
            var svg = document.getElementById(svgId).outerHTML;
            var printWindow = window.open('', '_blank');
            printWindow.document.open();
            //printWindow.document.write('<html><head><title>Print SVG</title></head><body>');
            printWindow.document.write(svg);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }

        function generateQr()
        {
            $.ajax({
                url: '/dashboard/tables/create',
                type: 'GET',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    const table_number = response.table_number;
                    const qrContainer = $('#qrs-container');
                    const qrCardHtml = `
                        <div id="qr-${table_number}" class="qrCard flex flex-col items-center justify-between w-36 h-fit rounded-lg py-2 bg-stone-200 shadow-4">
                            <div class="bg-orange-950 p-3 rounded">
                                <img src="/storage/qrcodes_images/table_${table_number}.svg" alt="Imagen SVG" class="svg-to-print" id="svg-${table_number}">
                            </div>
                            <p class="font-bold my-2">MESA: ${table_number}</p>
                            <div class="flex flex-col gap-2 font-bold">
                                <button class="p-2 bg-green-400 w-32 text-green-800 rounded" onclick="printSVG('svg-${table_number}')">Imprimir</button>
                                <a href="{{ url('/download-qr-code/'${table_number})" class="p-2 bg-red-500 w-32 rounded text-red-800">Descargar QR</a>
                            </div>
                        </div>
                    `;
                    qrContainer.append(qrCardHtml);
                    qrCard = $(`#qr-${table_number}`);
                    qrCard.hide().fadeIn(150);

                },

                error: function(error){
                    console.log("Error: ",error.responseText);
                }

            });
        }
    </script>
@endsection



