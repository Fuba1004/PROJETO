-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Nov-2022 às 17:55
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `juliana`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrador`
--

CREATE TABLE `administrador` (
  `administradorId` int(11) NOT NULL,
  `administradorNome` varchar(30) NOT NULL,
  `administradorSenha` varchar(30) NOT NULL,
  `administradorEmail` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `administrador`
--

INSERT INTO `administrador` (`administradorId`, `administradorNome`, `administradorSenha`, `administradorEmail`) VALUES
(1, 'Juliano', '654321', 'julianoamasp@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `banners`
--

CREATE TABLE `banners` (
  `bannersId` int(11) NOT NULL,
  `bannersTitulo` varchar(100) NOT NULL,
  `bannersSubTitulo` varchar(100) NOT NULL,
  `bannersParagrafo` text NOT NULL,
  `bannersCapa` varchar(100) NOT NULL,
  `bannersLink` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `banners`
--

INSERT INTO `banners` (`bannersId`, `bannersTitulo`, `bannersSubTitulo`, `bannersParagrafo`, `bannersCapa`, `bannersLink`) VALUES
(1, 'deconto 50%', 'agora 50% de desconto', 'super mega promoção', 'banner-2.jpg', ''),
(2, '', '', '', 'banner-1.jpg', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `breadcrumps`
--

CREATE TABLE `breadcrumps` (
  `breadcrumpsId` int(11) NOT NULL,
  `breadcrumpsTitulo` varchar(100) NOT NULL,
  `breadcrumpsIcone` varchar(100) NOT NULL,
  `breadcrumpsParagrafo` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `breadcrumps`
--

INSERT INTO `breadcrumps` (`breadcrumpsId`, `breadcrumpsTitulo`, `breadcrumpsIcone`, `breadcrumpsParagrafo`) VALUES
(1, 'MODERN DESIGN', 'feature_img_2.png', 'Lorem Ipsum is simply dummy text of the printing and printing industry unknown printer'),
(2, 'FREE SHIPPING', 'feature_img_1.png', 'Lorem Ipsum is simply dummy text of the printing and printing industry unknown printer'),
(3, 'LIVE SUPPORT', 'feature_img_3.png', 'Lorem Ipsum is simply dummy text of the printing and printing industry unknown printer');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `categoriaId` int(11) NOT NULL,
  `categoriaNome` varchar(100) NOT NULL,
  `categoriaDescricao` text NOT NULL,
  `categoriaPermalink` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`categoriaId`, `categoriaNome`, `categoriaDescricao`, `categoriaPermalink`) VALUES
(1, 'Frutas', 'todos os tipos de frutas', 'frutas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `empresaId` int(11) NOT NULL,
  `empresaNome` varchar(300) NOT NULL,
  `empresaLogo` varchar(100) NOT NULL,
  `empresaResumoQuemSomos` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`empresaId`, `empresaNome`, `empresaLogo`, `empresaResumoQuemSomos`) VALUES
(1, 'sooooo', '6366e7a48310a.png', 'Lorem I');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque`
--

