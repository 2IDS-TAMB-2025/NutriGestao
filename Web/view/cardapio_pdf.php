<?php
require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../model/model_cardapio_visualizacao.php';
use Dompdf\Dompdf;

// Parâmetros
$unidade_escolar = $_GET['unidade_escolar'] ?? null;
$inicio_semana = $_GET['inicio_semana'] ?? date('Y-m-d');

if (!$unidade_escolar) {
    die("Unidade escolar não especificada.");
}

$model = new CardapioVisualizacaoModel();

// Garante que é segunda-feira
function getSegundaFeira($date) {
    $timestamp = strtotime($date);
    $dayOfWeek = date('w', $timestamp);
    $daysToMonday = $dayOfWeek == 0 ? -6 : 1 - $dayOfWeek;
    return date('Y-m-d', strtotime($daysToMonday . ' days', $timestamp));
}

$inicio_semana = getSegundaFeira($inicio_semana);

// Busca cardápio da semana específica
$cardapios = $model->getCardapiosPorSemana($unidade_escolar, $inicio_semana);

// Datas da semana
$diasSemana = ['segunda', 'terca', 'quarta', 'quinta', 'sexta'];
$datasFormatadas = [];
foreach ($diasSemana as $index => $dia) {
    $datasFormatadas[$dia] = date('d/m/Y', strtotime("$inicio_semana +$index days"));
}

// Nomes dos dias em português
$nomesDias = [
    'segunda' => 'SEGUNDA',
    'terca' => 'TERÇA', 
    'quarta' => 'QUARTA',
    'quinta' => 'QUINTA',
    'sexta' => 'SEXTA'
];

// Função para formatar o texto das refeições
function formatarRefeicao($texto) {
    if (empty(trim($texto))) return '';
    
    // Adiciona • no início de cada linha
    $linhas = explode("\n", $texto);
    $linhasFormatadas = array_map(function($linha) {
        $linha = trim($linha);
        if (!empty($linha)) {
            return "• " . $linha;
        }
        return $linha;
    }, $linhas);
    
    return implode("\n", $linhasFormatadas);
}

// Gera HTML
ob_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cardápio da Semana</title>
  <style>
    body { 
        font-family: 'Arial', sans-serif; 
        margin: 0;
        padding: 20px;
        color: #000;
        background: #fff;
        line-height: 1.4;
    }
    
    .header { 
        text-align: center; 
        margin-bottom: 25px;
        border-bottom: 2px solid #fd9c14;
        padding-bottom: 15px;
    }
    
    .header h1 { 
        margin: 0 0 8px 0; 
        font-size: 22px; 
        color: #fd9c14;
        font-weight: bold;
        text-transform: uppercase;
    }
    
    .header h2 { 
        margin: 0; 
        font-size: 16px; 
        color: #000;
        font-weight: normal;
    }
    
    .semana-periodo {
        margin-bottom: 25px;
    }
    
    .periodo-title {
        background: #fd9c14;
        color: white;
        padding: 10px 12px;
        font-weight: bold;
        font-size: 14px;
        border: 1px solid #fd9c14;
        margin-bottom: 8px;
        text-transform: uppercase;
        border-radius: 8px 8px 0 0;
    }
    
    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin-bottom: 5px;
        font-size: 12px;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 0 0 1px #fd9c14;
    }
    
    th, td {
        border: 1px solid #fd9c14;
        padding: 8px;
        vertical-align: top;
        text-align: left;
    }
    
    th {
        background: #fd9c14;
        color: white;
        font-weight: bold;
        text-align: center;
    }
    
    .dia-header {
        background: #fff8f0;
        font-weight: bold;
        text-align: center;
        width: 15%;
        color: #000;
    }
    
    .refeicao-content {
        font-size: 11px;
        line-height: 1.3;
    }
    
    .refeicao-item {
        margin-bottom: 4px;
    }
    
    .no-refeicao {
        color: #666;
        font-style: italic;
        text-align: center;
        font-size: 11px;
    }
    
    .almoco-content {
        text-align: center;
        font-weight: normal;
        font-size: 11px;
        line-height: 1.3;
    }
    
    .footer {
        margin-top: 30px;
        padding-top: 15px;
        border-top: 1px solid #fd9c14;
        text-align: center;
        font-size: 11px;
        color: #333;
    }
    
    .nutricionista {
        font-weight: bold;
        margin-bottom: 5px;
        color: #fd9c14;
    }
    
    .aviso {
        font-style: italic;
        color: #d00;
        margin-bottom: 5px;
    }
    
    .data-geracao {
        color: #666;
    }
    
    /* Estilos para listas com bullets */
    ul {
        margin: 0;
        padding-left: 15px;
    }
    
    li {
        margin-bottom: 2px;
    }
    
    /* Bordas arredondadas para a primeira e última célula */
    thead tr th:first-child {
        border-top-left-radius: 7px;
    }
    
    thead tr th:last-child {
        border-top-right-radius: 7px;
    }
    
    tbody tr:last-child td:first-child {
        border-bottom-left-radius: 7px;
    }
    
    tbody tr:last-child td:last-child {
        border-bottom-right-radius: 7px;
    }
  </style>
