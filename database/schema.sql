-- Criação da tabela de cargos
CREATE TABLE cargos (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Criação da tabela de pessoas
CREATE TABLE pessoas (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) UNIQUE,
    email VARCHAR(100),
    telefone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Criação da tabela de histórico de cargos
CREATE TABLE historico_cargos (
    id SERIAL PRIMARY KEY,
    pessoa_id INTEGER NOT NULL REFERENCES pessoas(id),
    cargo_id INTEGER NOT NULL REFERENCES cargos(id),
    data_inicio DATE NOT NULL,
    data_fim DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Índices para melhorar a performance
CREATE INDEX idx_historico_cargos_pessoa_id ON historico_cargos(pessoa_id);
CREATE INDEX idx_historico_cargos_cargo_id ON historico_cargos(cargo_id);
CREATE INDEX idx_historico_cargos_data_inicio ON historico_cargos(data_inicio);
CREATE INDEX idx_historico_cargos_data_fim ON historico_cargos(data_fim); 