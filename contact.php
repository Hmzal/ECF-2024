<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Send email logic here
        if (mail('zoo@example.com', $title, $description, "From: $email")) {
            $message = "Your message has been sent.";
        } else {
            $message = "Sorry, something went wrong. Please try again.";
        }
    } else {
        $message = "Invalid email address.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arcadia Zoo</title>

    <!-- Favicon -->
    <link rel="icon" href="img/favicon.ico">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Carattere&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="bootstrap-5.2.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Owl Carousel CSS -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <link href="./css/styles_index.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?> <!-- Include the navbar -->

    <div class="container mt-5">
        <h2 class="mb-4">Contact Us</h2>
        <?php if (isset($message)): ?>
            <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
        <form action="contact.php" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>

    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <img src="./images/animal-kingdom.jpg" alt="Animal Kingdom" class="img-fluid mb-3">
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Contact Us</h5>
                    <p>Email: <a href="mailto:arcadia.zoo@gmail.com" class="text-white">arcadia.zoo@gmail.com</a></p>
                    <p>Phone: <a href="tel:0610800800" class="text-white">0610800800</a></p>
                    <p>Address: 20 Broceliande forest</p>
                </div>
                <div class="col-md-4">
                    <h5>Follow Us</h5>
                    <a href="#" class="text-white me-2"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white me-2"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-white me-2"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white me-2"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <p class="mb-0">&copy; 2024 Arcadia Zoo. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Your Custom JS -->
    <script src="./js/navigate.js"></script>

    <!-- JS to reset form fields on load -->
    <script>
        window.onload = function (){
            document.querySelector('form').reset();
        }
    </script>
</body>
</html>
