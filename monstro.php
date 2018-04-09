<?php
$hardware = array(
    'Processador' => 'Intel Core I5 3570K',
    'Placa Mae' => 'Gigabyte GA B75M-D3H',
    'Placa de Video' => 'Galax Geforce GTX970 4GB GDDR5 OC',
    'Memória:' => 'Hyperx Fury Red-Blue 8gb Ddr3 1600mhz',
    'SSD:' => 'Kingston SSDNow V300 120GB',
    'HD:' => 'Western Digital C.B. 1TB 64MB 7200RPM',
    'Fonte:' => 'EVGA 600W 80 Plus',
    'Gabinete:' => 'Cooler Master K380'
);

$perifericos = array(
    'Monitor' => 'Philips LED LCD 24 144Hz Gaming',
    'Mouse' => 'Logitech G400s',
    'Teclado' => 'Microsoft 600',
    'Headphone' => 'Arcano SHP-80',
    'Microfone' => 'Neewer',
    'Mousepad' => 'Steelseries QCK Mass',
    'Cadeira' => 'Luis Inácio Lula da Silva'
);

$computador = array(
    'HARDWARE' => $hardware,
    'PERIFÉRICOS' => $perifericos
);

echo json_encode($computador);
