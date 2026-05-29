<?php
require_once '../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarUser();

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'];
    $comentario = $_POST['comentario'];
    $nota = $_POST['nota'];
    $data = date('Y-m-d');

    if (!empty($comentario) && !empty($nota)) {
        $stmtImg = $pdo->prepare("SELECT img_user FROM users WHERE id = :user_id");
        $stmtImg->bindValue(':user_id', $user_id);
        $stmtImg->execute();
        $usuario = $stmtImg->fetch(PDO::FETCH_ASSOC);
        $img_user = !empty($usuario['img_user']) ? $usuario['img_user'] : 'semfoto.jpg';

        $stmt = $pdo->prepare("INSERT INTO reviews (user_id, nota, comentario, data, img_user) VALUES (:user_id, :nota, :comentario, :data, :img_user)");
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':nota', $nota);
        $stmt->bindValue(':comentario', $comentario);
        $stmt->bindValue(':data', $data);
        $stmt->bindValue(':img_user', $img_user);
        $stmt->execute();

        header('Location: avaliacoes.php');
        exit();
    }
}

// ── Salvar edição via modal ──
if (isset($_POST['salvar_edicao'])) {
    $rev_id     = (int)$_POST['review_id'];
    $nova_nota  = (int)$_POST['nova_nota'];
    $novo_comt  = trim($_POST['novo_comentario']);

    if ($rev_id && $nova_nota && !empty($novo_comt)) {
        $upd = $pdo->prepare("UPDATE reviews SET nota=:nota, comentario=:comentario WHERE id=:id AND user_id=:uid");
        $upd->bindValue(':nota', $nova_nota);
        $upd->bindValue(':comentario', $novo_comt);
        $upd->bindValue(':id', $rev_id);
        $upd->bindValue(':uid', $_SESSION['user_id']);
        $upd->execute();
    }
    header('Location: avaliacoes.php');
    exit();
}

// ── Excluir avaliação ──
if (isset($_GET['excluir']) && is_numeric($_GET['excluir'])) {
    $del = $pdo->prepare("DELETE FROM reviews WHERE id=:id AND user_id=:uid");
    $del->bindValue(':id', (int)$_GET['excluir']);
    $del->bindValue(':uid', $_SESSION['user_id']);
    $del->execute();
    header('Location: avaliacoes.php');
    exit();
}

$stmt = $pdo->query("SELECT r.*, u.nome AS user_nome, u.img_user AS user_img FROM reviews r JOIN users u ON r.user_id = u.id ORDER BY r.id DESC");
$avaliacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
$user_id_atual = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Notte — Avaliações</title>
    <link rel="stylesheet" href="/LaNotte/assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="user">

<?php include '../../includes/nav_user.php'; ?>

<!-- Cabeçalho -->
<div class="cardapio-user-header">
    <div>
        <span class="section-tag">O que nossos clientes dizem</span>
        <h2 class="section-h2">Nossas Avaliações</h2>
    </div>
    <a href="#form-avaliacao" class="carrinho-link">
        <i class="fa-solid fa-star"></i> Avaliar Agora
    </a>
</div>

