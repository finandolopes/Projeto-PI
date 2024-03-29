<?php
// Conectar ao banco de dados (substitua os valores conforme necessário)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "confinter";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Preparar a declaração SQL para inserir os dados na tabela clientes
$sqlClientes = "INSERT INTO clientes (nome, email, telefone)
VALUES (?, ?, ?)";

// Preparar e executar a declaração para inserir os dados na tabela clientes
if ($stmtClientes = $conn->prepare($sqlClientes)) {
    $stmtClientes->bind_param("sss", $nome, $email, $telefone);

    // Atribuir os valores recebidos do formulário às variáveis para a tabela clientes
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    // Executar a declaração para inserir os dados na tabela clientes
    if (!$stmtClientes->execute()) {
        echo "Erro ao executar a declaração para inserir os dados na tabela clientes: " . $stmtClientes->error;
    }

    // Fechar a declaração para inserir os dados na tabela clientes
    $stmtClientes->close();
} else {
    echo "Erro na preparação da declaração para inserir os dados na tabela clientes: " . $conn->error;
}

// Preparar a declaração SQL para inserir os dados na tabela requisicoes
$sqlRequisicoes = "INSERT INTO requisicoes (horario_contato, tipo, categoria, outros_info)
VALUES (?, ?, ?, ?)";

// Preparar e executar a declaração para inserir os dados na tabela requisicoes
if ($stmtRequisicoes = $conn->prepare($sqlRequisicoes)) {
    $stmtRequisicoes->bind_param("ssss", $horario_contato, $tipo, $categoria, $outros_info);

    // Atribuir os valores recebidos do formulário às variáveis para a tabela requisicoes
    $horario_contato = $_POST['horario_contato'];
    $tipo = $_POST['tipo'];
    $categoria = isset($_POST['categoria']) ? implode(', ', $_POST['categoria']) : '';
    $outros_info = isset($_POST['outros_info']) ? $_POST['outros_info'] : '';

    // Executar a declaração para inserir os dados na tabela requisicoes
    if (!$stmtRequisicoes->execute()) {
        echo "Erro ao executar a declaração para inserir os dados na tabela requisicoes: " . $stmtRequisicoes->error;
    } else {
        echo "Requisição enviada com sucesso!";
    }

    // Fechar a declaração para inserir os dados na tabela requisicoes
    $stmtRequisicoes->close();
} else {
    echo "Erro na preparação da declaração para inserir os dados na tabela requisicoes: " . $conn->error;
}

// Fechar a conexão
$conn->close();

// Após a inserção bem-sucedida, redirecionar de volta ao index.php com uma variável na URL
header("Location: index.php?success=true");
exit;
?>
