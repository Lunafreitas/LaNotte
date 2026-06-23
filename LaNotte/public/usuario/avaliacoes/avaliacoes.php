<?php
require_once '../../../config/conn.php';
require_once '../../login/autenticacao.php';

verificarUser();

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'];
    $comentario = trim($_POST['comentario']);
    $nota = $_POST['nota'];
    $data = date('Y-m-d');

    if (!empty($comentario) && $nota >= 1 && $nota <= 5) {
        $stmtImg = $pdo->prepare("SELECT img_user FROM users WHERE id = :user_id");
        $stmtImg->bindValue(':user_id', $user_id, PDO::PARAM_INT);
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

        header('Location: /public/usuario/avaliacoes/avaliacoes.php');
        exit();
    }
}

if (isset($_POST['salvar_edicao'])) {

    $review_id = (int) ($_POST['review_id'] ?? 0);
    $nota = (int) ($_POST['nova_nota'] ?? 0);
    $comentario = trim($_POST['novo_comentario'] ?? '');

    if ($review_id > 0 && $nota >= 1 && $nota <= 5 && !empty($comentario)) {

        $update = $pdo->prepare("UPDATE reviews SET nota = :nota, comentario = :comentario WHERE id = :id AND user_id = :user_id");

        $update->bindValue(':nota', $nota, PDO::PARAM_INT);
        $update->bindValue(':comentario', $comentario);
        $update->bindValue(':id', $review_id, PDO::PARAM_INT);
        $update->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);

        $update->execute();
    }

    header('Location: /public/usuario/avaliacoes/avaliacoes.php');
    exit();
}

if (isset($_GET['excluir'])) {

    $del = $pdo->prepare("DELETE FROM reviews WHERE id = :id AND user_id = :uid");

    $del->bindValue(':id', $_GET['excluir']);
    $del->bindValue(':uid', $_SESSION['user_id']);
    $del->execute();

    header('Location: /public/usuario/avaliacoes/avaliacoes.php');
    exit();
}

$stmt = $pdo->query("SELECT r.id AS review_id, r.user_id, r.nota, r.comentario, r.data, r.img_user, u.nome AS user_nome, u.img_user AS user_img FROM reviews r INNER JOIN users u ON r.user_id = u.id ORDER BY r.id DESC");

$avaliacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$user_id_atual = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Notte — Avaliações</title>
    <link rel="stylesheet" href="/assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>

<body class="user">

    <?php include '../../includes/nav_user.php'; ?>

    <div class="cardapio-user-header">
        <div>
            <span class="section-tag">O que nossos clientes dizem</span>
            <h2 class="section-h2">Nossas Avaliações</h2>
        </div>
        <a href="#form-avaliacao" class="carrinho-link">
            <i class="fa-solid fa-star"></i> Avaliar Agora
        </a>
    </div>

    <div class="avaliacoes-container">

        <?php if (!empty($avaliacoes)): ?>
            <?php foreach ($avaliacoes as $avaliacao): ?>
                <div class="avaliacao-card">
                    <div class="avaliacao-topo">
                        <img
                            src="/public/images/<?= !empty($avaliacao['user_img']) ? $avaliacao['user_img'] : 'semfoto.jpg' ?>"
                                alt="<?= $avaliacao['user_nome'] ?>"class="avaliacao-avatar">
                        <strong><?= $avaliacao['user_nome'] ?></strong>
                        <span><?= date('d/m/Y', strtotime($avaliacao['data'])) ?></span>
                    </div>

                    <!-- Estrelas -->
                    <div class="avaliacao-nota">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="<?= $i <= $avaliacao['nota'] ? 'fa-solid' : 'fa-regular' ?> fa-star"></i>
                        <?php endfor; ?>
                    </div>

                    <p class="avaliacao-texto"><?= $avaliacao['comentario'] ?></p>

                    <?php if ((int)$avaliacao['user_id'] === $user_id_atual): ?>
                        <div class="avaliacao-acoes">
                            <button
                                type="button"
                                class="btn-av-editar abrirModal"
                                data-id="<?= $avaliacao['review_id']; ?>"
                                data-nota="<?= $avaliacao['nota']; ?>"
                                data-comentario="<?= $avaliacao['comentario']; ?>">
                                <i class="fa-solid fa-pen"></i>
                                Editar
                            </button>

                            <a
                                href="/public/usuario/avaliacoes/avaliacoes.php?excluir=<?= $avaliacao['review_id']; ?>"
                                class="btn-av-excluir"
                                onclick="return confirm('Excluir sua avaliação? Esta ação não pode ser desfeita.')">
                                <i class="fa-solid fa-trash"></i>
                                Excluir
                            </a>
                        </div>
                    <?php endif; ?>

                </div>
            <?php endforeach; ?>

        <?php else: ?>
            <div class="carrinho-vazio">
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

        <form method="post" action="/public/usuario/avaliacoes/avaliacoes.php">
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
            const modal = document.getElementById('modalEditar');

        document.querySelectorAll('.abrirModal').forEach(btn => {

            btn.addEventListener('click', function() {

                document.getElementById('modal-review-id').value =
                    this.dataset.id;

                document.getElementById('nova_nota').value =
                    this.dataset.nota;

                document.getElementById('novo_comentario').value =
                    this.dataset.comentario;

                modal.showModal();
            });

        });

        document.getElementById('fecharModal')
            .addEventListener('click', () => modal.close());

        document.getElementById('cancelarModal')
            .addEventListener('click', () => modal.close());

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.close();
            }
        });
    </script>

</body>

</html>