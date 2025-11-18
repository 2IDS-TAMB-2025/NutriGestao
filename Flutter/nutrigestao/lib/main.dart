import 'package:flutter/material.dart';
import 'package:nutrigestao/controller/api_controller.dart';
import 'package:nutrigestao/model/cardapio_model.dart';
import 'package:nutrigestao/model/contagem_model.dart';
import 'package:nutrigestao/view/terceira_tela.dart';

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
              width: 90,
              height: 110,
              child: DrawerHeader(
                child: Image.asset(
                  'assets/images/logoo.png',
                ),
              ),
            ),
            ListTile(
              leading: const Icon(Icons.group,
                  color: Color.fromRGBO(246, 146, 0, 1)),
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
      body: const TelaUnificada(), // Agora usa a tela unificada
    );
  }
}

// === TELA UNIFICADA - CARDÁPIO + CONTAGEM ===
class TelaUnificada extends StatefulWidget {
  const TelaUnificada({super.key});

  @override
  _TelaUnificadaState createState() => _TelaUnificadaState();
}

class _TelaUnificadaState extends State<TelaUnificada> {
  String? _dropdownValueDia = 'segunda';
  String? _dropdownValueTurma;

  final TextEditingController _lancheManhaController = TextEditingController();
  final TextEditingController _bebidaManhaController = TextEditingController();
  final TextEditingController _lancheTardeController = TextEditingController();
  final TextEditingController _bebidaTardeController = TextEditingController();
  final TextEditingController _contagemGeralController =
      TextEditingController();

  bool _isLoading = false;
  late Future<Map<String, Cardapio>> _cardapioFuture;

  Map<String, Map<String, String>> refeicoesFallback = {
    'segunda': {
      'Manhã': '',
      'Almoço': 'Nada inserido!',
      'Tarde': '',
    },
    'terca': {
      'Manhã': '',
      'Almoço': 'Nada inserido!',
      'Tarde': '',
    },
    'quarta': {
      'Manhã': '',
      'Almoço': 'Nada inserido!',
      'Tarde': '',
    },
    'quinta': {
      'Manhã': '',
      'Almoço': 'Nada inserido!',
      'Tarde': '',
    },
    'sexta': {
      'Manhã': '',
      'Almoço': 'Nada inserido!',
      'Tarde': '',
    }
  };

  @override
  void initState() {
    super.initState();
    _cardapioFuture = ApiController.fetchCardapio();
  }

  bool _isCardapioVazio(Cardapio cardapio) {
    return cardapio.lancheManha.isEmpty &&
        cardapio.bebidaManha.isEmpty &&
        cardapio.acompanhamentoManha.isEmpty &&
        cardapio.frutaManha.isEmpty &&
        cardapio.almoco.isEmpty &&
        cardapio.lancheTarde.isEmpty &&
        cardapio.bebidaTarde.isEmpty &&
        cardapio.acompanhamentoTarde.isEmpty &&
        cardapio.frutaTarde.isEmpty;
  }

  String _formatarRefeicaoManha(Cardapio cardapio) {
    if (cardapio.lancheManha.isEmpty &&
        cardapio.bebidaManha.isEmpty &&
        cardapio.acompanhamentoManha.isEmpty &&
        cardapio.frutaManha.isEmpty) {
      return 'Não haverá aula';
    }

    List<String> partes = [];
    if (cardapio.lancheManha.isNotEmpty) partes.add(cardapio.lancheManha);
    if (cardapio.bebidaManha.isNotEmpty) partes.add(cardapio.bebidaManha);
    if (cardapio.acompanhamentoManha.isNotEmpty)
      partes.add(cardapio.acompanhamentoManha);
    if (cardapio.frutaManha.isNotEmpty) partes.add(cardapio.frutaManha);
    return partes.join('\n');
  }

  String _formatarAlmoco(Cardapio cardapio) {
    if (cardapio.almoco.isEmpty) {
      return 'Não haverá aula';
    }

    return cardapio.almoco
        .replaceAll(', ', '\n')
        .replaceAll('; ', '\n')
        .replaceAll('. ', '\n');
  }

