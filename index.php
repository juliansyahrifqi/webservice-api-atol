<?php
    $url = 'https://api.football-data.org/v2/competitions/2021/standings';
    $token = '89403b3a0d1c462c91d61cd6882f7d6d';

    // Inisialisasi
    $curl = curl_init($url);

    // Set HTTP Header : Token
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'X-Auth-Token: '.$token.''
    ]);

    // Mendapatkan respons
    $response = json_decode(curl_exec($curl), true);
    
    // Menutup CURL
    curl_close($curl);

    // Mendapatkan array tentang klasemen 
    $result = $response['standings'];

    // Mendapatkan array tentang kompetisi
    $update = $response['competition'];
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

    <title>Klasemen Premier League</title>
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
        <h2 class="center-align">Klasemen Premier League</h2>
        <p class="center-align">Terakhir Update: <strong><?= $update['lastUpdated']; ?></strong></p>
        <table class="klasemen" id="tabel-klasemen">
            <thead>
                <tr>
                    <th class="center-align"> No.</th>
                    <th colspan="2" class="center-align"> Klub</th>
                    <th class="center-align"> Main</th>
                    <th class="center-align"> Menang</th>
                    <th class="center-align"> Seri </th>
                    <th class="center-align"> Kalah </th>
                    <th class="center-align"> GM </th>
                    <th class="center-align"> GK</th>
                    <th class="center-align"> SG </th>
                    <th class="center-align"> Poin </th>
                </tr>
                        
            </thead>
            <tbody>

                <?php if(!empty($result)) { ?>  
                    <?php foreach($result as $res) : ?>
                        <?php $season = $res['type']; ?>
                        <?php $match = $res['table']; ?>

                        <?php if($season == "TOTAL") { ?>
                            <?php foreach($match as $m) : ?>
                                <?php $image = $m['team']['crestUrl']; ?>
                                <?php $image = preg_replace("/^http:/i", "https:", $image); ?>

                            
                                    <tr>
                                        <td class="center-align"><?= $m['position']; ?></td>
                                        <td class="center-align">
                                            <img src="<?= $image;?>" class="icon-team">
                                        </td>
                                        <td>
                                            <a href="info-klub.php?id=<?= $m['team']['id']; ?>"><?= $m['team']['name']; ?></a>
                                        </td>
                                        <td class="center-align"><?= $m['playedGames']; ?></td>
                                        <td class="center-align"><?= $m['won']; ?></td>
                                        <td class="center-align"><?= $m['draw']; ?></td>
                                        <td class="center-align"><?= $m['lost']; ?></td>
                                        <td class="center-align"><?= $m['goalsFor']; ?></td>
                                        <td class="center-align"><?= $m['goalsAgainst']; ?></td>
                                        <td class="center-align"><?= $m['goalDifference']; ?></td>
                                        <td class="center-align"><?= $m['points']; ?></td>
                                    </tr>
                            <?php endforeach; ?>
                        <?php } ?>
                    <?php endforeach; ?>
                <?php } ?>
            </tbody>
        </table>
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