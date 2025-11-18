class Cardapio {
  final String diaSemana;
  final String bebidaManha;
  final String lancheManha;
  final String acompanhamentoManha;
  final String frutaManha;
  final String almoco;
  final String bebidaTarde;
  final String lancheTarde;
  final String acompanhamentoTarde;
  final String frutaTarde;

  Cardapio({
    required this.diaSemana,
    required this.bebidaManha,
    required this.lancheManha,
    required this.acompanhamentoManha,
    required this.frutaManha,
    required this.almoco,
    required this.bebidaTarde,
    required this.lancheTarde,
    required this.acompanhamentoTarde,
    required this.frutaTarde,
  });

  factory Cardapio.fromJson(Map<String, dynamic> json) {
    return Cardapio(
      diaSemana: json['DIA_SEMANA'] ?? '',
      bebidaManha: json['BEBIDA_MANHA'] ?? '',
      lancheManha: json['LANCHE_MANHA'] ?? '',
      acompanhamentoManha: json['ACOMPANHAMENTO_MANHA'] ?? '',
      frutaManha: json['FRUTA_MANHA'] ?? '',
      almoco: json['ALMOCO'] ?? '',
      bebidaTarde: json['BEBIDA_TARDE'] ?? '',
      lancheTarde: json['LANCHE_TARDE'] ?? '',
      acompanhamentoTarde: json['ACOMPANHAMENTO_TARDE'] ?? '',
      frutaTarde: json['FRUTA_TARDE'] ?? '',
    );
  }

  // Método para formatar a refeição da manhã
  String get refeicaoManhaFormatada {
    List<String> partes = [];
    if (lancheManha.isNotEmpty) partes.add(lancheManha);
    if (bebidaManha.isNotEmpty) partes.add(bebidaManha);
    if (acompanhamentoManha.isNotEmpty) partes.add(acompanhamentoManha);
    if (frutaManha.isNotEmpty) partes.add(frutaManha);
    return partes.join('\n');
  }

  // Método para formatar a refeição da tarde
  String get refeicaoTardeFormatada {
    List<String> partes = [];
    if (lancheTarde.isNotEmpty) partes.add(lancheTarde);
    if (bebidaTarde.isNotEmpty) partes.add(bebidaTarde);
    if (acompanhamentoTarde.isNotEmpty) partes.add(acompanhamentoTarde);
    if (frutaTarde.isNotEmpty) partes.add(frutaTarde);
    return partes.join('\n');
  }

  // Método para formatar o almoço
  String get almocoFormatado {
    return almoco.replaceAll(', ', '\n').replaceAll('; ', '\n');
  }
}