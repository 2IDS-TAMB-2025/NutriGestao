<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../model/model_cardapio_visualizacao.php';

class CardapioVisualizacaoController {
    private $model;

    public function __construct() {
        $this->model = new CardapioVisualizacaoModel();
    }

    // Busca cardápio da semana específica
    public function getCardapioPorSemana($unidade_escolar, $data_inicio_semana) {
        return $this->model->getCardapiosPorSemana($unidade_escolar, $data_inicio_semana);
    }

    // Busca a última semana com cardápio
    public function getUltimaSemanaComCardapio($unidade_escolar) {
        return $this->model->getUltimaSemanaComCardapio($unidade_escolar);
    }
}

// --- Processamento da requisição ---
$unidade_escolarLogado = $_SESSION['unidade_escolar'] ?? ($_GET['unidade_escolar'] ?? null);
if (!$unidade_escolarLogado) {
    die("Usuário não identificado. Faça login novamente.");
}

$controller = new CardapioVisualizacaoController();

// FUNÇÃO para obter segunda-feira
function getSegundaFeira($date = null) {
    $date = $date ? new DateTime($date) : new DateTime();
    $dayOfWeek = $date->format('w'); // 0=domingo, 1=segunda, ..., 6=sábado
    $daysToMonday = $dayOfWeek == 0 ? -6 : 1 - $dayOfWeek;
    $date->modify($daysToMonday . ' days');
    return $date->format('Y-m-d');
}

// DETERMINA a semana a ser exibida
if (isset($_POST['semana_anterior']) && !empty($_POST['semana_anterior'])) {
    $inicio_semana = getSegundaFeira($_POST['semana_anterior']);
} elseif (isset($_POST['semana_seguinte']) && !empty($_POST['semana_seguinte'])) {
    $inicio_semana = getSegundaFeira($_POST['semana_seguinte']);
} elseif (isset($_POST['inicio_semana']) && !empty($_POST['inicio_semana'])) {
    $inicio_semana = getSegundaFeira($_POST['inicio_semana']);
} else {
    // Busca a última semana com cardápio ou usa a semana atual
    $ultima_semana = $controller->getUltimaSemanaComCardapio($unidade_escolarLogado);
    $inicio_semana = $ultima_semana ? getSegundaFeira($ultima_semana) : getSegundaFeira();
}

// BUSCA o cardápio da semana selecionada
$cardapio_semana = $controller->getCardapioPorSemana($unidade_escolarLogado, $inicio_semana);