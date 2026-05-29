<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>La Notte - Comida Italiana</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="assets/style.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Playfair+Display+SC:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

</head>
<body class="inicio">

<!-- navbar -->
<nav id="navbar">
  <div class="nav-logo">La<span>Notte</span>.</div>
  <ul class="nav-links">
    <li><a href="#historia">Nossa História</a></li>
    <li><a href="#diferenciais">Diferenciais</a></li>
    <li><a href="#cardapio">Cardápio</a></li>
    <li><a href="#avaliacoes">Avaliações</a></li>
    <li><a href="login/login.php" class="btn-login">Entrar</a></li>
    <li><a href="login/cadastro.php" class="btn-cadastro">Cadastrar</a></li>
  </ul>
</nav>


<!-- hero -->
<section class="hero" id="home" data-nav="cream">
    <div class="hero-left">
    <div class="hero-tag">Tradição Italiana desde 1987</div>
    <h1 class="hero-h1">
      <span>Uma</span>
      <span class="line-accent">Experiência</span>
      <span>Italiana</span>
      <span>Inesquecível</span>
    </h1>
    <p class="hero-desc">Sabores que atravessam gerações. Ingredientes importados, massas feitas à mão e a autenticidade da nonna Rosaria em cada prato.</p>
    <div class="hero-btns">
        <a href="#cardapio" class="btn-cardapio">Ver Cardápio</a>
        <a href="#reserva" class="btn-mesa">Reservar Mesa</a>
    </div>
</div>
<div class="hero-right">
    <div class="hero-img">
        <img src="images/pizza-heropage.png" alt="Prato italiano">
        <div class="badge">★ Desde 1987 ★</div>
    </div>
</div>
</section>

<!-- carrossel -->
<div class="carrossel">
  <div class="carrossel-diferenciais" id="carrossel-diferenciais">
    <span>Tradição Italiana desde 1987</span>
    <span>Massas Artesanais</span>
    <span>Ingredientes Importados</span>
    <span>Nonna Rosaria</span>
    <span>Delivery em 35min</span>
    <span>Adega Premiada</span>
    <span>Cashback 5%</span>
    <span>Programa Fidelidade</span>
    <span>Tradição Italiana desde 1987</span>
    <span>Massas Artesanais</span>
    <span>Ingredientes Importados</span>
    <span>Nonna Rosaria</span>
    <span>Delivery em 35min</span>
    <span>Adega Premiada</span>
    <span>Cashback 5%</span>
    <span>Programa Fidelidade</span>
  </div>
</div>

<!-- historia -->
<section class="historia" id="historia" data-nav="dark">
  <div class="historia-img">
    <img src="images/restaurantelanotte.jfif" alt="Restaurante La Notte">
    <div class="historia-data">1987<small>Fundação</small></div>
  </div>
  <div class="historia-text">
    <span class="section-tag">Nossa História</span>
    <h2 class="section-h2">Uma família italiana que trouxe a Itália ao Brasil</h2>
    <p>Em 1987, <em>Leonardo Ferretti</em>, um jovem cozinheiro da Campânia, cruzou o oceano com sua esposa Maria e três filhos, trazendo consigo apenas suas malas — e as receitas guardadas a sete chaves da <em>nonna Rosaria</em>.</p>
    <p>Começou vendendo massas artesanais de porta em porta. Em 1992, abriu o primeiro restaurante em Pinheiros. Hoje, a terceira geração da família mantém a tradição viva: ingredientes importados diretamente da Itália e massas feitas à mão todos os dias.</p>
    <div class="pills">
      <div class="pill">100% Importados</div>
      <div class="pill">Massas Artesanais</div>
      <div class="pill">3 Gerações</div>
      <div class="pill">Autenticidade</div>
    </div>
    <div class="frase">"Con amore sempre" — Leonardo Ferretti</div>
  </div>
</section>