</head>
<body>
  <div class="header">
    <h1>Cardápio Escolar - Semana</h1>
    <h2>Período: <?= $datasFormatadas['segunda'] ?> a <?= $datasFormatadas['sexta'] ?></h2>
  </div>

  <!-- Manhã -->
  <div class="semana-periodo">
    <div class="periodo-title">Manhã</div>
    <table>
      <thead>
        <tr>
          <th class="dia-header">Segunda<br><?= $datasFormatadas['segunda'] ?></th>
          <th class="dia-header">Terça<br><?= $datasFormatadas['terca'] ?></th>
          <th class="dia-header">Quarta<br><?= $datasFormatadas['quarta'] ?></th>
          <th class="dia-header">Quinta<br><?= $datasFormatadas['quinta'] ?></th>
          <th class="dia-header">Sexta<br><?= $datasFormatadas['sexta'] ?></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php foreach ($diasSemana as $dia): 
              $registro = $cardapios[$dia] ?? null;
          ?>
          <td>
            <div class="refeicao-content">
              <?php if ($registro && ($registro['BEBIDA_MANHA'] || $registro['LANCHE_MANHA'] || $registro['ACOMPANHAMENTO_MANHA'] || $registro['FRUTA_MANHA'])): ?>
                <?php if(!empty(trim($registro['BEBIDA_MANHA'] ?? ''))): ?>
                  <div class="refeicao-item"><?= nl2br(htmlspecialchars($registro['BEBIDA_MANHA'])) ?></div>
                <?php endif; ?>
                <?php if(!empty(trim($registro['LANCHE_MANHA'] ?? ''))): ?>
                  <div class="refeicao-item"><?= nl2br(htmlspecialchars($registro['LANCHE_MANHA'])) ?></div>
                <?php endif; ?>
                <?php if(!empty(trim($registro['ACOMPANHAMENTO_MANHA'] ?? ''))): ?>
                  <div class="refeicao-item"><?= nl2br(htmlspecialchars($registro['ACOMPANHAMENTO_MANHA'])) ?></div>
                <?php endif; ?>
                <?php if(!empty(trim($registro['FRUTA_MANHA'] ?? ''))): ?>
                  <div class="refeicao-item"><?= nl2br(htmlspecialchars($registro['FRUTA_MANHA'])) ?></div>
                <?php endif; ?>
              <?php else: ?>
                <div class="no-refeicao">Não haverá aula</div>
              <?php endif; ?>
            </div>
          </td>
          <?php endforeach; ?>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Almoço -->
  <div class="semana-periodo">
    <div class="periodo-title">Almoço</div>
    <table>
      <thead>
        <tr>
          <th class="dia-header">Segunda<br><?= $datasFormatadas['segunda'] ?></th>
          <th class="dia-header">Terça<br><?= $datasFormatadas['terca'] ?></th>
          <th class="dia-header">Quarta<br><?= $datasFormatadas['quarta'] ?></th>
          <th class="dia-header">Quinta<br><?= $datasFormatadas['quinta'] ?></th>
          <th class="dia-header">Sexta<br><?= $datasFormatadas['sexta'] ?></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php foreach ($diasSemana as $dia): 
              $registro = $cardapios[$dia] ?? null;
          ?>
          <td>
            <div class="refeicao-content almoco-content">
              <?php if ($registro && !empty(trim($registro['ALMOCO'] ?? ''))): ?>
                <?= nl2br(htmlspecialchars($registro['ALMOCO'])) ?>
              <?php else: ?>
                <div class="no-refeicao">Não haverá aula</div>
              <?php endif; ?>
            </div>
          </td>
          <?php endforeach; ?>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Tarde -->
  <div class="semana-periodo">
    <div class="periodo-title">Tarde</div>
    <table>
      <thead>
        <tr>
          <th class="dia-header">Segunda<br><?= $datasFormatadas['segunda'] ?></th>
          <th class="dia-header">Terça<br><?= $datasFormatadas['terca'] ?></th>
          <th class="dia-header">Quarta<br><?= $datasFormatadas['quarta'] ?></th>
          <th class="dia-header">Quinta<br><?= $datasFormatadas['quinta'] ?></th>
          <th class="dia-header">Sexta<br><?= $datasFormatadas['sexta'] ?></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php foreach ($diasSemana as $dia): 
              $registro = $cardapios[$dia] ?? null;
          ?>
          <td>
            <div class="refeicao-content">
              <?php if ($registro && ($registro['BEBIDA_TARDE'] || $registro['LANCHE_TARDE'] || $registro['ACOMPANHAMENTO_TARDE'] || $registro['FRUTA_TARDE'])): ?>
                <?php if(!empty(trim($registro['BEBIDA_TARDE'] ?? ''))): ?>
                  <div class="refeicao-item"><?= nl2br(htmlspecialchars($registro['BEBIDA_TARDE'])) ?></div>
                <?php endif; ?>
                <?php if(!empty(trim($registro['LANCHE_TARDE'] ?? ''))): ?>
                  <div class="refeicao-item"><?= nl2br(htmlspecialchars($registro['LANCHE_TARDE'])) ?></div>
                <?php endif; ?>
                <?php if(!empty(trim($registro['ACOMPANHAMENTO_TARDE'] ?? ''))): ?>
                  <div class="refeicao-item"><?= nl2br(htmlspecialchars($registro['ACOMPANHAMENTO_TARDE'])) ?></div>
                <?php endif; ?>
                <?php if(!empty(trim($registro['FRUTA_TARDE'] ?? ''))): ?>
                  <div class="refeicao-item"><?= nl2br(htmlspecialchars($registro['FRUTA_TARDE'])) ?></div>
                <?php endif; ?>
              <?php else: ?>
                <div class="no-refeicao">Não haverá aula</div>
              <?php endif; ?>
            </div>
          </td>
          <?php endforeach; ?>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="footer">
    <p class="nutricionista">Nutricionista responsável: Taynara Carvalho Soares</p>
    <p class="aviso">* Cardápio sujeito a alterações</p>
    <p class="data-geracao">Gerado em: <?= date('d/m/Y H:i') ?></p>
  </div>
</body>
</html>
<?php
$html = ob_get_clean();

// Gera PDF
try {
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    // Nome do arquivo
    $filename = "cardapio_semana_" . date('d_m_Y', strtotime($inicio_semana)) . ".pdf";
    
    // Abre no navegador para o usuário escolher (visualizar/imprimir/baixar)
    $dompdf->stream($filename, [
        "Attachment" => false
    ]);
    
} catch (Exception $e) {
    echo "Erro ao gerar PDF: " . $e->getMessage();
}