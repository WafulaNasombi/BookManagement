<!DOCTYPE html>
<html>
<head>
    <title>Welcome to the Bookstore</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>

.side-panel {
    position: fixed;
    top: 0;
    right: -80%; /* Initially hidden to the right */
    width: 50%;
    height: 100%;
    background-color: #f2f2f2;
    padding: 20px;
    box-shadow: -4px 0px 4px rgba(0, 0, 0, 0.2);
    transition: right 0.3s ease-in-out;
    z-index: 1000; /* Ensure the side panel is on top of other content */
    overflow-y: auto; /* Add vertical scrollbar if content overflows */
}

.side-panel.active {
    right: 0; /* Slides in from the right */
}

      .circular-image {
    width: 150px; /* Set your desired width */
    height: 150px; /* Set your desired height */
    border-radius: 50%; /* Makes the frame circular */
    overflow: hidden; /* Hide overflowing parts of the image */
}

.circular-image img {
    width: 100%; /* Make sure the image fills the circular frame */
    height: 100%; /* Make sure the image fills the circular frame */
    object-fit: cover; /* Maintain the aspect ratio and cover the frame */
}
</style>  
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
        <div class="d-flex justify-content-between align-items-center">
            <h1>Authors</h1>
            <a href="/register_author" class="btn btn-primary">Register an Author</a>
        </div>

        <div class="row mt-3">
            @foreach($authors as $author)
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-body author-container" data-id="{{ $author->id }}">
                        <div class="d-flex align-items-start">
                            <div class="circular-image">
                                <img src="{{ $author->image_url }}" class="card-img-top" alt="{{ $author->name }} Image">
                            </div>
                            <div class="ml-3">
                                <h5 class="card-title">{{ $author->firstname }} {{ $author->lastname }}</h5>
                                <h6 class="card-title">{{ $author->type }}</h6>
                                <p class="card-text">{{ $author->email }}</p>
                            </div>
                        </div>
                        <p class="card-text">{{ $author->write_up }}</p>

                         <!-- Add Preview button -->
                         <button class="btn btn-primary preview-btn" data-id="{{ $author->id }}">Preview</button>
                        
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
                <img src="" alt="Author Image" id="authorImage" class="img-fluid">
            </div>
                
            <div class="col-md-9">
                <div class="author-info">
                    <h2 id="authorName"></h2>
                    <h5 id="authorType"></h5>
                    <p><strong>Email:</strong> <span id="authorEmail" class="author-email"></span></p>
                </div>
                <div class="author-write-up">
                    <h4>Write Up</h4>
                    <p id="authorWriteUp" class="author-write-up-content"></p>
                </div>
                <div class="author-books">
                    <h4>Author's Books</h4>
                    <ul id="bookList" class="author-books-list"></ul> <!-- Changed to <ul> -->
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
            const authorImage = document.querySelector('#authorImage');
            const authorName = document.querySelector('#authorName');
            const authorType = document.querySelector('#authorType');
            const authorEmail = document.querySelector('#authorEmail');
            const authorWriteUp = document.querySelector('#authorWriteUp');
            const bookList = document.querySelector('#bookList'); // Changed to <ul>
    
            previewButtons.forEach(button => {
                button.addEventListener('click', function() {
                    event.stopPropagation();
                    const authorId = this.getAttribute('data-id'); // Get the author ID from the button attribute
    
                    axios.get(`/api/authors/${authorId}`)
                        .then(response => {
                            const data = response.data;
                            authorImage.src = data.image_url;
                            authorName.textContent = `${data.firstname} ${data.lastname}`;
                            authorType.textContent = data.type;
                            authorEmail.textContent = data.email;
                            authorWriteUp.textContent = data.write_up;
    
                            // Clear the book list before populating with the filtered books
                            bookList.innerHTML = '';
    
                            // Create a container to hold the book cards
const bookContainer = document.createElement('div');
bookContainer.className = 'row';

data.books.forEach(book => {
    // Create a card for each book
    const bookCard = document.createElement('div');
    bookCard.className = 'col-md-4 mb-4 book-card'; // Use col-md-4 for three columns

    const cardContent = `
        <div class="card h-100">
            <img src="${book.cover_url}" class="card-img-top" alt="${book.name} Cover">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title mb-2">${book.name}</h5>
                <p class="card-text">${book.category}</p>
                
            </div>
        </div>
    `;

    bookCard.innerHTML = cardContent;
    bookContainer.appendChild(bookCard);
});

// Append the book container to the book list
bookList.appendChild(bookContainer);
    
                            sidePanel.classList.add('active');
                        })
                        .catch(error => {
                            console.error(error);
                        });
                });
            });
    
            closeButton.addEventListener('click', function() {
                event.stopPropagation();
                sidePanel.classList.remove('active');
            });
    
            document.addEventListener('click', function(event) {
                if (!sidePanel.contains(event.target)) {
                    sidePanel.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>