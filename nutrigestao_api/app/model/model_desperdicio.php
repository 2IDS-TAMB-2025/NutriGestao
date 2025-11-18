<?php
include_once '../config/conecta_banco.php';

class Desperdicio {

    public function inserirQuantidades($ra, $desperdicio_aluno) {
        $conn = Database::getConnection();
        
        // Aplicar calibração - subtrair 0,45 apenas se a medição for maior ou igual a 450
        if ($desperdicio_aluno >= 0.45) {
            $desperdicio_calibrado = max(0, $desperdicio_aluno - 0.45);
        } else {
            $desperdicio_calibrado = 0;
        }
        
        $stmt = $conn->prepare("
            INSERT INTO DESPERDICIO_ALUNOS (RA, DESPERDICIO_ALUNO, DATA_REGISTRO) 
            VALUES (?, ?, NOW())
        ");
        if (!$stmt) {
            die("Erro na query: " . $conn->error);
        }
        $stmt->bind_param("sd", $ra, $desperdicio_calibrado);
        $stmt->execute();
        $stmt->close();
        return true;
    }

}