SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emsql`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `contas`
--

CREATE TABLE `contas` (
  `id_conta` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `contato` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cpf` varchar(20),
  `data_nasc` date NOT NULL,
  `username` varchar(100) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Inserindo dados na tabela `contas`
--

INSERT INTO `contas` (`id_conta`, `nome`, `sobrenome`, `contato`, `email`, `cpf`, `data_nasc`, `username`, `genero`, `password`) VALUES
(1, 'Erick', 'Bandeira', '03150100830', 'erickbandeira19@gmail.com', '3530231218003', '2023-05-03', 'admin1', 'M', 'admin123');


-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id_conta` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `cqtd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Inserindo dados na tabela `detal_pedidos`
--

CREATE TABLE `detal_pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `qtd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Inserindo dados na tabela `detal_pedidos``
--

INSERT INTO `detal_pedidos` (`id_pedido`, `id_produto`, `qtd`) VALUES
(17, 35, 5),
(18, 31, 1),
(19, 37, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `data_pedido` date NOT NULL,
  `data_entrega` date DEFAULT NULL,
  `id_conta` int(11) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `num_cartao` char(16) DEFAULT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Inserindo dados na tabela `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `data_pedido`, `data_entrega`, `id_conta`, `endereco`, `cidade`, `estado`, `num_cartao`, `total`) VALUES
(17, '2023-05-15', '2023-05-15', 14, 'Rua das Flores, 123, Centro', 'São Paulo', 'Brasil', NULL, 375),
(18, '2023-05-15', '2023-05-15', 20, 'Avenida Paulista, 1500, Bela Vista', 'São Paulo', 'Brasil', NULL, 130),
(19, '2023-05-15', '2023-05-15', 18, 'Rua XV de Novembro, 32A, Centro', 'Curitiba', 'Brasil', '3120246834724793', 380);


-- --------------------------------------------------------

--
-- Estrutura da tabela 'produtos'
--

CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL,
  `produto_nome` varchar(100) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `preco` int(11) NOT NULL,
  `qtdavali` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `marca` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Inserindo dados na tabela `produtos`
--

INSERT INTO produtos (id_produto, produto_nome, categoria, descricao, preco, qtdavali, img, marca) VALUES
(1, 'Tapete de Crochê Sisal', 'Decoração', 'Tapete redondo realizado na técnica de crochê nos fios de sisal natural juta e barbante de algodão cru. Feito à mão. Perfeito para decoração de qualquer ambiente', 350, 14, 'item-1.jpg', 'Encanto Manual'),
(2, 'Cascata Decorativa', 'Decoração', 'Fonte cascata excelente para energizar ambiente.', 145 , 17, 'item-2.jpg', 'Encanto Manual'),
(3, 'Escultura de Madeira', 'Decoração', 'A Escultura "O Pensador" é uma obra de arte magnífica. Muito bem trabalhada e com um visual moderno, ela encanta a todos ao seu redor.', 550, 6, 'item-3.jpg', 'Encanto Manual'),
(4, 'Kit Safari Amigurumi', 'Decoração', 'Kit safari com 4 bichinhos. Perfeito para decoração e brinquedo. Todos feitos com linha 100% algodão, olhos com travas de segurança, e enchimento com fibra siliconada. Todos com aproximadamente 28 a 30 cm sentado.', 390, 8, 'item-4.jpg', 'Encanto Manual'),
(5, 'Peso de porta', 'Decoração', 'Adicione um toque de elegância rústica à sua casa com o Peso de Porta artesanal em concreto da Aleta. Este acessório decorativo, com formato Quadrado/Cubo, é cuidadosamente elaborado para unir funcionalidade e estilo de maneira única. O puxador de corda de sisal não só facilita o manuseio, mas também acrescenta um charme natural e autêntico ao design e uma base aveludada incrível.', 19, 28, 'item-5.jpg', 'Encanto Manual'),
(6, 'Vaso de Resina', 'Decoração', 'Ideal para acomodar plantas naturais ou artificiais, este vaso é uma peça versátil que se encaixa perfeitamente em qualquer espaço, seja na sua casa ou no seu escritório.', 24, 31, 'item-6.jpg', 'Encanto Manual'),
(7, 'Filtro de Barro', 'Decoração', 'Filtro de barro personalizados e pintados à mão . 4 litros, sendo 2 litros na parte inferior e 2 litros na parte superior.', 299, 9, 'item-7.jpg', 'Encanto Manual'),
(8, 'Prateleira de Madeira Rústica', 'Decoração', 'Prateleira de madeira rústica. Uma excelente opção para organizar o seu espaço.', 159, 13, 'item-8.jpg', 'Encanto Manual'),
(9, 'Jogo Americano', 'Decoração', 'Jogo americano com bordado de corais em sarja 100% algodão semi impermeável.', 35, 34, 'item-9.jpg', 'Encanto Manual'),
(10, 'Manta de Sofá', 'Decoração', 'Peça versátil e prática, você pode usar sobre o sofá de várias maneiras. Cru com dourado, ocre e fitas de nylon, essa peça dá destaque e um bonito visual ao seu ambiente.', 340, 28, 'item-10.jpg', 'Encanto Manual'),
(11, 'Tapete de Cozinha', 'Decoração', 'Tecido grosso e de ótima qualidade. Especialmente para você que tem bom gosto e é exigente com sua casa.', 80, 43, 'item-11.jpg', 'Encanto Manual'),
(12, 'Colar de Mesa', 'Decoração', 'Colar de mesa feito com bolas de madeira e tassel de algodão. Peça decorativa que deixará sua salar mais elegante e moderna.', 135 , 64, 'item-12.jpg', 'Encanto Manual'),
(13, 'Pulseira olho de tigre', 'Acessório', 'Olho de Tigre é o líder protetor entre os minerais, tem forte influência em afastar inveja e energias ruins, traz clareza nos pensamentos e paz interior. Ele possui uma forte energia Yang, de ação, que dá força para enfrentar desafios e difíceis decisões.', 29, 13, 'item-13.jpg', 'Encanto Manual'),
(14, 'Pulseira de Miçangas com Grafismo', 'Acessório', 'Pulseira de miçangas, feita a mão, bastante confortável com fecho regulável. As miçangas utilizadas para esses trabalhos são as melhores disponíveis no mercado para artesanatos, são a prova de água e resistentes ao uso diário sem perder a cor.', 45, 19, 'item-14.jpg', 'Encanto Manual'),
(15, 'Pulseira de Macramê', 'Acessório', 'Pulseira de macramê artesanal, confeccionada com fio de alta qualidade e detalhes cuidadosamente trançados para um visual elegante e moderno. Esta peça combina estilo boho com um toque natural, perfeita para complementar qualquer look casual ou sofisticado.', 21, 22, 'item-15.jpg', 'Encanto Manual'),
(16, 'Pulseira Carpe Diem', 'Acessório', 'Pulseira unissex confeccionada em macramê com cordão de alta qualidade e plaquinha metálica "Carpe Diem" -"Aproveite o dia". Pulseira ajustável.', 21, 57, 'item-16.jpg', 'Encanto Manual'),
(17, 'Pulseira de Pedra Halteres', 'Acessório', 'Pulseira masculina confeccionada em fio de nylon especial com pedras onix 6 mm e entremeio halteres', 29, 45, 'item-17.jpg', 'Encanto Manual'),
(18, 'Pulseira de Pedra Onix', 'Acessório', 'Pulseira com pedra natural onix - 6 mm, em fio de silicone fechamento em azeitona onix.', 29, 87, 'item-18.jpg', 'Encanto Manual'),
(19, 'Pulseira de Pedra Jaspe Branca', 'Acessório', 'Pulseira unissex confeccionada em fio de silicone com pedras jaspe picture naturais tamanho 6 mm de diâmetro.', 37, 15, 'item-19.jpg', 'Encanto Manual'),
(20, 'Pulseira de Pedra Jaspe Verde', 'Acessório', 'Pulseira de pedras naturais Jaspe Imperador Verde, confeccionada em fio de nylon resistente, regulável.', 29, 12, 'item-20.jpg', 'Encanto Manual');

