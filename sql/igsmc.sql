-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 25-Maio-2015 às 19:46
-- Versão do servidor: 5.5.43
-- versão do PHP: 5.4.39-0+deb7u2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `igsmc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_alteracao`
--

DROP TABLE IF EXISTS `ig_alteracao`;
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

DROP TABLE IF EXISTS `ig_anexos`;
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

DROP TABLE IF EXISTS `ig_arquivo`;
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
-- Estrutura da tabela `ig_cinema`
--

DROP TABLE IF EXISTS `ig_cinema`;
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
-- Estrutura da tabela `ig_comunicacao`
--

DROP TABLE IF EXISTS `ig_comunicacao`;
CREATE TABLE IF NOT EXISTS `ig_comunicacao` (
  `idCom` int(8) NOT NULL AUTO_INCREMENT,
  `subtituloSPCultura` varchar(120) NOT NULL,
  `ig_ocorrencia_idOcorrencia` int (8) DEFAULT NULL,
  `sinopse` longtext,
  `spcultura_inscricoes` longtext,
  `spcultura_linguagem` int(2) DEFAULT NULL,
  `spcultura_descricao` longtext,
  `spcultura_projeto` varchar(120) DEFAULT NULL,
  `spcultura_projetoId` int(4) DEFAULT NULL,
  `spcultura_tipoProjeto` int(2) DEFAULT NULL,
  `parecerArtisico` longtext,
  `fichaTecnica` longtext,
  `autor` longtext,
  `releasecom` longtext,
  `filme` int(1) DEFAULT NULL,
  `revisado` int(1) DEFAULT NULL,
  `editado` int(1) DEFAULT NULL,
  `site` int(1) DEFAULT NULL,
  `publicacao` int(1) DEFAULT NULL,
  `registroAudio` int(1) DEFAULT NULL,
  `registroVideo` int(1) DEFAULT NULL,
  `registroFotografia` int(1) DEFAULT NULL,
  PRIMARY KEY (`idCom`),
    KEY `ig_comunicao_FKIndex1` (`ig_ocorrencia_idOcorrencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_espaco`
--

DROP TABLE IF EXISTS `ig_espaco`;
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

DROP TABLE IF EXISTS `ig_evento`;
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

DROP TABLE IF EXISTS `ig_instituicao`;
CREATE TABLE IF NOT EXISTS `ig_instituicao` (
  `idInstituicao` int(3) NOT NULL AUTO_INCREMENT,
  `ig_usuario_idUsuario` int(3) NOT NULL,
  `instituicao` varchar(60) NOT NULL,
  `instituicaoPai` int(2) NOT NULL,
  `sigla` varchar(12) NOT NULL,
  PRIMARY KEY (`idInstituicao`),
  KEY `ig_instituicao_FKIndex1` (`ig_usuario_idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_local`
--

DROP TABLE IF EXISTS `ig_local`;
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

DROP TABLE IF EXISTS `ig_log`;
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

DROP TABLE IF EXISTS `ig_modalidade`;
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

DROP TABLE IF EXISTS `ig_musica`;
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
-- Estrutura da tabela `ig_ocorrencia`
--

DROP TABLE IF EXISTS `ig_ocorrencia`;
CREATE TABLE IF NOT EXISTS `ig_ocorrencia` (
  `idOcorrencia` int(8) NOT NULL AUTO_INCREMENT,
  `idTipoOcorrencia` int(8) DEFAULT NULL,
  `ig_comunicao_idCom` int (8) DEFAULT NULL,
  `local` int(3) DEFAULT NULL,
  `idEvento` int(6) DEFAULT NULL,
  `segunda` int(1) DEFAULT NULL,
  `terca` int(1) DEFAULT NULL,
  `quarta` int(1) DEFAULT NULL,
  `quinta` int(1) DEFAULT NULL,
  `sexta` int(1) DEFAULT NULL,
  `sabado` int(1) DEFAULT NULL,
  `domingo` int(1) DEFAULT NULL,
  `dataInicio` date DEFAULT NULL,
  `dataFinal` date DEFAULT NULL,
  `horaInicio` time DEFAULT NULL,
  `horaFinal` time DEFAULT NULL,
  `timezone` int(3) DEFAULT NULL,
  `diaInteiro` int(1) DEFAULT NULL,
  `diaEspecial` int(1) DEFAULT NULL,
  `libras` int(1) DEFAULT NULL,
  `audiodescricao` int(1) DEFAULT NULL,
  `valorIngresso` decimal(10,2) DEFAULT NULL,
  `retiradaIngresso` int(2) DEFAULT NULL,
  `localOutros` varchar(120) DEFAULT NULL,
  `lotacao` int(7) DEFAULT NULL,
  `reservados` int(4) DEFAULT NULL,
  `duracao` int(4) DEFAULT NULL,
  `precoPopular` decimal(10,2) DEFAULT NULL,
  `frequencia` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`idOcorrencia`),
   KEY `ig_ocorrencia_FKIndex1` (`ig_comunicao_idCom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_pais`
--

DROP TABLE IF EXISTS `ig_pais`;
CREATE TABLE IF NOT EXISTS `ig_pais` (
  `idPais` int(3) NOT NULL AUTO_INCREMENT,
  `paisNome` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idPais`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_papelusuario`
--

DROP TABLE IF EXISTS `ig_papelusuario`;
CREATE TABLE IF NOT EXISTS `ig_papelusuario` (
  `idPapelUsuario` int(3) NOT NULL AUTO_INCREMENT,
  `nomePapelUsuario` varchar(60) NOT NULL,
  PRIMARY KEY (`idPapelUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_producao`
--

DROP TABLE IF EXISTS `ig_producao`;
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

DROP TABLE IF EXISTS `ig_produtor`;
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

DROP TABLE IF EXISTS `ig_programa`;
CREATE TABLE IF NOT EXISTS `ig_programa` (
  `idPrograma` int(2) NOT NULL AUTO_INCREMENT,
  `programa` varchar(120) NOT NULL,
  PRIMARY KEY (`idPrograma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_projeto_especial`
--

DROP TABLE IF EXISTS `ig_projeto_especial`;
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

DROP TABLE IF EXISTS `ig_protocolo`;
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

DROP TABLE IF EXISTS `ig_responsavel`;
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

DROP TABLE IF EXISTS `ig_retirada`;
CREATE TABLE IF NOT EXISTS `ig_retirada` (
  `idRetirada` int(2) NOT NULL AUTO_INCREMENT,
  `retirada` varchar(120) NOT NULL,
  PRIMARY KEY (`idRetirada`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_servico`
--

DROP TABLE IF EXISTS `ig_servico`;
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

DROP TABLE IF EXISTS `ig_spcultura`;
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

DROP TABLE IF EXISTS `ig_status`;
CREATE TABLE IF NOT EXISTS `ig_status` (
  `ig_evento_idEvento` int(6) NOT NULL,
  `nomeStatus` varchar(12) NOT NULL,
  KEY `ig_status_FKIndex1` (`ig_evento_idEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_sub_evento`
--

DROP TABLE IF EXISTS `ig_sub_evento`;
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

DROP TABLE IF EXISTS `ig_teatro_danca`;
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

DROP TABLE IF EXISTS `ig_tipo_evento`;
CREATE TABLE IF NOT EXISTS `ig_tipo_evento` (
  `idTipoEvento` int(3) NOT NULL AUTO_INCREMENT,
  `tipoEvento` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`idTipoEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_tipo_ocorrencia`
--

DROP TABLE IF EXISTS `ig_tipo_ocorrencia`;
CREATE TABLE IF NOT EXISTS `ig_tipo_ocorrencia` (
  `idTipoOcorrencia` int(4) NOT NULL AUTO_INCREMENT,
  `tipoOcorrencia` varchar(60) NOT NULL,
  PRIMARY KEY (`idTipoOcorrencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_usuario`
--

DROP TABLE IF EXISTS `ig_usuario`;
CREATE TABLE IF NOT EXISTS `ig_usuario` (
  `idUsuario` int(3) NOT NULL AUTO_INCREMENT,
  `ig_papelusuario_idPapelUsuario` int(3) NOT NULL,
  `senha` varchar(120) NOT NULL,
  `receberNotificacao` tinyint(1) NOT NULL,
  `nomeUsuario` varchar(60) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `ig_usuario_FKIndex1` (`ig_papelusuario_idPapelUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `ig_alteracao`
--
ALTER TABLE `ig_alteracao`
  ADD CONSTRAINT `fk_{F4B41A4D-A75E-4B4F-B291-3E196EE08469}` FOREIGN KEY (`ig_evento_idEvento`) REFERENCES `ig_evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ig_anexos`
--
ALTER TABLE `ig_anexos`
  ADD CONSTRAINT `fk_{A0BA7468-62E8-4D1D-8857-22784B101B5D}` FOREIGN KEY (`ig_evento_idEvento`) REFERENCES `ig_evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_{BC876EDC-82DE-47D0-89D9-A9618CA3BECC}` FOREIGN KEY (`ig_alteracao_idAlteracao`) REFERENCES `ig_alteracao` (`idAlteracao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ig_arquivo`
--
ALTER TABLE `ig_arquivo`
  ADD CONSTRAINT `fk_{79A43DE5-3D61-434A-BAEC-9A60B9D86D16}` FOREIGN KEY (`ig_evento_idEvento`) REFERENCES `ig_evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ig_cinema`
--
ALTER TABLE `ig_cinema`
  ADD CONSTRAINT `fk_{4348B620-C453-4402-83EE-2AE4DCC4A344}` FOREIGN KEY (`ig_pais_idPais`) REFERENCES `ig_pais` (`idPais`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_{4FFA8281-C47F-4D9C-A314-80B438F85275}` FOREIGN KEY (`ig_evento_idEvento`) REFERENCES `ig_evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ig_espaco`
--
ALTER TABLE `ig_espaco`
  ADD CONSTRAINT `fk_{0447B5F0-C66F-4A99-84AA-472F6D1D97E3}` FOREIGN KEY (`ig_spcultura_idSPCultura`) REFERENCES `ig_spcultura` (`idSPCultura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_{FC12B553-6C47-4EF7-B196-49F4EC540BEA}` FOREIGN KEY (`ig_instituicao_idInstituicao`) REFERENCES `ig_instituicao` (`idInstituicao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ig_evento`
--
ALTER TABLE `ig_evento`
  ADD CONSTRAINT `fk_{0610A49A-4711-4927-A4E3-513663464036}` FOREIGN KEY (`ig_produtor_idProdutor`) REFERENCES `ig_produtor` (`idProdutor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_{279F7050-B4D7-463F-8D21-690DB7F3FD17}` FOREIGN KEY (`ig_tipo_evento_idTipoEvento`) REFERENCES `ig_tipo_evento` (`idTipoEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_{F58EFFD3-7038-4FA4-A13F-2CC655475B58}` FOREIGN KEY (`ig_programa_idPrograma`) REFERENCES `ig_programa` (`idPrograma`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ig_instituicao`
--
ALTER TABLE `ig_instituicao`
  ADD CONSTRAINT `fk_{EBBC2C11-1B9C-436C-97CC-6AD8A75CAB5E}` FOREIGN KEY (`ig_usuario_idUsuario`) REFERENCES `ig_usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ig_log`
--
ALTER TABLE `ig_log`
  ADD CONSTRAINT `fk_{E062B9E4-E44A-4C2C-94D4-052FE04DB721}` FOREIGN KEY (`ig_usuario_idUsuario`) REFERENCES `ig_usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ig_musica`
--
ALTER TABLE `ig_musica`
  ADD CONSTRAINT `fk_{F67D3205-E0B0-42E3-A800-B15585C351C6}` FOREIGN KEY (`ig_evento_idEvento`) REFERENCES `ig_evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ig_producao`
--
ALTER TABLE `ig_producao`
  ADD CONSTRAINT `fk_{A21FE65D-9B78-489F-AC84-A970111E6351}` FOREIGN KEY (`ig_evento_idEvento`) REFERENCES `ig_evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ig_protocolo`
--
ALTER TABLE `ig_protocolo`
  ADD CONSTRAINT `fk_{4EFEDB61-453C-4F3F-B985-F15FEDD987FE}` FOREIGN KEY (`ig_evento_idEvento`) REFERENCES `ig_evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ig_responsavel`
--
ALTER TABLE `ig_responsavel`
  ADD CONSTRAINT `fk_{546BF90B-300B-41DD-9D64-761D6F2A7315}` FOREIGN KEY (`ig_spcultura_idSPCultura`) REFERENCES `ig_spcultura` (`idSPCultura`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ig_servico`
--
ALTER TABLE `ig_servico`
  ADD CONSTRAINT `fk_{394B952E-8AB1-42C8-B375-C0D33E589D96}` FOREIGN KEY (`ig_evento_idEvento`) REFERENCES `ig_evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ig_status`
--
ALTER TABLE `ig_status`
  ADD CONSTRAINT `fk_{EF836E01-763F-4D16-BE2E-61495590A941}` FOREIGN KEY (`ig_evento_idEvento`) REFERENCES `ig_evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ig_sub_evento`
--
ALTER TABLE `ig_sub_evento`
  ADD CONSTRAINT `fk_{35671BFF-213D-4D51-BC95-80B2EFCA3F67}` FOREIGN KEY (`ig_tipo_ocorrencia_idTipoOcorrencia`) REFERENCES `ig_tipo_ocorrencia` (`idTipoOcorrencia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_{DBEE11FE-0E7C-4221-A038-944E339816B1}` FOREIGN KEY (`ig_evento_idEvento`) REFERENCES `ig_evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ig_teatro_danca`
--
ALTER TABLE `ig_teatro_danca`
  ADD CONSTRAINT `fk_{64CC3230-DE9D-4674-A6A5-F1B87A12D87D}` FOREIGN KEY (`ig_evento_idEvento`) REFERENCES `ig_evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ig_usuario`
--
ALTER TABLE `ig_usuario`
  ADD CONSTRAINT `fk_{3BA448DE-8129-4EC5-9992-CDCF1EC3F713}` FOREIGN KEY (`ig_papelusuario_idPapelUsuario`) REFERENCES `ig_papelusuario` (`idPapelUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
