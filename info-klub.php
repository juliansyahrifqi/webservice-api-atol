<?php

    // API URL
    $url = 'https://api.football-data.org/v2/teams';

    // TOKEN API
    $token = '89403b3a0d1c462c91d61cd6882f7d6d';

    // Inisialisasi CURL dengan parameter
    $curl = curl_init($url . '/' . $_GET['id']);

    // Set header request dengan Auth Token
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'X-Auth-Token: '.$token.''
    ]);

    // Mendapatkan respons dari server berupa json
    $response = json_decode(curl_exec($curl), true);
    
    // Close CURL
    curl_close($curl);

    // Mendapatkan array dari hasil respons
    $result = $response;
    $pemain = $response['squad'];
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

    <title>Info Klub</title>
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
            <h2 class="center-align"> Daftar Klub </h2>
                <div class="container col s12 m12 center-align">
                    <div class="card">
                        <?php $image = $result['crestUrl']; ?>
                        <?php $image = preg_replace("/^http:/i", "https:", $image); ?>


                        <div class="card-image">
                            <img src="<?= $image; ?>" class="logo-klub">
                        </div>
                    
                        <div class="card-content">
                            <span class="card-title"><strong> <?= $result['name']; ?> </strong></span>
                            
                            <table>
                                <tr>
                                    <th> Nama Pendek  </th> 
                                    <td> <?= $result['shortName']; ?> </td>
                                </tr>
                                <tr>
                                    <th> Singkatan  </th> 
                                    <td> <?= $result['tla']; ?></td>
                                </tr>
                                <tr>
                                    <th> Berdiri  </th> 
                                    <td> <?= $result['founded']; ?> </td>
                                </tr>
                                <tr>
                                    <th> Stadion  </th> 
                                    <td> <?= $result['venue']; ?> </td>
                                </tr>
                                <tr>
                                    <th> Jersey  </th> 
                                    <td> <?= $result['clubColors']; ?> </td>
                                </tr>
                                <tr>
                                    <th> Alamat  </th> 
                                    <td> <?= $result['address']; ?> </td>
                                </tr>
                                <tr>
                                    <th> No. Tlp  </th> 
                                    <td> <?= $result['phone']; ?> </td>
                                </tr>
                                <tr>
                                    <th> Website  </th> 
                                    <td> <a href="<?= $result['website']; ?>" target="_blank"><?= $result['website']; ?></td>
                                </tr>
                                <tr>
                                    <th> Email  </th>
                                    <td> <?= $result['email']; ?> </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
        
        <h2 class="center-align"> Daftar Pemain </h2>

        <div class="row">
            <div class="col s12 m12">
                <?php if(!empty($pemain)) { ?>
                    <?php foreach($pemain as $p) : { ?>
                
                        <div class="col s12 m6">
                            <div class="card">
                                
                                <div class="card-content">
                                <center><span class="card-title"><strong><?= $p['name']; ?></strong></span></center>
                                
                                    <p class="center-align"><?= $p['position']; ?></p>
                                    <h1 class="center-align"><?= $p['shirtNumber']; ?></h1>
                                    <p class="center-align">Asal Negara: <b><?= $p['nationality']; ?></b></p>
                                    <p class="center-align">Tempat Lahir: <b><?= $p['countryOfBirth'];?></b> </p>
                                    <p class="center-align">Tanggal Lahir: <b><?= $p['dateOfBirth']; ?></b></p>
                                </div>
                            </div>
                        </div>       
                    <?php } endforeach; ?> 
                <?php } ?>
            </div>
        </div>  
        <center><h5>Last Update: <?= $result['lastUpdated']; ?></h5></center>
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