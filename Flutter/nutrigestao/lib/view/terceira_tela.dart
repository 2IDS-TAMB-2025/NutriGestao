import 'package:flutter/material.dart';

class TerceiraTela extends StatelessWidget {
  const TerceiraTela({super.key});

  final integrantes = const [
    {
      'nome': 'Alexandre Eduardo da Silva Velucci',
      'funcao': 'Full Stack',
      'imagem': 'assets/images/alex.jpeg'
    },
    {
      'nome': 'Amanda Vieira da Costa',
      'funcao': 'Front-End',
      'imagem': 'assets/images/aman.png'
    },
    {
      'nome': 'Gabriel Giorgetti Faria',
      'funcao': 'Banco de Dados',
      'imagem': 'assets/images/gabri.jpeg'
    },
    {
      'nome': 'Gabriel Viana Moroni',
      'funcao': 'Back-End',
      'imagem': 'assets/images/moro.jpeg'
    },
    {
      'nome': 'Júlia Puelcher Ribeiro',
      'funcao': 'Full Stack',
      'imagem': 'assets/images/juli.jpeg'
    },
    {
      'nome': 'Liebert Henrique Simões de Oliveira',
      'funcao': 'Front-End',
      'imagem': 'assets/images/lieb.jpeg'
    },
    {
      'nome': 'Thalita Bichoff Perle',
      'funcao': 'Back-End',
      'imagem': 'assets/images/thal.jpeg'
    },
    {
      'nome': 'Yasmin Caroline Brandalia',
      'funcao': 'Banco de Dados',
      'imagem': 'assets/images/yasm.png'
    },
  ];

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
        child: Padding(
          padding: const EdgeInsets.all(30),
          child: Column(
            children: [
              const SizedBox(height: 10),
              Image.asset("assets/images/car1.png",
                  width: double.infinity, fit: BoxFit.cover),
              const SizedBox(height: 30),
              Container(
                width: double.infinity, // ocupa toda a largura disponível
                child: const Text(
                  'Um pouco sobre o nosso projeto:',
                  textAlign: TextAlign.center,
                  style: TextStyle(fontWeight: FontWeight.bold, fontSize: 30),
                ),
              ),
              const SizedBox(height: 30),
              const Text(
                'Seja bem-vindo ao NutriGestão, um projeto inovador desenvolvido por estudantes do 3º ano do Ensino Médio do SESI Joelmir Beting - CE-370, em parceria com o curso de Tecnologia da Informação do SENAI. O NutriGestão foi criado com o propósito de otimizar o gerenciamento do consumo de alimentos nas instituições de ensino, promovendo um equilíbrio entre oferta e demanda. A iniciativa busca reduzir o desperdício de alimentos e garantir que todos os alunos tenham acesso adequado às refeições, contribuindo para uma alimentação mais sustentável e eficiente. Por meio de soluções tecnológicas práticas e intuitivas, o NutriGestão se destaca como uma ferramenta essencial para escolas preocupadas com o bem-estar de seus estudantes.',
                textAlign: TextAlign.justify,
              ),
              const SizedBox(height: 20),
              const Text(
                'Através do nosso tablet interativo, os alunos podem visualizar o cardápio do dia, garantindo que todas as turmas saibam antecipadamente quais refeições estão disponíveis. Após essa consulta, cada sala informa a quantidade exata de lanches e bebidas que deseja, permitindo um planejamento mais preciso na distribuição dos alimentos.',
                textAlign: TextAlign.justify,
              ),
              const SizedBox(height: 20),
              const Text(
                'Com esse sistema, conseguimos reduzir desperdícios, melhorar a gestão dos recursos alimentares e promover uma maior conscientização sobre o consumo responsável. Tudo isso de forma prática, integrada e eficiente, beneficiando tanto os alunos quanto a equipe responsável pela alimentação na escola.',
                textAlign: TextAlign.justify,
              ),
              const SizedBox(height: 40),
              Container(
                padding: EdgeInsets.all(0),
                height: 20,
                decoration: const BoxDecoration(
                  border: Border(
                    bottom: BorderSide(
                        color: Color.fromRGBO(246, 146, 0, 1), width: 20.0),
                  ),
                ),
              ),
              const SizedBox(height: 30),
              const Text(
                'Desenvolvedores',
                style: TextStyle(fontWeight: FontWeight.bold, fontSize: 30),
              ),
              const SizedBox(height: 30),
              GridView.builder(
                shrinkWrap: true,
                physics: const NeverScrollableScrollPhysics(),
                itemCount: integrantes.length,
                gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
                  crossAxisCount: 2, // 2 por linha
                  mainAxisSpacing: 20,
                  crossAxisSpacing: 20,
                  childAspectRatio: 1.2,
                ),
                itemBuilder: (context, index) {
                  final integrante = integrantes[index];
                  return Stack(
                    children: [
                      ClipRRect(
                        borderRadius: BorderRadius.circular(10),
                        child: Image.asset(
                          integrante['imagem']!,
                          width: double.infinity,
                          height: double.infinity,
                          fit: BoxFit.cover,
                        ),
                      ),
                      Positioned(
                        bottom: 0,
                        left: 0,
                        right: 0,
                        child: Container(
                          padding: const EdgeInsets.all(10),
                          color: Colors.black.withOpacity(0.6),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(
                                integrante['nome']!,
                                style: const TextStyle(
                                  color: Colors.white,
                                  fontWeight: FontWeight.bold,
                                  fontSize: 14,
                                ),
                              ),
                              Text(
                                integrante['funcao']!,
                                style: const TextStyle(
                                  color: Colors.white70,
                                  fontSize: 12,
                                ),
                              ),
                            ],
                          ),
                        ),
                      ),
                    ],
                  );
                },
              ),
            ],
          ),
        ),
      ),
    );
  }
}
