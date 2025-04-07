-- Adiciona o campo created_at na tabela pessoas
ALTER TABLE pessoas ADD COLUMN IF NOT EXISTS created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;

-- Adiciona o campo created_at na tabela cargos
ALTER TABLE cargos ADD COLUMN IF NOT EXISTS created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;

-- Adiciona o campo created_at na tabela historico_cargos
ALTER TABLE historico_cargos ADD COLUMN IF NOT EXISTS created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP; 