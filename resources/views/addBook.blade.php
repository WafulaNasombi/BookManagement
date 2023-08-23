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

    <div class="container mt-4">
        <h1>Add a Book</h1>
        <form id="add-book-form">
            <div class="form-group">
                <label for="coverImage">Cover Image</label>
                <input type="file" class="form-control-file" id="coverImage" name="cover_url">
                <img src="#" alt="Selected Cover Image" id="selectedCover" class="img-fluid mt-2" style="display: none;">
                <small id="imageError" class="text-danger"></small>
            </div>
            
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" required>
            </div>
            <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" class="form-control" id="isbn" required>
            </div>
            <div class="form-group">
                <label for="pages">Number of Pages</label>
                <input type="number" class="form-control" id="pages" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category" required>
                    <option hidden value="">Choose Category</option>
                    <option value="thriller">Thriller</option>
                    <option value="mystery">Mystery</option>
                    <option value="romance">Romance</option>
                    <option value="fantasy">Fantasy</option>
                    <option value="fiction">Fiction</option>
                </select>
            </div>

            <div class="form-group">
                <label for="author">Author</label>
                <select class="form-control" id="authorSelect" name="authors_id">
                    <option hidden value="">Select an author</option>
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->firstname }} {{ $author->lastname }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="5" required></textarea>
            </div>
            <button type="button" class="btn btn-primary" id="submit-button">Add Book</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
       
        document.addEventListener('DOMContentLoaded', function() {
            
            const coverImageInput = document.getElementById('coverImage');
            const selectedCoverImage = document.getElementById('selectedCover');
            const imageError = document.getElementById('imageError');
            const nameInput = document.getElementById('name');
            const pagesInput = document.getElementById('pages');
            const categoryInput = document.getElementById('category');
            const isbnInput = document.getElementById('isbn');
            const descriptionInput = document.getElementById('description');
            const authorSelect = document.getElementById('authorSelect');
            const submitButton = document.getElementById('submit-button');
    
            coverImageInput.addEventListener('change', function() {
                const selectedFile = this.files[0];
                
                if (selectedFile) {
                    const img = new Image();
                    img.src = URL.createObjectURL(selectedFile);
    
                    img.onload = function() {
                        if (img.width <= 700 && img.height <= 1500) {
                            selectedCoverImage.src = img.src;
                            selectedCoverImage.style.display = 'block';
                            imageError.textContent = '';
                        } else {
                            imageError.textContent = 'Image dimensions should not exceed 700x1500 pixels.';
                            selectedCoverImage.style.display = 'none';
                        }
                    };
                } else {
                    selectedCoverImage.style.display = 'none';
                    imageError.textContent = '';
                }
            });
    
            submitButton.addEventListener('click', function() {
                const formData = new FormData();
                formData.append('cover_url', coverImageInput.files[0]);
                formData.append('name', nameInput.value);
                formData.append('pages', pagesInput.value);
                formData.append('category', categoryInput.value);
                formData.append('isbn', isbnInput.value);
                formData.append('description', descriptionInput.value);

                const selectedAuthorId = authorSelect.value;
               formData.append('authors_id', selectedAuthorId);
    
               axios.post('/api/books', formData, {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              })
            .then(response => {
                console.log(response.data);
                // Redirect to books view and display success message
                window.location.href = '/books'; // Change '/books' to your actual route
                alert('Book added successfully'); // Display success message
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