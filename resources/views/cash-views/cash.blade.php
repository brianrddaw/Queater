@extends('layouts.html-layout')

@section('title', 'Cash')
@section('content')

    <main class="w-full h-full min-h-[calc(100vh-3.5rem)] p-4  flex flex-col gap-6">
        <section>

            <div id="canvas" class="dragging-container w-full h-[50vh] bg-gray-50 rounded-lg drop-shadow-md">

                <div id="miElemento"  class="draggable absolute w-[50px] h-[50px] border border-black">
                    <img src="../imgs/table.webp" alt="">
                </div>
                <br>
                <div class="draggable w-[50px] h-[50px] absolute border border-black">
                    <img src="../imgs/table.webp" alt="">
                </div>
            </div>


        </section>
        <section class="w-full h-fit flex flex-wrap flex-col gap-4">

            <div class="flex  gap-2" >
                <button class="bg-orange-500 w-full text-orange-50 font-bold text-2xl rounded-md">Mesa</button>
                <button class="bg-orange-500 w-full text-orange-50 font-bold text-2xl rounded-md">Para llevar</button>
            </div>

            {{-- Orders container --}}
            <div class="flex flex-col gap-4">

                {{-- orders --}}
                <div class="flex flex-col gap-4 rounded-lg bg-gray-100 drop-shadow-lg">
                    <div class=" w-full h-20  grid grid-cols-4 items-center gap-2">

                        <span class="flex flex-col justify-center items-left text-lg ml-4">
                            <p>Nº Pedido</p>
                            <p class="text-3xl font-bold">37</p>

                        </span>
                        <span class="flex flex-col justify-center items-center text-lg">
                            <p>Hora</p>
                            <p class="text-3xl font-bold">14:37</p>

                        </span>
                        <span class="flex flex-col justify-center items-center text-lg">
                            <p>Mesa</p>
                            <p class="text-3xl font-bold">37</p>

                        </span>

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="arrow-icon w-10 h-10 ml-auto mr-4 transition-all">
                            <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clip-rule="evenodd" />
                        </svg>



                    </div>

                    {{-- Comments section --}}
                    <section class="comments-section hidden flex-col gap-2 w-full p-4">

                        <h2 class="text-xl uppercase font-bold">Comentarios</h2>

                        <textarea name="client-comments" id="client-comments" cols="30" rows="5" class="w-full rounded-md p-2"></textarea>

                    </section>

                </div>

            </div>



        </section>

    </main>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.arrow-icon').click(function() {
                toggleComments($(this));
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

    </style>

@endsection

