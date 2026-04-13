<!--
Faça um programa que receba os dados a seguir de vários produtos: 
preço unitário, país de origem (1-Estados Unidos; 2 - México; e 3 outros),
meio de transporte (T- terrestre; F - fluvial; e A - aéreo), 
carga perigosa (S-sim; N - não), 
finalize a entrada de dados com um preço inválido, ou seja, menor ou igual a zero. 
O programa deve calcular e mostrar os itens a seguir.
O valor do imposto,usando a regra a seguir.
Até 100,00 = 5%
maior que 100,00 = 10%
O valor do transporte, usando a regra a seguir.
carga perigosa = sim = 1 = 50,00
2 = 21,00
3 = 24,00
nao = 1 = 12,00
2 = 21,00
3 = 60,00
O valor do seguro usando a regra a seguir
Os produtos que vêm do México e os produtos que utilizam transporte aéreo 
pagam metade do valor do seu preço unitário como seguro.

O preço final, ou seja, preço unitário mais imposto mais valor do transporte 
mais valor do seguro.
O total dos impostos.-->
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Resultado do Cálculo</title>
        <link rel="stylesheet" href="estilo.css">
    </head>
    <body>
        <div class="container-vendas">
            <h3>Produto</h3>
            <?php

            $motos = $_GET['moto'];
            $precos = $_GET['preco_unit'];
            $paiss = $_GET['pais'];
            $transportes = $_GET['transporte'];
            $cargas = $_GET['carga'];

            $cont = 0; 

            do {
                $moto = $motos[$cont];
                $preco = $precos[$cont];
                $pais = $paiss[$cont];
                $transporte = $transportes[$cont];
                $carga = $cargas[$cont];

                if ($preco <= 0) {
                    echo "<div class='erro-destaque'>";
                    echo "Preco errado (R$ " . number_format($preco, 2, ',', '.') . ").";
                    echo "</div>";

                    echo "<form action='produtos_mostra.html' method='get' class='form-retorno'>";
                    echo "<input type='submit' class='botao-enviar' value='Faz de novo'>";
                    echo "</form>";
                    break;
                } else {

                    if ($preco <= 100) {
                        $imppais = $preco * 0.05;
                    } else {
                        $imppais = $preco * 0.10;
                    }

                    $valortransp = 0;
                    if ($carga == "S") {
                        if ($pais == 1)
                            $valortransp = 50.00;
                        elseif ($pais == 2)
                            $valortransp = 21.00;
                        elseif ($pais == 3)
                            $valortransp = 24.00;
                    } else {
                        if ($pais == 1)
                            $valortransp = 12.00;
                        elseif ($pais == 2)
                            $valortransp = 21.00;
                        elseif ($pais == 3)
                            $valortransp = 60.00;
                    }

                    if ($pais == 2 || $transporte == "A") {
                        $seguro = $preco / 2;
                    } else {
                        $seguro = 0;
                    }

                    $totalcusto = $imppais + $valortransp + $seguro;
                    $precofinal = $preco + $totalcusto;

                    echo "<div class='resultado-box'>";
                    echo "Moto:" . $moto . "<br>";
                    echo "Preco: R$ " . number_format($preco, 2, ',', '.') . "<br>";
                    echo "Imposto: R$ " . number_format($imppais, 2, ',', '.') . "<br>";
                    echo "Frete: R$ " . number_format($valortransp, 2, ',', '.') . "<br>";
                    echo "Seguro: R$ " . number_format($seguro, 2, ',', '.') . "<br>";
                    echo "Carga Perigosa: " . ($carga) . "<br>";
                    echo "<div class='total-destaque'>Preco Final: R$ " . number_format($precofinal, 2, ',', '.') . "</div>";
                    echo "</div>";
                }

                $cont++;
            } while ($cont < count($motos));

            echo "<form action='produtos_mostra.html' method='get'>";
            echo "<input type='submit' class='botao-enviar' value='Voltar'>";
            echo "</form>";
            ?>
        </div>
    </body>
</html>