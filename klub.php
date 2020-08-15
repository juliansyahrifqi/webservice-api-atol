<?php
    // API URL
    $url = 'https://api.football-data.org/v2/competitions/2021/teams';
    
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
    $result = $response['teams'];
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

    <title>Daftar Klub - Premier League</title>
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

    <div class="row">
        <h2 class="center-align">Daftar Klub</h2>
        <div class="col s12 m12">
            <?php if(!empty($result)) { ?>
                <?php foreach($result as $res) : { ?>
                    <?php $image = $res['crestUrl']; ?>
                    <?php $image = preg_replace("/^http:/i", "https:", $image); ?>

                    <div class="col s12 m4">
                        <div class="card">
                            <center><span class="card-title"><strong><?= $res['name']; ?></strong></span></center>
                            
                            <div class="card-image">
                                <img src="<?= $image; ?>" class="logo-klub valign-wrapper">
                            </div>
                            
                            <div class="card-content">
                                <div class="content">
                                    <p class="center-align">Nama Pendek</p>
                                    <p class="center-align"><b><?= $res['shortName']; ?></b></p>
                                </div>
                                
                                <div class="content">
                                    <p class="center-align">Berdiri</p>
                                    <p class="center-align"><b><?= $res['founded']; ?></b></p>
                                </div>
                                
                                <div class="content">
                                    <p class="center-align">Stadion</p>
                                    <p class="center-align"><b><?= $res['venue']; ?></b></p>
                                </div>
                                
                                <div class="content">
                                    <p class="center-align">Website</p>
                                    <p class="center-align"><a href="<?= $res['website']; ?>"><?= $res['website']; ?></a></p>
                                </div>  
                            </div>

                            <div class="card-action center-align">
                                <a href="info-klub.php?id=<?= $res['id']; ?>" class="waves-effect waves-light btn indigo darken-2">Info Klub</a>
                            </div>
                        </div>
                    </div>       
                <?php } endforeach; ?> 
            <?php } ?>
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