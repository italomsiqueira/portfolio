-- reset.sql
-- Reset completo do banco de dados

-- --------------------------------------------------------
-- Excluir tabelas se existirem
-- --------------------------------------------------------
DROP TABLE IF EXISTS ocorrencia_aluno;
DROP TABLE IF EXISTS ocorrencia;
DROP TABLE IF EXISTS alunos;
DROP TABLE IF EXISTS turma;
DROP TABLE IF EXISTS usuarios;

-- --------------------------------------------------------
-- Criar tabela usuarios
-- --------------------------------------------------------
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    login VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    nivel ENUM('admin','usuario') DEFAULT 'usuario',
    foto VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Inserir usuário admin (senha: 123456)
INSERT INTO usuarios (nome, login, senha, nivel) VALUES
('Administrador', 'admin', '$2y$10$zO6lI1FJ9ldzHrrUsp/5leI8DLrFQnTyl0r2n8G.JPzZTXwUd04Ee', 'admin');
-- Obs: senha 123456 gerada via password_hash

-- --------------------------------------------------------
-- Criar tabela turma
-- --------------------------------------------------------
CREATE TABLE turma (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ano INT NOT NULL,
    turma VARCHAR(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Inserir turmas 1A a 9B
INSERT INTO turma (ano, turma) VALUES
(1,'A'),(1,'B'),
(2,'A'),(2,'B'),
(3,'A'),(3,'B'),
(4,'A'),(4,'B'),
(5,'A'),(5,'B'),
(6,'A'),(6,'B'),
(7,'A'),(7,'B'),
(8,'A'),(8,'B'),
(9,'A'),(9,'B');

-- --------------------------------------------------------
-- Criar tabela alunos
-- --------------------------------------------------------
CREATE TABLE alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    rg VARCHAR(30) NOT NULL,
    cpf VARCHAR(20) NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    tel VARCHAR(80) NOT NULL,
    escolaridade VARCHAR(50) NOT NULL,
    turma INT NOT NULL,
    FOREIGN KEY (turma) REFERENCES turma(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Criar tabela ocorrencia
-- --------------------------------------------------------
CREATE TABLE ocorrencia (
    id INT AUTO_INCREMENT PRIMARY KEY,
    data DATE NOT NULL,
    descricao TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Criar tabela ocorrencia_aluno
-- --------------------------------------------------------
CREATE TABLE ocorrencia_aluno (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ocorrencia_id INT NOT NULL,
    alunos_id INT NOT NULL,
    FOREIGN KEY (ocorrencia_id) REFERENCES ocorrencia(id) ON DELETE CASCADE,
    FOREIGN KEY (alunos_id) REFERENCES alunos(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
