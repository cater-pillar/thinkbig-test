<x-layout>
    <form class="user-form" action="/store" method="post" enctype="multipart/form-data">
        @csrf
        <h3>Upload CSV File</h3>
        <input type="file" name="csv_file" id="csv_file" accept="csv, xml, xlsv"><br>
        @if (session()->has('failure'))
        <span class="warning">{{ session('failure') }}</span>
        @endif 
        <input type="submit" value="Submit">
        <p><a href="/">Go back</a></p>
    </form>
</x-layout>