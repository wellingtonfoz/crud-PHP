CREATE DATABASE crud;
use crud;
--
-- Base de Dados: `crud`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro`
--

CREATE TABLE IF NOT EXISTS `cadastro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(1000) DEFAULT NULL,
  `valor` varchar(255) DEFAULT NULL,
  `descricao` varchar(5000) DEFAULT NULL,
  `complementar` varchar(5000) DEFAULT NULL,
  `ano` varchar(255) DEFAULT NULL,
  `cor` varchar(255) DEFAULT NULL,
  `combustivel` varchar(255) DEFAULT NULL,
  `km` varchar(255) DEFAULT NULL,
  `transmissao` varchar(255) DEFAULT NULL,
  `placa` varchar(255) DEFAULT NULL,
  `itens` varchar(5000) DEFAULT NULL,
  `desativar` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `foto`
--

CREATE TABLE IF NOT EXISTS `foto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fotoPath` varchar(255) NOT NULL,
  `principal` tinyint(1) NOT NULL,
  `cadastro_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_foto_cadastro` (`cadastro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;
