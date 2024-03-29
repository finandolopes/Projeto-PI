<?php
// Função para listar todas as requisições
function listarRequisicoes($conexao) {
    $sql = "SELECT r.id_requisicao, r.horario_contato, r.tipo, r.categoria, r.outros_info, r.data_requisicao, c.nome, c.email, c.telefone 
            FROM requisicoes r
            INNER JOIN clientes c ON r.id_cliente = c.id_cliente";
    $resultado = mysqli_query($conexao, $sql);
    $requisicoes = array();
    while ($requisicao = mysqli_fetch_assoc($resultado)) {
        $requisicoes[] = $requisicao;
    }
    return $requisicoes;
}

// Função para listar requisições por data
function listarRequisicoesPorData($conexao, $data_inicio, $data_fim) {
    // Verifica se as datas não estão vazias
    if (empty($data_inicio) || empty($data_fim)) {
        return array(); // Retorna um array vazio se as datas estiverem vazias
    }
    
    $sql = "SELECT r.id_requisicao, r.horario_contato, r.tipo, r.categoria, r.outros_info, r.data_requisicao, c.nome, c.email, c.telefone 
            FROM requisicoes r
            INNER JOIN clientes c ON r.id_cliente = c.id_cliente
            WHERE r.data_requisicao BETWEEN '$data_inicio' AND '$data_fim'";
    $resultado = mysqli_query($conexao, $sql);
    $requisicoes = array();
    while ($requisicao = mysqli_fetch_assoc($resultado)) {
        $requisicoes[] = $requisicao;
    }
    return $requisicoes;
}

// Função para buscar um cliente pelo ID
function buscarClientePorId($conexao, $id_cliente) {
    $sql = "SELECT * FROM clientes WHERE id_cliente = $id_cliente";
    $resultado = mysqli_query($conexao, $sql);
    return mysqli_fetch_assoc($resultado);
}
?>
