<?php
require_once '../app/model/adm.php';
require_once '../app/view/admView.php';

class admController{
    private $model;
    private $view;

    public function __construct($db){
        $this->model = new Adm($db);
        $this->view = new admView($db);

    }
    
    //Criar um novo usuário
    public function createAdm(){
        $dados = json_decode(file_get_contents("php://input"),true);
        if(isset($dados['CPF']) && isset($dados['TIPO']) && isset($dados['NOME']) && isset($dados['EMAIL']) && isset($dados['UNIDADE_ESCOLAR']) && isset($dados['SENHA'])){
            
            // Valida se UNIDADE_ESCOLAR é um número de 3 dígitos
            if (!preg_match('/^\d{3}$/', $dados['UNIDADE_ESCOLAR'])) {
                $this->view->sendResponse(['message' => 'Unidade escolar deve ser um número de 3 dígitos!'], 400);
                return;
            }
            
            // Converte para integer
            $dados['UNIDADE_ESCOLAR'] = intval($dados['UNIDADE_ESCOLAR']);
            
            $this->model->create($dados['CPF'],$dados['TIPO'],$dados['NOME'],$dados['EMAIL'],$dados['UNIDADE_ESCOLAR'],$dados['SENHA']);
            $this->view->sendResponse(['message' => 'Administração Atualizada com Sucesso'],201);
        }
        else {
            $this->view->sendResponse(['message' => 'Dados Inválidos!'],400);
        }
    }

    //Obter todos os usuários
    public function getTodasAdministracoes(){
        $administrador = $this->model->getAdministracoes();
        $this->view->sendResponse($administrador);
    }

    //Obter usuário pelo ID
    public function getAdministradorPeloCpf($cpf){
        $administrador = $this->model->getAdministradorCpf($cpf);
        if($administrador){
            $this->view->sendResponse($administrador);
        }
        else{
            $this->view->sendResponse(['message' => 'Cpf não encontrado'],404);
        }
    }

    //Atualizar um usuário
    public function atualizaAdm($cpf){
        $dados = json_decode(file_get_contents("php://input"),true);
        if(isset($dados['CPF']) && isset($dados['TIPO']) && isset($dados['NOME']) && isset($dados['EMAIL']) && isset($dados['UNIDADE_ESCOLAR']) && isset($dados['SENHA'])){
            
            // Valida se UNIDADE_ESCOLAR é um número de 3 dígitos
            if (!preg_match('/^\d{3}$/', $dados['UNIDADE_ESCOLAR'])) {
                $this->view->sendResponse(['message' => 'Unidade escolar deve ser um número de 3 dígitos!'], 400);
                return;
            }
            
            // Converte para integer
            $dados['UNIDADE_ESCOLAR'] = intval($dados['UNIDADE_ESCOLAR']);
            
            $this->model->updateAdm($dados['CPF'],$dados['TIPO'],$dados['NOME'],$dados['EMAIL'],$dados['UNIDADE_ESCOLAR'],$dados['SENHA']);
            $this->view->sendResponse(['message' => 'Administração Atualizada!']);
        }
        else{
            $this->view->sendResponse(['message' => 'Dados Inválidos'],400);
        }
    }

    //Excluir usuário
    public function deleteAdm($cpf){
        $this->model->deleteAdm($cpf);
        $this->view->sendResponse(['message' => 'Administração excluída']);
    }
}
?>