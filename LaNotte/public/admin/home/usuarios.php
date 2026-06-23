<?php
require_once '../../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarAdmin();

$stmt = $pdo->query("SELECT * FROM users WHERE nivel = 0 ORDER BY id DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total = count($users);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Notte — Usuários</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>

<body class="admin">
    <?php include '../../includes/nav_admin.php'; ?>

    <div class="main">

        <div class="page-header">
            <div>
                <div class="eyebrow">Gestão</div>
                <h2>Usuários</h2>
            </div>
        </div>

        <div class="input-pai">
            <input
                type="text"
                id="busca"
                placeholder="Buscar por nome ou email..."
                oninput="filtrar(this.value)"
                class="input-user"
                onfocus="this.style.borderColor='var(--amarelo)'"
                onblur="this.style.borderColor='rgba(248,164,27,.2)'">
            <span id="count-txt" class="txt-input-user">
                <?= $total ?> usuário(s)
            </span>
        </div>

        <div class="tabela-wrap">
            <div class="tabela-topo">
                <span class="tabela-label">Todos os Usuários</span>
                <span class="tabela-count"><?= $total ?> registro(s)</span>
            </div>
            <table id="tabela-users">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td class="td-img">
                                <?php if (empty($user['img_user'])): ?>
                                    <img src="/public/images/semfoto.jpg">
                                <?php else: ?>
                                    <img src="/public/images/<?= $user['img_user'] ?>">
                                <?php endif; ?>
                            </td>
                            <td class="td-id"><?= $user['id'] ?></td>
                            <td class="td-nome"><?= $user['nome'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td>
                                <div class="td-acoes">
                                    <a href="/public/admin/excluir_usuario.php?id=<?= $user['id'] ?>"
                                        class="btn-deletar"
                                        onclick="return confirm('Excluir <?= $user['nome'] ?>? Esta ação não pode ser desfeita.')">
                                        <i class="fa-solid fa-trash"></i> Excluir
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

    <script>
        function filtrar(t) {
            t = t.toLowerCase();
            let v = 0;
            document.querySelectorAll('#tabela-users tbody tr').forEach(tr => {
                const ok = tr.textContent.toLowerCase().includes(t);
                tr.style.display = ok ? '' : 'none';
                if (ok) v++;
            });
            document.getElementById('count-txt').textContent = v + ' usuário(s)';
        }
    </script>

</body>

</html>