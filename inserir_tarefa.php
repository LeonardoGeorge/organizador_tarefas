<?php
include 'conexao.php';

// Verifica o método HTTP
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Recebe dados JSON
$input = json_decode(file_get_contents('php://input'), true);

$stmt = $conn->prepare("INSERT INTO tarefas (data, tarefa) VALUES (?, ?)");
$stmt->bind_param("ss", $input['data'], $input['tarefa']);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Tarefa salva!"]);
} else {
    echo json_encode(["error" => $stmt->error]);
}

$conn->close();
?>