<!-- Grid de cards -->
<div class="avaliacoes-container">

    <?php if (!empty($avaliacoes)): ?>
        <?php foreach ($avaliacoes as $av): ?>
            <div class="avaliacao-card">

                <!-- Topo: avatar + nome + data -->
                <div class="avaliacao-topo">
                    <img
                        src="/LaNotte/images/<?= htmlspecialchars(!empty($av['user_img']) ? $av['user_img'] : 'semfoto.jpg') ?>"
                        alt="<?= htmlspecialchars($av['user_nome']) ?>"
                        class="avaliacao-avatar"
                    >
                    <strong><?= htmlspecialchars($av['user_nome']) ?></strong>
                    <span><?= date('d/m/Y', strtotime($av['data'])) ?></span>
                </div>

                <!-- Estrelas -->
                <div class="avaliacao-nota">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <i class="<?= $i <= $av['nota'] ? 'fa-solid' : 'fa-regular' ?> fa-star"></i>
                    <?php endfor; ?>
                </div>

                <p class="avaliacao-texto"><?= htmlspecialchars($av['comentario']) ?></p>

                <!-- Editar/excluir — apenas para o dono da avaliação -->
                <?php if ((int)$av['user_id'] === $user_id_atual): ?>
                    <div class="avaliacao-acoes">
                        <!-- Editar abre o modal e preenche os campos via JS -->
                        <button
                            class="btn-av-editar abrirModal"
                            data-id="<?= $av['id'] ?>"
                            data-nota="<?= $av['nota'] ?>"
                            data-comentario="<?= htmlspecialchars($av['comentario'], ENT_QUOTES) ?>"
                        >
                            <i class="fa-solid fa-pen"></i> Editar
                        </button>
                        <!-- Excluir com confirmação -->
                        <a
                            href="avaliacoes.php?excluir=<?= $av['id'] ?>"
                            class="btn-av-excluir"
                            onclick="return confirm('Excluir sua avaliação? Esta ação não pode ser desfeita.')"
                        >
                            <i class="fa-solid fa-trash"></i> Excluir
                        </a>
                    </div>
                <?php endif; ?>

            </div>
        <?php endforeach; ?>

    <?php else: ?>
        <div class="avaliacao-vazia">
            <p>Nenhuma avaliação ainda. Seja o primeiro a avaliar!</p>
        </div>
    <?php endif; ?>

</div>

<!-- Formulário nova avaliação -->
<div class="avaliacao-form-wrap" id="form-avaliacao">
    <form action="" method="POST" class="avaliacao-form">
        <h3>Deixe sua avaliação</h3>
        <label for="nota">Nota</label>
        <select name="nota" id="nota" required>
            <option value="">Selecione</option>
            <option value="5">5 ★★★★★</option>
            <option value="4">4 ★★★★</option>
            <option value="3">3 ★★★</option>
            <option value="2">2 ★★</option>
            <option value="1">1 ★</option>
        </select>
        <label for="comentario">Comentário</label>
        <textarea name="comentario" id="comentario" rows="3" placeholder="Escreva sua avaliação..." required></textarea>
        <button type="submit" name="submit">
            Enviar Avaliação <i class="fa-solid fa-arrow-right"></i>
        </button>
    </form>
</div>

<!-- ── Modal de edição ── -->
<dialog id="modalEditar">
    <div class="modal-topo">
        <span class="modal-titulo">Editar Avaliação</span>
        <button class="modal-fechar" id="fecharModal" type="button">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <form method="POST" action="avaliacoes.php">
        <input type="hidden" name="review_id" id="modal-review-id">

        <div class="modal-corpo">
            <div class="modal-campo">
                <label for="nova_nota">Nota</label>
                <select name="nova_nota" id="nova_nota" required>
                    <option value="5">5 ★★★★★</option>
                    <option value="4">4 ★★★★</option>
                    <option value="3">3 ★★★</option>
                    <option value="2">2 ★★</option>
                    <option value="1">1 ★</option>
                </select>
            </div>
            <div class="modal-campo">
                <label for="novo_comentario">Comentário</label>
                <textarea name="novo_comentario" id="novo_comentario" rows="4" required></textarea>
            </div>
        </div>

        <div class="modal-acoes">
            <button type="submit" name="salvar_edicao" class="btn-modal-salvar">
                <i class="fa-solid fa-check"></i> Salvar
            </button>
            <button type="button" id="cancelarModal" class="btn-modal-cancelar">
                Cancelar
            </button>
        </div>
    </form>
</dialog>

<script>
const modal        = document.getElementById('modalEditar');
const fechar       = document.getElementById('fecharModal');
const cancelar     = document.getElementById('cancelarModal');
const inputId      = document.getElementById('modal-review-id');
const selectNota   = document.getElementById('nova_nota');
const textareaComt = document.getElementById('novo_comentario');

// Abre o modal e preenche os campos com os dados do card clicado
document.querySelectorAll('.abrirModal').forEach(btn => {
    btn.addEventListener('click', () => {
        inputId.value      = btn.dataset.id;
        selectNota.value   = btn.dataset.nota;
        textareaComt.value = btn.dataset.comentario;
        modal.showModal();
    });
});

fechar.addEventListener('click',  () => modal.close());
cancelar.addEventListener('click', () => modal.close());

// Fecha ao clicar fora (no backdrop)
modal.addEventListener('click', e => {
    if (e.target === modal) modal.close();
});
</script>

</body>
</html>
