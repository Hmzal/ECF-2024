<?php
require_once 'config.php';
session_start();
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch habitats
$query = "SELECT * FROM habitat";
$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}

$habitats = $result->fetch_all(MYSQLI_ASSOC);
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
    <h1>Habitats</h1>
    <?php foreach ($habitats as $habitat): ?>
        <div class="habitat">
            <h2><?= htmlspecialchars($habitat['nom']) ?></h2>
            <p><?= htmlspecialchars($habitat['description']) ?></p>
            <!-- Fetch and display animals for this habitat -->
            <?php
            $habitat_id = $habitat['habitat_id'];
            $animal_query = "SELECT * FROM animal WHERE habitat_id = $habitat_id";
            $animal_result = $conn->query($animal_query);

            if (!$animal_result) {
                echo "Error fetching animals: " . $conn->error;
            } else {
                $animals = $animal_result->fetch_all(MYSQLI_ASSOC);
                foreach ($animals as $animal): ?>
                    <div class="animal">
                        <h3><?= htmlspecialchars($animal['prenom']) ?></h3>
                        <p><?= htmlspecialchars($animal['etat']) ?></p>
                    </div>
                <?php endforeach;
            }
            ?>
        </div>
    <?php endforeach; ?>
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
            document.getElementById('join-form').reset();
        }
    </script>
</body>
</html>
