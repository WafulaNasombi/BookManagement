<!DOCTYPE html>
<html>
<head>
    <title>Welcome to the Bookstore</title>
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
        <h1>Register an Author</h1>
        <form id="author-form">
            <div class="form-group">
                <label for="image"><strong>Profile Picture</strong></label>
                <input type="file" class="form-control-file" id="image"name="image_url">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="firstname"><strong>First Name</strong></label>
                    <input type="text" class="form-control" id="firstname">
                </div>
                <div class="form-group col-md-6">
                    <label for="lastname"><strong>Last Name</strong></label>
                    <input type="text" class="form-control" id="lastname">
                </div>
            </div>
            <div class="form-group">
                <label  for="type"><strong>Type of Author</strong></label>
                <p>
                    <i>Which Genres do you write on mostly. If more than one write them like so:</i><br>
                    <i>Fiction\Thriller\Mystery</i><br>
                    
                </p>
                <input type="text" class="form-control" name="type" id="type">
            </div>
            
            <div class="form-group">
                <label for="email"><strong>Email</strong></label>
                <input type="email" class="form-control" id="email">
            </div>
            <div class="form-group">
                <label for="write_up"><strong>Write Up</strong></label>
                <p>
                    <i>Feel free to tell us anything else you want</i>
                <textarea class="form-control" id="write_up" rows="5"></textarea>
            </div>
            <button type="button" class="btn btn-primary" id="submit-button">Submit</button>
        </form>
    </div>
    


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const submitButton = document.getElementById('submit-button');
    
            submitButton.addEventListener('click', function() {
                
    
                const formData = new FormData();
                formData.append('image_url', document.getElementById('image').files[0]);
                formData.append('firstname', document.getElementById('firstname').value);
                formData.append('lastname', document.getElementById('lastname').value);
                formData.append('type', document.getElementById('type').value);
                formData.append('email', document.getElementById('email').value);
                formData.append('write_up', document.getElementById('write_up').value);
    
                axios.post('/api/authors', formData, {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              })
            .then(response => {
                console.log(response.data);
                // Redirect to books view and display success message
                window.location.href = '/authors'; // Change '/books' to your actual route
                alert('Author added successfully'); // Display success message
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