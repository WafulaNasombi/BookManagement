<!DOCTYPE html>
<html>
<head>
    <title>Our Library</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .side-panel {
            position: fixed;
            top: 3%;
            right: -100%; /* Initially hidden to the right */
            width: 500px;
            height: 100%;
            background-color: #f2f2f2;
            padding: 20px;
            box-shadow: -4px 0px 4px rgba(0, 0, 0, 0.2);
            transition: right 0.3s ease-in-out;
            z-index: 1000; /* Ensure the side panel is on top of other content */
            overflow-y: auto; /* Add vertical scrollbar if content overflows */
        }
    
        .side-panel.active {
            right: 0; /* Slides in to the right */
        }
    
        .side-panel .side-content {
            display: flex;
            
            padding: 20px;
        }
    
        .side-panel .col-md-3 {
            padding: 0;
            flex: 0 0 30%;
            display: flex;
            flex-direction: column; /* Change to column layout */
            justify-content: flex-start;
            align-items: center; /* Center horizontally */
            margin-bottom: 20px;
        }
    
        .side-panel .col-md-3 img {
            max-width: 100%;
            max-height: 300px;
            object-fit: contain;
            margin-bottom: 10px;
        }
    
        .side-panel .col-md-9 {
            padding: 0;
            flex: 0 0 70%;
        }
    
        .side-panel h2 {
            font-size: 24px;
            margin-bottom: 10px;
            text-align: center;
        }
    
        .book-info {
            padding: 20px;
        }
    
        .book-description {
            padding: 20px;
            border-top: 1px solid #ccc;
        }
    
        .book-description h4 {
            margin-top: 10px;
        }
    
        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            background: none;
            border: none;
            cursor: pointer;
        }
    
        .book-cover {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
        }
    
        .book-title {
            margin-top: 20px;
        }
    
        .author-name {
            margin-top: 10px;
        }
    </style>
    
</head>

<body>
 
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

    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Our Library</h1>
            <a href="/add_book" class="btn btn-primary">Add A Book</a>
        </div>
        &nbsp;
    
        <div class="row">
            @foreach ($books as $book)
                <div class="col-md-2 mb-4 book-card">
                    <div class="card">
                        <img src="{{ $book->cover_url }}" class="card-img-top" alt="{{ $book->name }} Cover">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->name }}</h5>
                            <h6 class="card-title">{{ $book->category }}</h6>
                            <button class="btn btn-primary preview-btn" data-id="{{ $book->id }}">Preview</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    
    <div class="side-panel">
        <button class="close-button">&times;</button>
        <div class="side-content d-flex">
            <div class="col-md-3 text-center">
                <img src="" alt="Book Cover" id="bookCover" class="img-fluid">
            </div>
            
            <div class="col-md-9">
                <div class="book-info">
                    <h2 id="bookTitle"></h2>
                    <p><strong>ISBN:</strong> <span id="bookIsbn" class="book-isbn"></span></p>
                    <p><strong>Pages:</strong> <span id="bookPages" class="book-pages"></span></p>
                    <p><strong>Category:</strong> <span id="bookCategory" class="book-category"></span></p>
                    <p><strong>Author:</strong> <span id="authorName" class="author-name"></span></p>
                </div>
                <div class="book-description">
                    <h4>Description</h4>
                    <p id="bookDescription" class="book-description-content"></p>
                    {{-- <a href="{{ route('edit_book', ['id' => $book->id]) }}" class="btn btn-primary">Edit Book</a> --}}
                 </div>
            </div>
        </div>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const previewButtons = document.querySelectorAll('.preview-btn');
            const sidePanel = document.querySelector('.side-panel');
            const closeButton = document.querySelector('.close-button');
            const bookCover = document.querySelector('#bookCover');
            const bookTitle = document.querySelector('#bookTitle');
            const bookIsbn = document.querySelector('#bookIsbn');
            const bookCategory = document.querySelector('#bookCategory');
            const bookPages= document.querySelector('#bookPages');
            const bookDescription = document.querySelector('#bookDescription');
            const authorName = document.querySelector('#authorName');
           

            previewButtons.forEach(button => {
                button.addEventListener('click', function() {
                    event.stopPropagation(); // Prevent the click event from propagating to the document
                    const bookId = this.getAttribute('data-id');
                    
                    // Fetch book details using Axios
                    axios.get(`/api/books/${bookId}`)
                        .then(response => {
                            const data = response.data;
                            bookCover.src = data.cover_url;
                            bookTitle.textContent = data.name;
                            bookIsbn.textContent = data.isbn;
                            bookCategory.textContent = data.category;
                            bookPages.textContent = data.pages;
                            bookDescription.textContent = data.description;
                            authorName.textContent = `${data.author.firstname} ${data.author.lastname}`;
                            
                        })
                        .catch(error => {
                            console.error(error);
                        });

                    sidePanel.classList.add('active'); // Slide in the side panel
                });
            });

            closeButton.addEventListener('click', function() {
                event.stopPropagation(); // Prevent the click event from propagating to the document
                sidePanel.classList.remove('active'); // Slide out the side panel
            });

            // Close the side panel when clicking anywhere on the page outside the panel
        document.addEventListener('click', function(event) {
            if (!sidePanel.contains(event.target)) {
                sidePanel.classList.remove('active'); // Slide out the side panel
            }
        });

    });
    </script>
</body>
</html>