<form action="{{ route('login') }}" method="post" class=" bg-gray-50 max-w-[350px] max-h-[400px] h-[400px] flex flex-col  gap-4 text-orange-950 m-auto mt-16 drop-shadow-lg rounded-lg">
        @csrf

        <h1 class="text-center font-bold text-orange-50  text-3xl bg-orange-500 p-4 rounded-t-lg">{{ $title }}</h1>

        <div class="flex flex-col p-4 w-full h-full">

            <div class="flex flex-col gap-4 mt-4">
                <label for="email" class=" h-fit p-2 grid grid-cols-3 items-center">Email
                    <input hidden type="text" name="route" value="{{ $route }}">
                    <input class="bg-gray-300 p-1  rounded col-span-2 caret-orange-950" type="email" name="email" id="email"
                    >
                </label>
                <label for="password" class=" h-fit p-2 grid grid-cols-3 items-center">Password
                    <div class="flex col-span-2 gap-1 items-center bg-gray-300 p-1 rounded">
                        <input  class="text-sm bg-gray-300  rounded  caret-orange-950" type="password" name="password" id="password">
                        <button onclick="togglePasswordVisibility()" type="button" class="flex items-center pr-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" id="show">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hidden" id="hide">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>


                        </button>


                    </div>
                </label>

            </div>
            <button class='max-w-[150px] w-[150px] p-4 bg-orange-500 rounded-lg text-orange-50 font-bold mt-auto ml-auto' type="submit">Login</button>
        </div>
    </form>

<style>
    input:focus {
        outline: none;
    }

</style>

<script>

    function togglePasswordVisibility() {
        let show = document.getElementById("show");
        let hide = document.getElementById("hide");
        let input = document.getElementById("password");

        if (input.type === "password") {
            input.type = "text";


            show.classList.add("hidden");
            hide.classList.remove("hidden");
        } else {
            input.type = "password";
            show.classList.remove("hidden");
            hide.classList.add("hidden");
        }
    }

</script>
