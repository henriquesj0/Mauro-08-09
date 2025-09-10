<!DOCTYPE html>
<html>
<head>
    <title>Calculadora de Multiplicação</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php
$pg_atual = 'multiplicacao';
include 'navbar.php';
$n1 = $_GET['num1'];
$n2 = $_GET['num2'];
$n3 = $_GET['num3'];
?>
        <?php
        function multiplicar_vetor($vetor)
        {
            $resultado = $vetor[0] * $vetor[1] * $vetor[2];
            return $resultado;
        }

        $numeros = array(
            $_GET['n1'],
            $_GET['n2'],
            $_GET['n3']
        );
        
        $resultado = multiplicar_vetor($numeros);
        
        echo "<h2 class='mt-4'>Resultado:</h2>";
        echo "<p class='lead'>" . $numeros[0] . " * " . $numeros[1] . " * " . $numeros[2] . " = " . $resultado . "</p>";
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>