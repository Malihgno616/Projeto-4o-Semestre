<?php
require_once 'config/database.php';

$hostname = gethostname();
$server_ip = $_SERVER['SERVER_ADDR'] ?? 'N/A';
$client_ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$mysql_version = "Não conectado";
$visits = [];

try {
    $pdo = getDBConnection();
    
    // Verificar se a tabela existe, se não, criar
    $tableCheck = $pdo->query("SHOW TABLES LIKE 'visits'");
    if ($tableCheck->rowCount() == 0) {
        // Criar tabela se não existir
        $pdo->exec("CREATE TABLE IF NOT EXISTS visits (
            id INT AUTO_INCREMENT PRIMARY KEY,
            container_name VARCHAR(255) NOT NULL,
            visit_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            ip_address VARCHAR(45)
        )");
    }
    
    // Registrar visita
    $stmt = $pdo->prepare("INSERT INTO visits (container_name, ip_address) VALUES (?, ?)");
    $stmt->execute([$hostname, $client_ip]);
    
    // Contar visitas por container
    $countStmt = $pdo->query("SELECT container_name, COUNT(*) as visits FROM visits GROUP BY container_name");
    $visits = $countStmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Versão do MySQL
    $versionStmt = $pdo->query("SELECT VERSION() as version");
    $mysql_version = $versionStmt->fetch()['version'];
    
} catch (PDOException $e) {
    $mysql_version = "Erro: " . $e->getMessage();
    // Continua executando mesmo com erro
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Escalonado</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="container">
        <h1>🚀 Aplicação PHP Escalonada</h1>
        
        <div class="info-card">
            <h2>Informações do Container</h2>
            <p><strong>Container ID:</strong> <?php echo $hostname; ?></p>
            <p><strong>IP do Servidor:</strong> <?php echo $server_ip; ?></p>
            <p><strong>Versão MySQL:</strong> <?php echo $mysql_version; ?></p>
            <p><strong>Timestamp:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
        </div>

        <?php if (!empty($visits)): ?>
        <div class="visits-card">
            <h2>📊 Estatísticas de Visitas</h2>
            <?php foreach ($visits as $visit): ?>
                <p><strong><?php echo htmlspecialchars($visit['container_name']); ?>:</strong> <?php echo $visit['visits']; ?> visitas</p>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="visits-card">
            <h2>📊 Estatísticas de Visitas</h2>
            <p>Nenhuma visita registrada ainda.</p>
        </div>
        <?php endif; ?>
        
        <div class="refresh">
            <button onclick="location.reload()">🔄 Atualizar Página</button>
        </div>
    </div>
</body>
</html>