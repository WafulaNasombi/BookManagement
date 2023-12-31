<!DOCTYPE html>
<html>
<head>
    <title>Welcome to the Bookstore</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* ... (existing styles) ... */

        body {
            background-image: url("https://images.unsplash.com/photo-1481627834876-b7833e8f5570?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8bGlicmFyeXxlbnwwfHwwfHx8MA%3D%3D&w=1000&q=80");
            background-size: cover;
            
            background-position: center;
        }

        .welcome-text {
            text-align: center;
            color: white;
            padding: 100px 0;
        }

        .search-section {
            text-align: center;
            margin-top: -10px;
            
        }

        .search-input {
            margin-top: 5px;
            width: 60%;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
        }

        .search-button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
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

    <div class="container mt-4">
        <h1>Welcome to the Bookstore</h1>
        <div class="welcome-text">
            <h2>Looking for something specific? We got you:</h2>
        </div>

        <div class="search-section">
            <input type="text" class="search-input" placeholder="Enter your search...">
            <button class="search-button">Search</button>
        </div>

        {{-- <div class="container mt-4">
            <h2>Featured Authors</h2>
            <div class="row">
                <!-- Display some authors horizontally in three columns -->
                @foreach ($authors as $author)
                    <div class="col-md-6 mb-4 author-card">
                        <div class="card">
                            <img  src="{{ $author->image_url }}" class="card-img-top" alt="{{ $author->name }} Cover">
                            <div class="card-body">
                                <h5 class="card-title">{{ $author->firstname }}{{ $author->lastname }}</h5>
                                <h6 class="card-title">{{ $author->write_up}}</h6>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div> --}}
    </div>

    {{-- <div class="container mt-4 contact-form">
        <h2>Feel Free to Contact Us</h2>
        <form action="/contact" method="post">
            <!-- Contact form fields -->
            <!-- ... (add your form fields here) ... -->

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div> --}}

    
    
    

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