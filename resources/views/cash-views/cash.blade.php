@extends('layouts.html-layout')

@section('title', 'Cash')
@section('content')

    <main class="w-full h-full min-h-[calc(100vh-3.5rem)] p-4  flex flex-col gap-6">
        <section>

            <canvas class="border border-orange-950 w-full h-[50vh]"></canvas>

        </section>
        <section class="w-full h-fit flex flex-wrap flex-col gap-4  overflow-scroll">

            <div class="flex  gap-2" >
                <button class="bg-orange-500 w-full text-orange-50 font-bold text-2xl rounded-md">Mesa</button>
                <button class="bg-orange-500 w-full text-orange-50 font-bold text-2xl rounded-md">Para llevar</button>
            </div>

            <div class="flex flex-col gap-4">

                <div class="w-full h-20 border  rounded-lg bg-gray-100 drop-shadow-lg flex flex-col items-center justify-center gap-2">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-24 h-24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                    <h2 class="text-2xl">Mesa</h2>


                </div>
                <div class="w-full h-20 border  rounded-lg bg-gray-100 drop-shadow-lg flex flex-col items-center justify-center gap-2">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-24 h-24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    <h2 class="text-2xl">Para llevar</h2>
                </div>


            </div>



        </section>

    </main>

@endsection
