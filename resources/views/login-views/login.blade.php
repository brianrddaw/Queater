<form action="{{ route('login') }}" method="post">
    @csrf
    <label for="email">Email
        <input hidden type="text" name="route" value="{{ $route }}">
        <input class="border border-blue-500" type="email" name="email" id="email">
    </label><br>
    <label for="password">Password
        <input class="border border-blue-500" type="password" name="password" id="password">
    </label><br>
    <button class='p-4 bg-blue-700 rounded-lg text-white ' type="submit">Login</button>
</form>

<style>
    input:focus {
        outline: none;
    }
</style>
