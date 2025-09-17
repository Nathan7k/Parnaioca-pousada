create database Pousadaparanioca;
use Pousadaparanioca;


CREATE TABLE funcionarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    perfil ENUM('admin','user') DEFAULT 'user',
    stat TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    data_nascimento DATE NOT NULL,
    cpf VARCHAR(20) NOT NULL,
    email VARCHAR(150),
    telefone VARCHAR(20),
    estado VARCHAR(50),
    cidade VARCHAR(50),
    ativo TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE tipos_acomodacao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE acomodacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo_id INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    numero VARCHAR(10) NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    capacidade_maxima INT NOT NULL,
    ativo TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (tipo_id) REFERENCES tipos_acomodacao(id)
);


CREATE TABLE itens_frigobar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    ativo TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE acomodacao_itens_frigobar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    acomodacao_id INT NOT NULL,
    item_id INT NOT NULL,
    quantidade INT DEFAULT 0,
    ativo TINYINT(1) DEFAULT 1,
    FOREIGN KEY (acomodacao_id) REFERENCES acomodacoes(id),
    FOREIGN KEY (item_id) REFERENCES itens_frigobar(id)
);



CREATE TABLE hospedagens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    acomodacao_id INT NOT NULL,
    funcionario_id INT NOT NULL, 
    data_checkin DATETIME NOT NULL,
    data_checkout DATETIME,
    status ENUM('reservado','hospedado','finalizado','cancelado') DEFAULT 'reservado',
    total DECIMAL(12,2) DEFAULT 0, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id),
    FOREIGN KEY (acomodacao_id) REFERENCES acomodacoes(id),
    FOREIGN KEY (funcionario_id) REFERENCES funcionarios(id)
);



CREATE TABLE consumo_frigobar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hospedagem_id INT NOT NULL,
    item_id INT NOT NULL,
    quantidade INT NOT NULL,
    valor_unitario DECIMAL(10,2) NOT NULL,
    total DECIMAL(10,2) NOT NULL,       
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (hospedagem_id) REFERENCES hospedagens(id),
    FOREIGN KEY (item_id) REFERENCES itens_frigobar(id)
);


CREATE TABLE estacionamento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    acomodacao_id INT NOT NULL,
    vaga_numero INT NOT NULL,
    ocupada TINYINT(1) DEFAULT 0,
    FOREIGN KEY (acomodacao_id) REFERENCES acomodacoes(id)
); 


CREATE TABLE logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    acao VARCHAR(255) NOT NULL,
    tabela_afetada VARCHAR(50),
    registro_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES funcionarios(id)
);