-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 20-Abr-2015 às 15:02
-- Versão do servidor: 5.5.41
-- versão do PHP: 5.4.39-0+deb7u2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `mydb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_alteracao`
--

CREATE TABLE IF NOT EXISTS `ig_alteracao` (
  `idAlteracao` int(4) NOT NULL AUTO_INCREMENT,
  `ig_evento_idEvento` int(6) NOT NULL,
  `protocolo` int(3) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `dataAlteracao` date NOT NULL,
  `assunto` varchar(60) NOT NULL,
  `descricao` longtext NOT NULL,
  `justificativa` longtext NOT NULL,
  PRIMARY KEY (`idAlteracao`),
  KEY `ig_alteracao_FKIndex1` (`ig_evento_idEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_anexos`
--

CREATE TABLE IF NOT EXISTS `ig_anexos` (
  `idAnexos` int(3) NOT NULL AUTO_INCREMENT,
  `ig_alteracao_idAlteracao` int(4) NOT NULL,
  `ig_evento_idEvento` int(6) NOT NULL,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`idAnexos`),
  KEY `ig_anexos_FKIndex1` (`ig_evento_idEvento`),
  KEY `ig_anexos_FKIndex2` (`ig_alteracao_idAlteracao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_arquivo`
--

CREATE TABLE IF NOT EXISTS `ig_arquivo` (
  `idArquivo` int(4) NOT NULL AUTO_INCREMENT,
  `ig_evento_idEvento` int(6) NOT NULL,
  `arquivo` varchar(50) NOT NULL,
  `idEvento` int(6) NOT NULL,
  PRIMARY KEY (`idArquivo`),
  KEY `ig_arquivo_FKIndex1` (`ig_evento_idEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_artes_visuais`
--

CREATE TABLE IF NOT EXISTS `ig_artes_visuais` (
  `idArtes` int(4) NOT NULL AUTO_INCREMENT,
  `ig_evento_idEvento` int(6) NOT NULL,
  `numero` int(2) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `valorTotal` decimal(8,0) NOT NULL,
  PRIMARY KEY (`idArtes`),
  KEY `ig_artes_visuais_FKIndex1` (`ig_evento_idEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_cinema`
--

CREATE TABLE IF NOT EXISTS `ig_cinema` (
  `idCinema` int(3) NOT NULL AUTO_INCREMENT,
  `ig_pais_idPais` int(3) NOT NULL,
  `ig_evento_idEvento` int(6) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `tituloOriginal` varchar(100) NOT NULL,
  `anoProducao` int(4) NOT NULL,
  `genero` varchar(20) NOT NULL,
  `bitola` varchar(30) NOT NULL,
  `direcao` longtext NOT NULL,
  `sinopse` longtext NOT NULL,
  `minutagem` int(3) NOT NULL,
  `linkTrailer` varchar(60) NOT NULL,
  `elenco` longtext NOT NULL,
  PRIMARY KEY (`idCinema`),
  KEY `ig_cinema_FKIndex1` (`ig_evento_idEvento`),
  KEY `ig_cinema_FKIndex2` (`ig_pais_idPais`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_espaco`
--

CREATE TABLE IF NOT EXISTS `ig_espaco` (
  `idEspaco` int(3) NOT NULL AUTO_INCREMENT,
  `ig_spcultura_idSPCultura` int(2) NOT NULL,
  `ig_instituicao_idInstituicao` int(3) NOT NULL,
  `espaco` varchar(120) NOT NULL,
  `espacoPai` int(3) NOT NULL,
  `idSPCulturaEspaco` int(6) NOT NULL,
  PRIMARY KEY (`idEspaco`),
  KEY `ig_espaco_FKIndex1` (`ig_instituicao_idInstituicao`),
  KEY `ig_espaco_FKIndex2` (`ig_spcultura_idSPCultura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_evento`
--

CREATE TABLE IF NOT EXISTS `ig_evento` (
  `idEvento` int(6) NOT NULL AUTO_INCREMENT,
  `ig_produtor_idProdutor` int(4) NOT NULL,
  `ig_tipo_evento_idTipoEvento` int(3) NOT NULL,
  `ig_programa_idPrograma` int(2) NOT NULL,
  `projetoEspecial` int(3) NOT NULL,
  `nomeEvento` varchar(240) NOT NULL,
  `projeto` varchar(120) DEFAULT NULL,
  `memorando` varchar(20) DEFAULT NULL,
  `idResponsavel` int(4) NOT NULL,
  `suplente` int(4) NOT NULL,
  `autor` longtext NOT NULL,
  `fichaTecnica` longtext NOT NULL,
  `faixaEtaria` varchar(12) NOT NULL,
  `sinopse` longtext NOT NULL,
  `release` longtext NOT NULL,
  `parecerArtistico` longtext NOT NULL,
  `confirmaFinanca` tinyint(1) DEFAULT NULL,
  `confirmaDiretoria` tinyint(1) DEFAULT NULL,
  `confirmaComunicacao` tinyint(1) DEFAULT NULL,
  `confirmaDocumentacao` tinyint(1) DEFAULT NULL,
  `confirmaProducao` tinyint(1) DEFAULT NULL,
  `justificativaCuradoria` longtext,
  `justificativaDiretoria` longtext,
  `justificativaComunicacao` longtext,
  `justificativaDocumentacao` longtext,
  `justificativaProducao` longtext,
  `numeroProcesso` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idEvento`),
  KEY `ig_evento_FKIndex1` (`ig_programa_idPrograma`),
  KEY `ig_evento_FKIndex2` (`ig_tipo_evento_idTipoEvento`),
  KEY `ig_evento_FKIndex3` (`ig_produtor_idProdutor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_instituicao`
--

CREATE TABLE IF NOT EXISTS `ig_instituicao` (
  `idInstituicao` int(3) NOT NULL AUTO_INCREMENT,
  `nomeInstituicao` varchar(60) NOT NULL,
  `instituicaoPai` int(2) NOT NULL,
  `sigla` varchar(12) NOT NULL,
  PRIMARY KEY (`idInstituicao`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `ig_instituicao`
--

INSERT INTO `ig_instituicao` (`idInstituicao`, `nomeInstituicao`, `instituicaoPai`, `sigla`) VALUES
(1, 'Centro Cultural São Paulo', 0, 'CCSP');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_local`
--

CREATE TABLE IF NOT EXISTS `ig_local` (
  `idLocal` int(3) NOT NULL AUTO_INCREMENT,
  `sala` varchar(60) NOT NULL,
  `lotacao` int(4) NOT NULL,
  PRIMARY KEY (`idLocal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_log`
--

CREATE TABLE IF NOT EXISTS `ig_log` (
  `idLog` int(8) NOT NULL AUTO_INCREMENT,
  `ig_usuario_idUsuario` int(3) NOT NULL,
  `enderecoIP` int(12) NOT NULL,
  `dataLog` datetime NOT NULL,
  `descricao` longtext NOT NULL,
  PRIMARY KEY (`idLog`),
  KEY `ig_log_FKIndex1` (`ig_usuario_idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_modalidade`
--

CREATE TABLE IF NOT EXISTS `ig_modalidade` (
  `idModalidade` int(2) NOT NULL AUTO_INCREMENT,
  `modalidade` varchar(60) NOT NULL,
  `financa` tinyint(1) NOT NULL,
  `contratos` tinyint(1) NOT NULL,
  PRIMARY KEY (`idModalidade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_musica`
--

CREATE TABLE IF NOT EXISTS `ig_musica` (
  `idMusica` int(4) NOT NULL AUTO_INCREMENT,
  `ig_evento_idEvento` int(6) NOT NULL,
  `genero` varchar(60) NOT NULL,
  `venda` tinyint(1) NOT NULL,
  `material` longtext NOT NULL,
  PRIMARY KEY (`idMusica`),
  KEY `ig_musica_FKIndex1` (`ig_evento_idEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_oficinas`
--

CREATE TABLE IF NOT EXISTS `ig_oficinas` (
  `idOficinas` int(4) NOT NULL AUTO_INCREMENT,
  `ig_evento_idEvento` int(6) NOT NULL,
  `certificado` tinyint(1) NOT NULL,
  `vagas` int(3) NOT NULL,
  `publico` longtext NOT NULL,
  `material` longtext NOT NULL,
  `inscricao` varchar(60) NOT NULL,
  `valorHora` varchar(12) NOT NULL,
  `venda` tinyint(1) NOT NULL,
  PRIMARY KEY (`idOficinas`),
  KEY `ig_oficinas_FKIndex1` (`ig_evento_idEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_pais`
--

CREATE TABLE IF NOT EXISTS `ig_pais` (
  `idPais` int(3) NOT NULL AUTO_INCREMENT,
  `paisNome` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idPais`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_papelusuario`
--

CREATE TABLE IF NOT EXISTS `ig_papelusuario` (
  `idPapelUsuario` int(3) NOT NULL AUTO_INCREMENT,
  `nomePapelUsuario` varchar(60) NOT NULL,
  `include` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPapelUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `ig_papelusuario`
--

INSERT INTO `ig_papelusuario` (`idPapelUsuario`, `nomePapelUsuario`, `include`) VALUES
(1, 'Administrador de Sistema', 'admin.php'),
(2, 'Comunicação', 'comunicacao.php');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_producao`
--

CREATE TABLE IF NOT EXISTS `ig_producao` (
  `idProducao` int(4) NOT NULL AUTO_INCREMENT,
  `ig_evento_idEvento` int(6) NOT NULL,
  `carros` longtext NOT NULL,
  `equipe` longtext NOT NULL,
  `infraestrutura` longtext NOT NULL,
  PRIMARY KEY (`idProducao`),
  KEY `ig_producao_FKIndex1` (`ig_evento_idEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_produtor`
--

CREATE TABLE IF NOT EXISTS `ig_produtor` (
  `idProdutor` int(4) NOT NULL AUTO_INCREMENT,
  `nome` varchar(120) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `idSpCultura` int(6) NOT NULL,
  PRIMARY KEY (`idProdutor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_programa`
--

CREATE TABLE IF NOT EXISTS `ig_programa` (
  `idPrograma` int(2) NOT NULL AUTO_INCREMENT,
  `programa` varchar(120) NOT NULL,
  PRIMARY KEY (`idPrograma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_projeto_especial`
--

CREATE TABLE IF NOT EXISTS `ig_projeto_especial` (
  `idProjetoEspecial` int(3) NOT NULL AUTO_INCREMENT,
  `projetoEspecial` varchar(120) NOT NULL,
  `apresentacao` longtext NOT NULL,
  PRIMARY KEY (`idProjetoEspecial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_protocolo`
--

CREATE TABLE IF NOT EXISTS `ig_protocolo` (
  `idProtocolo` int(6) NOT NULL AUTO_INCREMENT,
  `ig_evento_idEvento` int(6) NOT NULL,
  PRIMARY KEY (`idProtocolo`),
  KEY `ig_protocolo_FKIndex1` (`ig_evento_idEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_responsavel`
--

CREATE TABLE IF NOT EXISTS `ig_responsavel` (
  `idResponsavel` int(4) NOT NULL AUTO_INCREMENT,
  `ig_spcultura_idSPCultura` int(2) NOT NULL,
  `tipo` int(2) NOT NULL,
  `nomeResponsavel` varchar(120) NOT NULL,
  `emailResponsavel` varchar(60) NOT NULL,
  `telResponsavel` varchar(20) NOT NULL,
  PRIMARY KEY (`idResponsavel`),
  KEY `ig_responsavel_FKIndex1` (`ig_spcultura_idSPCultura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_retirada`
--

CREATE TABLE IF NOT EXISTS `ig_retirada` (
  `idRetirada` int(2) NOT NULL AUTO_INCREMENT,
  `retirada` varchar(120) NOT NULL,
  PRIMARY KEY (`idRetirada`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_servico`
--

CREATE TABLE IF NOT EXISTS `ig_servico` (
  `idServico` int(3) NOT NULL AUTO_INCREMENT,
  `ig_evento_idEvento` int(6) NOT NULL,
  `legenda` varchar(60) DEFAULT NULL,
  `traducao` varchar(60) DEFAULT NULL,
  `graficos` varchar(60) DEFAULT NULL,
  `passagens` varchar(60) DEFAULT NULL,
  `itinerario` longtext,
  `libras` varchar(60) DEFAULT NULL,
  `audiodescricao` varchar(60) DEFAULT NULL,
  `montagem` varchar(60) DEFAULT NULL,
  `hospedagem` longtext,
  `seguro` varchar(60) DEFAULT NULL,
  `transporte` varchar(60) DEFAULT NULL,
  `razaoSocial` varchar(120) DEFAULT NULL,
  `cpfCnpj` varchar(12) DEFAULT NULL,
  `banco` varchar(24) DEFAULT NULL,
  `agencia` varchar(12) DEFAULT NULL,
  `conta` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`idServico`),
  KEY `ig_servico_FKIndex1` (`ig_evento_idEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_spcultura`
--

CREATE TABLE IF NOT EXISTS `ig_spcultura` (
  `idSPCultura` int(2) NOT NULL AUTO_INCREMENT,
  `site` varchar(120) NOT NULL,
  `maisInformacoes` varchar(120) NOT NULL,
  PRIMARY KEY (`idSPCultura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_status`
--

CREATE TABLE IF NOT EXISTS `ig_status` (
  `ig_evento_idEvento` int(6) NOT NULL,
  `nomeStatus` varchar(12) NOT NULL,
  KEY `ig_status_FKIndex1` (`ig_evento_idEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_sub_evento`
--

CREATE TABLE IF NOT EXISTS `ig_sub_evento` (
  `idSubEvento` int(4) NOT NULL AUTO_INCREMENT,
  `ig_tipo_ocorrencia_idTipoOcorrencia` int(4) NOT NULL,
  `ig_evento_idEvento` int(6) NOT NULL,
  `titulo` varchar(120) NOT NULL,
  `descricao` longtext NOT NULL,
  PRIMARY KEY (`idSubEvento`),
  KEY `ig_sub_evento_FKIndex1` (`ig_evento_idEvento`),
  KEY `ig_sub_evento_FKIndex2` (`ig_tipo_ocorrencia_idTipoOcorrencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_teatro_danca`
--

CREATE TABLE IF NOT EXISTS `ig_teatro_danca` (
  `idTeatro` int(4) NOT NULL AUTO_INCREMENT,
  `ig_evento_idEvento` int(6) NOT NULL,
  `estreia` tinyint(1) NOT NULL,
  `genero` varchar(60) NOT NULL,
  PRIMARY KEY (`idTeatro`),
  KEY `ig_teatro_danca_FKIndex1` (`ig_evento_idEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_tipo_evento`
--

CREATE TABLE IF NOT EXISTS `ig_tipo_evento` (
  `idTipoEvento` int(3) NOT NULL AUTO_INCREMENT,
  `tipoEvento` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`idTipoEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_tipo_ocorrencia`
--

CREATE TABLE IF NOT EXISTS `ig_tipo_ocorrencia` (
  `idTipoOcorrencia` int(4) NOT NULL AUTO_INCREMENT,
  `tipoOcorrencia` varchar(60) NOT NULL,
  PRIMARY KEY (`idTipoOcorrencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_usuario`
--

CREATE TABLE IF NOT EXISTS `ig_usuario` (
  `idUsuario` int(3) NOT NULL AUTO_INCREMENT,
  `senha` varchar(120) NOT NULL,
  `receberNotificacao` tinyint(1) NOT NULL,
  `nomeUsuario` varchar(60) NOT NULL,
  `nome` varchar(120) DEFAULT NULL,
  `instituicao` int(3) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `idPapelUsuario` int(2) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `instituicao` (`instituicao`),
  KEY `idPapelUsuario` (`idPapelUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `ig_usuario`
--

INSERT INTO `ig_usuario` (`idUsuario`, `senha`, `receberNotificacao`, `nomeUsuario`, `nome`, `instituicao`, `email`, `idPapelUsuario`) VALUES
(1, 'e44313433d93ce4d00143f4773be2dfc', 1, 'marcioyonamine', 'Marcio Yonamine', 1, 'marcioyonamine@gmail.com', 1);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `ig_usuario`
--
ALTER TABLE `ig_usuario`
  ADD CONSTRAINT `ig_usuario_ibfk_1` FOREIGN KEY (`idPapelUsuario`) REFERENCES `ig_papelusuario` (`idPapelUsuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
