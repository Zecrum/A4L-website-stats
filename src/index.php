<?php
    include("connexion.php");
    include("other.php");


    $url = 'URL'; // URL de l'API pour récupérer les info du serveur Arma 3
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer {INSERT TOKEN}',
        'Content-Type: application/x-www-form-urlencoded',
    ));
    curl_setopt($curl, CURLOPT_POSTFIELDS, '{IP-SERVEUR-ET-PORT}'); // exemple 'ip=a4l.mrratsuper.fr&port=2302'

    $result = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($result, true);
    
?>


<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>A4l - Accueil</title>
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
    
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  

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
                                        <a href="index.php" class="active" aria-label="Toggle navigation">Accueil</a>
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
    
    <!-- Start Hero Area -->
    <section class="hero-area overlay">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                    <div class="hero-content">
                        <h1 class="wow fadeInUp" data-wow-delay=".4s">ARMA FOR LIFE</h1>
                        <div class="button wow fadeInUp" data-wow-delay=".8s">
                            <a href="classement-heure.php" class="btn">Classement</a>
                            <a href="recherche.php" class="btn btn-alt">Trouver un joueur</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero Area -->


    <!-- Start Features Area -->
    <section class="features section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- <div class="alert alert-danger text-center" role="alert">
                        01/02/2022 : services opérationnels
                    </div> -->
                    <div class="section-title wow fadeInUp">
                        <button type="button" class="btn btn-warning btn-lg">
                            <span> 
                                <?php
                                if ($result['api']['response'] != 200) {
                                    echo "Erreur de réception des données";
                                }	
                                else if ($result['infos']['server_locked']){
                                    echo "Serveur verrouillé<br>";
                                }
                                else{
                                    echo "Serveur déverrouillé<br>";
                                } 
                                ?>
                            </span>
                            <span class="badge badge-light text-dark font-weight-bold ml-2">
                                <?php
                                    echo $result['result']['infos']['server_players']." / ".$result['result']['infos']['server_max_players'];
                                ?>
                            
                            </span>
                        </button>



                        

                        <h2 class="wow fadeInUp" data-wow-delay=".4s">Le meilleur site pour voir ses heures de connexions ! </h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">Inutile de rappeler, que ça ne sert à rien de se comparer ! Et que l'historique des
                            connexions débute à partir de 23/06/2021.
                            <br>Julien Clavet</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Features Area -->

    <!-- Start Achievement Area -->
    <section class="our-achievement section">
        <div class="container">
            <div class="row wow fadeInUp">
                <div class="col-lg-10 offset-lg-1 col-md-12 col-12">
                    <div class="title">
                        <h2>Liste des joueurs connectés</h2>
                        <p>Temps de conexion et nombres de kills !</p>
                    </div>
                    <table class="table table-striped table-dark" data-toggle="table" data-search="true">
                        <thead>
                          <tr>
                            <th data-sortable="true" data-field="nom" scope="col">Joueur</th>
                            <th data-sortable="true" data-field="kills" scope="col">Kills</th>
                            <th data-sortable="true" data-field="temps" scope="col">Temps de connexion</th>
                          </tr>
                        </thead>
                        <tbody>

                        <?php
                            echo "<script type=\"text/javascript\">
                                    function sec2time(timeInSeconds) {
                                        var pad = function(num, size) { return ('000' + num).slice(size * -1); },
                                        time = parseFloat(timeInSeconds).toFixed(3),
                                        hours = Math.floor(time / 60 / 60),
                                        minutes = Math.floor(time / 60) % 60,
                                        seconds = Math.floor(time - minutes * 60),
                                        milliseconds = time.slice(-3);
                                    
                                        return pad(hours, 2) + ' heure(s) ' + pad(minutes, 2) + ' minute(s)';
                                    };
                                </script>
                            ";
                        ?>




                        
                        <?php 
                            $nb = 1;
                            foreach ($result['result']['players'] as $value) {
                                $day = date("Y-m-d", time() + 86400);
                                $player = str_replace(" ", "+", $value['player_name_format']);
                                $time = $value['player_time'];

                                echo "<tr>";
                                echo "<td><a href='https://a4l.zecrum.fr/recherche?playerName=$player&dateDebut=2021-01-01&dateFin=$day'>".ucwords($value['player_name_format'])."</a></td>";
                                echo "<td>".$value['player_kills']."</td>";
                                $temps = secondsToTime($value['player_time']);
                                // echo "<td>".$temps["h"]." heures ".$temps["m"]." minutes</td>";
                                echo "<td class='effectif_time_update' uid='$nb' time='$time'></td>";
                                echo "</tr>";
                                $nb++;
                            }
                        ?>
                        <?php
                            echo "<script type=\"text/javascript\">
                            var all_times = new Object();
                            $('.effectif_time_update').each(function() {
                                var time = $(this).attr('time');
                                $(this).text(sec2time(time));
        
                            });
        
        
                            </script>
                            ";

                        ?>
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </section>
    <!-- End Achievement Area -->

    <!-- Start Pricing Table Area -->
    <section class="pricing-table section">
        <div class="container">
            <div class="row wow fadeInUp">
                <div class="col-12">
                    <div class="section-title">
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">Twitter</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">Retrouvez les derniers tweets de la PN et du SDIS</p>
                        <br>
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                <a class="twitter-timeline" data-lang="fr" data-width="800" data-height="400" data-theme="dark" href="https://twitter.com/PN_A4L?ref_src=twsrc%5Etfw">Tweets by PN_A4L</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script> 
                                <br>
                                </div>
                                <div class="col">
                                <a class="twitter-timeline" data-lang="fr" data-width="500" data-height="400" data-theme="dark" href="https://twitter.com/sdis_a4l?ref_src=twsrc%5Etfw">Tweets by PN_A4L</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script> 
                                </div>
                            </div>
                            </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!--/ End Pricing Table Area -->


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
    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/tiny-slider.js"></script>
    <script src="assets/js/glightbox.min.js"></script>
    <script src="assets/js/count-up.min.js"></script>
    <script src="assets/js/imagesloaded.min.js"></script>
    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script type="text/javascript">

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

