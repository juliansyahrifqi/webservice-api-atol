<?php
    $url = 'https://api.football-data.org/v2/competitions/2014/teams';
    $token = "27719df59a6f4a64959954fa35d4a6ad";

    $curl = curl_init($url);


    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'X-Auth-Token: 27719df59a6f4a64959954fa35d4a6ad'
    ]);

    $response = json_decode(curl_exec($curl), true);
    curl_close($curl);

    $result = $response["teams"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Test</title>
</head>
<body>
    <h1 class="title"><center>LA LIGA CLUB</center></h1>
    <div class="container">
        <?php if(!empty($result)) { ?>
            <?php foreach($result as $res) : { ?>
                <?php $image = $res['crestUrl']; ?>
                <?php $image = preg_replace("/^http:/i", "https:", $image); ?>
                
                    

                    <div class="card">
                        <span class="card-title"><strong><?= $res['name']; ?></strong></span>
                        
                        <div class="card-image">
                            <img src="<?= $image; ?>" class="logo-club">
                        </div>

                        <hr>

                        <div class="card-content">
                           
                            <label for="nama-pendek">Nama Pendek</label><br>
                            <p><strong><?= $res['shortName']; ?></strong></p>

                            <label for="berdiri">Didirikan</label>
                            <p><strong><?= $res['founded']; ?></strong></p>

                            <label for="stadion">Stadion</label>
                            <p><strong><?= $res['venue']; ?></strong></p>

                            <label for="website">Website</label>
                            <p><strong><?= $res['website']; ?></strong></p>
                        </div>

                        <div class="card-action">
                            <a href="info-klub.php?id=<?= $res['id']; ?>">Info Klub</a>
                        </div>
                    </div> 
            <?php } endforeach; ?> 
        <?php } ?>
    </div>
    
    
</body>
</html>