  String _formatarRefeicaoTarde(Cardapio cardapio) {
    if (cardapio.lancheTarde.isEmpty &&
        cardapio.bebidaTarde.isEmpty &&
        cardapio.acompanhamentoTarde.isEmpty &&
        cardapio.frutaTarde.isEmpty) {
      return 'Não haverá aula';
    }

    List<String> partes = [];
    if (cardapio.lancheTarde.isNotEmpty) partes.add(cardapio.lancheTarde);
    if (cardapio.bebidaTarde.isNotEmpty) partes.add(cardapio.bebidaTarde);
    if (cardapio.acompanhamentoTarde.isNotEmpty)
      partes.add(cardapio.acompanhamentoTarde);
    if (cardapio.frutaTarde.isNotEmpty) partes.add(cardapio.frutaTarde);
    return partes.join('\n');
  }

  Map<String, String> _getRefeicoesDoDia(
      Map<String, Cardapio>? cardapios, String dia) {
    if (cardapios == null || !cardapios.containsKey(dia)) {
      return refeicoesFallback[dia] ?? {};
    }

    final cardapio = cardapios[dia]!;

    if (_isCardapioVazio(cardapio)) {
      return {
        'Manhã': ' ',
        'Almoço': 'Não haverá aula',
        'Tarde': ' ',
      };
    }

    return {
      'Manhã': _formatarRefeicaoManha(cardapio),
      'Almoço': _formatarAlmoco(cardapio),
      'Tarde': _formatarRefeicaoTarde(cardapio),
    };
  }

  Future<void> _salvarContagem() async {
    if (_dropdownValueTurma == null) {
      ScaffoldMessenger.of(context).showSnackBar(const SnackBar(
        content: Text("Selecione uma turma!"),
      ));
      return;
    }

    setState(() {
      _isLoading = true;
    });

    try {
      final contagem = Contagem(
        quantidadeLancheManha: int.tryParse(_lancheManhaController.text) ?? 0,
        quantidadeBebidaManha: int.tryParse(_bebidaManhaController.text) ?? 0,
        quantidadeLancheTarde: int.tryParse(_lancheTardeController.text) ?? 0,
        quantidadeBebidaTarde: int.tryParse(_bebidaTardeController.text) ?? 0,
        turma: _dropdownValueTurma!,
        data: DateTime.now().toIso8601String().split('T')[0],
        unidadeEscolar: '370',
      );

      await ApiController.postContagem(contagem);

      ScaffoldMessenger.of(context).showSnackBar(const SnackBar(
        content: Text("Contagem salva com sucesso!"),
      ));

      _lancheManhaController.clear();
      _bebidaManhaController.clear();
      _lancheTardeController.clear();
      _bebidaTardeController.clear();
      _contagemGeralController.clear();
    } catch (e) {
      ScaffoldMessenger.of(context).showSnackBar(SnackBar(
        content: Text("Erro ao salvar contagem: $e"),
        backgroundColor: Colors.red,
      ));
    } finally {
      setState(() {
        _isLoading = false;
      });
    }
  }

