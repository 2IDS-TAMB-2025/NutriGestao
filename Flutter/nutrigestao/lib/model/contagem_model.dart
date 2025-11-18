class Contagem {
  final int quantidadeLancheManha;
  final int quantidadeBebidaManha;
  final int quantidadeLancheTarde;
  final int quantidadeBebidaTarde;
  final String turma;
  final String data;
  final String unidadeEscolar;

  Contagem({
    required this.quantidadeLancheManha,
    required this.quantidadeBebidaManha,
    required this.quantidadeLancheTarde,
    required this.quantidadeBebidaTarde,
    required this.turma,
    required this.data,
    required this.unidadeEscolar,
  });

  Map<String, dynamic> toJson() => {
    'QUANTIDADE_LANCHE_MANHA': quantidadeLancheManha,
    'QUANTIDADE_BEBIDA_MANHA': quantidadeBebidaManha,
    'QUANTIDADE_LANCHE_TARDE': quantidadeLancheTarde,
    'QUANTIDADE_BEBIDA_TARDE': quantidadeBebidaTarde,
    'TURMA': turma,
    'DATA': data,
    'UNIDADE_ESCOLAR': unidadeEscolar,
  };
}