<?php
require_once '../app/model/model_desperdicio.php';
require_once '../app/view/desperdicioView.php';

    class DesperdicioController{
        private $modelDesperdicio;
        private $view;

        public function __construct($db){
            $this->modelDesperdicio = new Desperdicio($db);
            $this->view = new desperdicioView();

        }
        
        //Registrar desperdicio
        public function inserirQuantidades(){
            $data = json_decode(file_get_contents("php://input"),(true));
            if(isset($data['RA']) &&
               isset($data['DESPERDICIO_ALUNO'])
            ){
                $this->modelDesperdicio->inserirQuantidades($data['RA'], $data['DESPERDICIO_ALUNO'],);
                $this->view->sendResponse(['message'=> 'Desperdício registrado!'], 201);
            }
            else{
                $this->view->sendResponse(['message' => 'Dados Inválidos'], 400);
            }
        }
    }
?>