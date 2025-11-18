<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    require_once '../app/controller/cardapioController.php';
    require_once '../app/controller/contagem_alunosController.php';
    require_once '../app/controller/desperdicioController.php';

    $database = new DataBase();
    $db = $database->getConnection();

    $method = $_SERVER['REQUEST_METHOD'];
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode('/',$uri);

    $cardapioController = new CardapioController($db);
    $contagemController = new contagemController($db);
    $desperdicioController = new DesperdicioController($db);
    
    //ROTA: localhost/nutrigestao_api/cardapio
    if($uri[2] == "cardapio"){
        if($method == "GET"){
            $cardapioController->getCardapio();
        }
    }
    else if($uri[2] == "contagem"){
        if($method == "POST"){
            $contagemController->inserirContagem();
        }
    }
    else if($uri[2] == "desperdicio"){
        if($method == "POST"){
            $desperdicioController->inserirQuantidades();
        }
    }
?>