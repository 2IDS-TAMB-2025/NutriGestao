import 'dart:convert';
import 'package:http/http.dart' as http;
import '../model/cardapio_model.dart';
import '../model/contagem_model.dart';

class ApiController {
  static const String baseUrl = 'http://10.141.128.116/nutrigestao_api';

  // GET Cardápio
  static Future<Map<String, Cardapio>> fetchCardapio() async {
    final response = await http.get(Uri.parse('$baseUrl/cardapio'));
    if (response.statusCode == 200) {
      Map<String, dynamic> jsonMap = jsonDecode(response.body);
      Map<String, Cardapio> cardapios = {};
      jsonMap.forEach((key, value) {
        cardapios[key] = Cardapio.fromJson(value);
      });
      return cardapios;
    } else {
      throw Exception("Erro ao carregar cardápio");
    }
  }

  // POST Contagem
  static Future<void> postContagem(Contagem contagem) async {
    final response = await http.post(
      Uri.parse('$baseUrl/contagem'),
      headers: {'Content-Type': 'application/json'},
      body: jsonEncode(contagem.toJson()),
    );
    if (response.statusCode == 200 || response.statusCode == 201) {
      print("✅ Contagem registrada com sucesso");
    } else {
      throw Exception("Erro ao registrar contagem");
    }
  }
}
