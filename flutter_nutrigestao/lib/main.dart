import 'package:flutter/material.dart';
import 'package:nutrigestao/segunda_tela.dart';
import 'package:nutrigestao/terceira_tela.dart';

void main() {
  runApp(const MainApp());
}

class MainApp extends StatelessWidget {
  const MainApp({super.key});

  @override
  Widget build(BuildContext context) {
    return const MaterialApp(
      home: HomePage(),
      debugShowCheckedModeBanner: false,
    );
  }
}


class HomePage extends StatelessWidget {
  const HomePage({super.key});

  @override
Widget build(BuildContext context) {
  return Scaffold(
    appBar: AppBar(
      title: Row(
        mainAxisAlignment: MainAxisAlignment.start,
        children: [
          Image.asset("images/nutri2.png", width: 50),
          Image.asset("images/nutri1.png", width: 350),
        ],
      ),
      leading: Builder(
        builder: (context) => IconButton(
          icon: const Icon(Icons.menu, color: Colors.white, size: 28),
          onPressed: () {
            Scaffold.of(context).openDrawer();
          },
        ),
      ),
        backgroundColor: const Color.fromRGBO(246, 146, 0, 1),
        toolbarHeight: 100,
      ),
      drawer: Drawer(
        child: ListView(
          padding: EdgeInsets.zero,
          children: [
            Container(
              height: 80,
              child: const DrawerHeader(
                child: Text("Menu Lateral", style: TextStyle(color: Colors.black),),
              ),
            ),
            ListTile(
              leading: Icon(Icons.ballot, color: const Color.fromRGBO(246, 146, 0, 1),),
              title: const Text('Contagem Alunos'),
              onTap: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => const TelaPrincipal()),
                );
              },
            ),
            ListTile(
              leading: Icon(Icons.group, color: const Color.fromRGBO(246, 146, 0, 1),),
              title: const Text('Sobre Nós'),
              onTap: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => const TerceiraTela()),
                );
              },
            ),
          ],
        ),
      ),
      body: const RefeicoesPorDia(),
    );
  }
}

// === TELA DE REFEIÇÕES POR DIA ===
class RefeicoesPorDia extends StatefulWidget {
  const RefeicoesPorDia({super.key});

  @override
  _RefeicoesPorDiaState createState() => _RefeicoesPorDiaState();
}

class _RefeicoesPorDiaState extends State<RefeicoesPorDia> {
  String? _dropdownValue = 'Segunda';

  final Map<String, Map<String, String>> refeicoes = {
    'Segunda': {
      'Manhã': 'Leite Batido com Banana Congelada e Chocolate\nF1: Bolo de Chocolate\nF2 e EM: Pão de Queijo\nMelão',
      'Almoço': 'Arroz\nFeijão\nFrango Empanado\nHambúrguer de feijão\nFradinho com Molho\nParafuso ao Molho Rosê\nSalada de Cenoura e Beterraba Ralada\nLaranja',
      'Tarde': 'Suco de Limão\nPão de Leite com Presunto + Acompanhamentos\nMelão',
    },
    'Terça': {
      'Manhã': 'Leite Napolitano\nPão de Milho com Requeijão\nMaçã',
      'Almoço': 'Arroz\nFeijão\nFricassê de Frango\nFricassê de PTS\nSalada de Acelga\nMelancia',
      'Tarde': 'Suco de Abacaxi com Hortelã\nPão de Forma com Patê de Atum\nMaçã',
    },
    'Quarta': {
      'Manhã': 'Suco de Caju\nF1: Crepioca com Queijo\nF2 e EM: Tortinha de Tapioca com Frango\nBanana Prata',
      'Almoço': 'Arroz\nFeijão Preto\nBife Grelhado\nCozido de Grão de Bico\nSalada de Alface Lisa\nPera',
      'Tarde': 'F2: Idem LM\nEM: Leite Batido com Polpa de Coco\nBolo Simples\nBanana Prata',
    },
    'Quinta': {
      'Manhã': 'Suco de Acerola\nPão de Cenoura com Queijo Muçarela\nF1 e 2ºEM: Frutas Diversas\nF2 e 1º e 3º EM: Bombom',
      'Almoço': 'Arroz\nFeijão\nPeixe Crocante\nLasanha à Bolonhesa de Lentilha\nBrócolis Alho e Óleo\nSalada Mix\nBombom',
      'Tarde': 'Iogurte de Vitamina de Frutas\nF1: Milho e Frutas Diversas\nF2: Milho + Pão com Patê de Ervas e Bombom',
    },
    'Sexta': {
      'Manhã': 'Leite Napolitano\nPão de Milho com Requeijão\nMaçã',
      'Almoço': 'Arroz\nFeijão Preto\nBife Grelhado\nCozido de Grão de Bico\nSalada de Alface Lisa\nPera',
      'Tarde': 'Suco de Abacaxi com Hortelã\nPão de Forma com Patê de Atum\nMaçã',
    }
  };

