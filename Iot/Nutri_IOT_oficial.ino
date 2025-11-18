#include <WiFi.h>
#include <WiFiClient.h>
#include <HTTPClient.h>
#include <MFRC522.h>
#include <SPI.h>
#include "HX711.h"

// ======= CONFIGURAÇÕES DE REDE =======
const char* ssid     = "CE370_SENAI";
const char* password = "ac3ce7ss0";
const char* serverUrl = "http://10.141.128.116/nutrigestao_api/desperdicio";

// ======= PINOS E CONSTANTES =======
#define SS_PIN          5
#define RST_PIN         22
#define BUZZER          14
#define SIZE_BUFFER     18
#define MAX_SIZE_BLOCK  16
#define BLOCO           4   // bloco usado no cartão

// ======= BALANÇA HX711 =======
#define DT  21   // DOUT (Data)
#define SCK 15   // SCK (Clock)

MFRC522 mfrc522(SS_PIN, RST_PIN);
MFRC522::MIFARE_Key key;
MFRC522::StatusCode status;
HX711 escala;

// ================================================================
void setup() {
  Serial.begin(9600);
  Serial.println("Iniciando sistema RFID + Balança...");

  // Inicializa RFID
  SPI.begin(18, 19, 23, 5);
  mfrc522.PCD_Init();
  Serial.println("Aproxime o cartao...");

  // Inicializa Balança
  Serial.println("Iniciando balança...");
  escala.begin(DT, SCK);
  
  // Aguarda estabilizar a balança
  Serial.print("Leitura do Valor ADC: ");
  Serial.println(escala.read());
  
  Serial.println("Não coloque nada na balança!");
  delay(2000);
  Serial.println("Iniciando calibração da balança...");
  
  // Ajuste de calibração — substitua pelo valor correto que você mediu
  escala.set_scale(108424.4);
  
  // Faz tara (zera)
  escala.tare(20);
  Serial.println("Balança calibrada e zerada!");

  // Conectar ao Wi-Fi
  WiFi.begin(ssid, password);
  Serial.print("Conectando ao Wi-Fi");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\nWi-Fi conectado com sucesso!");

  pinMode(BUZZER, OUTPUT);
  digitalWrite(BUZZER, LOW);

  // Chave padrão (0xFF)
  for (byte i=0; i<6; i++) key.keyByte[i] = 0xFF;
}

// ================================================================
void loop() {
  if (!mfrc522.PICC_IsNewCardPresent()) return;
  if (!mfrc522.PICC_ReadCardSerial()) return;

  tone(BUZZER, 1500); delay(150); noTone(BUZZER);

  // Sem menu - executa automaticamente leitura + pesagem + envio
  String dadosRFID = leituraDados();
  if (dadosRFID != "") {
    Serial.println("Aguardando estabilização da balança...");
    delay(1000);
    
    float peso = lerPeso();
    
    // Envia apenas o RA limpo e o peso separadamente
    enviarServidor(getUID(), dadosRFID, peso);
  }

  mfrc522.PICC_HaltA();
  mfrc522.PCD_StopCrypto1();
}

// ================================================================
float lerPeso() {
  Serial.println("=== FAÇA A PESAGEM ===");
  Serial.println("Coloque o item na balança e aguarde...");
  
  float peso = 0;
  float pesoAnterior = 0;
  int leiturasEstaveis = 0;
  
  // Aguarda peso estabilizar (3 leituras consecutivas similares)
  while (leiturasEstaveis < 3) {
    peso = escala.get_units(10); // 10 leituras para média
    
    Serial.print("Peso lido: ");
    Serial.print(peso, 3);
    Serial.println(" kg");
    
    // Verifica se a leitura está estável (variação menor que 0.01kg)
    if (abs(peso - pesoAnterior) < 0.01) {
      leiturasEstaveis++;
    } else {
      leiturasEstaveis = 0;
    }
    
    pesoAnterior = peso;
    delay(500);
  }
  
  Serial.print("Peso final: ");
  Serial.print(peso, 3);
  Serial.println(" kg");
  
  return peso;
}

// ================================================================
String leituraDados() {
  byte buffer[SIZE_BUFFER] = {0};
  byte tamanho = SIZE_BUFFER;

  // Autentica
  status = mfrc522.PCD_Authenticate(MFRC522::PICC_CMD_MF_AUTH_KEY_A,
                                    BLOCO, &key, &(mfrc522.uid));
  if (status != MFRC522::STATUS_OK) {
    Serial.print("Falha na autenticacao: ");
    Serial.println(mfrc522.GetStatusCodeName(status));
    bipErro();
    return "";
  }

  // Lê
  status = mfrc522.MIFARE_Read(BLOCO, buffer, &tamanho);
  if (status != MFRC522::STATUS_OK) {
    Serial.print("Erro ao ler: ");
    Serial.println(mfrc522.GetStatusCodeName(status));
    bipErro();
    return "";
  }

  String dados = "";
  Serial.print("Dados do bloco: ");
  for (byte i=0; i<MAX_SIZE_BLOCK; i++) {
    if (buffer[i] != 0) {
      Serial.write(buffer[i]);
      dados += (char)buffer[i];
    }
  }
  Serial.println();
  return dados;
}

// ================================================================
String getUID() {
  String uid = "";
  for (byte i=0; i < mfrc522.uid.size; i++)
    uid += String(mfrc522.uid.uidByte[i], HEX);
  return uid;
}

// ================================================================
void enviarServidor(String uid, String ra, float peso) {
  if (WiFi.status() != WL_CONNECTED) {
    Serial.println("Wi-Fi desconectado!");
    return;
  }
  
  ra.trim();
  
  HTTPClient http;
  http.begin(serverUrl);
  http.addHeader("Content-Type", "application/json");

  // CORREÇÃO: Envia apenas o RA limpo no campo RA e o peso no campo DESPERDICIO_ALUNO
  String json = "{";
  json += "\"RA\":\"" + ra + "\",";  // Apenas o RA, sem o peso
  json += "\"DESPERDICIO_ALUNO\":\"" + String(peso, 3) + "\"";
  json += "}";
  
  Serial.println("JSON enviado:");
  Serial.println(json);

  int code = http.POST(json);
  if (code > 0) {
    Serial.println("Resposta servidor:");
    Serial.println(http.getString());
    bipOk();
  } else {
    Serial.print("Erro HTTP: ");
    Serial.println(code);
    bipErro();
  }
  http.end();
}

// ================================================================
void bipOk() {
  tone(BUZZER, 1500);
  delay(200);
  noTone(BUZZER);
}

void bipErro() {
  for (int i=0; i<2; i++) {
    tone(BUZZER, 500); delay(150); noTone(BUZZER); delay(150);
  }
}
