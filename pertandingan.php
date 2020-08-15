<?php
    // API URL
    $url = 'https://api.football-data.org/v2/competitions/2021/matches';
    
    // API Token
    $token = '89403b3a0d1c462c91d61cd6882f7d6d';

    // Inisialisasi CURL
    $curl = curl_init($url);

    // Set Header Auth Token 
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'X-Auth-Token: '.$token.''
    ]);

    // Mendapatkan respons 
    $response = json_decode(curl_exec($curl), true);
    
    // Menutup CURL
    curl_close($curl);

    // Mendapatkan array dari respons
    $lastUpdate = $response['competition'];
    $result = $response['matches'];

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Icon Font -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- My CSS -->
    <link rel="stylesheet" href="css/style.css">
    
    <!-- Materialize CSS -->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

    <title>Pertandingan - Premier League</title>
</head>
<body>

    <!-- Navigasi -->

    <nav class="indigo darken-4">
        <div class="nav-wrapper container">
            <a href="#!" class="brand-logo">Premier League</a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            
            <ul class="right hide-on-med-and-down">
                <li><a href="index.php">Klasemen</a></li>
                <li><a href="klub.php">Daftar Klub</a></li>
                <li><a href="pertandingan.php">Pertandingan</a></li>
            </ul>
        </div>
    </nav>

    <ul class="sidenav" id="mobile-demo">
        <li><a href="index.php">Klasemen</a></li>
        <li><a href="klub.php">Daftar Klub</a></li>
        <li><a href="pertandingan.php">Pertandingan</a></li>
    </ul>

    <div class="container">
        <div class="row">
            <h2 class="center-align"> Pertandingan </h2>
            <p class="center-align"><strong>Terakhir Update: <?= $lastUpdate['lastUpdated']; ?></strong></p>
            <div class="col s12 m12">
                <?php if(!empty($result)) { ?>
                    <?php foreach($result as $res) : ?>
                    
                        <div class="card horizontal">
                            <div class="card-stacked">
                                <div class="card-content">
                                    <div class="col s12 m5">
                                        <h2 class="center-align"> <?= $res['score']['fullTime']['homeTeam']; ?></h2>
                                        <h4 class="center-align"> <?= $res['homeTeam']['name']; ?></h4>
                                    </div>
                                    <div class="col s12 m2">
                                        <h3 class="center-align"> VS </h3>
                                    </div>
                                    <div class="col s12 m5">
                                        <h2 class="center-align"> <?= $res['score']['fullTime']['awayTeam']; ?></h2>
                                        <h4 class="center-align"> <?= $res['awayTeam']['name']; ?></h4>
                                    </div>
                                </div>
                                <p class="center-align"><strong> <?= $res['utcDate']; ?> </strong> </p>
                                <p class="center-align"><strong> <?= $res['status']; ?> </strong></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php } ?>
            </div>
        </div>
    </div>
    
    <script src="js/materialize.min.js"></script>
    <script>
        // Sidenav
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.sidenav');
            M.Sidenav.init(elems);
        });
    </script>
</body>
</html>