-- --------------------------------------------------------

--
-- Estrutura da tabela `reviews`
--

CREATE TABLE `reviews` (
  `id_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `texto_avalia` varchar(1000) DEFAULT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Inserindo dados na tabela `reviews`
--

INSERT INTO `reviews` (`id_pedido`, `id_produto`, `texto_avalia`, `rating`) VALUES
(19, 37, 'teste', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `wishlist`
--

CREATE TABLE `wishlist` (
  `id_conta` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Inserindo dados na tabela `wishlist`
--

INSERT INTO `wishlist` (`id_conta`, `id_produto`) VALUES
(18, 35),
(18, 36);

--
-- Índices para tabela `contas`
--
ALTER TABLE `contas`
  ADD PRIMARY KEY (`id_conta`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `contato` (`contato`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Índices para tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id_conta`,`id_produto`),
  ADD KEY `carrinhofk2` (`id_produto`);

--
-- Índices para tabela `detal_pedidos`
--
ALTER TABLE `detal_pedidos`
  ADD PRIMARY KEY (`id_pedido`,`id_produto`),
  ADD KEY `orderdtfk2` (`id_produto`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `pedidosfk` (`id_conta`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices para tabela `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id_pedido`,`id_produto`),
  ADD KEY `reviewsfk2` (`id_produto`);

--
-- Índices para tabela `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id_conta`,`id_produto`),
  ADD KEY `wishlistfk2` (`id_produto`);

--
-- AUTO_INCREMENT para tabela `contas`
--
ALTER TABLE `contas`
  MODIFY `id_conta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT para tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT para tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Restrições para tabela `carringo`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `carrinhofk1` FOREIGN KEY (`id_conta`) REFERENCES `contas` (`id_conta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carrinhofk2` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabela `detal_pedidos`
--
ALTER TABLE `detal_pedidos`
  ADD CONSTRAINT `orderdtfk1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderdtfk2` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidosfk` FOREIGN KEY (`id_conta`) REFERENCES `contas` (`id_conta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabela `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviewsfk1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviewsfk2` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabela `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlistfk1` FOREIGN KEY (`id_conta`) REFERENCES `contas` (`id_conta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlistfk2` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

-- Configurações de Codificação Restauradas
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
