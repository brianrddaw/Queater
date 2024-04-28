<!DOCTYPE html>
<html lang="es" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@100..900&display=swap" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <title><?php echo $__env->yieldContent('title'); ?></title>
</head>

<body class="overflow-x-hidden bg-slate-200">

    <div id="loader" class="fixed top-0 left-0 z-50 w-screen h-screen bg-black bg-opacity-50 items-center justify-center hidden">
        <svg aria-hidden="true" class="w-14 h-14 text-gray-200 animate-spin dark:text-gray-600 fill-orange-500" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
        </svg>
        <span class="sr-only">Loading...</span>
    </div>

    <header class="flex justify-items-center items-center bg-orange-500 p-2 h-14 text-zinc-100 ">
        <img src="<?php echo e(asset('imgs/letras.webp')); ?>" alt="" class="pl-2 h-4 mr-auto  ">

        <?php if(!empty(trim($__env->yieldContent('navegacion')))): ?>
            <nav class="flex flex-row items-center ml-auto mr-2 ">
                <button id="nav-button" class="">
                    <svg  id="icono-expandir" class="cursor-pointer w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">

                        <path fill-rule="evenodd" d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                    </svg>
                </button>

            
                <div class="nav-slide hidden flex-col gap-2 items-center min-w-fit absolute right-0 top-14 z-10 bg-orange-500 overflow-hidden text-ellipsis w-fit text-[1rem]">
                    <?php echo $__env->yieldContent('navegacion'); ?>
                </div>
            </nav>
        <?php endif; ?>
    </header>


    <?php echo $__env->yieldContent('content'); ?>

    <script>
        $(document).ready(function() {
            $('#nav-button').click(toggleDropdownNav);
        });

        window.onload = function() {
            //Si el loader esta activo se oculta
            if (document.getElementById('loader').classList.contains('flex')) {
                toggleLoader();
            }
        }

        function toggleDropdownNav()
        {
            const dropdawn =  $(this).parent();
            const dropdawnItems = dropdawn.find('.nav-slide');
            console.log(dropdawn);
            console.log(dropdawnItems);

            dropdawnItems.slideToggle();
        }

        function toggleLoader() {
            const loader = document.getElementById('loader');
            if (loader.classList.contains('hidden')) {
                loader.classList.remove('hidden');
                loader.classList.add('flex');
            } else {
                loader.classList.remove('flex');
                loader.classList.add('hidden');
            }
        }
    </script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            min-width: 0;
            font-family: 'Encode Sans';
        }

        ::-webkit-scrollbar {
            width: .3rem;
            height: .3rem;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #FF5B19;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-track {
            background-color: lightgray;
        }

        html {
            scroll-behavior: smooth;
        }

        .nav-slide a {
            display: flex;
            width: 100%;
            font-weight: bold;
            white-space: nowrap;
            text-transform: uppercase;
            text-align: right;
            padding: .75rem;
        }
    </style>
</body>
</html>
<?php /**PATH C:\Users\Programación\Desktop\miguel\resources\views/layouts/html-layout.blade.php ENDPATH**/ ?>