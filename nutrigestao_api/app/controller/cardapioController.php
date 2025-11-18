<?php
    require_once '../app/model/model_cardapio.php';
    require_once '../app/view/cardapioView.php';

    class CardapioController{
        private $modelCardapio;
        private $view;

        public function __construct($db){
            $this->modelCardapio = new Cardapio($db);
            $this->view = new cardapioView();

        }

        public function getCardapio(){
            $cardapio = $this->modelCardapio->getUltimosCardapios();
            $this->view->sendResponse($cardapio);
        }
    }
?>