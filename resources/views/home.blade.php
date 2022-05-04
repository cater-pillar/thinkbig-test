<x-layout>
    @if (session()->has('success'))
        <span class="success">{{ session('success') }}</span>
    @endif
    
        <h1>Home Page</h1>
        <div class="nav">
            <span>Welcome <i>{{ auth()->user()->username }}</i>!</span>
            @if (auth()->user()->is_admin)
                <a class="btn" href="upload">Upload .csv</a>
            @endif
            <form  class="logout-form" action="/logout" method="POST">
                @csrf
                <input class="btn" type="submit" value="Log Out">
            </form>
        </div>
        <h3>Filter through the book list</h3>
        <form class="filter-form" action="/" method="GET" class="filter">
            <input type="text" name="search" id="search" 
                   placeholder="Search by book title" value={{ request('search')}}>
            <select name="age" id="age">
                <option value="">Search by publishing year</option>
                <option value="until5">Up to 5 years old</option>
                <option value="until10">Up to 10 years old</option>
                <option value="above10">More than 10 years old</option>
            </select>
            <input type="submit" value="Submit">
        </form>

        <h3>Book results</h3>
        @if (count($books) == 0)
            <p>No books to show.</p>
        @else
            <table class="books-table">
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Year</th>
                </tr>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $book->naziv_knjige }}</td>
                    <td>{{ $book->autor }}</td>
                    <td>{{ $book->izdavac }}</td>
                    <td>{{ $book->godina_izdanja }}</td>
                </tr>
            @endforeach
            </table>
        @endif
</x-layout>


