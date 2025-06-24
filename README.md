# 🥗 NutriGestão

> Solução tecnológica para o combate ao desperdício de alimentos, monitoramento nutricional e planejamento eficiente nas instituições de ensino.

---

## 🧠 Problema

- Desperdício de alimentos por falta de monitoramento do consumo real.
- Preparo inadequado dos lanches, gerando sobras ou faltas.
- Comunicação ineficaz do cardápio, afetando a satisfação dos alunos e aumentando o desperdício.

---

## 🎯 Objetivo

- Criar uma solução inovadora para **monitoramento, planejamento e comunicação eficiente**.
- Automatizar o processo de medição do desperdício por meio de **tecnologia IoT**.
- Apresentar **gráficos semanais** com dados de consumo e desperdício.
- Proporcionar **eficiência, economia, satisfação e sustentabilidade**.

---

## 🧍 Público-Alvo

- Nutricionistas  
- Alunos  
- Auxiliares de cozinha

---

## 📱 Funcionalidades

- Monitoramento de consumo
- Planejamento de quantidades ideais
- Exibição do cardápio por dia
- Redução de desperdício
- Coleta de dados via RFID + Balança
- Geração de relatórios e gráficos
- Integração entre web, mobile e IoT

---

## 🚀 Entregas por Sprint

### 🌐 Web

**Sprint 1 - 100%**
- Tela de login (cadastro, esqueci senha, validações)
- Tela inicial (refeições, desperdícios)

**Sprint 2 - 80%**
- Relatórios
- Contagem de alunos
- Restrições alimentares e dietas
- Ações e configurações
- Logout

**Sprint 3 - 85%**
- Integração de dados

### 📱 Mobile

**Sprint 1 - 100%**
- Cardápio
- Contagem por turmas (menu lateral)
- Sobre nós (equipe)

**Sprint 2 - 100%**
- Visualização de turmas
- Contagem

**Sprint 3 - 0%**
- Integração mobile

### ⚙️ IoT

**Sprint 1 - 0%**
- Leitor RFID

**Sprint 2 - 0%**
- Estrutura da balança

**Sprint 3 - 0%**
- Integração do RFID com a balança

---

## 🔧 Tecnologias Utilizadas

### 👨‍💻 Linguagens

- HTML, CSS, JavaScript (Script)
- PHP
- Flutter (para app mobile)
- MySQL (banco de dados)
- BR Modelo / Astah Community (modelagem)

### 🌐 Internet das Coisas (IoT)

- **ESP32**: Microcontrolador com Wi-Fi
- **Leitor RFID**: Identificação dos alunos
- **Célula de carga + HX711**: Medição do peso das sobras
- **LCD Display**: Exibição do peso em tempo real
- **MySQL**: Armazenamento dos dados com nome, hora e peso

---

## 🧩 Funcionamento da IoT no NutriGestão

1. **Identificação do aluno**: O cartão RFID é lido e o aluno é reconhecido.
2. **Registro no banco**: O sistema consulta ou atualiza os dados do aluno no MySQL.
3. **Pesagem do desperdício**: O prato é colocado na balança e o valor é exibido no LCD.
4. **Envio automático**: Os dados são enviados para o banco via Wi-Fi.

---

## 👥 Equipe

| Nome                          | Função                               |
|-------------------------------|--------------------------------------|
| Alexandre E. da S. Velucci    | P.O e Desenvolvedor Full Stack       |
| Júlia Puelcher Ribeiro        | Desenvolvedora Full Stack            |
| Yasmin Caroline Brandalia     | Analista de Banco de Dados           |
| Gabriel Giorgetti Faria       | Analista de Banco de Dados           |
| Thalita Bichoff Perle         | Scrum Master e Programadora Back-End |
| Gabriel Viana Moroni          | Programador Back-End                 |
| Liebert Henrique Simões       | Programador Front-End                |
| Amanda Viera Costa            | Programadora Front-End               |

---

## 📈 Layout e Progresso

> Adicione aqui imagens das telas Desktop, Mobile e quadros de sprint se desejar.

---

## 📝 Licença

Este projeto está licenciado sob a **MIT License**. Veja o arquivo [LICENSE](LICENSE) para mais informações.

---

## ✨ Autora do README

**Yasmin Caroline Brandalia**  
📧 [Seu e-mail aqui, se quiser]  
🔗 [Seu LinkedIn, se quiser]