<!-- diferenciais -->
<section class="diferenciais" id="diferenciais" data-nav="green">
  <div class="dif-header">
    <span class="section-tag">Por que nos escolher</span>
    <h2 class="section-h2">Nossos Diferenciais</h2>
    <p>Cada detalhe foi pensado para que você viva a mais autêntica experiência italiana fora da Itália</p>
  </div>
  <div class="carousel-wrap">
    <div class="carousel-track" id="carouselTrack">
      <div class="card-dif" data-num="01">
        <i class="fa-solid fa-plane card-icon"></i><h3>Ingredientes Importados</h3><p>Tomate San Marzano, Parmigiano-Reggiano, azeite siciliano e muito mais, direto da Itália.</p>
      </div>

      <div class="card-dif" data-num="02">
        <i class="fa-solid fa-utensils card-icon"></i><h3>Massas Artesanais</h3><p>Preparadas diariamente à mão, seguindo as receitas tradicionais da nonna Rosaria.</p>
      </div>

      <div class="card-dif" data-num="03">
        <i class="fa-solid fa-star card-icon"></i><h3>Atendimento Premium</h3><p>Nossa equipe garante uma experiência completa, memorável e personalizada.</p>
      </div>

      <div class="card-dif" data-num="04">
        <i class="fa-solid fa-rocket card-icon"></i><h3>Delivery Rápido</h3><p>Pedido em até 35 minutos na sua porta, com embalagem térmica para manter a perfeição.</p>
      </div>

      <div class="card-dif" data-num="05">
        <i class="fa-solid fa-credit-card card-icon"></i><h3>Cashback Exclusivo</h3><p>5% de cashback em todos os pedidos, acumulando créditos para suas próximas refeições.</p>
      </div>

      <div class="card-dif" data-num="06">
        <i class="fa-solid fa-leaf card-icon"></i><h3>Ambiente Agradável</h3><p>Espaço acolhedor e elegante, ideal para momentos especiais com família e amigos.</p>
      </div>

      <div class="card-dif" data-num="07">
        <i class="fa-solid fa-gift card-icon"></i><h3>Programa Fidelidade</h3><p>Acumule pills, desbloqueie prêmios e ganhe brindes nos seus aniversários.</p>
      </div>

      <div class="card-dif" data-num="08">
        <i class="fa-solid fa-wine-bottle card-icon"></i><h3>Adega Premiada</h3><p>Mais de 60 rótulos italianos selecionados por nosso sommelier para todos os gostos.</p>
      </div>


      <!-- duplicadas pro carrossel do grau -->
      <div class="card-dif" data-num="01">
        <i class="fa-solid fa-plane card-icon"></i><h3>Ingredientes Importados</h3><p>Tomate San Marzano, Parmigiano-Reggiano, azeite siciliano e muito mais, direto da Itália.</p>
      </div>

      <div class="card-dif" data-num="02">
        <i class="fa-solid fa-utensils card-icon"></i><h3>Massas Artesanais</h3><p>Preparadas diariamente à mão, seguindo as receitas tradicionais da nonna Rosaria.</p>
      </div>

      <div class="card-dif" data-num="03">
        <i class="fa-solid fa-star card-icon"></i><h3>Atendimento Premium</h3><p>Nossa equipe garante uma experiência completa, memorável e personalizada.</p>
      </div>

      <div class="card-dif" data-num="04">
        <i class="fa-solid fa-rocket card-icon"></i><h3>Delivery Rápido</h3><p>Pedido em até 35 minutos na sua porta, com embalagem térmica para manter a perfeição.</p>
      </div>

      <div class="card-dif" data-num="05">
        <i class="fa-solid fa-credit-card card-icon"></i><h3>Cashback Exclusivo</h3><p>5% de cashback em todos os pedidos, acumulando créditos para suas próximas refeições.</p>
      </div>

      <div class="card-dif" data-num="06">
        <i class="fa-solid fa-leaf card-icon"></i><h3>Ambiente Agradável</h3><p>Espaço acolhedor e elegante, ideal para momentos especiais com família e amigos.</p>
      </div>

      <div class="card-dif" data-num="07">
        <i class="fa-solid fa-gift card-icon"></i><h3>Programa Fidelidade</h3><p>Acumule pills, desbloqueie prêmios e ganhe brindes nos seus aniversários.</p>
      </div>

      <div class="card-dif" data-num="08">
        <i class="fa-solid fa-wine-bottle card-icon"></i><h3>Adega Premiada</h3><p>Mais de 60 rótulos italianos selecionados por nosso sommelier para todos os gostos.</p>
      </div>

    </div>
  </div>
</section>

