<style>
    @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:wght@400;700&display=swap');


    :root {
        --creme: #e8dabf;
        --preto: #262d24;
        --vermelho: #de4a2d;
        --verde: #006B3A;
        --amarelo: #f8a41b;
        --azul: #17529f;
        --marrom: #bb9257;
    }


    .sidebar {
        width: 240px;
        min-height: 100%;
        background: #191d17;
        border-right: 3px solid var(--amarelo);
        display: flex;
        flex-direction: column;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 200;
    }

    .sidebar-logo {
        padding: 26px 24px 18px;
        border-bottom: 1px solid var(--amarelo);
        text-decoration: none;
        display: block;
    }

    .sidebar-logo-txt {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 26px;
        letter-spacing: 2px;
        color: var(--amarelo);
        display: block;
    }

    .sidebar-logo-txt span {
        color: var(--marrom);
    }

    .sidebar-badge {
        font-size: 8px;
        font-weight: 500;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--creme);
        display: block;
        margin-top: 3px;
        font-family: 'Roboto';
    }

    .sidebar-nav {
        flex: 1;
        padding: 16px 0;
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .sidebar-grupo {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--marrom);
        padding: 14px 24px 5px;
        font-family: 'Roboto', sans-serif;
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 11px 24px;
        text-decoration: none;
        font-family: 'Roboto', sans-serif;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: var(--amarelo);
        border-left: 3px solid transparent;
        transition: 0.5s;
    }

    .sidebar-link i {
        font-size: 13px;
        width: 15px;
        flex-shrink: 0;
    }

    .sidebar-link:hover {
        color: var(--creme);
        background: rgba(255, 255, 255, 0.1);
        border-left-color: var(--amarelo);
    }

    .sidebar-footer {
        padding: 18px 24px;
        border-top: 1px solid var(--amarelo);
    }

    .sidebar-sair {
        align-items: center;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        text-decoration: none;
        color: var(--marrom);
        font-family: 'Roboto', sans-serif;
        transition: 0.5s;
    }

    .sidebar-sair:hover {
        color: #de4a2d;
    }
</style>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<aside class="sidebar">

    <a href="/LaNotte/public/admin/dashboard_admin.php" class="sidebar-logo">
        <span class="sidebar-logo-txt">La<span>Notte</span>.</span>
        <span class="sidebar-badge">Painel Admin</span>
    </a>

    <nav class="sidebar-nav">

        <span class="sidebar-grupo">Visão Geral</span>

        <a href="/public/admin/home/dashboard_admin.php" class="sidebar-link">
            <i class="fa-solid fa-chart-pie"></i> Inicio
        </a>

        <span class="sidebar-grupo">Gestão</span>

        <a href="/public/admin/produtos/produtos.php" class="sidebar-link">
            <i class="fa-solid fa-utensils"></i> Produtos
        </a>

        <a href="/public/admin/categorias/categorias.php" class="sidebar-link">
            <i class="fa-solid fa-tags"></i> Categorias
        </a>

        <a href="/public/admin/pedidos/pedidos.php" class="sidebar-link">
            <i class="fa-solid fa-receipt"></i> Pedidos
        </a>

        <a href="/public/admin/home/usuarios.php" class="sidebar-link">
            <i class="fa-solid fa-users"></i> Usuários
        </a>

        <a href="/public/admin/avaliacoes/avaliacoes_excluir.php" class="sidebar-link">
            <i class="fa-solid fa-chart-bar"></i> Avaliações
        </a>

        <span class="sidebar-grupo">Conta</span>

        <a href="/index.php" class="sidebar-link">
            <i class="fa-solid fa-globe"></i> Ver Site
        </a>
    </nav>

    <div class="sidebar-footer">
        <a href="/public/login/logout.php" class="sidebar-sair">
            <i class="fa-solid fa-right-from-bracket"></i> Sair
        </a>
    </div>

</aside>