CREATE TABLE `estoque` (
  `estoqueId` int(11) NOT NULL,
  `estoqueIdProd` int(11) NOT NULL,
  `estoqueSKU` text NOT NULL,
  `estoqueKiloGrama` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `paginas`
--

CREATE TABLE `paginas` (
  `paginasId` int(11) NOT NULL,
  `paginasNome` varchar(60) NOT NULL,
  `paginasPermalink` varchar(60) NOT NULL,
  `paginasArquivo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `paginas`
--

INSERT INTO `paginas` (`paginasId`, `paginasNome`, `paginasPermalink`, `paginasArquivo`) VALUES
(1, 'Home', 'home', 'home.php'),
(2, 'carrinho', 'carrinho', 'carrinho.php'),
(3, 'login', 'login', 'login.php'),
(4, 'minha conta', 'minhaconta', 'minha-conta.php'),
(5, 'minhas compras', 'minhascompras', 'minhas-compras.php'),
(6, 'produtos', 'produtos', 'produtos.php'),
(7, 'produto', 'produto', 'produto.php'),
(8, 'checkout', 'checkout', 'checkout.php');

-- --------------------------------------------------------

--
-- Estrutura da tabela `painelareas`
--

CREATE TABLE `painelareas` (
  `painelAreasId` int(11) NOT NULL,
  `painelAreasIdParent` int(11) DEFAULT NULL,
  `painelAreasNome` varchar(30) NOT NULL,
  `painelAreasPermalink` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `painelareas`
--

INSERT INTO `painelareas` (`painelAreasId`, `painelAreasIdParent`, `painelAreasNome`, `painelAreasPermalink`) VALUES
(1, NULL, 'DashBoard', 'dashboard'),
(2, NULL, 'Gerenciar Produtos', 'gerenciamento-produtos'),
(3, NULL, 'Gerenciar Acesso', 'gerenciamento-acesso'),
(4, 2, 'Estoque', 'estoque'),
(5, 2, 'Produtos', 'produtos'),
(6, 3, 'Usuários', 'usuarios'),
(8, 2, 'Categorias', 'categorias'),
(9, NULL, 'Site', 'site'),
(10, 9, 'Banners', 'banners'),
(11, 9, 'Empresa', 'empresa'),
(12, 9, 'Parceiros', 'parceiros'),
(13, 9, 'BreadCrumbs', 'breadcrumbs'),
(14, 2, 'Vendas', 'vendas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `parceiros`
--

CREATE TABLE `parceiros` (
  `parceirosId` int(11) NOT NULL,
  `parceirosImagem` varchar(300) NOT NULL,
  `parceirosLink` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `parceiros`
--

INSERT INTO `parceiros` (`parceirosId`, `parceirosImagem`, `parceirosLink`) VALUES
(1, '14.png', ''),
(2, '35.png', ''),
(3, '1.png', ''),
(4, '2.png', ''),
(5, '3.png', ''),
(6, '4.png', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `produtosId` int(11) NOT NULL,
  `produtosNome` varchar(100) NOT NULL,
  `produtosPermalink` varchar(300) NOT NULL,
  `produtosDescricao` text NOT NULL,
  `produtosCapa` varchar(100) NOT NULL,
  `produtosPreco` decimal(10,2) NOT NULL,
  `produtosGramasUni` int(11) NOT NULL,
  `produtosStatus` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `relcatprod`
--

CREATE TABLE `relcatprod` (
  `relCatProdId` int(11) NOT NULL,
  `relCatProdIdCat` int(11) NOT NULL,
  `relCatProdIdProd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tiposvenda`
--

CREATE TABLE `tiposvenda` (
  `tiposVendaId` int(11) NOT NULL,
  `tiposVendaNome` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tiposvenda`
--

INSERT INTO `tiposvenda` (`tiposVendaId`, `tiposVendaNome`) VALUES
(1, 'Vendido'),
(2, 'Recusado'),
(3, 'Aguardando');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `usuarioId` int(11) NOT NULL,
  `usuarioNome` varchar(100) NOT NULL,
  `usuarioSenha` varchar(100) NOT NULL,
  `usuarioEmail` varchar(300) NOT NULL,
  `usuarioRg` varchar(100) NOT NULL,
  `usuarioLogradouro` varchar(300) NOT NULL,
  `usuarioNumero` varchar(30) NOT NULL,
  `usuarioCep` varchar(11) NOT NULL,
  `usuarioCidade` varchar(60) NOT NULL,
  `usuarioEstado` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usuarioId`, `usuarioNome`, `usuarioSenha`, `usuarioEmail`, `usuarioRg`, `usuarioLogradouro`, `usuarioNumero`, `usuarioCep`, `usuarioCidade`, `usuarioEstado`) VALUES
(8, 'a', 's', 'julianoamasp@gmail.com', 's', 's', 's', 's', 's', 's');

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

CREATE TABLE `venda` (
  `vendaId` int(11) NOT NULL,
  `vendaIdEstoqueProduto` int(11) NOT NULL,
  `vendaIdUsuario` int(11) NOT NULL,
  `vendaIdPeso` int(11) NOT NULL,
  `vendaIdPreco` decimal(10,2) NOT NULL,
  `vendaIdTipo` int(11) NOT NULL,
  `vendaIdData` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`administradorId`);

--
-- Índices para tabela `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`bannersId`);

--
-- Índices para tabela `breadcrumps`
--
ALTER TABLE `breadcrumps`
  ADD PRIMARY KEY (`breadcrumpsId`);

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoriaId`);

--
-- Índices para tabela `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`empresaId`);

--
-- Índices para tabela `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`estoqueId`);

--
-- Índices para tabela `paginas`
--
ALTER TABLE `paginas`
  ADD PRIMARY KEY (`paginasId`);

--
-- Índices para tabela `painelareas`
--
ALTER TABLE `painelareas`
  ADD PRIMARY KEY (`painelAreasId`);

--
-- Índices para tabela `parceiros`
--
ALTER TABLE `parceiros`
  ADD PRIMARY KEY (`parceirosId`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`produtosId`);

--
-- Índices para tabela `relcatprod`
--
ALTER TABLE `relcatprod`
  ADD PRIMARY KEY (`relCatProdId`);

--
-- Índices para tabela `tiposvenda`
--
ALTER TABLE `tiposvenda`
  ADD PRIMARY KEY (`tiposVendaId`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuarioId`);

--
-- Índices para tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`vendaId`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administrador`
--
ALTER TABLE `administrador`
  MODIFY `administradorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `banners`
--
ALTER TABLE `banners`
  MODIFY `bannersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `breadcrumps`
--
ALTER TABLE `breadcrumps`
  MODIFY `breadcrumpsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoriaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `empresa`
--
ALTER TABLE `empresa`
  MODIFY `empresaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `estoqueId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `paginas`
--
ALTER TABLE `paginas`
  MODIFY `paginasId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `painelareas`
--
ALTER TABLE `painelareas`
  MODIFY `painelAreasId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `parceiros`
--
ALTER TABLE `parceiros`
  MODIFY `parceirosId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `produtosId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `relcatprod`
--
ALTER TABLE `relcatprod`
  MODIFY `relCatProdId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tiposvenda`
--
ALTER TABLE `tiposvenda`
  MODIFY `tiposVendaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuarioId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `vendaId` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
