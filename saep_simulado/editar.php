<?php

include 'db.php'; 
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM alunos WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nome = $row['nome'];
        $idade = $row['idade'];
        $email = $row['email'];
        $curso = $row['curso'];
    } else {
        echo "O Aluno não foi encontrado!";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $email = $_POST['email'];
    $curso = $_POST['curso'];
    $sql = "UPDATE alunos SET nome = '$nome', idade = $idade, email = '$email', curso = '$curso' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Dados atualizados!";
        header("Location: index.php");
        exit;
    } else {
        echo "Erro!" . $conn->error;
    }
}
?>
<!DOCTYPE html> 
<html lang="pt-BR"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Editar Aluno</h1>
        <form action="editar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo $email; ?>" required><br>

            <label for="curso">Curso:</label>
            <input type="text" name="curso" id="curso" value="<?php echo $curso; ?>" required><br>
            <button type="submit">Atualizar</button>
        </form>
    </div>
</body>
</html>