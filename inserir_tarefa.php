<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

$input = json_decode(file_get_contents('php://input'), true);

// Inserir nova tarefa
if (isset($input['data'], $input['tarefa'])) {
    $stmt = $conn->prepare("INSERT INTO tarefas (data, tarefa) VALUES (?, ?)");
    $stmt->bind_param("ss", $input['data'], $input['tarefa']);
}

// Marcar como concluída
if (isset($input['concluir'], $input['id'])) {
    $stmt = $conn->prepare("UPDATE tarefas SET concluida = TRUE WHERE id = ?");
    $stmt->bind_param("i", $input['id']);
}

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => $stmt->error]);
}

$conn->close();
?>