<?php
$article = "telescopio espacial hubble"; // Cambia esto por el artículo que quieras buscar
$article = str_replace(' ', '_', $article); // reemplaza espacios por guiones bajos
$url = "https://es.wikipedia.org/api/rest_v1/page/summary/$article";

// Inicializar cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0'); // obligatorio
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($http_code !== 200) {
    die("Error al acceder a Wikipedia: HTTP $http_code");
}

// Decodificar JSON
$data = json_decode($response, true);

if (!$data) {
    die("Error al decodificar JSON");
}

// Mostrar resultado
$title = "<h2>" . htmlspecialchars($data['title']) . "</h2>";
$extract = "<p>" . htmlspecialchars($data['extract']) . "</p>";

if (isset($data['thumbnail']['source'])) {
    $img = "<img src='" . htmlspecialchars($data['thumbnail']['source']) . "' width='200'>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articulo de ejemplo</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
    <div style="display: flex; align-items: flex-start; gap: 20px; max-width: 800px; margin: 20px auto; padding: 20px; font-family: Arial, sans-serif;">
        <?php if (isset($img)): ?>
            <div style="flex-shrink: 0;">
                <?php echo $img; ?>
            </div>
        <?php endif; ?>
        <div style="flex: 1;">
            <?php echo $title; ?>
            <?php echo $extract; ?>
        </div>
    </div>
</body>
</html>