  Widget _buildSessaoContagem(
      String titulo,
      TextEditingController lancheController,
      TextEditingController bebidaController) {
    return Card(
      margin: const EdgeInsets.symmetric(vertical: 12, horizontal: 16),
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
      elevation: 4,
      child: Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(
              titulo,
              style: const TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
            ),
            const Divider(),
            Padding(
              padding: const EdgeInsets.symmetric(vertical: 8),
              child: Row(
                children: [
                  const Expanded(child: Text("Lanches")),
                  SizedBox(
                    width: 60,
                    child: TextFormField(
                      controller: lancheController,
                      keyboardType: TextInputType.number,
                      decoration: const InputDecoration(
                        border: OutlineInputBorder(),
                        isDense: true,
                        contentPadding:
                            EdgeInsets.symmetric(horizontal: 8, vertical: 6),
                      ),
                    ),
                  ),
                  const SizedBox(width: 8),
                  const Text('unid.'),
                ],
              ),
            ),
            Padding(
              padding: const EdgeInsets.symmetric(vertical: 8),
              child: Row(
                children: [
                  const Expanded(child: Text("Bebidas")),
                  SizedBox(
                    width: 60,
                    child: TextFormField(
                      controller: bebidaController,
                      keyboardType: TextInputType.number,
                      decoration: const InputDecoration(
                        border: OutlineInputBorder(),
                        isDense: true,
                        contentPadding:
                            EdgeInsets.symmetric(horizontal: 8, vertical: 6),
                      ),
                    ),
                  ),
                  const SizedBox(width: 8),
                  const Text('unid.'),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }

  TableRow _buildRow(String periodo, String conteudo) {
    return TableRow(
      children: [
        Padding(
          padding: const EdgeInsets.all(8.0),
          child: Text(periodo,
              textAlign: TextAlign.center,
              style: const TextStyle(fontWeight: FontWeight.bold)),
        ),
        Padding(
          padding: const EdgeInsets.all(8.0),
          child: Text(conteudo, textAlign: TextAlign.center),
        ),
      ],
    );
  }

  @override
  Widget build(BuildContext context) {
    return SingleChildScrollView(
      child: Padding(
        padding: const EdgeInsets.all(15.0),
        child: Column(
          children: [
            Image.asset("assets/images/carrossel.png",
                width: double.infinity, fit: BoxFit.cover),

            const SizedBox(height: 30),

            // SEÇÃO DO CARDÁPIO
            FutureBuilder<Map<String, Cardapio>>(
              future: _cardapioFuture,
              builder: (context, snapshot) {
                Map<String, Cardapio>? cardapios;

                if (snapshot.connectionState == ConnectionState.waiting) {
                  return const Center(child: CircularProgressIndicator());
                } else if (snapshot.hasError) {
                  print("Erro ao carregar cardápio: ${snapshot.error}");
                  cardapios = null;
                } else if (snapshot.hasData) {
                  cardapios = snapshot.data;
                }

                final refeicaoSelecionada =
                    _getRefeicoesDoDia(cardapios, _dropdownValueDia!);

                return Column(
                  children: [
                    /// Dropdown de dia da semana
                    DropdownButton<String>(
                      value: _dropdownValueDia,
                      hint: const Text("Selecione o dia da semana"),
                      isExpanded: true,
                      items: const [
                        DropdownMenuItem(
                            value: 'segunda', child: Text('Segunda-feira')),
                        DropdownMenuItem(
                            value: 'terca', child: Text('Terça-feira')),
                        DropdownMenuItem(
                            value: 'quarta', child: Text('Quarta-feira')),
                        DropdownMenuItem(
                            value: 'quinta', child: Text('Quinta-feira')),
                        DropdownMenuItem(
                            value: 'sexta', child: Text('Sexta-feira')),
                      ],
                      onChanged: (String? newValue) {
                        setState(() {
                          _dropdownValueDia = newValue;
                        });
                      },
                    ),

                    const SizedBox(height: 20),

                    /// Tabela vertical de refeições
                    ClipRRect(
                      borderRadius: BorderRadius.circular(10),
                      child: Container(
                        decoration: BoxDecoration(
                          border: Border.all(
                              color: Color.fromARGB(255, 223, 222, 222)),
                        ),
                        child: Table(
                          columnWidths: const {
                            0: FlexColumnWidth(8),
                            1: FlexColumnWidth(15),
                          },
                          children: [
                            TableRow(
                              decoration: const BoxDecoration(
                                color: Color.fromRGBO(246, 146, 0, 1),
                              ),
                              children: const [
                                Padding(
                                  padding: EdgeInsets.all(8.0),
                                  child: Text(
                                    'Período',
                                    style: TextStyle(
                                        color: Colors.white,
                                        fontWeight: FontWeight.bold),
                                    textAlign: TextAlign.center,
                                  ),
                                ),
                                Padding(
                                  padding: EdgeInsets.all(5.0),
                                  child: Text(
                                    'Refeição',
                                    style: TextStyle(
                                        color: Colors.white,
                                        fontWeight: FontWeight.bold),
                                    textAlign: TextAlign.center,
                                  ),
                                ),
                              ],
                            ),
                            _buildRow('Manhã',
                                refeicaoSelecionada['Manhã'] ?? 'Sem dados'),
                            _buildRow('Almoço',
                                refeicaoSelecionada['Almoço'] ?? 'Sem dados'),
                            _buildRow('Tarde',
                                refeicaoSelecionada['Tarde'] ?? 'Sem dados'),
                          ],
                        ),
                      ),
                    ),
                  ],
                );
              },
            ),

            const SizedBox(height: 40),

            // DIVISÓRIA VISUAL
            Container(
              height: 2,
              color: const Color.fromRGBO(246, 146, 0, 1),
              margin: const EdgeInsets.symmetric(vertical: 10),
            ),

            const SizedBox(height: 30),

            // SEÇÃO DE CONTAGEM
            const Text(
              'Contagem dos Alunos',
              style: TextStyle(fontWeight: FontWeight.bold, fontSize: 24),
            ),
            const SizedBox(height: 20),

            // Dropdown de turma
            DropdownButton<String>(
              value: _dropdownValueTurma,
              hint: const Text("Selecione a turma"),
              isExpanded: true,
              items: const [
                DropdownMenuItem(
                    value: "6º Ano Ef2 A", child: Text("6º Ano Ef2 A")),
                DropdownMenuItem(
                    value: "6º Ano Ef2 B", child: Text("6º Ano Ef2 B")),
                DropdownMenuItem(
                    value: "7º Ano Ef2 A", child: Text("7º Ano Ef2 A")),
                DropdownMenuItem(
                    value: "7º Ano Ef2 B", child: Text("7º Ano Ef2 B")),
                DropdownMenuItem(
                    value: "8º Ano Ef2 A", child: Text("8º Ano Ef2 A")),
                DropdownMenuItem(
                    value: "8º Ano Ef2 B", child: Text("8º Ano Ef2 B")),
                DropdownMenuItem(
                    value: "9º Ano Ef2 A", child: Text("9º Ano Ef2 A")),
                DropdownMenuItem(
                    value: "9º Ano Ef2 B", child: Text("9º Ano Ef2 B")),
                DropdownMenuItem(
                    value: "1º Ano E.M A", child: Text("1º Ano E.M A")),
                DropdownMenuItem(
                    value: "1º Ano E.M B", child: Text("1º Ano E.M B")),
                DropdownMenuItem(
                    value: "2º Ano E.M A", child: Text("2º Ano E.M A")),
                DropdownMenuItem(
                    value: "2º Ano E.M B", child: Text("2º Ano E.M B")),
                DropdownMenuItem(
                    value: "3º Ano E.M A", child: Text("3º Ano E.M A")),
                DropdownMenuItem(
                    value: "3º Ano E.M B", child: Text("3º Ano E.M B")),
              ],
              onChanged: (String? newValue) {
                setState(() {
                  _dropdownValueTurma = newValue;
                });
              },
            ),
            const SizedBox(height: 20),

            // Seções de contagem
            _buildSessaoContagem("Café da Manhã", _lancheManhaController,
                _bebidaManhaController),
            _buildSessaoContagem("Café da Tarde", _lancheTardeController,
                _bebidaTardeController),

            const SizedBox(height: 20),

            // Botão de salvar
            Center(
              child: ElevatedButton(
                onPressed: _isLoading ? null : _salvarContagem,
                style: ElevatedButton.styleFrom(
                  backgroundColor: const Color.fromRGBO(246, 146, 0, 1),
                  disabledBackgroundColor: Colors.grey,
                  padding:
                      const EdgeInsets.symmetric(horizontal: 30, vertical: 15),
                ),
                child: _isLoading
                    ? const SizedBox(
                        height: 20,
                        width: 20,
                        child: CircularProgressIndicator(
                          strokeWidth: 2,
                          valueColor:
                              AlwaysStoppedAnimation<Color>(Colors.white),
                        ),
                      )
                    : const Text("Salvar Contagem",
                        style: TextStyle(color: Colors.white, fontSize: 16)),
              ),
            ),

            const SizedBox(height: 30),

            // Informações sobre a contagem (mantido do original)
            Padding(
              padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 0),
              child: Container(
                padding:
                    const EdgeInsets.symmetric(horizontal: 15, vertical: 5),
                decoration: BoxDecoration(
                  borderRadius: BorderRadius.circular(10),
                  color: const Color.fromARGB(255, 223, 222, 222),
                  boxShadow: [
                    BoxShadow(
                        color: Colors.grey.withValues(alpha: 0.5),
                        spreadRadius: 2,
                        blurRadius: 3,
                        offset: const Offset(0, 5))
                  ],
                ),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: const [
                    Text(
                      "🕗 Contagem de Lanches",
                      style: TextStyle(
                          fontSize: 16,
                          fontWeight: FontWeight.bold,
                          color: Colors.black),
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
                      "⚠️➡️ Para um preparo mais preciso dos lanches, pedimos que a contagem da turma seja enviada até às 7h50. Após esse horário, não podemos garantir a inclusão de novos registros a tempo.",
                      style: TextStyle(fontSize: 14, color: Colors.black),
                      textAlign: TextAlign.justify,
                    ),
                  ],
                ),
              ),
            ),
            const SizedBox(height: 30),
          ],
        ),
      ),
    );
  }
}
