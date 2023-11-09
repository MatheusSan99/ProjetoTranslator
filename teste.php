<?php

// Conjunto de dados de treinamento
$dataset = [
    ['peso' => 140, 'textura' => 'áspera', 'fruta' => 'Laranja'],
    ['peso' => 130, 'textura' => 'áspera', 'fruta' => 'Laranja'],
    ['peso' => 150, 'textura' => 'lisa', 'fruta' => 'Maçã'],
    ['peso' => 170, 'textura' => 'lisa', 'fruta' => 'Maçã'],
];

// Ponto desconhecido que queremos classificar
$newPoint = ['peso' => 160, 'textura' => 'lisa'];

// Valor de k (número de vizinhos mais próximos a considerar)
$k = 3;

// Função para calcular a distância entre dois pontos
function calculateDistance($point1, $point2) {
    $weightDiff = abs($point1['peso'] - $point2['peso']);
    $textureDiff = ($point1['textura'] !== $point2['textura']) ? 1 : 0;
    return sqrt($weightDiff * $weightDiff + $textureDiff * $textureDiff);
}

// Calcular distâncias entre o novo ponto e os pontos de treinamento
$distances = [];
foreach ($dataset as $data) {
    $distance = calculateDistance($newPoint, $data);
    $distances[] = ['fruta' => $data['fruta'], 'distance' => $distance];
}

// Ordenar as distâncias em ordem crescente
usort($distances, function($a, $b) {
    return $a['distance'] - $b['distance'];
});

// Selecionar os k vizinhos mais próximos
$nearestNeighbors = array_slice($distances, 0, $k);

// Contar as classes dos vizinhos mais próximos
$counts = array_count_values(array_column($nearestNeighbors, 'fruta'));

// Encontrar a classe com mais votos
arsort($counts);
$predictedClass = key($counts);

echo "A fruta desconhecida é provavelmente uma: " . $predictedClass;

?>
