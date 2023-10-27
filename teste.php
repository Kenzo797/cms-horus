
<?php

// Inclua o arquivo que contém suas classes
require 'model/mensagens.php';

// Crie uma instância da ClasseA
$instanciaA = new ClasseA();

// Teste um método da ClasseA
$resultadoA = $instanciaA->metodoDaClasseA();

if ($resultadoA === true) {
    echo 'O método da ClasseA está funcionando corretamente.';
} else {
    echo 'O método da ClasseA não está funcionando como esperado.';
}

// Crie uma instância da ClasseB
$instanciaB = new ClasseB();

// Teste um método da ClasseB
$resultadoB = $instanciaB->metodoDaClasseB();

if ($resultadoB === true) {
    echo 'O método da ClasseB está funcionando corretamente.';
} else {
    echo 'O método da ClasseB não está funcionando como esperado.';
}

// Você pode adicionar mais testes para outros métodos, se necessário.

?>






