<?php
class contagem_alunosView{
    //Função que envia as respostas
    public function sendResponse($dados,$statusCode=200){
        http_response_code($statusCode);
        echo json_encode($dados);
    }
}
?>