<?php
    include("connexion.php");
    include("other.php");
?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>A4L - Recherche</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/png" href="assets/images/logo.png" />

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/LineIcons.2.0.css" />
    <link rel="stylesheet" href="assets/css/animate.css" />
    <link rel="stylesheet" href="assets/css/tiny-slider.css" />
    <link rel="stylesheet" href="assets/css/glightbox.min.css" />
    <link rel="stylesheet" href="assets/css/main.css" />

</head>

<body>

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- /End Preloader -->

    <!-- Start Header Area -->
    <header class="header navbar-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="nav-inner">
                        <!-- Start Navbar -->
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="index.php">
                                <img src="assets/images/logo/logo_a4l.png" alt="Logo">
                            </a>
                            <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ms-auto">
                                    <li class="nav-item">
                                        <a href="index.php" class="" aria-label="Toggle navigation">Accueil</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="classement-heure.php" class="" aria-label="Toggle navigation">Classement Heure</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="classement-kill.php" class="" aria-label="Toggle navigation">Classement Kill</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="recherche.php" aria-label="Toggle navigation" class="active">Recherche joueur</a>
                                    </li>
                                </ul>
                            </div> <!-- navbar collapse -->
                        </nav>
                        <!-- End Navbar -->
                    </div>
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </header>
    <!-- End Header Area -->

    <!-- Start recherche -->
    <div class="recherche overlay">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                    <div class="recherche-content">
                        <h1 class="page-title">Rechercher un joueur</h1>
                    </div>
                    <ul class="breadcrumb-nav">
                        <li><a href="index.php">Accueil</a></li>
                        <li>Recherche</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End recherche -->

    <!-- Start About Area -->
    <section class="about-us section">
        <div class="container">
            <div class="row align-items-center">
                <div class="title text-center">
                    <h2>Recherchez le joueur que vous souhaitez</h2>
                    <p>Sélectionne tes choix</p>
                </div>


                <form class="row gx-3 gy-2 justify-content-center" action="recherche" method="GET">
                    <div class="col-sm-3">
                        <label class="visually-hidden" >Username</label>
                        <div class="input-group">
                          <div class="input-group-text">👤</div>
                          <input type="text" class="form-control" name="playerName" placeholder="Joueur" size="200" required>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label class="visually-hidden" >Date Début</label>
                        <div class="input-group">
                          <div class="input-group-text">📅</div>
                          <input type="date" class="form-control" name="dateDebut" placeholder="Date de débutz" required  value="2021-01-01" min="2021-01-01" max="<?php echo date("Y-m-d", time() + 86400);?>">
                        </div>
                    </div>
                    <div class="col-sm-2">
                      <label class="visually-hidden">Date Fin</label>
                      <div class="input-group">
                        <div class="input-group-text">📅</div>
                        <input type="date" class="form-control" name="dateFin" placeholder="Date de fin" required value="<?php echo date("Y-m-d", time() + 86400);?>" min="2021-01-01" max="<?php echo date("Y-m-d", time() + 86400);?>">
                      </div>
                    </div>
                    <div class="col-auto">
                      <button type="submit" class="btn btn-success">Rechercher</button>
                    </div>
                  </form>
                  <section class="text-center">
                      <br>

                    <?php
                        if (isset($_GET['playerName']) && isset($_GET['dateDebut']) && isset($_GET['dateFin'])) {
                            $playerName = $_GET['playerName'];
                            $dateDebut = $_GET['dateDebut'];
                            $dateFin = $_GET['dateFin'];

                            $resultSql1 = $database->query("SELECT * FROM Player WHERE playerName = '$playerName' LIMIT 1")->fetch();
                            if ($resultSql1 != 0){ // joueur trouvé
                                $idP = $resultSql1['idP'];
                                $resultSql3 = $database->query("SELECT idP, SUM((TO_SECONDS(dateDeco)-TO_SECONDS(dateCo))) as temps, SUM(killH) as killH FROM Historique WHERE idP = '$idP' AND dateCo > '$dateDebut' AND dateCo < '$dateFin' AND (dateCo < '2021-10-30 19:59:00' OR dateCo > '2021-10-31 01:00:00') AND (dateCo < '2021-10-31 19:59:00' OR dateCo > '2021-11-01 01:00:00') GROUP BY idP")->fetch();
                                $resultSql2 = $database->query("SELECT idH, dateCo, dateDeco, (TO_SECONDS(dateDeco)-TO_SECONDS(dateCo)) as temps, killH FROM Historique WHERE idP = '$idP' AND dateCo > '$dateDebut' AND dateCo <= '$dateFin' ORDER BY idH DESC");

                                echo "<h6>Joueur : ".ucwords($playerName)."</h6>";
                                echo "<p>Du $dateDebut au $dateFin</h6>";
                                if ($resultSql1['connecte'] == "True"){
                                    echo "<p>Connecté : ✔️</p>";
                                }
                                else {
                                    echo "<p>Connecté : ❌</p>";
                                }
                                echo "<br>";
                                echo "<h6>Temps de connexion :</h6>";
                                $temps = secondsToTime($resultSql3['temps']);
                                echo "<p class='fw-bold fw-light'>".$temps["d"]. " jours ".$temps["h"]." heures ".$temps["m"]." minutes.</p>";
                                echo "<br><h6>Joueurs tués :</h6>";
                                echo "<p class='fw-bold fw-light'>".$resultSql3['killH']." joueurs.</p>";
                                echo "<br>";
                                echo "<h4 class='text-center'>Historique : </h4>";
                                echo "<table class='table table-striped table-dark'>";
                                echo "<thead>";
                                echo "<tr> <th scope='col'>Connexion</th>";
                                echo "<th scope='col'>Déconnexion</th>";
                                echo "<th scope='col'>Temps</th>";
                                echo "<th scope='col'>Joueurs tués</th></tr>";
                                echo "</thead>";

                                echo "<tbody>";
                                while ($row = $resultSql2->fetch()){
                                    echo "<tr>";
                                    $dateCo = $row['dateCo'];
                                    $dateDeco = $row['dateDeco'];
                                    $temps = secondsToTime($row['temps']);
                                    $sqlSetFR = $database->query("SET lc_time_names = 'fr_FR'");
                                    $resultSqlDate1 = $database->query("SELECT DATE_FORMAT('$dateCo', '%W %e %M %Y %Hh%i') as d")->fetch();
                                    echo "<td>$resultSqlDate1[0]</td>";
                                    if ($row['dateDeco'] == ""){
                                        echo "<td><b>🔗 Connecté 🔗</b></td>";
                                        $date = date("Y-md-d H:m:s");
                                        $resultSqlSeconds = $database->query("SELECT (TO_SECONDS(CURRENT_TIME())-TO_SECONDS('$dateCo')) as temps")->fetch();
                                        $tempsS = secondsToTime($resultSqlSeconds['temps']);
                                        echo "<td><b>".$tempsS["h"]." heures ".$tempsS["m"]." minutes</b></td>";
                                    }
                                    else {
                                        $resultSqlDate2 = $database->query("SELECT DATE_FORMAT('$dateDeco', '%Hh%i') as d")->fetch();
                                        echo "<td>jusqu'à $resultSqlDate2[0]</td>";
                                        if ($temps["h"] == 0 && $temps["m"] <= 5){
                                            echo "<td class='text-warning'>".$temps["h"]." heures ".$temps["m"]." minutes</td>";
                                        }
                                        else {
                                            echo "<td>".$temps["h"]." heures ".$temps["m"]." minutes</td>";
                                        }
                                    }
                                    $kills = $row['killH'];
                                    if ($kills >= 1){
                                        echo "<td>$kills</td>";
                                    }
                                    else{
                                        echo "<td></td>";
                                    }
                                    
                                    
                                    echo "</tr>";
                                }
                                echo "</tbody> </table>";
                            }
                            else{   // pas de joueurs
                                echo "<h6>Pas de joueur trouvé</h6>";
                                echo "<p>Suggestion :</p><br>";
                                $resultSqlOtherPlayer = $database->query("SELECT * FROM Player WHERE playerName LIKE '%$playerName%'");
                                while ($row = $resultSqlOtherPlayer->fetch()){
                                    $day = date("Y-m-d", time() + 86400);
                                    $player = str_replace(" ", "+", $row["playerName"]);
                                    echo "<li><a href='https://a4l.zecrum.fr/recherche?playerName=$player&dateDebut=2021-01-01&dateFin=$day'>".ucwords($row['playerName'])."</a></li>";


                                }
                            }
                            


                        }


                    ?>

                </section>

            </div>
        </div>
    </section>
    <!-- End About Area -->


    <!-- Start Footer Area -->
    <footer class="footer">
        <!-- Start Footer Top -->
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-md-4 col-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-8 col-6">
                                <!-- Single Widget -->
                                <div class="single-footer f-link">
                                    <h3>Contact</h3>
                                    <ul>
                                        <li><a >zecrum.94@gmail.com</a></li>
                                        <li><a >Alex - Zecrum#7458</a></li>
                                    </ul>
                                </div>
                                <!-- End Single Widget -->
                            </div>
                            <div class="col-lg-6 col-md-8 col-6">
                                <!-- Single Widget -->
                                <div class="single-footer f-about">
                                    <h3>Mes réseaux</h3>
                                    <ul class="social">
                                        <li><a href="https://twitter.com/Alexandre_Zeze_" target="_blank"><i class="lni lni-twitter-original"></i></a></li>
                                        <li><a href="https://github.com/Zecrum" target="_blank"><i class="lni lni-github-original"></i></a></li>
                                        <li><a href="https://www.youtube.com/c/JulienClavet" target="_blank"><i class="lni lni-youtube"></i></a></li>
                                    </ul>
                                </div>
                                <!-- End Single Widget -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4 col-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-8 col-6">
                                <!-- Single Widget -->
                                <div class="single-footer f-link">
                                    <h3>A propos de moi</h3>
                                        <p class="copyright-text">
                                        Je m'appelle Alexandre, je suis étudiant en DUT Informatique. J'aime m'amuser sur mon pc :).
                                    </p>
                                </div>
                                <!-- End Single Widget -->
                            </div>
                            <div class="col-lg-6 col-md-8 col-6">
                                <!-- Single Widget -->
                                <div class="single-footer f-about">
                                    <h3>Crédits</h3>
                                    <ul class="">
                                        <li><a href="https://github.com/tomfcz" rel="nofollow" target="_blank">Tomfcz</a> -> API et aide</li>
                                        <li><a href="https://graygrids.com/" rel="nofollow" target="_blank">GrayGrids</a> -> Template du site</li>
                                        <li></li>
                                    </ul>
                                </div>
                                <!-- End Single Widget -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Footer Top -->
    </footer>
    <!--/ End Footer Area -->

    <!-- ========================= scroll-top ========================= -->
    <a href="#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ========================= JS here ========================= -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/tiny-slider.js"></script>
    <script src="assets/js/glightbox.min.js"></script>
    <script src="assets/js/count-up.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script type="text/javascript">
        //========= glightbox
        GLightbox({
            'href': 'https://www.youtube.com/watch?v=r44RKWyfcFw&fbclid=IwAR21beSJORalzmzokxDRcGfkZA1AtRTE__l5N4r09HcGS5Y6vOluyouM9EM',
            'type': 'video',
            'source': 'youtube', //vimeo, youtube or local
            'width': 900,
            'autoplayVideos': true,
        });

        //====== counter up 
        var cu = new counterUp({
            start: 0,
            duration: 2000,
            intvalues: true,
            interval: 100,
            append: " ",
        });
        cu.start();
    </script>
</body>

</html>