<!-- cardapio -->
<section class="cardapio" id="cardapio" data-nav="cream">
  <div class="cardapio-header">
    <div>
      <span class="section-tag">Cardápio</span>
      <h2 class="section-h2">Destaques do<br>Cardápio</h2>
    </div>
    <a href="login/login.php" class="cardapio-link">Cardápio Completo →</a>
  </div>
  <div class="menu-grid">
    <div class="menu-card">
      <img class="menu-card-img" src="images/Carbonara.jpg" alt="Carbonara">
      <div class="menu-card-body">
        <h3>Spaghetti alla Carbonara</h3>
        <p>Prato romano autêntico: ovos, pecorino, guanciale e pimenta preta. Sem creme de leite.</p>
      </div>
      <div class="menu-card-footer"><span class="menu-tag">Massa</span><span class="menu-price">R$ 72</span></div>
    </div>
    <div class="menu-card">
      <img class="menu-card-img" src="images/Pizza-napoletana.jpg" alt="Pizza Napoletana">
      <div class="menu-card-body">
        <h3>Pizza Napoletana</h3>
        <p>Originária de Nápoles, com massa fina no centro e bordas altas e macias.</p>
      </div>
      <div class="menu-card-footer"><span class="menu-tag">Pizza</span><span class="menu-price">R$ 68</span></div>
    </div>
    <div class="menu-card">
      <img class="menu-card-img" src="images/lasanha-bolonhesa.webp" alt="Lasanha">
      <div class="menu-card-body">
        <h3>Lasanha à Bolonhesa</h3>
        <p>Camadas de massa com ragù de carne, besciamella e queijo parmesão.</p>
      </div>
      <div class="menu-card-footer"><span class="menu-tag">Massa</span><span class="menu-price">R$ 78</span></div>
    </div>
    <div class="menu-card">
      <img class="menu-card-img" src="images/risoto.jpg" alt="Risotto">
      <div class="menu-card-body">
        <h3>Risotto alla Milanese</h3>
        <p>Arroz arbóreo com caldo de legumes, funghi porcini e toque de parmesão.</p>
      </div>
      <div class="menu-card-footer"><span class="menu-tag">Risotto</span><span class="menu-price">R$ 85</span></div>
    </div>
    <div class="menu-card">
      <img class="menu-card-img" src="images/ossobuco.webp" alt="Ossobuco">
      <div class="menu-card-body">
        <h3>Ossobuco</h3>
        <p>Vitela cozida lentamente com vegetais, vinho e caldo, com Risotto alla Milanese.</p>
      </div>
      <div class="menu-card-footer"><span class="menu-tag">Carnes</span><span class="menu-price">R$ 118</span></div>
    </div>
    <div class="menu-card">
      <img class="menu-card-img" src="images/tiramisu.jpg" alt="Tiramisu">
      <div class="menu-card-body">
        <h3>Tiramisù</h3>
        <p>Sobremesa cremosa com biscoito champanhe embebido em café e creme de mascarpone.</p>
      </div>
      <div class="menu-card-footer"><span class="menu-tag">Sobremesa</span><span class="menu-price">R$ 38</span></div>
    </div>
  </div>
</section>

<!-- avaliações -->
<section class="avaliacoes" id="avaliacoes" data-nav="blue">
  <div class="avaliacoes-header">
    <span class="section-tag">Avaliações</span>
    <h2 class="section-h2">O que nossos<br>clientes dizem</h2>
    <p>Experiências reais de quem já viveu a magia La Notte</p>
  </div>

  <div class="reviews-grid">
    <div class="review-card">
      <div class="stars">★★★★★</div>
      <p class="review-text">"A melhor Carbonara que já comi fora da Itália. A massa é perfeita, o guanciale derrete na boca. Um lugar que vale cada centavo."</p>
      <div class="reviewer">
        <div class="reviewer-avatar">AM</div>
        <div>
          <div class="reviewer-name">Ana Medeiros</div>
          <div class="reviewer-date">Google · há 2 semanas</div>
        </div>
      </div>
    </div>

    <div class="review-card">
      <div class="stars">★★★★★</div>
      <p class="review-text">"Ambiente incrível, atendimento impecável e a Pizza Napoletana é de outro mundo. Já virei cliente fiel do programa de fidelidade."</p>
      <div class="reviewer">
        <div class="reviewer-avatar">RC</div>
        <div>
          <div class="reviewer-name">Rafael Costa</div>
          <div class="reviewer-date">Google · há 1 mês</div>
        </div>
      </div>
    </div>

    <div class="review-card">
      <div class="stars">★★★★★</div>
      <p class="review-text">"Trouxe minha família para comemorar e foi inesquecível. O Ossobuco com Risotto alla Milanese é uma obra de arte. Voltaremos sempre."</p>
      <div class="reviewer">
        <div class="reviewer-avatar">JS</div>
        <div>
          <div class="reviewer-name">Juliana Souza</div>
          <div class="reviewer-date">Google · há 3 semanas</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- rodape -->
<footer>
  <div class="footer-logo">La<span>Notte</span>.</div>
  <p class="footer-copy">© 2026 LaNotte Italiana. Todos os direitos reservados.</p>
  <div class="footer-links">
    <a href="#historia">História</a>
    <a href="#cardapio">Cardápio</a>
    <a href="login/login.php">Entrar</a>
  </div>
</footer>

<script>
// fazer a navbar mudar de cor
const nav = document.getElementById('navbar');
const sections = document.querySelectorAll('section[data-nav]');

function updateNav(){
  let current = 'cream';
  sections.forEach(sec => {
    const top = sec.getBoundingClientRect().top;
    if(top <= 80) current = sec.dataset.nav;
  });
  nav.className = '';
  if(current === 'dark') nav.classList.add('dark');
  else if(current === 'green') nav.classList.add('green-bg');
  else if(current === 'blue') nav.classList.add('blue-bg');
}
window.addEventListener('scroll', updateNav);
updateNav();
</script>
</body>
</html>