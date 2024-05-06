<?php
require_once ('../../Controller/CoursC.php'); // Supposant que le chemin vers votre classe CoursC est correct
require_once ('../../Controller/FormationC.php'); // Supposant que le chemin vers votre classe CoursC est correct


$coursC = new CoursC();

if (
    isset($_POST["nom"]) &&
    isset($_POST["description"]) &&
    isset($_POST["duree"]) &&
    isset($_POST["tuteur"]) &&
    isset($_POST["nbrEtudiants"]) &&
    isset($_POST['formation'])
) {

    $nom = $_POST["nom"];
    $description = $_POST["description"];
    $duree = $_POST["duree"];
    $tuteur = $_POST["tuteur"];
    $nbrEtudiants = $_POST["nbrEtudiants"];
    $formationId = (int) $_POST['formation'];


    if ($coursC->nomExisteDeja($nom)) {
        // Nom déjà pris, renvoie une erreur
        header("HTTP/1.1 400 Bad Request");
        echo "Le nom du cours est déjà pris. Veuillez choisir un autre nom.";
        return false;
    }
    $cours = new Cours(0, $nom, $description, $duree, $tuteur, $nbrEtudiants, $formationId);

    $coursC->ajouterCours($cours);

    header("Location: courses.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script>
        function validateForm() {
            var nom = document.getElementById("nom").value.trim();
            var description = document.getElementById("description").value.trim();
            var duree = document.getElementById("duree").value.trim();
            var tuteur = document.getElementById("tuteur").value.trim();
            var nbrEtudiants = document.getElementById("nbrEtudiants").value.trim();

            // Check if any field is empty
            if (nom === "" || description === "" || tuteur === "" || duree === "" || nbrEtudiants === "") {
                alert("Veuillez remplir tous les champs.");
                return false;
            }



            // Check if numeric fields contain valid numbers
            if (isNaN(duree) || isNaN(nbrEtudiants)) {
                alert("Les champs 'Duré' et 'Nombre d'étudiants' doivent être des nombres.");
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
                                <label for="nom">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description">
                            </div>
                            <div class="form-group">
                                <label for="duree">Durée</label>
                                <input type="text" class="form-control" id="duree" name="duree">
                            </div>
                            <div class="form-group">
                                <label for="tuteur">Tuteur</label>
                                <input type="text" class="form-control" id="tuteur" name="tuteur">
                            </div>
                            <div class="form-group">
                                <label for="nbrEtudiants">Nombre d'étudiants</label>
                                <input type="text" class="form-control" id="nbrEtudiants" name="nbrEtudiants">
                            </div>
                            <div class="form-group">
                                <label for="formation">Formation</label>
                                <select class="form-control" id="formation" name="formation">
                                    <?php
                                    // Fetch formations from the database
                                    $formationC = new FormationC();
                                    $formations = $formationC->afficherFormation();

                                    // Loop through the formations and create options for the select input
                                    foreach ($formations as $formation) {
                                        echo '<option value="' . $formation['id'] . '">' . $formation['title'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Ajouter</button>
                            <a href="courses.php"><button class="btn btn-danger" type="button">Retour à la
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



    </script>


</body>

</html>