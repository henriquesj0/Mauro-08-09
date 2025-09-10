<?php
function calcularJurosSimples($capital, $taxa, $tempo) {
    $taxa_decimal = $taxa / 100;
    $juros = $capital * $taxa_decimal * $tempo;
    return $juros;
}

$capital = 1000;
$taxa = 5;
$tempo = 2;

$juros_simples_pago = calcularJurosSimples($capital, $taxa, $tempo);
echo "Juros Simples:" . $juros_simples_pago . "\n";
?>