  @override
  Widget build(BuildContext context) {
    final refeicaoSelecionada = refeicoes[_dropdownValue] ?? {};

    return SingleChildScrollView(
      child: Padding(
        padding: const EdgeInsets.all(15.0),
        child: Column(
          children: [
            
            Image.asset("assets/images/carrossel.png", width: double.infinity, fit: BoxFit.cover),

            const SizedBox(height: 20),

            /// Dropdown de dia da semana
            DropdownButton<String>(
              value: _dropdownValue,
              hint: const Text("Selecione o dia da semana"),
              isExpanded: true,
              items: const [
                DropdownMenuItem(value: 'Segunda', child: Text('Segunda-feira')),
                DropdownMenuItem(value: 'Terça', child: Text('Terça-feira')),
                DropdownMenuItem(value: 'Quarta', child: Text('Quarta-feira')),
                DropdownMenuItem(value: 'Quinta', child: Text('Quinta-feira')),
                DropdownMenuItem(value: 'Sexta', child: Text('Sexta-feira')),
              ],
              onChanged: (String? newValue) {
                setState(() {
                  _dropdownValue = newValue;
                });
              },
            ),
            const SizedBox(height: 20),

            /// Tabela vertical de refeições
            ClipRRect(
  borderRadius: BorderRadius.circular(10),
  child: Container(
    decoration: BoxDecoration(
      border: Border.all(color: Color.fromARGB(255, 223, 222, 222)),
    ),
    child: Table(
      columnWidths: const {
        0: FlexColumnWidth(8),
        1: FlexColumnWidth(15),
      },
      children: [
        TableRow(
          decoration: BoxDecoration(
            color: Color.fromRGBO(246, 146, 0, 1),
          ),
          children: const [
            Padding(
              padding: EdgeInsets.all(8.0),
              child: Text(
                'Período',
                style: TextStyle(
                    color: Colors.white, fontWeight: FontWeight.bold),
                textAlign: TextAlign.center,
              ),
            ),
            Padding(
              padding: EdgeInsets.all(5.0),
              child: Text(
                'Refeição',
                style: TextStyle(
                    color: Colors.white, fontWeight: FontWeight.bold),
                textAlign: TextAlign.center,
              ),
            ),
          ],
        ),
        _buildRow('Manhã', refeicaoSelecionada['Manhã'] ?? 'Sem dados'),
        _buildRow('Almoço', refeicaoSelecionada['Almoço'] ?? 'Sem dados'),
        _buildRow('Tarde', refeicaoSelecionada['Tarde'] ?? 'Sem dados'),
      ],
    ),
  ),
),
      const SizedBox(height: 50),
Container(
  decoration: BoxDecoration(
    borderRadius: BorderRadius.circular(8),
    boxShadow: [
      BoxShadow(
        color: Colors.black.withOpacity(0.3),
        blurRadius: 6,
        offset: Offset(0, 4),
      ),
    ],
  ),
  child: TextButton(
    style: ButtonStyle(
      foregroundColor: MaterialStateProperty.all<Color>(Colors.white),
      backgroundColor: MaterialStateProperty.all<Color>(Color.fromRGBO(246, 146, 0, 1)),
    ),
    onPressed: () {
      Navigator.push(
        context,
        MaterialPageRoute(builder: (context) => const TelaPrincipal()),
      );
    },
    child: const Text('Contagem de Cardápio'),
  ),
),      
    const SizedBox(height: 50),
    Padding(
      padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 0),
      child: Container(
        padding: const EdgeInsets.symmetric(horizontal: 15, vertical: 5),
        decoration: BoxDecoration(
          borderRadius: BorderRadius.circular(10),
          color: Color.fromARGB(255, 223, 222, 222),
          boxShadow: [
                    BoxShadow(
                        color: Colors.grey.withValues(alpha: 0.5),
                        spreadRadius: 2,
                        blurRadius: 3,
                        offset: Offset(0, 5))
                  ],
        ),
        child: Column(
  crossAxisAlignment: CrossAxisAlignment.start,
  children: const [
    Text(
      "🕗 Contagem de Cardápio",
      style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold, color: Colors.black),
    ),
    SizedBox(height: 8),
    Text(
      "Todos os dias úteis, das 7h00 até, no máximo, 7h50 da manhã.",
      style: TextStyle(fontSize: 14, color: Colors.black),
      textAlign: TextAlign.justify,
    ),
    SizedBox(height: 8),
    Text(
      "Essa contagem nos ajuda a saber quantas refeições preparar, evitando desperdícios e garantindo que todos sejam atendidos.",
      style: TextStyle(fontSize: 14, color: Colors.black),
      textAlign: TextAlign.justify,
    ),
    SizedBox(height: 8),
    Text(
      "➡️ Acesse a tela \"Contagem de Alunos\" no aplicativo e registre sua presença dentro do horário.",
      style: TextStyle(fontSize: 14, color: Colors.black),
      textAlign: TextAlign.justify,
    ),
    SizedBox(height: 8),
    Text(
      "⚠️ Após as 8h40, a contagem é encerrada e não será possível registrar sua participação.",
      style: TextStyle(fontSize: 14, color: Colors.black),
      textAlign: TextAlign.justify,
    ),
  ],
),
              ),
            ),
          ],
        ),
      ),
    );
  }


  static TableRow _buildRow(String periodo, String conteudo) {
    return TableRow(
      children: [
        Padding(
          padding: const EdgeInsets.all(8.0),
          child: Text(periodo, textAlign: TextAlign.center, style: const TextStyle(fontWeight: FontWeight.bold)),
        ),
        Padding(
          padding: const EdgeInsets.all(8.0),
          child: Text(conteudo, textAlign: TextAlign.center),
        ),
      ],
    );
  }
}
