<?php
require_once '../controller/conecta_banco.php'; // ou ajuste para sua conexão

class CardapioModel {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "root", "BD_BANCO_TCC");
        if ($this->conn->connect_error) {
            die("Conexão falhou: " . $this->conn->connect_error);
        }
        $this->conn->set_charset("utf8mb4");
    }

    public function salvarOuAtualizarCardapio($dados) {
        // Verifica se já existe registro para esta data, dia da semana e cpf_usuario
        $sqlCheck = "SELECT id FROM CARDAPIO WHERE data = ? AND dia_semana = ? AND cpf_usuario = ?";
        $stmtCheck = $this->conn->prepare($sqlCheck);
        if (!$stmtCheck) {
            die("Erro na preparação da query: " . $this->conn->error);
        }

        $stmtCheck->bind_param("sss", $dados['data'], $dados['dia_semana'], $dados['cpf_usuario']);
        $stmtCheck->execute();
        $resultado = $stmtCheck->get_result();

        if ($resultado->num_rows > 0) {
            // Atualiza registro existente
            $row = $resultado->fetch_assoc();
            $id = $row['id'];

            $sqlUpdate = "UPDATE CARDAPIO SET
                semana_referencia = ?,
                bebida_manha = ?,
                lanche_manha = ?,
                acompanhamento_manha = ?,
                fruta_manha = ?,
                almoco = ?,
                bebida_tarde = ?,
                lanche_tarde = ?,
                acompanhamento_tarde = ?,
                fruta_tarde = ?
                WHERE id = ?";

            $stmtUpdate = $this->conn->prepare($sqlUpdate);
            if (!$stmtUpdate) {
                die("Erro na preparação da query UPDATE: " . $this->conn->error);
            }

            $stmtUpdate->bind_param(
                "ssssssssssi",
                $dados['semana_referencia'],
                $dados['bebida_manha'],
                $dados['lanche_manha'],
                $dados['acompanhamento_manha'],
                $dados['fruta_manha'],
                $dados['almoco'],
                $dados['bebida_tarde'],
                $dados['lanche_tarde'],
                $dados['acompanhamento_tarde'],
                $dados['fruta_tarde'],
                $id
            );

            $stmtUpdate->execute();
            $stmtUpdate->close();

        } else {
            // Insere novo registro
            $sqlInsert = "INSERT INTO CARDAPIO (
                data, semana_referencia, dia_semana,
                bebida_manha, lanche_manha, acompanhamento_manha, fruta_manha,
                almoco,
                bebida_tarde, lanche_tarde, acompanhamento_tarde, fruta_tarde,
                cpf_usuario
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmtInsert = $this->conn->prepare($sqlInsert);
            if (!$stmtInsert) {
                die("Erro na preparação da query INSERT: " . $this->conn->error);
            }

            $stmtInsert->bind_param(
                "sssssssssssss",
                $dados['data'],
                $dados['semana_referencia'],
                $dados['dia_semana'],
                $dados['bebida_manha'],
                $dados['lanche_manha'],
                $dados['acompanhamento_manha'],
                $dados['fruta_manha'],
                $dados['almoco'],
                $dados['bebida_tarde'],
                $dados['lanche_tarde'],
                $dados['acompanhamento_tarde'],
                $dados['fruta_tarde'],
                $dados['cpf_usuario']
            );

            $stmtInsert->execute();
            $stmtInsert->close();
        }

        $stmtCheck->close();
    }

    public function fecharConexao() {
        $this->conn->close();
    }
}
