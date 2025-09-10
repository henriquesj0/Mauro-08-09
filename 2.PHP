<?php
function calculaJurosCompostos($capital, $taxa, $tempo) {
    $taxa_decimal = $taxa / 100;
    $montante = $capital * pow(1 + $taxa_decimal, $tempo);
    $juros = $montante - $capital;
    return $juros;
}

$capital = 1000;
$taxa = 5;
$tempo = 2;

$juros_compostos_pago = calculaJurosCompostos($capital, $taxa, $tempo);
echo "Juros Compostos: " . $juros_compostos_pago . "\n";
?>