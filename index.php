<?php
session_start();

if (!isset($_SESSION['tarefas'])) {
    $_SESSION['tarefas'] = [];
}

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['acao'] === 'adicionar') {
        $nome_tarefa = $_POST['nome_tarefa'];
        $data_tarefa = $_POST['data_tarefa'];
        $_SESSION['tarefas'][] = ['nome' => $nome_tarefa, 'data' => $data_tarefa];
        $mensagem = 'Tarefa adicionada!';
    } elseif ($_POST['acao'] === 'excluir') {
        $indice = $_POST['indice'];
        array_splice($_SESSION['tarefas'], $indice, 1);
        $mensagem = 'Tarefa excluída!';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Tarefas</a>
    <ul class="navbar-nav me-auto">
      <li class="nav-item"><a class="nav-link" href="?view=hoje">Hoje</a></li>
      <li class="nav-item"><a class="nav-link" href="?view=nova">Nova</a></li>
      <li class="nav-item"><a class="nav-link" href="?view=todas">Todas</a></li>
    </ul>
    <span class="navbar-text">Total: <?php echo count($_SESSION['tarefas']); ?></span>
  </div>
</nav>

<div class="container mt-4">
    <?php if ($mensagem): ?>
        <div class="alert alert-info"><?php echo $mensagem; ?></div>
    <?php endif; ?>

    <?php
    $view = $_GET['view'] ?? 'todas';
    $data_hoje = date('Y-m-d');

    switch ($view) {
        case 'nova':
    ?>
        <h2>Nova Tarefa</h2>
        <form method="POST">
            <input type="hidden" name="acao" value="adicionar">
            <input type="text" class="form-control mb-3" name="nome_tarefa" placeholder="Nome da Tarefa" required>
            <input type="date" class="form-control mb-3" name="data_tarefa" required>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    <?php
        break;

        case 'hoje':
    ?>
        <h2>Tarefas de Hoje</h2>
        <ul class="list-group">
            <?php
            $tarefas_hoje = array_filter($_SESSION['tarefas'], fn($t) => $t['data'] === $data_hoje);
            if (empty($tarefas_hoje)): ?>
                <li class="list-group-item">Nenhuma tarefa pra hoje.</li>
            <?php else:
                foreach ($tarefas_hoje as $i => $tarefa): ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span><?php echo "{$tarefa['nome']} - <small>{$tarefa['data']}</small>"; ?></span>
                        <form method="POST">
                            <input type="hidden" name="acao" value="excluir">
                            <input type="hidden" name="indice" value="<?php echo $i; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Apagar</button>
                        </form>
                    </li>
            <?php endforeach;
            endif; ?>
        </ul>
    <?php
        break;

        case 'todas':
        default:
    ?>
        <h2>Todas as Tarefas</h2>
        <ul class="list-group">
            <?php if (empty($_SESSION['tarefas'])): ?>
                <li class="list-group-item">Nenhuma tarefa cadastrada.</li>
            <?php else:
                foreach ($_SESSION['tarefas'] as $i => $tarefa): ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span><?php echo "{$tarefa['nome']} - <small>{$tarefa['data']}</small>"; ?></span>
                        <form method="POST">
                            <input type="hidden" name="acao" value="excluir">
                            <input type="hidden" name="indice" value="<?php echo $i; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Apagar</button>
                        </form>
                    </li>
            <?php endforeach;
            endif; ?>
        </ul>
    <?php
        break;
    }
    ?>
</div>

</body>
</html>