-- Criar tabela de visits
CREATE TABLE IF NOT EXISTS visits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    container_name VARCHAR(255) NOT NULL,
    visit_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip_address VARCHAR(45)
);

-- Inserir dados iniciais
INSERT IGNORE INTO visits (container_name, ip_address) VALUES 
('initial_setup', '127.0.0.1');