import 'package:flutter/material.dart';

void main() {
  runApp(CardapioEscolarApp());
}

class CardapioEscolarApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'Cardápio Escolar',
      home: TelaPrincipal(),
      
    );
  }
}

class TelaPrincipal extends StatefulWidget {
  const TelaPrincipal({super.key});

  @override
  _TelaPrincipalState createState() => _TelaPrincipalState();
}

class _TelaPrincipalState extends State<TelaPrincipal> {
  String? _dropdownValue;

  final Map<String, int> cafeDaManha = {
    'Pão com manteiga': 0,
    'Leite com achocolatado': 0,
  };

  final Map<String, int> cafeDaTarde = {
    'Bolo de cenoura': 0,
    'Suco de laranja': 0,
  };

  int contagemGeral = 0;

  void dropdownCallback(String? selectedValue) {
    if (selectedValue != null) {
      setState(() {
        _dropdownValue = selectedValue;
      });
    }
  }

  Widget buildSessao(String titulo, Map<String, int> alimentos) {
    return Card(
      margin: EdgeInsets.symmetric(vertical: 12, horizontal: 16),
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
      elevation: 4,
      child: Padding(
        padding: EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(
              titulo,
              style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold),
            ),
            Divider(),
            ...alimentos.keys.map((alimento) {
              return Padding(
                padding: const EdgeInsets.symmetric(vertical: 8),
                child: Row(
                  children: [
                    Expanded(child: Text(alimento)),
                    SizedBox(
                      width: 60,
                      child: TextFormField(
                        initialValue: alimentos[alimento].toString(),
                        keyboardType: TextInputType.number,
                        decoration: InputDecoration(
                          border: OutlineInputBorder(),
                          isDense: true,
                          contentPadding: EdgeInsets.symmetric(horizontal: 8, vertical: 6),
                        ),
                        onChanged: (value) {
                          setState(() {
                            alimentos[alimento] = int.tryParse(value) ?? 0;
                          });
                        },
                      ),
                    ),
                    SizedBox(width: 8),
                    Text('alunos'),
                  ],
                ),
              );
            }).toList(),
          ],
        ),
      ),
    );
  }

  Widget buildSessaoContagemGeral() {
    return Card(
      margin: EdgeInsets.symmetric(vertical: 12, horizontal: 16),
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
      elevation: 4,
      child: Padding(
        padding: EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(
              "Contagem Geral",
              style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold),
            ),
            Divider(),
            Row(
              children: [
                Expanded(child: Text("Total de alunos:")),
                SizedBox(
                  width: 60,
                  child: TextFormField(
                    initialValue: contagemGeral.toString(),
                    keyboardType: TextInputType.number,
                    decoration: InputDecoration(
                      border: OutlineInputBorder(),
                      isDense: true,
                      contentPadding: EdgeInsets.symmetric(horizontal: 8, vertical: 6),
                    ),
                    onChanged: (value) {
                      setState(() {
                        contagemGeral = int.tryParse(value) ?? 0;
                      });
                    },
                  ),
                ),
                SizedBox(width: 8),
                Text('alunos'),
              ],
            ),
          ],
        ),
      ),
    );
  }

  int _selectedIndex = 0;

  void _onBottomNavTap(int index) {
    setState(() {
      _selectedIndex = index;
      if (index == 1) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text("Você saiu.")),
        );
      }
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Contagem Alunos', style: TextStyle(color: Colors.white, fontSize: 30,)),
        leading: IconButton(
          icon: Icon(Icons.arrow_back, color: Colors.white, size: 28),
          onPressed: () {
            Navigator.pop(context);
          },
        ),
        backgroundColor: const Color.fromRGBO(246, 146, 0, 1),
        toolbarHeight: 100,
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Image.asset("assets/images/carro.png", width: double.infinity, fit: BoxFit.cover),
            const SizedBox(height: 20),
            const Text(
              'Contagem dos Alunos',
              style: TextStyle(fontWeight: FontWeight.bold, fontSize: 26),
            ),
            const SizedBox(height: 20),
            DropdownButton<String>(
              value: _dropdownValue,
              hint: const Text("Selecione o ano"),
              isExpanded: true,
              items: const [
                DropdownMenuItem(value: "6° Ano A E.F2", child: Text("6° Ano A E.F2")),
                DropdownMenuItem(value: "6° Ano B E.F2", child: Text("6° Ano B E.F2")),
                DropdownMenuItem(value: "7° Ano A E.F2", child: Text("7° Ano A E.F2")),
                DropdownMenuItem(value: "7° Ano B E.F2", child: Text("7° Ano B E.F2")),
                DropdownMenuItem(value: "8° Ano A E.F2", child: Text("8° Ano A E.F2")),
                DropdownMenuItem(value: "8° Ano B E.F2", child: Text("8° Ano B E.F2")),
                DropdownMenuItem(value: "9° Ano A E.F2", child: Text("9° Ano A E.F2")),
                DropdownMenuItem(value: "9° Ano B E.F2", child: Text("9° Ano B E.F2")),
                DropdownMenuItem(value: "1° Ano A E.M", child: Text("1° Ano A E.M")),
                DropdownMenuItem(value: "1° Ano B E.M", child: Text("1° Ano B E.M")),
                DropdownMenuItem(value: "2° Ano A E.M", child: Text("2° Ano A E.M")),
                DropdownMenuItem(value: "2° Ano B E.M", child: Text("2° Ano B E.M")),
                DropdownMenuItem(value: "3° Ano A E.M", child: Text("3° Ano A E.M")),
                DropdownMenuItem(value: "3° Ano B E.M", child: Text("3° Ano B E.M")),
              ],
              onChanged: dropdownCallback,
            ),
            const SizedBox(height: 30),
            buildSessao("Café da Manhã", cafeDaManha),
            buildSessao("Café da Tarde", cafeDaTarde),
            buildSessaoContagemGeral(),
            const SizedBox(height: 20),
            Center(
              child: ElevatedButton(
                onPressed: () {
                  print("Ano selecionado: $_dropdownValue");
                  print("Contagem Café da Manhã: $cafeDaManha");
                  print("Contagem Café da Tarde: $cafeDaTarde");
                  print("Contagem Geral: $contagemGeral");
                  ScaffoldMessenger.of(context).showSnackBar(
                    SnackBar(content: Text("Contagem salva com sucesso!")),
                  );
                },
                style: ElevatedButton.styleFrom(
                  backgroundColor: const Color.fromRGBO(246, 146, 0, 1),
                ),
                child: const Text("Salvar Contagem", style: TextStyle(color: Colors.white),),
              ),
            ),
            const SizedBox(height: 30),
          ],
        ),
      ),
    );
  }
}
