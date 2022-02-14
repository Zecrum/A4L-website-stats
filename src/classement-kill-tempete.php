<?php
    include("connexion.php");
    include("other.php");

?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>A4L - Classement kill</title>
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
                                        <a href="recherche.php" aria-label="Toggle navigation">Recherche joueur</a>
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

    <!-- Start Breadcrumbs -->
    <div class="classementK overlay">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                    <div class="classementK-content">
                        <h1 class="page-title">Classement par kills et tempêtes</h1>
                    </div>
                    <ul class="breadcrumb-nav">
                        <li><a href="index.php">Accueil</a></li>
                        <li>Classement par kills</li>
                        <li>Par tempête</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Small Features Area -->
    <section class="small-features">
        <div class="container">
            <div class="inner-content">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-4 col-12">
                        <!-- Start Single Feature -->
                        <a class="single-feature" href="classement-kill.php">
                            <i class="lni lni-investment"></i>
                            <h2>Classement par kill
                                <span>Voir les kills des joueurs</span>
                            </h2>
                        </a>
                        <!-- End Single Feature -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Small Features Area -->


    <!-- Start About Area -->
    <section class="about-us section">
        <div class="container">
            <div class="row align-items-center">
                <div class="title text-center">
                    <h2>Classements par nombres de kills et par tempête</h2>
                    <p>Sélectionne tes choix</p>
                </div>

                <form class="row gx-3 gy-2 justify-content-center" action="classement-kill-tempete" method="GET">
                    <div class="col-sm-2">
                      <label class="visually-hidden">Preference</label>
                      <select class="form-select" name="duree">
                        <option selected disabled>Choisissez l'heure</option>
                        <option value="1">1h à 7h</option>
                        <option value="7">7h à 13h</option>
                        <option value="13">13h à 20h</option>
                        <option value="20">20h à 1h</option>
                      </select>
                    </div>
                    <div class="col-sm-2">
                        <label class="visually-hidden" >Date Début</label>
                        <div class="input-group">
                          <div class="input-group-text">📅</div>
                          <input type="date" class="form-control" name="dateT" placeholder="Date de débutz" required  value="<?php echo date("Y-m-d", time());?>" min="2021-01-01" max="<?php echo date("Y-m-d", time() + 86400);?>">
                        </div>
                    </div>
                    <div class="col-auto">
                      <button type="submit" class="btn btn-success">Rechercher</button>
                    </div>
                </form>
                

                <table class="table table-striped table-dark table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Joueur</th>
                    <th scope="col">Joueurs tués</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        if (isset($_GET['duree']) && isset($_GET['dateT'])) { // choix de la tempête
                            $dateD = date("Y-m-d H:i:s", strtotime("+".$_GET['duree']." hours 5 minutes", strtotime(date($_GET['dateT']))));
                            
                            if ($_GET['duree'] == 13){
                                $valFin = $_GET['duree'] + 7;
                                $dateF = date("Y-m-d H:i:s", strtotime("+$valFin hours 5 minutes", strtotime(date($_GET['dateT']))));
                            }
                            elseif ($_GET['duree'] == 20){
                                $dateF = date("Y-m-d H:i:s", strtotime("+1 hours 5 minutes", strtotime(date($_GET['dateT']))) + 86400);
                            }
                            else {
                                $valFin = $_GET['duree'] + 6;
                                $dateF = date("Y-m-d H:i:s", strtotime("+$valFin hours 5 minutes", strtotime(date($_GET['dateT']))));
                            }

                            $resultSql1 = $database->query("SELECT playerName, Player.idP, connecte, SUM((TO_SECONDS(dateDeco)-TO_SECONDS(dateCo))) as temps, SUM(killH) as killH FROM Historique, Player
                            WHERE Historique.idP = Player.idP  AND dateCo > '$dateD' AND dateDeco < '$dateF' AND killH >= '1'
                            GROUP BY idP  
                            ORDER BY killH  DESC LIMIT 100");

                            $nb = 1;
                            while ($row = $resultSql1->fetch()){
                                $day = date("Y-m-d", time() + 86400);
                                $player = str_replace(" ", "+", $row["playerName"]);
                                echo "<tr>";
                                echo "<th scope='row'>$nb</th>";
                                echo "<td><a href='https://a4l.zecrum.fr/recherche?playerName=$player&dateDebut=2021-01-01&dateFin=$day'>".ucwords($row['playerName'])."</a></td>";
                                echo "<td>".$row['killH']."</td>";
                                echo "</tr>";
                                $nb++;
                            }
                        }
                    ?>
                    </tbody>
                  </table>

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