<!DOCTYPE html>
<html>
<head>
    <title>The Library</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Bookstore</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/books">Books</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/authors">Authors</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1>Edit Book</h1>
        <form id="edit-book-form" >
            <div class="form-group">
                <label for="coverImage">Cover Image</label>
                <input type="file" class="form-control-file" id="coverImage" name="cover_url">
                <img src="{{ $book->cover_url }}" alt="Selected Cover Image" id="selectedCover" class="img-fluid mt-2">
                <small id="imageError" class="text-danger"></small>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $book->name }}">
            </div>
            <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" class="form-control" id="isbn" name="isbn" value="{{ $book->isbn }}">
            </div>
            <div class="form-group">
                <label for="pages">Number of Pages</label>
                <input type="number" class="form-control" id="pages" name="pages" value="{{ $book->pages }}">
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category">
                    <option hidden value="">Choose Category</option>
                    <option value="thriller"{{ $book->category === 'thriller' ? ' selected' : '' }}>Thriller</option>
                    <option value="mystery"{{ $book->category === 'mystery' ? ' selected' : '' }}>Mystery</option>
                    <option value="romance"{{ $book->category === 'romance' ? ' selected' : '' }}>Romance</option>
                    <option value="fantasy"{{ $book->category === 'fantasy' ? ' selected' : '' }}>Fantasy</option>
                    <option value="fiction"{{ $book->category === 'fiction' ? ' selected' : '' }}>Fiction</option>
                </select>
            </div>

            <div class="form-group">
                <label for="author">Author</label>
                <select class="form-control" id="authorSelect" name="authors_id">
                    <option hidden value="">Select an author</option>
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}"{{ $book->authors_id === $author->id ? ' selected' : '' }}>
                            {{ $author->firstname }} {{ $author->lastname }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="5" required>{{ $book->description }}</textarea>
            </div>
            <button type="submit" id="submit-button" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const editBookForm = document.getElementById('edit-book-form');
    const submitButton = document.getElementById('submit-button');
    

    submitButton.addEventListener('click', function() {
        const formData = new FormData(editBookForm);
        const bookId = submitButton.getAttribute('data-book-id');

        axios.put(`/api/books/${bookId}`, formData)
            .then(response => {
                console.log(response.data);
                window.location.href = '/books'; // Change '/books' to your actual route
                alert('Book updated successfully'); // Display success message
            })
            .catch(error => {
                console.error(error);
                // Handle errors
            });
    });
});
    </script>
    
    
</body>
</html>