@extends('dashboard-views.dashboard')

@section('dashboard-content')

    <main class="w-full h-[calc(100vh-3.5rem)] flex flex-col gap-4 overflow-y-scroll">

        <section class="flex flex-col gap-4">
            <button onclick="generateQr()" class="flex justify-center items-center gap-4 bg-stone-100 min-w-fit w-fit h-fit p-4 mt-2 rounded-lg  active:bg-walter-300 font-bold shadow-4">
                <p class="text-orange-950 uppercase" >
                    Generar QR para mesa
                </p>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </button>

            <div id="qrs-container" class="flex flex-wrap gap-4 p-8 w-fit h-fit bg-slate-800 rounded-lg shadow-4">

                @foreach ($tables as $table)
                    <div id="qr-{{$table->number}}" class="qrCard flex flex-col items-center justify-between w-36 h-fit rounded-lg py-2 bg-stone-100 shadow-4">
                        <div class=" p-3 rounded">
                            <img src="/storage/qrcodes_images/table_{{ $table->number }}.svg" alt="Imagen SVG" class="svg-to-print" id="svg-{{ $table->number }}">
                        </div>
                            <p class="font-bold mb-2">MESA: {{ $table->number }}</p>
                        <div class="flex flex-col gap-2 font-bold">
                            <button class="p-2 bg-green-400 w-32 text-green-800 rounded" onclick="printSVG('svg-{{ $table->number }}')">Imprimir</button>
                            <a href="{{ url('/download-qr-code/'.$table->number) }}" class="p-2 bg-cyan-500 w-32 rounded text-cyan-800">Descargar QR</a>
                            <button type="button" onclick="deleteTable({{ $table->number }})" class="p-2 bg-red-500 w-32 rounded text-red-800">Eliminar</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="flex flex-col gap-4">
            <div class="flex justify-center items-center gap-4 bg-stone-100 min-w-fit w-fit h-fit p-4 mt-4 rounded-lg  active:bg-walter-300 font-bold shadow-4">
                <p class="text-orange-950 uppercase" >
                    QR PARA LLEVAR
                </p>
            </div>

            <div id="qrs-container" class="flex flex-wrap gap-4 p-8 w-fit h-fit bg-slate-800 rounded-lg shadow-4">
                @if(file_exists(public_path('storage/qrcodes_images/take_away.svg')))
                    <div class="qrCard flex flex-col items-center justify-between w-36 h-fit rounded-lg py-2 bg-stone-100 shadow-4">
                        <div class="p-3 rounded">
                            <img src="/storage/qrcodes_images/take_away.svg" alt="Imagen SVG" class="svg-to-print" id="svg-take-away">
                        </div>
                            <p class="font-bold my-2">QR para llevar</p>
                        <div class="flex flex-col gap-2 font-bold">
                            <button class="p-2 bg-green-400 w-32 text-green-800 rounded" onclick="printSVG('svg-take-away')">Imprimir</button>
                            <a href="{{ url('/download-qr-code-take-away') }}" class="p-2 bg-cyan-500 w-32 rounded text-cyan-800">Descargar QR</a>
                            <button type="button" onclick="deleteTakeAwayQR()" class="p-2 bg-red-500 w-32 rounded text-red-800">Eliminar</button>
                        </div>
                    </div>
                @else
                    <div class="flex flex-col gap-4 text-orange-50">
                        <p class="text-2xl font-bold">No existe ningún QR para llevar </p>
                        <div onclick="addTakeAwayQR()" class="flex items-center justify-center gap-4 cursor-pointer text-lg font-semibold p-2 bg-green-400 w-fit text-green-800 rounded active:scale-95 active:bg-green-300">
                            <p>Generar QR para llevar</p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function deleteTakeAwayQR()
        {
            $.ajax({
                url: '/delete-qr-code-take-away',
                type: 'GET',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response){
                    console.log("Success");
                    console.log(response);
                    location.reload();
                },
                error: function(error){
                    console.log("Error: ",error.responseText);
                }

            });
        }

        function addTakeAwayQR()
        {
            $('#take-away-button').off('click');

            $.ajax({
                url: '/generate-qr-code-take-away',
                type: 'GET',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response){
                    location.reload();
                },
                error: function(error){
                    console.log("Error: ",error.responseText);
                }

            });
        }

        //Funcion asincrona para imprimir el SVG

        function printSVG(id)
        {
            const svg = document.getElementById(id);
            const printWindow = window.open('', '', 'width=600,height=600');

            if(id == "svg-take-away")
            {
                printWindow.document.write(`
                    <div>
                        <h1> PARA LLEVAR </h1>
                        <img src="${svg.src}" />
                    </div>

                    <style>

                    </style>
                `);
            }else{
                printWindow.document.write(`
                    <div>
                        <h1>MESA ${id.match(/svg-(\d+)/)[1]}</h1>
                        <img src="${svg.src}" />
                    </div>

                    <style>

                    </style>
                `);
            }

            printWindow.document.close();
            printWindow.onload = function(){
                printWindow.print();
            }
        }

        function generateQr()
        {
            $.ajax({
                url: '/dashboard/tables/create',
                type: 'GET',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response){
                    const table_number = response.table_number;
                    const qrContainer = $('#qrs-container');
                    const qrCardHtml = `
                        <div id="qr-${table_number}" class="qrCard flex flex-col items-center justify-between w-36 h-fit rounded-lg py-2 bg-stone-100 shadow-4">
                            <div class="p-3 rounded">
                                <img src="/storage/qrcodes_images/table_${table_number}.svg" alt="Imagen SVG" class="svg-to-print" id="svg-${table_number}">
                            </div>
                            <p class="font-bold mb-2">MESA: ${table_number}</p>
                            <div class="flex flex-col gap-2 font-bold">
                                <button class="p-2 bg-green-400 w-32 text-green-800 rounded" onclick="printSVG('svg-${table_number}')">Imprimir</button>
                                <a href="/download-qr-code/${table_number}" class="p-2 bg-cyan-500 w-32 rounded text-cyan-800">Descargar QR</a>
                                <button type="button" onclick="deleteTable(${table_number})" class="p-2 bg-red-500 w-32 rounded text-red-800">Eliminar</button>
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

        function deleteTable(table_number)
        {
            $.ajax({
                url: '/dashboard/tables/delete/'+table_number,
                type: 'DELETE',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response){
                    $(`#qr-${table_number}`).fadeOut(150);
                    location.reload();
                },
                error: function(error){
                    console.log("Error: ",error.responseText);
                }

            });
        }
    </script>
@endsection



