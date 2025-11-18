CREATE DATABASE IF NOT EXISTS BD_BANCO_TCC;
USE BD_BANCO_TCC;

CREATE TABLE ADMINISTRADOR(
 CPF VARCHAR(11) PRIMARY KEY,
 NOME VARCHAR(100) NOT NULL,
 EMAIL VARCHAR(100) NOT NULL,
 UNIDADE_ESCOLAR VARCHAR(3) NOT NULL,
 SENHA VARCHAR(100) NOT NULL
);

CREATE TABLE CARDAPIO(
	ID int auto_increment primary key, 
	SEMANA_REFERENCIA date, 
	DIA_SEMANA enum('segunda','terca','quarta','quinta','sexta'), 
	BEBIDA_MANHA varchar(100),
	LANCHE_MANHA varchar(100), 
	ACOMPANHAMENTO_MANHA varchar(100), 
	FRUTA_MANHA varchar(100), 
	ALMOCO text, 
	BEBIDA_TARDE varchar(100), 
	LANCHE_TARDE varchar(100), 
	ACOMPANHAMENTO_TARDE varchar(100), 
	FRUTA_TARDE varchar(100), 
	data date, 
	unidade_escolar varchar(100)
);

CREATE TABLE CONTAGEM_ALUNOS(
	ID int auto_increment primary key,
	QUANTIDADE_LANCHE_MANHA int, 
	QUANTIDADE_BEBIDA_MANHA int ,
	QUANTIDADE_LANCHE_TARDE int ,
	QUANTIDADE_BEBIDA_TARDE int ,
	TURMA varchar(30) ,
	DATA date ,
	UNIDADE_ESCOLAR varchar(100)
);

CREATE TABLE DESPERDICIO_ALUNOS(
	ID int auto_increment primary key,
	RA varchar(4) ,
	DESPERDICIO_ALUNO float ,
	DATA_REGISTRO date
);

CREATE TABLE RECUPERACAO_SENHA(
	ID int auto_increment primary key,
	email varchar(150) ,
	codigo varchar(6) ,
	expira_em datetime
);

CREATE TABLE REFEICAO(
	ID int auto_increment primary key,
	quantidade_diaria int ,
	data_registro timestamp, 
	unidade_escolar varchar(100)
);

CREATE TABLE RESTRICOES_ALIMENTARES(
	ID int auto_increment primary key,
	nome_aluno varchar(255) ,
	telefone_responsavel varchar(50) ,
	tipo_restricao varchar(255) ,
	turma varchar(50) ,
	nome_profissional varchar(255) ,
	registro_profissional varchar(100) ,
	anotacoes_sintomas text ,
	documento_medico varchar(255) ,
	criado_em timestamp ,
	unidade_escolar varchar(100)
);


