<?php
require_once ('../../Controller/FormationC.php'); // Supposant que le chemin vers votre classe CoursC est correct

$formationc = new FormationC();

if (
    isset($_POST["title"]) &&
    isset($_POST["description"]) &&
    isset($_POST["tuteur"]) &&
    isset($_POST["prix"])
) {

    $title = $_POST["title"];
    $description = $_POST["description"];
    $tuteur = $_POST["tuteur"];
    $prix = $_POST["prix"];

    $formation = new Formation(0, $title, $description, $tuteur, $prix);

    $formationc->ajouterFormation($formation);

    header("Location: formations.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script>
        function validateForm() {
            var title = document.getElementById("title").value.trim();
            var description = document.getElementById("description").value.trim();
            var tuteur = document.getElementById("tuteur").value.trim();
            var prix = document.getElementById("prix").value.trim();
            var rating = document.getElementById("rating").value.trim();

            // Check if any field is empty
            if (title === "" || description === "" || prix === "" || rating === "" || tuteur === "") {
                alert("Veuillez remplir tous les champs.");
                return false;
            }

            // Check if string fields contain valid strings
            if (!isString(title, /^[a-zA-Z\s]+$/) || isNaN(title)) {
                // Error message for invalid characters in "title"
                alert("Le champ 'Title' ne peut contenir que des lettres et des espaces.");
                return false;
            }

            // Check if numeric fields contain valid numbers
            if (isNaN(prix) || isNaN(rating) || isNaN(nbrEtudiants)) {
                alert("Les champs 'Prix', 'Rating' et 'Nombre d'étudiants' doivent être des nombres.");
                return false;
            }

            return true;
        }

        function isString(value, allowedChars = /^[a-zA-Z\s]+$/) {
            return typeof value === 'string' && allowedChars.test(value);
        }
    </script>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Admin Dashboard</div>
                        <a class="nav-link" href="index.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="courses.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Cours
                        </a>
                        <a class="nav-link" href="formations.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Formations
                        </a>

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Cours</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Nouveau cours</li>
                    </ol>

                    <div class="container mt-5">
                        <form method="POST" onsubmit="return validateForm()">
                            <div class="form-group">
                                <label for="title">Title
                                </label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description">
                            </div>
                            <div class="form-group">
                                <label for="tuteur">Tuteur</label>
                                <input type="text" class="form-control" id="tuteur" name="tuteur">
                            </div>
                            <div class="form-group">
                                <label for="prix">Prix</label>
                                <input type="number" class="form-control" id="prix" name="prix">
                            </div>

                            <button type="submit" class="btn btn-primary">Ajouter</button>
                            <a href="formations.php"><button class="btn btn-danger" type="button">Retour à la
                                    liste</button></a>
                        </form>
                    </div>
                </div>
            </main>


            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2022</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script>
        function validateForm() {
            var nom = document.getElementById("nom").value;
            var description = document.getElementById("description").value;
            var prix = document.getElementById("prix").value;
            var rating = document.getElementById("rating").value;
            var duree = document.getElementById("duree").value;
            var tuteur = document.getElementById("tuteur").value;
            var nbrEtudiants = document.getElementById("nbrEtudiants").value;

            if (nom == "" || description == "" || prix == "" || rating == "" || duree == "" || tuteur == "" || nbrEtudiants == "") {
                alert("Veuillez remplir tous les champs.");
                return false;
            }

            if (isNaN(prix) || isNaN(rating) || isNaN(nbrEtudiants)) {
                alert("Les champs 'Prix', 'Rating' et 'Nombre d'étudiants' doivent être des nombres.");
                return false;
            }

            return true;
        }
    </script>


    </script>


</body>

</html>