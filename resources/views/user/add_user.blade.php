<h1>Add User</h1>

< action="{{ route('user.store') }}" method="POST">
    @csrf
    <label for="name">Name: </label>
    <input type="text" id="name" name="'name" required><br></br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br></br>

    <button type="submit">Kirim</button>
    <a href="{{ route('welcome') }}">
        <button type="button">Kembali</button>
    </a>
    
</form>