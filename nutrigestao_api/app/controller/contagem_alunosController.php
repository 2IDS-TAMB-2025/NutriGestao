<?php
require_once '../app/model/model_contagem_alunos.php';
require_once '../app/view/contagem_alunosView.php';

class contagemController{
        private $modelContagem;
        private $view;

        public function __construct($db){
            $this->modelContagem = new ContagemModel ($db);
            $this->view = new contagem_alunosView();
        }
        
   public function inserirContagem(){
            $data = json_decode(file_get_contents("php://input"),(true));
            if(isset($data['QUANTIDADE_LANCHE_MANHA']) &&
               isset($data['QUANTIDADE_BEBIDA_MANHA']) &&
               isset($data['QUANTIDADE_LANCHE_TARDE']) &&
               isset($data['QUANTIDADE_BEBIDA_TARDE']) &&
               isset($data['TURMA']) &&
               isset($data['DATA']) &&
               isset($data['UNIDADE_ESCOLAR']) 
            ){
                $this->modelContagem->inserirContagem($data['QUANTIDADE_LANCHE_MANHA'], $data['QUANTIDADE_BEBIDA_MANHA'], $data['QUANTIDADE_LANCHE_TARDE'], $data['QUANTIDADE_BEBIDA_TARDE'], $data['TURMA'], $data['DATA'], $data['UNIDADE_ESCOLAR']);
                $this->view->sendResponse(['message'=> 'Contagem registrada!'], 201);
            }
            else{
                $this->view->sendResponse(['message' => 'Dados Inválidos'], 400);
            }
        }
    }
?>