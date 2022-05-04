<x-layout>
    <form class="user-form" action="/register" method="post">
        @csrf
        <h3>Registration Form</h3>
        <input type="text" name="username" id="username"
               placeholder="Username" value={{ old('username')}}>
        @error('username')
            <p class="warning">{{ $message }}</p>
        @enderror
        <input type="email" name="email" id="email" 
               placeholder="Email" value={{ old('email')}}>
        @error('email')
            <p class="warning">{{ $message }}</p>
        @enderror
        <input type="password" name="password" id="password"
               placeholder="Password">
        @error('password')
            <p class="warning">{{ $message }}</p>
        @enderror
        <input class="submit-center" type="submit" value="Submit">
        <p>Already registered? <a href="/login">Log in!</a></p>
    </form>  
    @if (session()->has('success'))
        <span class="success">{{ session('success') }}</span>
    @endif 
</x-layout>
