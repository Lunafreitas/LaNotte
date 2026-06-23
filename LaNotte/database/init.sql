-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05/06/2026 às 00:24
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lanotte`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`) VALUES
(4, 'Pizzas'),
(5, 'Massas'),
(6, 'Risotos'),
(7, 'Sobremesas'),
(8, ' Bebidas'),
(9, 'Vinhos'),
(10, 'Entradas'),
(11, 'Carnes');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('Esperando Confirmação','Preparando','Enviando','') NOT NULL,
  `preco` decimal(11,2) NOT NULL,
  `pedido` varchar(155) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `data_pedido` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `user_id`, `status`, `preco`, `pedido`, `quantidade`, `data_pedido`) VALUES
(6, 6, 'Preparando', 78.00, 'Lasanha à Bolonhesa', 1, '2026-05-29 15:28:46'),
(7, 6, 'Preparando', 118.00, 'Ossobuco', 1, '2026-05-29 15:28:46'),
(8, 14, 'Esperando Confirmação', 118.00, 'Ossobuco', 1, '2026-06-01 14:39:07');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `nome` varchar(155) NOT NULL,
  `descricao` varchar(155) NOT NULL,
  `preco` decimal(6,2) NOT NULL,
  `img_url` blob NOT NULL,
  `disponivel` enum('Disponível','Indisponível','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `categoria_id`, `nome`, `descricao`, `preco`, `img_url`, `disponivel`) VALUES
(1, 5, 'Spaghetti alla Carbonara', 'Prato romano autêntico: ovos, pecorino, guanciale e pimenta preta. Sem creme de leite.', 72.00, 0x436172626f6e6172612e6a7067, 'Disponível'),
(2, 4, 'Pizza Napoletana', 'Pizza napolitana com molho de tomate San Marzano, mozzarella di bufala DOP, manjericão fresco e azeite extra virgem siciliano', 68.00, 0x50697a7a612d6e61706f6c6574616e612e6a7067, 'Disponível'),
(3, 5, 'Lasanha à Bolonhesa', 'Camadas de massa com ragù de carne, besciamella e queijo parmesão.', 78.00, 0x6c6173616e68612d626f6c6f6e686573612e77656270, 'Disponível'),
(4, 6, 'Risotto alla Milanese', 'Arroz arbóreo com caldo de legumes, funghi porcini e toque de parmesão.', 85.00, 0x7269736f746f2e6a7067, 'Disponível'),
(5, 11, 'Ossobuco', 'Vitela cozida lentamente com vegetais, vinho e caldo, com Risotto alla Milanese.', 118.00, 0x6f73736f6275636f2e77656270, 'Disponível'),
(7, 7, 'Tiramisù', 'Sobremesa cremosa com biscoito champanhe embebido em café e creme de mascarpone.', 38.00, 0x746972616d6973752e6a7067, 'Disponível');

-- --------------------------------------------------------

--
-- Estrutura para tabela `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `img_user` blob NOT NULL,
  `nota` int(11) NOT NULL,
  `comentario` varchar(155) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `img_user`, `nota`, `comentario`, `data`) VALUES
(1, 6, 0x436170747572612064652074656c6120323032362d30322d3235203231313333302e706e67, 5, 'Adorei a comida, além do ambiente maravilhoso', '2026-05-30'),
(6, 14, 0x73656d666f746f2e6a7067, 5, 'A calabresa estava agressiva', '2026-06-01');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `img_user` blob NOT NULL,
  `id` int(110) NOT NULL,
  `nome` varchar(155) NOT NULL,
  `email` varchar(155) NOT NULL,
  `senha` varchar(155) NOT NULL,
  `nivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`img_user`, `id`, `nome`, `email`, `senha`, `nivel`) VALUES
(0x436170747572612064652074656c6120323032362d30322d3235203231313333302e706e67, 6, 'Luna Costa Freitas', 'luna.freitas5@aluno.ce.gov.br', '$2y$10$.eNRWp2m0f/.GjesFGssOOJelpzJ7tc2tLOTmH6ujV7PGMgP.gIGy', 0),
('', 7, 'Admin', 'admin@lanotte.com.br', '$2y$10$wQaecny95p/oFMxjCIIRde0o9jrh68tTRQjKoIevocr34iCMKC8Be', 1),
('', 13, 'Luna Costa Freitas', 'luna.costafreitas3@gmail.com', '$2y$10$BTONqHW8QOWMqTJnsGatNOLaFVxmPevfKUeNxsZuo83oONv.uCZQW', 0),
(0x73757065726d616e2e6a666966, 14, 'Tuzim', 'arthur.lima99@aluno.ce.gov.br', '$2y$10$D5.FhRXWYYIIY1oAscpOzOBC5T.eizOt6b6NPlPRAhNKUNB4Gpl92', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_carrinho_user` (`user_id`),
  ADD KEY `fk_carrinho_produto` (`produto_id`);

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pedidos_user` (`user_id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produto_categoria` (`categoria_id`);

--
-- Índices de tabela `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reviews_user` (`user_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(110) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `fk_carrinho_produto` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`),
  ADD CONSTRAINT `fk_carrinho_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_pedidos_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_produto_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Restrições para tabelas `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_reviews_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
