<?php
    $url = 'https://api.football-data.org/v2/teams';
    $token = "27719df59a6f4a64959954fa35d4a6ad";

    $curl = curl_init($url . '/' . $_GET['id']);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'X-Auth-Token: 27719df59a6f4a64959954fa35d4a6ad'
    ]);

    $response = json_decode(curl_exec($curl), true);
    curl_close($curl);

    $result = $response;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

        <?php echo $result['name']; ?>    
    
</body>
</html>