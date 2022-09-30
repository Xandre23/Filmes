<?php
require_once 'lib/Database/Connection.php';
require_once 'app/Core/Core.php';
require_once 'app/Controller/HomeController.php';
require_once 'app/Controller/ErroController.php';
require_once 'app/Model/Filmes.php';
require_once  'vendor/autoload.php';

//pegando o templete
$templete = file_get_contents('app/templete/estrutura.html');


//capturando retorno do metodo
ob_start();
$core = new Core;
$core->start($_GET);
$saida = ob_get_contents();
ob_end_clean();

//deixando a pagina dinamica
$tplPronto = str_replace('{{area_dinamica}}', $saida, $templete);

//mostrando o templete da pagina
echo $tplPronto;
