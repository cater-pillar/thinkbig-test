<x-layout>
    <form class="user-form" action="/sessions" method="post">
        @csrf
        <h3>Login Form</h3>
        <input type="text" name="email" id="emai" 
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
        <p>Dont have an account? <a href="/register">Register!</a></p>
    </form>
    
</x-layout>
