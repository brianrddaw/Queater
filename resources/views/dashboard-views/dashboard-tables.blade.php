@extends('dashboard-views.dashboard')

@section('dashboard-content')

    <main class="w-full h-full min-h-[calc(100vh-3.5rem)] p-4  flex flex-col gap-6">

        <section class="flex gap-2">
            <div id="canvas" class="dragging-container w-full h-[50vh] bg-gray-50 rounded-lg drop-shadow-md">

                @foreach ($tables as $table)

                    <div class="draggable flex flex-col items-center w-fit h-fit">
                        <p class="text-2xl font-bold">{{ $table->number }}</p>
                        <img src="../imgs/table.webp" alt="" class="w-10 h-10">
                        <img src="/storage/qrcodes_images/table_{{ $table->number }}.svg" alt="Imagen SVG" class="svg-to-print" id="svg-{{ $table->number }}">
                        <button type="button" onclick="printSVG('svg-{{ $table->number }}')">Imprimir SVG</button>
                        <a href="{{ url('/download-qr-code/'.$table->number) }}" class="btn btn-primary">Descargar SVG</a>
                        <button type="button" onclick="deleteTable({{ $table->number }})" class="btn btn-primary">Eliminar</button>
                    </div>

                @endforeach
            </div>
            <div onclick="addTableToCanvas()" class="add-table flex flex-col items-center h-fit w-[20%] bg-gray-50 rounded-lg drop-shadow-md p-2 pt-4">
                <div class="flex flex-col items-center">
                    <img src="../imgs/table.webp" alt="" class="w-10 h-10">
                    {{-- ADD TABLE --}}
                    <div>

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                </div>
            </div>



        </section>
        {{-- Si existe el QR take_away.svg se renderiza sino no --}}
        @if(file_exists(public_path('storage/qrcodes_images/take_away.svg')))
            <div class="flex flex-col items-center">
                <h1 class="text-2xl font-bold">QR para llevar</h1>
                <img src="/storage/qrcodes_images/take_away.svg" alt="Imagen SVG" class="svg-to-print" id="svg-take-away">
                <button type="button" onclick="printSVG('svg-take-away')">Imprimir SVG</button>
                <a href="{{ url('/download-qr-code/take-away') }}" class="btn btn-primary">Descargar SVG</a>
            </div>
        @else
            <div class="flex flex-col items-center">
                <h1 class="text-2xl font-bold">QR para llevar</h1>
                <p>No hay QR para llevar</p>
                <button type="button" onclick="addTakeAwayQR()">Generar QR para llevar</button>
            </div>
        @endif
    </main>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>

    <script>


        function addTakeAwayQR(){
            $.ajax({
                url: '/generate-qr-code-take-away',
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

        function printSVG(svgId) {
            var svg = document.getElementById(svgId).outerHTML;
            console.log(svg);
            var printWindow = window.open('', '_blank');
            printWindow.document.open();
            //printWindow.document.write('<html><head><title>Print SVG</title></head><body>');
            printWindow.document.write(svg);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }



        function addTableToCanvas(){

            $.ajax({
                url: '/dashboard/tables/create',
                type: 'GET',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response){
                    console.log("Success");
                    table_number = response.table_number;
                    console.log("Table number: ",table_number);

                    const canvas = $('#canvas');
                    const mesa = `
                        <div class="draggable flex flex-col items-center w-fit h-fit">
                            <p class="text-2xl font-bold">${table_number}</p>
                            <img src="../imgs/table.webp" alt="" class="w-10 h-10">
                            <img src="/storage/qrcodes_images/table_${table_number}.svg" alt="Imagen SVG" class="svg-to-print" id="svg-${table_number}">
                            <button type="button" onclick="printSVG('svg-${table_number}')">Imprimir SVG</button>
                            <a href="{{ url('/download-qr-code/${table_number}') }}" class="btn btn-primary">Descargar SVG</a>
                            <button type="button" onclick="deleteTable(${table_number})" class="btn btn-primary">Eliminar</button>
                        </div>
                    `;
                    canvas.append(mesa);
                },
                error: function(error){
                    console.log("Error: ",error.responseText);
                }

            });
        }

        function deleteTable(table_number){
            $.ajax({
                url: '/dashboard/tables/delete/'+table_number,
                type: 'DELETE',
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



        $(document).ready(function() {
            $('.arrow-icon').click(function() {
                toggleComments($(this));
                console.log('click');
            });
        });

        function toggleComments(arrowButton) {
            const expandComments = arrowButton;
            const comments = $(arrowButton).parent().next();
            const isCommentsVisible = comments.hasClass('active');


            if (!isCommentsVisible) {
                comments.addClass('active').css('display', 'flex').hide().slideDown(200);
                expandComments.css('transform', 'rotate(180deg)');

            } else {
                comments.removeClass('active').slideUp(200);
                expandComments.css('transform', 'rotate(0deg)');

            }
        };




        window.dragMoveListener = dragMoveListener;
        interact('.draggable')
        .draggable({
            onmove: dragMoveListener,
            restrict: {
            elementRect: {
                top: 0,
                left: 0,
                bottom: 1,
                right: 1
            }
            }
        })


        function dragMoveListener(event) {

        const boxes = document.getElementsByClassName("draggable");

        const target = event.target


        const self = {
            x: event.target.offsetLeft + event.dx,
            y: event.target.offsetTop + event.dy,
            width: event.target.offsetWidth,
            height: event.target.offsetHeight
        }

            var x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx
            var y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy



            target.style.transform = 'translate(' + x + 'px, ' + y + 'px)'
            target.setAttribute('data-x', x)
            target.setAttribute('data-y', y)


            console.log(`
            x= ,${target.offsetLeft},\n
            y= ,${(parseFloat(target.getAttribute('data-x')) || 0)},\n
            `);

        // }
        }

        function collides(self, event) {
        for (const box of boxes) {
            if (box == event.target) {
            continue;
            }

            const other = {
            x: box.offsetLeft,
            y: box.offsetTop,
            width: box.offsetWidth,
            height: box.offsetHeight
            }

            const collisionX = Math.max(self.x + self.width, other.x + other.width) - Math.min(self.x, other.x) < self.width + other.width;
            const collisionY = Math.max(self.y + self.height, other.y + other.height) - Math.min(self.y, other.y) < self.height + other.height;

            if (collisionX && collisionY) {
            return true;
            }
        }
        return false;
        }





    </script>

    <style>

        .dragging-container,
        .dragging-container * {
            -ms-touch-action: none;
            touch-action: none;
        }

        .add-table:active{
            scale: 0.9;
        }

    </style>
@endsection



