## NutriGestão

![NutriGestão](./Flutter/nutrigestao/assets/images/logoo.png)  

> Solução tecnológica para o combate ao desperdício de alimentos, monitoramento nutricional e planejamento eficiente nas instituições de ensino.

---

##  Problema

- Desperdício de alimentos por falta de monitoramento do consumo real.
- Preparo inadequado dos lanches, gerando sobras ou faltas.
- Comunicação ineficaz do cardápio, afetando a satisfação dos alunos e aumentando o desperdício.

---

##  Objetivo

- Criar uma solução inovadora para *monitoramento, planejamento e comunicação eficiente*.
- Automatizar o processo de medição do desperdício por meio de *tecnologia IoT*.
- Apresentar *gráficos semanais* com dados de consumo e desperdício.
- Proporcionar *eficiência, economia, satisfação e sustentabilidade*.

---

##  Público-Alvo

- Nutricionistas  
- Alunos  
- Auxiliares de cozinha

---

##  Funcionalidades

- Monitoramento de consumo
- Planejamento de quantidades ideais
- Exibição do cardápio por dia
- Redução de desperdício
- Coleta de dados via RFID + Balança
- Geração de relatórios e gráficos
- Integração entre web, mobile e IoT

---

##  Entregas por Sprint

###  Web

*Sprint 1 - 100%*
- Tela de login (cadastro, esqueci senha, validações)
- Tela inicial (refeições, desperdícios)

*Sprint 2 - 100%*
- Relatórios
- Contagem de alunos
- Restrições alimentares e dietas
- Ações e configurações
- Logout

*Sprint 3 - 100%*
- Integração de dados

### Mobile

*Sprint 1 - 100%*
- Cardápio
- Contagem por turmas (menu lateral)
- Sobre nós (equipe)

*Sprint 2 - 100%*
- Visualização de turmas
- Contagem

*Sprint 3 - 100%*
- Integração mobile

###  IoT

*Sprint 1 - 100%*
- Leitor RFID

*Sprint 2 - 100%*
- Estrutura da balança

*Sprint 3 - 100%*
- Integração do RFID com a balança

---

##  Tecnologias Utilizadas

###  Linguagens

- HTML, CSS, JavaScript (Script)
- PHP
- Flutter (para app mobile)
- MySQL (banco de dados)
- BR Modelo / Astah Community (modelagem)

###  Internet das Coisas (IoT)

- *ESP32*: Microcontrolador com Wi-Fi
- *Leitor RFID*: Identificação dos alunos
- *Célula de carga + HX711*: Medição do peso das sobras
- *LCD Display*: Exibição do peso em tempo real
- *MySQL*: Armazenamento dos dados com nome, hora e peso

---

##  Funcionamento da IoT no NutriGestão

1. *Identificação do aluno*: O cartão RFID é lido e o aluno é reconhecido.
2. *Registro no banco*: O sistema consulta ou atualiza os dados do aluno no MySQL.
3. *Pesagem do desperdício*: O prato é colocado na balança e o valor é exibido no LCD.
4. *Envio automático*: Os dados são enviados para o banco via Wi-Fi.

---

##  Equipe

| Nome                       | Função                                                         |
|----------------------------|----------------------------------------------------------------|
| Alexandre E. da S. Velucci | P.O e Desenvolvedor Full Stack <img src="./Web/view/images/alexandre.png" width="50">     |
| Júlia Puelcher Ribeiro     | Desenvolvedora Full Stack <img src="./Web/view/images/julia.png" width="50">             |
| Yasmin Caroline Brandalia  | Analista de Banco de Dados <img src="./Web/view/images/yasmin.png" width="50">           |
| Gabriel Giorgetti Faria    | Analista de Banco de Dados <img src="./Web/view/images/gabrielF.png" width="50">           |
| Thalita Bichoff Perle      | Scrum Master e Programadora Back-End <img src="./Web/view/images/thalita.png" width="50"> |
| Gabriel Viana Moroni       | Programador Back-End <img src="./Web/view/images/moroni.png" width="50">                  |
| Liebert Henrique Simões    | Programador Front-End <img src="./Web/view/images/liebert.png" width="50">                |
| Amanda Viera Costa         | Programadora Front-End <img src="./Web/view/images/amanda.png" width="50">               |

