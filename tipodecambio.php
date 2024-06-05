<?php
// URL del servicio web de Banxico para obtener tipos de cambio
$apiUrl = 'https://www.banxico.org.mx/SieAPIRest/service/v1/series/:idSerie/datos';
$apiKey = '9d2a632ce48795f562ebcca1bea4dab329586b71941c6231f017b2bca393eaa9'; // Reemplaza con tu propia API key

// Configurar opciones para la solicitud HTTP
$options = [
    'http' => [
        'header' => 'Bmx-Token: ' . $apiKey
    ]
];
$context = stream_context_create($options);

// Realizar la solicitud HTTP y decodificar la respuesta JSON
$response = @file_get_contents($apiUrl, false, $context);
if ($response === FALSE) {
    echo "Error al obtener los tipos de cambio de Banxico.";
    error_log("Error al obtener los tipos de cambio de Banxico.");
    $exchangeRates = null;
} else {
    $data = json_decode($response, true);
    if ($data !== null && isset($data['bmx']['series'][0]['datos'])) {
        // Extraer los tipos de cambio de la respuesta
        $exchangeRates = $data['bmx']['series'][0]['datos'];
    } else {
        echo "Error al procesar los datos de tipos de cambio de Banxico.";
        error_log("Error al procesar los datos de tipos de cambio de Banxico.");
        $exchangeRates = null;
    }
}
?>
<ul>
    <?php if ($exchangeRates !== null): ?>
        <?php foreach ($exchangeRates as $rate): ?>
            <li><?php echo htmlspecialchars($rate['fecha']) . ': ' . htmlspecialchars($rate['dato']); ?></li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>No se pudieron obtener los datos de tipos de cambio.</li>
    <?php endif; ?>
</ul>
