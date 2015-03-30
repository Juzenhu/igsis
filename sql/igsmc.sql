-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 30-Mar-2015 às 02:31
-- Versão do servidor: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `igsmc`
--
CREATE DATABASE IF NOT EXISTS `igsmc` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `igsmc`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_alteracao`
--

CREATE TABLE IF NOT EXISTS `ig_alteracao` (
`idAlteracao` int(4) NOT NULL,
  `ig_evento_idEvento` int(6) NOT NULL,
  `protocolo` int(3) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `dataAlteracao` date NOT NULL,
  `assunto` varchar(60) NOT NULL,
  `descricao` longtext NOT NULL,
  `justificativa` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_anexos`
--

CREATE TABLE IF NOT EXISTS `ig_anexos` (
`idAnexos` int(3) NOT NULL,
  `ig_alteracao_idAlteracao` int(4) NOT NULL,
  `ig_evento_idEvento` int(6) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_arquivo`
--

CREATE TABLE IF NOT EXISTS `ig_arquivo` (
`idArquivo` int(4) NOT NULL,
  `ig_evento_idEvento` int(6) NOT NULL,
  `arquivo` varchar(50) NOT NULL,
  `idEvento` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_artes_visuais`
--

CREATE TABLE IF NOT EXISTS `ig_artes_visuais` (
`idArtes` int(4) NOT NULL,
  `ig_evento_idEvento` int(6) NOT NULL,
  `numero` int(2) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `valorTotal` decimal(8,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_cinema`
--

CREATE TABLE IF NOT EXISTS `ig_cinema` (
`idCinema` int(3) NOT NULL,
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
  `elenco` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_comunicacao`
--

CREATE TABLE IF NOT EXISTS `ig_comunicacao` (
`idCom` int(4) NOT NULL,
  `ig_cinema_idCinema` int(3) NOT NULL,
  `ig_spcultura_idSPCultura` int(2) NOT NULL,
  `ig_evento_idEvento` int(6) NOT NULL,
  `subtituloSPCultura` varchar(120) NOT NULL,
  `sinopse` longtext NOT NULL,
  `spcultura_inscricoes` longtext NOT NULL,
  `spcultura_linguagens` int(2) NOT NULL,
  `spcultura_descricao` longtext NOT NULL,
  `spcultura_projeto` varchar(120) NOT NULL,
  `spcultura_projetoId` int(4) NOT NULL,
  `spcultura_tipoProjeto` int(2) NOT NULL,
  `parecerArtistico` longtext NOT NULL,
  `autor` longtext NOT NULL,
  `fichaTecnica` longtext NOT NULL,
  `release` longtext NOT NULL,
  `filme` tinyint(1) NOT NULL,
  `revisado` tinyint(1) NOT NULL,
  `editado` tinyint(1) NOT NULL,
  `site` tinyint(1) NOT NULL,
  `publicacao` tinyint(1) NOT NULL,
  `registroAudio` tinyint(1) NOT NULL,
  `registroFotografia` tinyint(1) NOT NULL,
  `registroVideo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_contratado`
--

CREATE TABLE IF NOT EXISTS `ig_contratado` (
`idContratado` int(4) NOT NULL,
  `ig_evento_idEvento` int(6) NOT NULL,
  `tipoPessoa` varchar(15) DEFAULT NULL,
  `cpfCnpj` varchar(15) DEFAULT NULL,
  `nomeEmpFis` varchar(60) DEFAULT NULL,
  `representante` varchar(60) DEFAULT NULL,
  `rg` varchar(12) DEFAULT NULL,
  `cpfRepresentante` varchar(15) DEFAULT NULL,
  `atividade` varchar(20) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `tel` varchar(15) DEFAULT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  `idValor` decimal(8,0) DEFAULT NULL,
  `banco` varchar(20) DEFAULT NULL,
  `agencia` varchar(8) DEFAULT NULL,
  `conta` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_espaco`
--

CREATE TABLE IF NOT EXISTS `ig_espaco` (
`idEspaco` int(3) NOT NULL,
  `ig_spcultura_idSPCultura` int(2) NOT NULL,
  `ig_instituicao_idInstituicao` int(3) NOT NULL,
  `espaco` varchar(120) NOT NULL,
  `espacoPai` int(3) NOT NULL,
  `idSPCulturaEspaco` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_evento`
--

CREATE TABLE IF NOT EXISTS `ig_evento` (
`idEvento` int(6) NOT NULL,
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
  `numeroProcesso` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_instituicao`
--

CREATE TABLE IF NOT EXISTS `ig_instituicao` (
`idInstituicao` int(3) NOT NULL,
  `ig_usuario_idUsuario` int(3) NOT NULL,
  `instituicao` varchar(60) NOT NULL,
  `instituicaoPai` int(2) NOT NULL,
  `sigla` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_local`
--

CREATE TABLE IF NOT EXISTS `ig_local` (
`idLocal` int(3) NOT NULL,
  `sala` varchar(60) NOT NULL,
  `lotacao` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_log`
--

CREATE TABLE IF NOT EXISTS `ig_log` (
`idLog` int(8) NOT NULL,
  `ig_usuario_idUsuario` int(3) NOT NULL,
  `enderecoIP` int(12) NOT NULL,
  `dataLog` datetime NOT NULL,
  `descricao` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_modalidade`
--

CREATE TABLE IF NOT EXISTS `ig_modalidade` (
`idModalidade` int(2) NOT NULL,
  `modalidade` varchar(60) NOT NULL,
  `financa` tinyint(1) NOT NULL,
  `contratos` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_musica`
--

CREATE TABLE IF NOT EXISTS `ig_musica` (
`idMusica` int(4) NOT NULL,
  `ig_evento_idEvento` int(6) NOT NULL,
  `genero` varchar(60) NOT NULL,
  `venda` tinyint(1) NOT NULL,
  `material` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_ocorrencia`
--

CREATE TABLE IF NOT EXISTS `ig_ocorrencia` (
`idOcorrencia` int(5) NOT NULL,
  `ig_local_idLocal` int(3) NOT NULL,
  `ig_tipo_ocorrencia_idTipoOcorrencia` int(4) NOT NULL,
  `ig_evento_idEvento` int(6) NOT NULL,
  `segunda` tinyint(1) NOT NULL,
  `terca` tinyint(1) NOT NULL,
  `quarta` tinyint(1) NOT NULL,
  `quinta` tinyint(1) NOT NULL,
  `sexta` tinyint(1) NOT NULL,
  `sabado` tinyint(1) NOT NULL,
  `domingo` tinyint(1) NOT NULL,
  `dataInicio` date NOT NULL,
  `dataFinal` date NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFinal` time NOT NULL,
  `timezone` int(3) NOT NULL,
  `diaInteiro` tinyint(1) NOT NULL,
  `diaEspecial` tinyint(1) NOT NULL,
  `libras` tinyint(1) NOT NULL,
  `audiodescricao` tinyint(1) NOT NULL,
  `valorIngresso` decimal(3,0) NOT NULL,
  `retiradaIngresso` int(2) NOT NULL,
  `localOutros` varchar(120) NOT NULL,
  `lotacao` int(7) NOT NULL,
  `reservados` int(4) NOT NULL,
  `duracao` int(4) NOT NULL,
  `precoPopular` decimal(3,0) NOT NULL,
  `frequencia` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_oficinas`
--

CREATE TABLE IF NOT EXISTS `ig_oficinas` (
`idOficinas` int(4) NOT NULL,
  `ig_evento_idEvento` int(6) NOT NULL,
  `certificado` tinyint(1) NOT NULL,
  `vagas` int(3) NOT NULL,
  `publico` longtext NOT NULL,
  `material` longtext NOT NULL,
  `inscricao` varchar(60) NOT NULL,
  `valorHora` varchar(12) NOT NULL,
  `venda` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_pais`
--

CREATE TABLE IF NOT EXISTS `ig_pais` (
`idPais` int(3) NOT NULL,
  `paisNome` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_papelusuario`
--

CREATE TABLE IF NOT EXISTS `ig_papelusuario` (
`idPapelUsuario` int(3) NOT NULL,
  `nomePapelUsuario` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_producao`
--

CREATE TABLE IF NOT EXISTS `ig_producao` (
`idProducao` int(4) NOT NULL,
  `ig_evento_idEvento` int(6) NOT NULL,
  `carros` longtext NOT NULL,
  `equipe` longtext NOT NULL,
  `infraestrutura` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_produtor`
--

CREATE TABLE IF NOT EXISTS `ig_produtor` (
`idProdutor` int(4) NOT NULL,
  `nome` varchar(120) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `idSpCultura` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_programa`
--

CREATE TABLE IF NOT EXISTS `ig_programa` (
`idPrograma` int(2) NOT NULL,
  `programa` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_projeto_especial`
--

CREATE TABLE IF NOT EXISTS `ig_projeto_especial` (
`idProjetoEspecial` int(3) NOT NULL,
  `projetoEspecial` varchar(120) NOT NULL,
  `apresentacao` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_protocolo`
--

CREATE TABLE IF NOT EXISTS `ig_protocolo` (
`idProtocolo` int(6) NOT NULL,
  `ig_evento_idEvento` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_responsavel`
--

CREATE TABLE IF NOT EXISTS `ig_responsavel` (
`idResponsavel` int(4) NOT NULL,
  `ig_spcultura_idSPCultura` int(2) NOT NULL,
  `tipo` int(2) NOT NULL,
  `nomeResponsavel` varchar(120) NOT NULL,
  `emailResponsavel` varchar(60) NOT NULL,
  `telResponsavel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_retirada`
--

CREATE TABLE IF NOT EXISTS `ig_retirada` (
`idRetirada` int(2) NOT NULL,
  `retirada` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_servico`
--

CREATE TABLE IF NOT EXISTS `ig_servico` (
`idServico` int(3) NOT NULL,
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
  `conta` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_spcultura`
--

CREATE TABLE IF NOT EXISTS `ig_spcultura` (
`idSPCultura` int(2) NOT NULL,
  `site` varchar(120) NOT NULL,
  `maisInformacoes` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_status`
--

CREATE TABLE IF NOT EXISTS `ig_status` (
  `ig_evento_idEvento` int(6) NOT NULL,
  `nomeStatus` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_sub_evento`
--

CREATE TABLE IF NOT EXISTS `ig_sub_evento` (
`idSubEvento` int(4) NOT NULL,
  `ig_tipo_ocorrencia_idTipoOcorrencia` int(4) NOT NULL,
  `ig_evento_idEvento` int(6) NOT NULL,
  `titulo` varchar(120) NOT NULL,
  `descricao` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_teatro_danca`
--

CREATE TABLE IF NOT EXISTS `ig_teatro_danca` (
`idTeatro` int(4) NOT NULL,
  `ig_evento_idEvento` int(6) NOT NULL,
  `estreia` tinyint(1) NOT NULL,
  `genero` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_tipo_evento`
--

CREATE TABLE IF NOT EXISTS `ig_tipo_evento` (
`idTipoEvento` int(3) NOT NULL,
  `tipoEvento` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_tipo_ocorrencia`
--

CREATE TABLE IF NOT EXISTS `ig_tipo_ocorrencia` (
`idTipoOcorrencia` int(4) NOT NULL,
  `tipoOcorrencia` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_usuario`
--

CREATE TABLE IF NOT EXISTS `ig_usuario` (
`idUsuario` int(3) NOT NULL,
  `ig_papelusuario_idPapelUsuario` int(3) NOT NULL,
  `senha` varchar(120) NOT NULL,
  `receberNotificacao` tinyint(1) NOT NULL,
  `nomeUsuario` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_valor`
--

CREATE TABLE IF NOT EXISTS `ig_valor` (
  `idValor` int(8) NOT NULL,
  `ig_contratado_idContratado` int(4) NOT NULL,
  `ig_evento_idEvento` int(6) NOT NULL,
  `valor` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ig_alteracao`
--
ALTER TABLE `ig_alteracao`
 ADD PRIMARY KEY (`idAlteracao`), ADD KEY `ig_alteracao_FKIndex1` (`ig_evento_idEvento`);

--
-- Indexes for table `ig_anexos`
--
ALTER TABLE `ig_anexos`
 ADD PRIMARY KEY (`idAnexos`), ADD KEY `ig_anexos_FKIndex1` (`ig_evento_idEvento`), ADD KEY `ig_anexos_FKIndex2` (`ig_alteracao_idAlteracao`);

--
-- Indexes for table `ig_arquivo`
--
ALTER TABLE `ig_arquivo`
 ADD PRIMARY KEY (`idArquivo`), ADD KEY `ig_arquivo_FKIndex1` (`ig_evento_idEvento`);

--
-- Indexes for table `ig_artes_visuais`
--
ALTER TABLE `ig_artes_visuais`
 ADD PRIMARY KEY (`idArtes`), ADD KEY `ig_artes_visuais_FKIndex1` (`ig_evento_idEvento`);

--
-- Indexes for table `ig_cinema`
--
ALTER TABLE `ig_cinema`
 ADD PRIMARY KEY (`idCinema`), ADD KEY `ig_cinema_FKIndex1` (`ig_evento_idEvento`), ADD KEY `ig_cinema_FKIndex2` (`ig_pais_idPais`);

--
-- Indexes for table `ig_comunicacao`
--
ALTER TABLE `ig_comunicacao`
 ADD PRIMARY KEY (`idCom`), ADD KEY `ig_comunicacao _FKIndex1` (`ig_evento_idEvento`), ADD KEY `ig_comunicacao _FKIndex2` (`ig_spcultura_idSPCultura`), ADD KEY `ig_comunicacao _FKIndex3` (`ig_cinema_idCinema`);

--
-- Indexes for table `ig_contratado`
--
ALTER TABLE `ig_contratado`
 ADD PRIMARY KEY (`idContratado`), ADD KEY `ig_contratado_FKIndex1` (`ig_evento_idEvento`);

--
-- Indexes for table `ig_espaco`
--
ALTER TABLE `ig_espaco`
 ADD PRIMARY KEY (`idEspaco`), ADD KEY `ig_espaco_FKIndex1` (`ig_instituicao_idInstituicao`), ADD KEY `ig_espaco_FKIndex2` (`ig_spcultura_idSPCultura`);

--
-- Indexes for table `ig_evento`
--
ALTER TABLE `ig_evento`
 ADD PRIMARY KEY (`idEvento`), ADD KEY `ig_evento_FKIndex1` (`ig_programa_idPrograma`), ADD KEY `ig_evento_FKIndex2` (`ig_tipo_evento_idTipoEvento`), ADD KEY `ig_evento_FKIndex3` (`ig_produtor_idProdutor`);

--
-- Indexes for table `ig_instituicao`
--
ALTER TABLE `ig_instituicao`
 ADD PRIMARY KEY (`idInstituicao`), ADD KEY `ig_instituicao_FKIndex1` (`ig_usuario_idUsuario`);

--
-- Indexes for table `ig_local`
--
ALTER TABLE `ig_local`
 ADD PRIMARY KEY (`idLocal`);

--
-- Indexes for table `ig_log`
--
ALTER TABLE `ig_log`
 ADD PRIMARY KEY (`idLog`), ADD KEY `ig_log_FKIndex1` (`ig_usuario_idUsuario`);

--
-- Indexes for table `ig_modalidade`
--
ALTER TABLE `ig_modalidade`
 ADD PRIMARY KEY (`idModalidade`);

--
-- Indexes for table `ig_musica`
--
ALTER TABLE `ig_musica`
 ADD PRIMARY KEY (`idMusica`), ADD KEY `ig_musica_FKIndex1` (`ig_evento_idEvento`);

--
-- Indexes for table `ig_ocorrencia`
--
ALTER TABLE `ig_ocorrencia`
 ADD PRIMARY KEY (`idOcorrencia`), ADD KEY `ig_ocorrencia_FKIndex1` (`ig_evento_idEvento`), ADD KEY `ig_ocorrencia_FKIndex2` (`ig_tipo_ocorrencia_idTipoOcorrencia`), ADD KEY `ig_ocorrencia_FKIndex3` (`ig_local_idLocal`);

--
-- Indexes for table `ig_oficinas`
--
ALTER TABLE `ig_oficinas`
 ADD PRIMARY KEY (`idOficinas`), ADD KEY `ig_oficinas_FKIndex1` (`ig_evento_idEvento`);

--
-- Indexes for table `ig_pais`
--
ALTER TABLE `ig_pais`
 ADD PRIMARY KEY (`idPais`);

--
-- Indexes for table `ig_papelusuario`
--
ALTER TABLE `ig_papelusuario`
 ADD PRIMARY KEY (`idPapelUsuario`);

--
-- Indexes for table `ig_producao`
--
ALTER TABLE `ig_producao`
 ADD PRIMARY KEY (`idProducao`), ADD KEY `ig_producao_FKIndex1` (`ig_evento_idEvento`);

--
-- Indexes for table `ig_produtor`
--
ALTER TABLE `ig_produtor`
 ADD PRIMARY KEY (`idProdutor`);

--
-- Indexes for table `ig_programa`
--
ALTER TABLE `ig_programa`
 ADD PRIMARY KEY (`idPrograma`);

--
-- Indexes for table `ig_projeto_especial`
--
ALTER TABLE `ig_projeto_especial`
 ADD PRIMARY KEY (`idProjetoEspecial`);

--
-- Indexes for table `ig_protocolo`
--
ALTER TABLE `ig_protocolo`
 ADD PRIMARY KEY (`idProtocolo`), ADD KEY `ig_protocolo_FKIndex1` (`ig_evento_idEvento`);

--
-- Indexes for table `ig_responsavel`
--
ALTER TABLE `ig_responsavel`
 ADD PRIMARY KEY (`idResponsavel`), ADD KEY `ig_responsavel_FKIndex1` (`ig_spcultura_idSPCultura`);

--
-- Indexes for table `ig_retirada`
--
ALTER TABLE `ig_retirada`
 ADD PRIMARY KEY (`idRetirada`);

--
-- Indexes for table `ig_servico`
--
ALTER TABLE `ig_servico`
 ADD PRIMARY KEY (`idServico`), ADD KEY `ig_servico_FKIndex1` (`ig_evento_idEvento`);

--
-- Indexes for table `ig_spcultura`
--
ALTER TABLE `ig_spcultura`
 ADD PRIMARY KEY (`idSPCultura`);

--
-- Indexes for table `ig_status`
--
ALTER TABLE `ig_status`
 ADD KEY `ig_status_FKIndex1` (`ig_evento_idEvento`);

--
-- Indexes for table `ig_sub_evento`
--
ALTER TABLE `ig_sub_evento`
 ADD PRIMARY KEY (`idSubEvento`), ADD KEY `ig_sub_evento_FKIndex1` (`ig_evento_idEvento`), ADD KEY `ig_sub_evento_FKIndex2` (`ig_tipo_ocorrencia_idTipoOcorrencia`);

--
-- Indexes for table `ig_teatro_danca`
--
ALTER TABLE `ig_teatro_danca`
 ADD PRIMARY KEY (`idTeatro`), ADD KEY `ig_teatro_danca_FKIndex1` (`ig_evento_idEvento`);

--
-- Indexes for table `ig_tipo_evento`
--
ALTER TABLE `ig_tipo_evento`
 ADD PRIMARY KEY (`idTipoEvento`);

--
-- Indexes for table `ig_tipo_ocorrencia`
--
ALTER TABLE `ig_tipo_ocorrencia`
 ADD PRIMARY KEY (`idTipoOcorrencia`);

--
-- Indexes for table `ig_usuario`
--
ALTER TABLE `ig_usuario`
 ADD PRIMARY KEY (`idUsuario`), ADD KEY `ig_usuario_FKIndex1` (`ig_papelusuario_idPapelUsuario`);

--
-- Indexes for table `ig_valor`
--
ALTER TABLE `ig_valor`
 ADD PRIMARY KEY (`idValor`), ADD KEY `ig_valor_FKIndex1` (`ig_evento_idEvento`), ADD KEY `ig_valor_FKIndex2` (`ig_contratado_idContratado`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ig_alteracao`
--
ALTER TABLE `ig_alteracao`
MODIFY `idAlteracao` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_anexos`
--
ALTER TABLE `ig_anexos`
MODIFY `idAnexos` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_arquivo`
--
ALTER TABLE `ig_arquivo`
MODIFY `idArquivo` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_artes_visuais`
--
ALTER TABLE `ig_artes_visuais`
MODIFY `idArtes` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_cinema`
--
ALTER TABLE `ig_cinema`
MODIFY `idCinema` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_comunicacao`
--
ALTER TABLE `ig_comunicacao`
MODIFY `idCom` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_contratado`
--
ALTER TABLE `ig_contratado`
MODIFY `idContratado` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_espaco`
--
ALTER TABLE `ig_espaco`
MODIFY `idEspaco` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_evento`
--
ALTER TABLE `ig_evento`
MODIFY `idEvento` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_instituicao`
--
ALTER TABLE `ig_instituicao`
MODIFY `idInstituicao` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_local`
--
ALTER TABLE `ig_local`
MODIFY `idLocal` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_log`
--
ALTER TABLE `ig_log`
MODIFY `idLog` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_modalidade`
--
ALTER TABLE `ig_modalidade`
MODIFY `idModalidade` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_musica`
--
ALTER TABLE `ig_musica`
MODIFY `idMusica` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_ocorrencia`
--
ALTER TABLE `ig_ocorrencia`
MODIFY `idOcorrencia` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_oficinas`
--
ALTER TABLE `ig_oficinas`
MODIFY `idOficinas` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_pais`
--
ALTER TABLE `ig_pais`
MODIFY `idPais` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_papelusuario`
--
ALTER TABLE `ig_papelusuario`
MODIFY `idPapelUsuario` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_producao`
--
ALTER TABLE `ig_producao`
MODIFY `idProducao` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_produtor`
--
ALTER TABLE `ig_produtor`
MODIFY `idProdutor` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_programa`
--
ALTER TABLE `ig_programa`
MODIFY `idPrograma` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_projeto_especial`
--
ALTER TABLE `ig_projeto_especial`
MODIFY `idProjetoEspecial` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_protocolo`
--
ALTER TABLE `ig_protocolo`
MODIFY `idProtocolo` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_responsavel`
--
ALTER TABLE `ig_responsavel`
MODIFY `idResponsavel` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_retirada`
--
ALTER TABLE `ig_retirada`
MODIFY `idRetirada` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_servico`
--
ALTER TABLE `ig_servico`
MODIFY `idServico` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_spcultura`
--
ALTER TABLE `ig_spcultura`
MODIFY `idSPCultura` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_sub_evento`
--
ALTER TABLE `ig_sub_evento`
MODIFY `idSubEvento` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_teatro_danca`
--
ALTER TABLE `ig_teatro_danca`
MODIFY `idTeatro` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_tipo_evento`
--
ALTER TABLE `ig_tipo_evento`
MODIFY `idTipoEvento` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_tipo_ocorrencia`
--
ALTER TABLE `ig_tipo_ocorrencia`
MODIFY `idTipoOcorrencia` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ig_usuario`
--
ALTER TABLE `ig_usuario`
MODIFY `idUsuario` int(3) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