---
 
📧 [nutrigestaosenai@gmail.com]  
🔗 [nutrigestaosenai]

--- 

## NutriGestão

![NutriGestão](./Flutter/nutrigestao/assets/images/logoo.png)

> Technological solution to combat food waste, monitor nutrition, and efficiently plan meals in educational institutions.

---

##  Problem

- Food waste due to lack of real consumption monitoring.
- Inadequate meal preparation, leading to leftovers or shortages.
- Ineffective communication of the menu, impacting student satisfaction and increasing waste.

---

##  Objective

- Create an innovative solution for *monitoring, planning, and effective communication*.
- Automate the waste measurement process using *IoT technology*.
- Present *weekly charts* with consumption and waste data.
- Promote *efficiency, cost reduction, satisfaction, and sustainability*.

---

##  Target Audience

- Nutritionists  
- Students  
- Kitchen assistants

---

##  Features

- Consumption monitoring
- Ideal quantity planning
- Daily menu display
- Waste reduction
- Data collection via RFID + Scale
- Report and chart generation
- Integration between web, mobile, and IoT platforms

---

##  Deliveries by Sprint

###  Web

*Sprint 1 - 100%*
- Login screen (sign-up, password recovery, validations)
- Home screen (meals, waste)

*Sprint 2 - 100%*
- Reports
- Student count
- Dietary restrictions
- Settings and actions
- Logout

*Sprint 3 - 100%*
- Data integration

###  Mobile

*Sprint 1 - 100%*
- Menu screen
- Count by class (side menu)
- About us (team)

*Sprint 2 - 100%*
- Class overview
- Student count

*Sprint 3 - 100%*
- Mobile integration

###  IoT

*Sprint 1 - 100%*
- RFID reader

*Sprint 2 - 100%*
- Scale structure

*Sprint 3 - 100%*
- Integration between RFID and scale

---

##  Technologies Used

###  Languages

- HTML, CSS, JavaScript
- PHP
- Flutter (for mobile app)
- MySQL (database)
- BR Modelo / Astah Community (modeling)

###  Internet of Things (IoT)

- *ESP32*: Wi-Fi enabled microcontroller
- *RFID Reader*: Student identification
- *Load cell + HX711*: Waste weight measurement
- *LCD Display*: Real-time weight display
- *MySQL*: Data storage including name, time, and weight

---

##  IoT Operation in NutriGestão

1. *Student identification*: RFID card is read, and the student is recognized.
2. *Database registration*: System checks or updates student data in MySQL.
3. *Waste weighing*: Plate is placed on the scale, and weight is shown on the LCD.
4. *Automatic data sending*: ESP32 sends the data via Wi-Fi to the database.

---

##  Team

| Name                        | Role                                                            |
|-----------------------------|-----------------------------------------------------------------|
| Alexandre E. da S. Velucci  | Product Owner & Full Stack Developer <img src="./Web/view/images/alexandre.png" width="50">      |
| Júlia Puelcher Ribeiro      | Full Stack Developer <img src="./Web/view/images/julia.png" width="50">                       |
| Yasmin Caroline Brandalia   | Database Analyst <img src="./Web/view/images/yasmin.png" width="50">                           |
| Gabriel Giorgetti Faria     | Database Analyst <img src="./Web/view/images/gabrielF.png" width="50">                           |
| Thalita Bichoff Perle       | Scrum Master & Back-End Developer <img src="./Web/view/images/thalita.png" width="50">          |
| Gabriel Viana Moroni        | Back-End Developer <img src="./Web/view/images/moroni.png" width="50">                         |
| Liebert Henrique Simões     | Front-End Developer <img src="./Web/view/images/liebert.png" width="50">                        |
| Amanda Viera Costa          | Front-End Developer <img src="./Web/view/images/amanda.png" width="50">                        |

---

📧 [nutrigestaosenai@gmail.com]  
🔗 [nutrigestaosenai]
