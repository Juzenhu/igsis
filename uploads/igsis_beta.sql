-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jun 01, 2015 as 03:52 PM
-- Versão do Servidor: 5.1.73
-- Versão do PHP: 5.4.39-1+deb.sury.org~lucid+2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `igsis_beta`
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

--
-- Extraindo dados da tabela `ig_alteracao`
--


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

--
-- Extraindo dados da tabela `ig_anexos`
--


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

--
-- Extraindo dados da tabela `ig_arquivo`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_artes_visuais`
--

DROP TABLE IF EXISTS `ig_artes_visuais`;
CREATE TABLE IF NOT EXISTS `ig_artes_visuais` (
  `idArtes` int(4) NOT NULL AUTO_INCREMENT,
  `idEvento` int(6) NOT NULL,
  `numero` int(2) DEFAULT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `valorTotal` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`idArtes`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `ig_artes_visuais`
--


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
  UNIQUE KEY `ig_cinema_FKIndex2` (`ig_pais_idPais`),
  KEY `ig_cinema_FKIndex1` (`ig_evento_idEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `ig_cinema`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_comunicacao`
--

DROP TABLE IF EXISTS `ig_comunicacao`;
CREATE TABLE IF NOT EXISTS `ig_comunicacao` (
  `idCom` int(8) NOT NULL AUTO_INCREMENT,
  `subtituloSPCultura` varchar(120) NOT NULL,
  `ig_ocorrencia_idOcorrencia` int(8) DEFAULT NULL,
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

--
-- Extraindo dados da tabela `ig_comunicacao`
--


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
  KEY `ig_espaco_FKIndex1` (`ig_instituicao_idInstituicao`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=41 ;

--
-- Extraindo dados da tabela `ig_espaco`
--

INSERT INTO `ig_espaco` (`idEspaco`, `ig_spcultura_idSPCultura`, `ig_instituicao_idInstituicao`, `espaco`, `espacoPai`, `idSPCulturaEspaco`) VALUES
(1, 0, 5, 'Sala Adoniran Barbosa', 0, 0),
(2, 0, 5, 'Sala Paulo Emilio Salles Gomes', 0, 0),
(3, 0, 5, 'Espaço Cênico Ademar Guerra', 0, 0),
(4, 0, 5, 'Sala Lima Barreto', 0, 0),
(5, 0, 5, 'Sala Tarsila do Amaral', 0, 0),
(6, 0, 5, 'Sala Jardel Filho', 0, 0),
(7, 0, 5, 'Sala de Debates', 0, 0),
(8, 0, 5, 'Espaço Mário Chamie (Praça das Bibliotecas)', 0, 0),
(9, 0, 5, 'Piso Caio Graco', 0, 0),
(10, 0, 5, 'Sala de Ensaio', 0, 0),
(11, 0, 5, 'Sala de Leitura Infanto-Juvenil', 0, 0),
(12, 0, 5, 'Piso Flávio de Carvalho', 0, 0),
(13, 0, 5, 'Área de Convivência', 0, 0),
(14, 0, 5, 'Espaço Flavio Império (Foyer)', 0, 0),
(15, 0, 5, 'Anexo Adoniran', 0, 0),
(16, 0, 6, 'Alameda', 0, 0),
(17, 0, 6, 'Anfiteatro', 0, 0),
(18, 0, 6, 'Área de Convivência', 0, 0),
(19, 0, 6, 'Arena', 0, 0),
(20, 0, 6, 'Ateliê', 0, 0),
(21, 0, 6, 'Biblioteca Jayme Cortez', 0, 0),
(22, 0, 6, 'Espaço Sarau', 0, 0),
(23, 0, 6, 'Estúdio', 0, 0),
(24, 0, 6, 'Foyer do Anfiteatro', 0, 0),
(25, 0, 6, 'Hall de Entrada', 0, 0),
(26, 0, 6, 'HQTeca', 0, 0),
(27, 0, 6, 'Internet Livre', 0, 0),
(28, 0, 6, 'Laboratório de Edição', 0, 0),
(29, 0, 6, 'Laboratório de Pesquisa', 0, 0),
(30, 0, 6, 'Mirante', 0, 0),
(31, 0, 6, 'Sala de Projetos', 0, 0),
(32, 0, 6, 'Varanda do Anfiteatro', 0, 0),
(33, 0, 6, 'Brinquedoteca', 0, 0),
(34, 0, 6, 'Cozinha Experimental', 0, 0),
(35, 0, 6, 'Varanda do Arena', 0, 0),
(36, 0, 6, 'Horta Comunitária', 0, 0),
(37, 0, 6, 'Local Externo', 0, 0),
(38, 0, 6, 'Terminal Vila Nova Cachoeirinha	', 0, 0),
(39, 0, 6, 'Largo do Japonês', 0, 0),
(40, 0, 6, 'Praça em frente ao CCJ', 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_etaria`
--

DROP TABLE IF EXISTS `ig_etaria`;
CREATE TABLE IF NOT EXISTS `ig_etaria` (
  `idIdade` int(2) NOT NULL AUTO_INCREMENT,
  `faixa` varchar(60) NOT NULL,
  PRIMARY KEY (`idIdade`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `ig_etaria`
--

INSERT INTO `ig_etaria` (`idIdade`, `faixa`) VALUES
(1, '12 anos'),
(2, '14 anos'),
(3, '16 anos'),
(4, '18 anos'),
(5, '21 anos'),
(6, 'Livre');

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
  `releaseCom` longtext NOT NULL,
  `parecerArtistico` longtext NOT NULL,
  `confirmaFinanca` tinyint(1) DEFAULT NULL,
  `confirmaDiretoria` tinyint(1) DEFAULT NULL,
  `confirmaComunicacao` tinyint(1) DEFAULT NULL,
  `confirmaDocumentacao` tinyint(1) DEFAULT NULL,
  `confirmaProducao` tinyint(1) DEFAULT NULL,
  `numeroProcesso` varchar(30) DEFAULT NULL,
  `publicado` int(1) DEFAULT NULL,
  `idUsuario` int(3) DEFAULT NULL,
  `ig_modalidade_IdModalidade` int(2) DEFAULT NULL,
  `linksCom` longtext,
  PRIMARY KEY (`idEvento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=127 ;

--
-- Extraindo dados da tabela `ig_evento`
--

INSERT INTO `ig_evento` (`idEvento`, `ig_produtor_idProdutor`, `ig_tipo_evento_idTipoEvento`, `ig_programa_idPrograma`, `projetoEspecial`, `nomeEvento`, `projeto`, `memorando`, `idResponsavel`, `suplente`, `autor`, `fichaTecnica`, `faixaEtaria`, `sinopse`, `releaseCom`, `parecerArtistico`, `confirmaFinanca`, `confirmaDiretoria`, `confirmaComunicacao`, `confirmaDocumentacao`, `confirmaProducao`, `numeroProcesso`, `publicado`, `idUsuario`, `ig_modalidade_IdModalidade`, `linksCom`) VALUES
(108, 0, 3, 0, 1, 'The Beatles', '', NULL, 8, 1, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL),
(109, 0, 12, 0, 12, 'The Beatles', '', NULL, 1, 8, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 2, NULL),
(110, 0, 16, 0, 3, 'Rolling Stones', '', NULL, 8, 1, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL),
(111, 8, 12, 0, 0, 'Blur no CCSP', '', NULL, 0, 0, 'Blur é uma banda inglesa de rock alternativo. Formada em 1989, em Londres, o grupo é formado pelo vocalista Damon Albarn, o guitarrista Graham Coxon, o baixista Alex James e o baterista Dave Rowntree.', 'Blur é uma banda inglesa de rock alternativo. Formada em 1989, em Londres, o grupo é formado pelo vocalista Damon Albarn, o guitarrista Graham Coxon, o baixista Alex James e o baterista Dave Rowntree.', '5', 'Leisure (1991)[editar | editar código-fonte]\r\nO primeiro álbum da banda estilisticamente não se diferenciava muito do que se fazia na época na Inglaterra, explorava letras curtas, simples e diretas, por vezes sem refrões, com os vocais de Damon Albarn se fundindo com a guitarra de Graham Coxon, estes sim já se destacando, junto com a combinação do baixo de Alex James e a bateria de Rowntree. As músicas exploravam uma sonoridade inclinada ao psicodelismo advindo dos Stone Roses e outros representantes da cena musical “Madchester”, que já mostrava declínio naquele ano de 1991. A primeira faixa, e também o primeiro single da banda, She’s So High abria o álbum de forma musicalmente fantástica, com sua letra curta e vaga, o que era uma regra poucas vezes desobedecida no álbum. Aqui é explorado um dos lados mais sombrios de Blur, com a canção Sing, que pode ser considerada um dos grandes clássicos da banda e já apresentava um lado diferenciado de Blur, e talvez o seu potencial, que seria melhor explorado a partir do álbum “Blur”. Sing seria incluída, bem posteriormente, na trilha sonora do filme Trainspotting.\r\n\r\nModern Life Is Rubbish (1993)[editar | editar código-fonte]\r\nO segundo álbum da banda abandonou boa parte da psicodelia e as letras curtas de Leisure e mostrou letras que indicam uma localização e uma época. For Tomorrow abre o disco, onde são citados vários pontos de Londres. Em Blue Jeans mais um passeio por Londres, supostamente retratando o relacionamento de Damon Albarn com Justine (Elastica). Neste álbum começam a aparecer as músicas centradas em personagens, retratados de forma irônica, sendo Colin Zeal o mais famoso. Destaque neste álbum também para Chemical World e Sunday Sunday. Chemical World merece destaque por si só, é um retrato da vida moderna nas grandes cidades, trabalhos ingratos, dificuldades para pagar o aluguel, falta de perspectivas e a solidão, ironicamente em um lugar superpopuloso.\r\n\r\nParklife (1994)[editar | editar código-fonte]\r\nParklife, praticamente uma continuação de Modern Life Is Rubbish, abria com Girls & Boys, um dos maiores "hits" da banda. Os personagens que retratam a sociedade continuam, um Inglês que sonha em se mudar para os USA em Magic America e Tracy Jacks, um funcionário público. As críticas ou ironias com a sociedada inglesa também aparecem em London Loves. Porém, há também a melancolia de This is a Low, Badhead, To the End eEnd of Century. Parklife é um álbum consistente em termos musicais, embora seja uma coletânea de histórias que nem sempre se interligam.\r\n\r\nThe Great Escape (1995)[editar | editar código-fonte]\r\nThe Great Escape continua com os personagens, estereótipos satirizados em diversas faixas, não é a toa que o álbum abre com Stereotypes. O álbum, embora tenha tido relativo sucesso, já demonstrava uma queda na fórmula e indicava novos rumos em canções como He Thought of Cars e The Universal, uma das canções mais significativas da banda. The Great Escape recebeu boas avaliações, recebendo a nota 9 em 10 por parte da NME3 . Este álbum o último do que ficou conhecido como The Life Trilogy4 , complementando Modern Life Is Rubbish e Parklife.\r\n\r\nBlur (1997)[editar | editar código-fonte]\r\nBlur rompeu com a linha que a banda vinha seguindo nos três últimos álbuns, centrados em personagens da vida britânica pós-thatcherismo5 . Na sonoridade a banda buscou se aproximar do cenário independente dos Estados Unidos como o Pavement e Sonic Youth 6 , essa diferença fica clara em músicas como M.O.R., On Your Own e You''re So Great. O álbum conta com Song 2, o maior êxito radiofônico da banda, inclusive no Brasil. Pelo lado melancólico o álbum conta com Beetlebum, Death of a Party e a imensuravelmente triste Strange News From Another Star.\r\n\r\n13 (1999)[editar | editar código-fonte]\r\nEm 13 a banda continua sua mudança de sonoridade, o produtor de longa data Stephen Street foi substituído por Willian Orbit neste álbum. O resultado foi adição de mais elementos experimentais e eletrônicos, se distanciando do rótulo Britpop. 13 abre com Tender, canção que virou hino em praticamente todas as apresentações da banda e, supostamente, mais uma canção dedicada a amada ex-companheira de Damon Albarn, Justine Frischmann. No entanto, 13 é um álbum com temática diversa, com canções novamente baseadas em personagens como Bugman e canções mais leves sobre a infância na cidade natal da banda, como Coffee & TV, que deu luz a um dos vídeo clipes mais famosos da banda, em que uma caixa de leite se aventura pela cidade. Neste álbum também se encontram dois grandes B-Sides do lado mais sombrios da banda Caramel e Battle. Blur teve boa receptividade por parte da crítica especializada7 .\r\n\r\nThink Tank (2003)[editar | editar código-fonte]\r\nGraham Coxon se afasta da banda para se dedicar a seus trabalhos solos. "Think Tank" é lançado em 2003. Para o lugar de Coxon, foi recrutado Simon Tong, ex-guitarrista do Verve. A única faixa que Coxon participa deste álbum é a última, chamada Battery in your Leg. "Think Tank" foi aclamado pela crítica, sendo citado em vigésimo lugar nos melhores álbuns da década, pela revista NME. Out of Time, Crazy Beat e Battery in Your Leg são os destaques desse trabalho.\r\n\r\nThe Magic Whip (2015)[editar | editar código-fonte]\r\nApós 12 anos sem criar álbuns de estúdio, já com a volta de Graham Coxon, a banda anuncia seu novo álbum, The Magic Whip, previsto para lançamento em 27 de Abril de 2015, e o lançamento do single Go Out junto com seu videoclipe, capa do álbum e o nome de todas as faixas.', 'Leisure (1991)[editar | editar código-fonte]\r\nO primeiro álbum da banda estilisticamente não se diferenciava muito do que se fazia na época na Inglaterra, explorava letras curtas, simples e diretas, por vezes sem refrões, com os vocais de Damon Albarn se fundindo com a guitarra de Graham Coxon, estes sim já se destacando, junto com a combinação do baixo de Alex James e a bateria de Rowntree. As músicas exploravam uma sonoridade inclinada ao psicodelismo advindo dos Stone Roses e outros representantes da cena musical “Madchester”, que já mostrava declínio naquele ano de 1991. A primeira faixa, e também o primeiro single da banda, She’s So High abria o álbum de forma musicalmente fantástica, com sua letra curta e vaga, o que era uma regra poucas vezes desobedecida no álbum. Aqui é explorado um dos lados mais sombrios de Blur, com a canção Sing, que pode ser considerada um dos grandes clássicos da banda e já apresentava um lado diferenciado de Blur, e talvez o seu potencial, que seria melhor explorado a partir do álbum “Blur”. Sing seria incluída, bem posteriormente, na trilha sonora do filme Trainspotting.\r\n\r\nModern Life Is Rubbish (1993)[editar | editar código-fonte]\r\nO segundo álbum da banda abandonou boa parte da psicodelia e as letras curtas de Leisure e mostrou letras que indicam uma localização e uma época. For Tomorrow abre o disco, onde são citados vários pontos de Londres. Em Blue Jeans mais um passeio por Londres, supostamente retratando o relacionamento de Damon Albarn com Justine (Elastica). Neste álbum começam a aparecer as músicas centradas em personagens, retratados de forma irônica, sendo Colin Zeal o mais famoso. Destaque neste álbum também para Chemical World e Sunday Sunday. Chemical World merece destaque por si só, é um retrato da vida moderna nas grandes cidades, trabalhos ingratos, dificuldades para pagar o aluguel, falta de perspectivas e a solidão, ironicamente em um lugar superpopuloso.\r\n\r\nParklife (1994)[editar | editar código-fonte]\r\nParklife, praticamente uma continuação de Modern Life Is Rubbish, abria com Girls & Boys, um dos maiores "hits" da banda. Os personagens que retratam a sociedade continuam, um Inglês que sonha em se mudar para os USA em Magic America e Tracy Jacks, um funcionário público. As críticas ou ironias com a sociedada inglesa também aparecem em London Loves. Porém, há também a melancolia de This is a Low, Badhead, To the End eEnd of Century. Parklife é um álbum consistente em termos musicais, embora seja uma coletânea de histórias que nem sempre se interligam.\r\n\r\nThe Great Escape (1995)[editar | editar código-fonte]\r\nThe Great Escape continua com os personagens, estereótipos satirizados em diversas faixas, não é a toa que o álbum abre com Stereotypes. O álbum, embora tenha tido relativo sucesso, já demonstrava uma queda na fórmula e indicava novos rumos em canções como He Thought of Cars e The Universal, uma das canções mais significativas da banda. The Great Escape recebeu boas avaliações, recebendo a nota 9 em 10 por parte da NME3 . Este álbum o último do que ficou conhecido como The Life Trilogy4 , complementando Modern Life Is Rubbish e Parklife.\r\n\r\nBlur (1997)[editar | editar código-fonte]\r\nBlur rompeu com a linha que a banda vinha seguindo nos três últimos álbuns, centrados em personagens da vida britânica pós-thatcherismo5 . Na sonoridade a banda buscou se aproximar do cenário independente dos Estados Unidos como o Pavement e Sonic Youth 6 , essa diferença fica clara em músicas como M.O.R., On Your Own e You''re So Great. O álbum conta com Song 2, o maior êxito radiofônico da banda, inclusive no Brasil. Pelo lado melancólico o álbum conta com Beetlebum, Death of a Party e a imensuravelmente triste Strange News From Another Star.\r\n\r\n13 (1999)[editar | editar código-fonte]\r\nEm 13 a banda continua sua mudança de sonoridade, o produtor de longa data Stephen Street foi substituído por Willian Orbit neste álbum. O resultado foi adição de mais elementos experimentais e eletrônicos, se distanciando do rótulo Britpop. 13 abre com Tender, canção que virou hino em praticamente todas as apresentações da banda e, supostamente, mais uma canção dedicada a amada ex-companheira de Damon Albarn, Justine Frischmann. No entanto, 13 é um álbum com temática diversa, com canções novamente baseadas em personagens como Bugman e canções mais leves sobre a infância na cidade natal da banda, como Coffee & TV, que deu luz a um dos vídeo clipes mais famosos da banda, em que uma caixa de leite se aventura pela cidade. Neste álbum também se encontram dois grandes B-Sides do lado mais sombrios da banda Caramel e Battle. Blur teve boa receptividade por parte da crítica especializada7 .\r\n\r\nThink Tank (2003)[editar | editar código-fonte]\r\nGraham Coxon se afasta da banda para se dedicar a seus trabalhos solos. "Think Tank" é lançado em 2003. Para o lugar de Coxon, foi recrutado Simon Tong, ex-guitarrista do Verve. A única faixa que Coxon participa deste álbum é a última, chamada Battery in your Leg. "Think Tank" foi aclamado pela crítica, sendo citado em vigésimo lugar nos melhores álbuns da década, pela revista NME. Out of Time, Crazy Beat e Battery in Your Leg são os destaques desse trabalho.\r\n\r\nThe Magic Whip (2015)[editar | editar código-fonte]\r\nApós 12 anos sem criar álbuns de estúdio, já com a volta de Graham Coxon, a banda anuncia seu novo álbum, The Magic Whip, previsto para lançamento em 27 de Abril de 2015, e o lançamento do single Go Out junto com seu videoclipe, capa do álbum e o nome de todas as faixas.', 'Leisure (1991)[editar | editar código-fonte]\r\nO primeiro álbum da banda estilisticamente não se diferenciava muito do que se fazia na época na Inglaterra, explorava letras curtas, simples e diretas, por vezes sem refrões, com os vocais de Damon Albarn se fundindo com a guitarra de Graham Coxon, estes sim já se destacando, junto com a combinação do baixo de Alex James e a bateria de Rowntree. As músicas exploravam uma sonoridade inclinada ao psicodelismo advindo dos Stone Roses e outros representantes da cena musical “Madchester”, que já mostrava declínio naquele ano de 1991. A primeira faixa, e também o primeiro single da banda, She’s So High abria o álbum de forma musicalmente fantástica, com sua letra curta e vaga, o que era uma regra poucas vezes desobedecida no álbum. Aqui é explorado um dos lados mais sombrios de Blur, com a canção Sing, que pode ser considerada um dos grandes clássicos da banda e já apresentava um lado diferenciado de Blur, e talvez o seu potencial, que seria melhor explorado a partir do álbum “Blur”. Sing seria incluída, bem posteriormente, na trilha sonora do filme Trainspotting.\r\n\r\nModern Life Is Rubbish (1993)[editar | editar código-fonte]\r\nO segundo álbum da banda abandonou boa parte da psicodelia e as letras curtas de Leisure e mostrou letras que indicam uma localização e uma época. For Tomorrow abre o disco, onde são citados vários pontos de Londres. Em Blue Jeans mais um passeio por Londres, supostamente retratando o relacionamento de Damon Albarn com Justine (Elastica). Neste álbum começam a aparecer as músicas centradas em personagens, retratados de forma irônica, sendo Colin Zeal o mais famoso. Destaque neste álbum também para Chemical World e Sunday Sunday. Chemical World merece destaque por si só, é um retrato da vida moderna nas grandes cidades, trabalhos ingratos, dificuldades para pagar o aluguel, falta de perspectivas e a solidão, ironicamente em um lugar superpopuloso.\r\n\r\nParklife (1994)[editar | editar código-fonte]\r\nParklife, praticamente uma continuação de Modern Life Is Rubbish, abria com Girls & Boys, um dos maiores "hits" da banda. Os personagens que retratam a sociedade continuam, um Inglês que sonha em se mudar para os USA em Magic America e Tracy Jacks, um funcionário público. As críticas ou ironias com a sociedada inglesa também aparecem em London Loves. Porém, há também a melancolia de This is a Low, Badhead, To the End eEnd of Century. Parklife é um álbum consistente em termos musicais, embora seja uma coletânea de histórias que nem sempre se interligam.\r\n\r\nThe Great Escape (1995)[editar | editar código-fonte]\r\nThe Great Escape continua com os personagens, estereótipos satirizados em diversas faixas, não é a toa que o álbum abre com Stereotypes. O álbum, embora tenha tido relativo sucesso, já demonstrava uma queda na fórmula e indicava novos rumos em canções como He Thought of Cars e The Universal, uma das canções mais significativas da banda. The Great Escape recebeu boas avaliações, recebendo a nota 9 em 10 por parte da NME3 . Este álbum o último do que ficou conhecido como The Life Trilogy4 , complementando Modern Life Is Rubbish e Parklife.\r\n\r\nBlur (1997)[editar | editar código-fonte]\r\nBlur rompeu com a linha que a banda vinha seguindo nos três últimos álbuns, centrados em personagens da vida britânica pós-thatcherismo5 . Na sonoridade a banda buscou se aproximar do cenário independente dos Estados Unidos como o Pavement e Sonic Youth 6 , essa diferença fica clara em músicas como M.O.R., On Your Own e You''re So Great. O álbum conta com Song 2, o maior êxito radiofônico da banda, inclusive no Brasil. Pelo lado melancólico o álbum conta com Beetlebum, Death of a Party e a imensuravelmente triste Strange News From Another Star.\r\n\r\n13 (1999)[editar | editar código-fonte]\r\nEm 13 a banda continua sua mudança de sonoridade, o produtor de longa data Stephen Street foi substituído por Willian Orbit neste álbum. O resultado foi adição de mais elementos experimentais e eletrônicos, se distanciando do rótulo Britpop. 13 abre com Tender, canção que virou hino em praticamente todas as apresentações da banda e, supostamente, mais uma canção dedicada a amada ex-companheira de Damon Albarn, Justine Frischmann. No entanto, 13 é um álbum com temática diversa, com canções novamente baseadas em personagens como Bugman e canções mais leves sobre a infância na cidade natal da banda, como Coffee & TV, que deu luz a um dos vídeo clipes mais famosos da banda, em que uma caixa de leite se aventura pela cidade. Neste álbum também se encontram dois grandes B-Sides do lado mais sombrios da banda Caramel e Battle. Blur teve boa receptividade por parte da crítica especializada7 .\r\n\r\nThink Tank (2003)[editar | editar código-fonte]\r\nGraham Coxon se afasta da banda para se dedicar a seus trabalhos solos. "Think Tank" é lançado em 2003. Para o lugar de Coxon, foi recrutado Simon Tong, ex-guitarrista do Verve. A única faixa que Coxon participa deste álbum é a última, chamada Battery in your Leg. "Think Tank" foi aclamado pela crítica, sendo citado em vigésimo lugar nos melhores álbuns da década, pela revista NME. Out of Time, Crazy Beat e Battery in Your Leg são os destaques desse trabalho.\r\n\r\nThe Magic Whip (2015)[editar | editar código-fonte]\r\nApós 12 anos sem criar álbuns de estúdio, já com a volta de Graham Coxon, a banda anuncia seu novo álbum, The Magic Whip, previsto para lançamento em 27 de Abril de 2015, e o lançamento do single Go Out junto com seu videoclipe, capa do álbum e o nome de todas as faixas.', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 'http://pt.wikipedia.org/wiki/Blur'),
(113, 0, 12, 0, 1, 'The Beatles', 'Quinta na Faixa', NULL, 1, 8, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 7, NULL),
(114, 0, 4, 0, 3, 'Teste123', '', NULL, 8, 1, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, NULL),
(115, 0, 7, 0, 2, 'Teste PHPMySQL', '', NULL, 1, 8, 'Retorna uma string com barras invertidas antes de caracteres que precisam ser escapados para serem escapados em query a banco de dados, etc. Estes caracteres são aspas simples (''), aspas duplas ("), barra invertida (\\) e NUL (o byte NULL).\r\n\r\nUm exemplo do uso de addslashes() é quando você esta entrando com dados em um banco de dados. Por exemplo, para inserir o nome O''reilly em um banco de dados, você vai precisar escapa-lo. A maior parte dos banco de dados faz isto com \\ o que nos leva a O\\''reilly. Isto é apenas para colocar os dados no banco de dados, a \\ não será inserida. Tendo a diretiva do PHP magic_quotes_sybase em on fará com que '' seja escapada com outra ''.\r\n\r\nA diretiva do PHP magic_quotes_gpc é on por padrão, e ela essencialmente executa addslashes() para todos dados de GET, POST e COOKIE. Não use addslashes() em strings que já foram escapadas com magic_quotes_gpc já que você acabara escapando duas vezes. A função get_magic_quotes_gpc() pode dar uma mão para conferir isto.', 'Retorna uma string com barras invertidas antes de caracteres que precisam ser escapados para serem escapados em query a banco de dados, etc. Estes caracteres são aspas simples (''), aspas duplas ("), barra invertida (\\) e NUL (o byte NULL).\r\n\r\nUm exemplo do uso de addslashes() é quando você esta entrando com dados em um banco de dados. Por exemplo, para inserir o nome O''reilly em um banco de dados, você vai precisar escapa-lo. A maior parte dos banco de dados faz isto com \\ o que nos leva a O\\''reilly. Isto é apenas para colocar os dados no banco de dados, a \\ não será inserida. Tendo a diretiva do PHP magic_quotes_sybase em on fará com que '' seja escapada com outra ''.\r\n\r\nA diretiva do PHP magic_quotes_gpc é on por padrão, e ela essencialmente executa addslashes() para todos dados de GET, POST e COOKIE. Não use addslashes() em strings que já foram escapadas com magic_quotes_gpc já que você acabara escapando duas vezes. A função get_magic_quotes_gpc() pode dar uma mão para conferir isto.', '1', 'Para compartilhar esse conteúdo, por favor utilize o link http://www1.folha.uol.com.br/ilustrada/2015/05/1635367-documentario-constroi-colagem-sensivel-e-divertida-da-vida-de-cauby-peixoto.shtml ou as ferramentas oferecidas na página. Textos, fotos, artes e vídeos da Folha estão protegidos pela legislação brasileira sobre direito autoral. Não reproduza o conteúdo do jornal em qualquer meio de comunicação, eletrônico ou impresso, sem autorização da Folhapress (pesquisa@folhapress.com.br). As regras têm como objetivo proteger o investimento que a Folha faz na qualidade de seu jornalismo. Se precisa copiar trecho de texto da Folha para uso privado, por favor logue-se como assinante ou cadastrado.', 'Para compartilhar esse conteúdo, por favor utilize o link http://www1.folha.uol.com.br/ilustrada/2015/05/1635367-documentario-constroi-colagem-sensivel-e-divertida-da-vida-de-cauby-peixoto.shtml ou as ferramentas oferecidas na página. Textos, fotos, artes e vídeos da Folha estão protegidos pela legislação brasileira sobre direito autoral. Não reproduza o conteúdo do jornal em qualquer meio de comunicação, eletrônico ou impresso, sem autorização da Folhapress (pesquisa@folhapress.com.br). As regras têm como objetivo proteger o investimento que a Folha faz na qualidade de seu jornalismo. Se precisa copiar trecho de texto da Folha para uso privado, por favor logue-se como assinante ou cadastrado.', 'Workshop de propostas para o desenvolvimento de políticas públicas para a Inovação Cidadã\r\n30 de julho de 2014\r\nCentro Cultural São Paulo\r\nRua Vergueiro 1000\r\nSão Paulo, Brasil\r\n\r\nRepresentantes de governos locais e nacionais, empresas, organismos internacionais, academia e coletivos sociais reúnem-se em São Paulo para debater sobre propostas para o desenvolvimento de políticas públicas para o impulso da Inovação Cidadã em Ibero-América.\r\nDos aportes feitos no workshop vão sistematizar-se as idéias para a conformação do documento que será entregue às Chefas e aos Chefes de Estado e de Governo na Cúpula de Veracruz de este ano.\r\n\r\nPrograma\r\n9:00 Bem-vinda e introdução: Políticas públicas e inovação cidadã\r\nJuca Ferreira, Secretário de Cultura da Prefeitura de São Paulo\r\n9:15 Apresentação Cidadania 2.0 / Inovação Cidadã\r\nCidadania 2.0 \r\n9:25 Objetivos e metodologia do workshop: \r\nCidadania 2.0 \r\n9:30 Inicio workshop \r\nTrabalho em subgrupos sobre propostas do documento, e novas propostas\r\n12:00 Almoço\r\n13:00 Sessão plenária \r\nDebate coletivo sobre propostas do documento e novas propostas:\r\n13:00-13:30 conexão com Madrid (Medialab-Prado): propostas documento e novas propostas\r\n13:30-15:00 debate propostas documento (SPaulo)\r\n15:00-16:30 apresentação e debate de propostas novas (SPaulo)  \r\n17:00 Orientações futuras e encerramento\r\nJuca Ferreira, Secretário de Cultura da Prefeitura de São Paulo e Cidadania 2.0 \r\n\r\n\r\n\r\nMetodología do Workshop\r\n\r\n1.	Objetivo \r\nDebater sobre propostas para o desenvolvimento de políticas públicas para o impulso da inovação cidadã, realizadas pelos participantes da Equipe de trabalho. O objetivo e criar um documento de propostas numa base consensual para entregar as Chefas e Chefes de Estado ibero-americanos durante a Cúpula de Veracruz.\r\n\r\n2.	Processo\r\nAs propostas realizadas previamente via Web no formulário http://www.ciudadania20.org/politicaspublicas/ pela Equipe de trabalho e cidadãos em geral vão ser categorizadas previamente em temáticas principais por Cidadania 2.0 e levadas ao workshop de São Paulo para trabalhar sobre elas num documento.\r\nOs participantes vão reunir-se em grupos heterogêneos (representantes de movimentos sociais, empresas, academia, organismos internacionais e governos) e vão debater sobre cada uma das propostas do documento, além de gerar novas propostas que posteriormente podam ser incluídas no documento para as Chefas e os Chefes de Estado. Dado que não todos os participantes estarão presentes em São Paulo, serão incluídos nos grupos mediante Skype através de dispositivo portátil. \r\nSimultaneamente vai reunir-se um grupo no Medialab-Prado em Madrid com o mesmo objetivo de debater e gerar novas propostas.\r\nSeguidamente, vai haver um espaço de apresentação coletiva das propostas de cada grupo mediante o seu porta-voz (incluindo o grupo de Madrid), e um debate entre todos os participantes, com o fim de gerar uma visão coletiva das propostas. \r\nFinalmente, o workshop vai finalizar com conclusões de Juca Ferreira e a equipe de Cidadania 2.0. \r\n\r\n3.	Ferramenta \r\nCommentpress vai ser a ferramenta a utilizar (a mesma utilizada durante todos os processos colaborativos de Inovação Cidadã), onde cada grupo vai funcionar como um usuário (grupo 1, grupo 2, etc.) plasmando em forma de comentário os seus aportes a cada proposta. Também os comentários sobre o debate coletivo vão ser incluídos em commentpress como um novo usuário. \r\nDe esta forma, a relatoria se irá construindo in situ de forma aberta e online. Isso permite que cidadãos não presentes no workshop também podam incluir os seus comentários em forma de propostas que vão ser incorporados ao debate.\r\n\r\n4.	Produto esperado \r\nAs propostas numa base consensual surgidas no workshop vão ser sistematizadas nos dias posteriores por Cidadania 2.0 para conformar o documento de propostas para o desenvolvimento de políticas públicas para as Chefas e os Chefes de Estado que vamos levar a Veracruz. O documento estará online até novembro.\r\n', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 7, 'http://futebol.placar.esporte.uol.com.br/futebol/brasileirao/2015/05/31/internacional-x-sao-paulo.htm'),
(121, 0, 1, 0, 1, 'teste123', '', NULL, 1, 1, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, NULL),
(123, 0, 12, 0, 7, 'The Beatles', 'Quinta na faixa', NULL, 1, 7, 'The Beatles', 'John, Paul, George e Ringo', '6', 'The Beatles foi uma banda de rock britânica, formada em Liverpool em 1960. É o grupo musical mais bem-sucedido e aclamado da história da música popular.1 A partir de 1962, o grupo era formado por John Lennon (guitarra rítmica e vocal), Paul McCartney (baixo, piano e vocal), George Harrison (guitarra solo e vocal) e Ringo Starr (bateria e vocal). Enraizada do skiffle e do rock and roll da década de 1950, a banda veio mais tarde a assumir diversos gêneros que vão do folk rock ao rock psicodélico, muitas vezes incorporando elementos da música clássica e outros, em formas inovadoras e criativas. Sua crescente popularidade, que a imprensa britânica chamava de "Beatlemania", fez com que eles crescessem em sofisticação. Os Beatles vieram a ser percebidos como a encarnação de ideais progressistas e sua influência se estendeu até as revoluções sociais e culturais da década de 1960.\r\n\r\nCom a formação inicial de Lennon, McCartney, Harrison, Stuart Sutcliffe (baixo) e Pete Best (bateria), os Beatles construíram sua reputação nos pubs de Liverpool e Hamburgo durante um período de três anos a partir de 1960. Sutcliffe deixou o grupo em 61, e Best foi substituído por Starr no ano seguinte. Abastecida de equipamentos profissionais moldados por Brian Epstein, que depois se ofereceu para gerenciar a banda, e com seu potencial reforçado pela criatividade do produtor George Martin, os Beatles alcançaram um sucesso imediato no Reino Unido com seu primeiro single "Love Me Do". Ganhando popularidade internacional a partir do ano seguinte, excursionaram extensivamente até 1966, quando retiraram-se para trabalhar em estúdio até sua dissolução definitiva em 1970. Cada músico então seguiu para uma carreira independente. McCartney e Starr continuam ativos; Lennon foi assassinado em 1980, e Harrison morreu de câncer em 2001.', 'Durante seus anos de estúdio, os Beatles produziram o que a crítica considera um dos seus melhores materiais, incluindo o álbum Sgt. Pepper''s Lonely Hearts Club Band (1967), amplamente visto como uma obra-prima. Quatro décadas após sua dissolução, a música do grupo continua a ser muito popular. Os Beatles tiveram mais álbuns em número 1 nas paradas britânicas do que qualquer outro grupo musical.2 De acordo com a RIAA, eles venderam mais álbuns nos Estados Unidos do que qualquer outro artista.3 Em 2008, a Billboard divulgou uma lista dos top-selling de todos os tempos dos artistas Hot 100 para celebrar o cinquentenário das paradas de singles dos Estados Unidos, e a banda permaneceu em primeiro lugar.4 Eles já foram honrados com 8 Grammy Awards,5 e 15 Ivor Novello Awards da BASCA.6 . Já venderam mais de um bilhão de discos. Os Beatles foram coletivamente incluídos na compilação da revista Time das 100 pessoas mais importantes e influentes do século XX.7', 'Em Março de 1957, empolgado com o skiffle que Lonnie Donegan popularizou com seus sons improvisados, John Lennon criou uma banda composta por colegas da escola Quarry Bank School — que incluía seu melhor amigo na época, Pete Shotton — primeiramente chamada de The Black Jacks, mas logo definida como The Quarrymen (em homenagem à escola).12 Inicialmente, além dos dois, a banda era composta por Eric Griffths (violão), Bill Smith (baixo improvisado) e Rod Davis (banjo). Em 6 de julho de 1957, Paul McCartney havia assistido uma apresentação da banda em uma festa na Igreja St. Peter, e Ivan Vaughan, amigo de John Lennon e colega de classe de Paul, apresentou-lhe a Lennon; Paul foi convidado a ingressar na banda e, no mesmo ano, mostrou a Lennon a composição "I''ve Lost My Little Girl".12 Em 6 de fevereiro de 1958, o jovem guitarrista George Harrison juntou-se à banda,13 apresentado por Paul que o teria conhecido por acaso num ônibus.14 Apesar da relutância inicial de Lennon pelo fato de Harrison ser três anos mais novo que ele (na época, com quinze anos),14 McCartney insistiu depois de uma demonstração de George e este terminou ingressando no grupo. Lennon e McCartney desempenharam a guitarra rítmica durante esse período e, após o baterista oficial do Quarrymen, Colin Hanton deixar a banda, em 1959, depois de uma discussão com os outros membros, teve uma alta rotatividade de bateristas. Stuart Sutcliffe, colega de Lennon numa escola de arte de Liverpool, aderiu ao baixo em janeiro de 1960, a pedido do amigo.12', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 7, 'http://pt.wikipedia.org/wiki/The_Beatles'),
(125, 0, 1, 0, 1, 'The Beatles', '', NULL, 1, 1, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, NULL),
(126, 0, 0, 0, 0, '', NULL, NULL, 0, 0, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_instituicao`
--

DROP TABLE IF EXISTS `ig_instituicao`;
CREATE TABLE IF NOT EXISTS `ig_instituicao` (
  `idInstituicao` int(3) NOT NULL AUTO_INCREMENT,
  `instituicao` varchar(60) NOT NULL,
  `instituicaoPai` int(2) NOT NULL,
  `sigla` varchar(12) NOT NULL,
  PRIMARY KEY (`idInstituicao`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `ig_instituicao`
--

INSERT INTO `ig_instituicao` (`idInstituicao`, `instituicao`, `instituicaoPai`, `sigla`) VALUES
(3, 'Prefeitura de São Paulo', 0, 'PMSP'),
(4, 'Secretaria Municipal de Cultura', 3, 'SMC'),
(5, 'Centro Cultural São Paulo', 4, 'CCSP'),
(6, 'Centro Cultural da Juventude', 3, 'CCJ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_justificativa`
--

DROP TABLE IF EXISTS `ig_justificativa`;
CREATE TABLE IF NOT EXISTS `ig_justificativa` (
  `idJustificativa` int(4) NOT NULL DEFAULT '0',
  `idEvento` int(11) NOT NULL,
  `idPapelUsuario` int(3) DEFAULT NULL,
  `justificativa` longtext,
  `data` datetime DEFAULT NULL,
  PRIMARY KEY (`idJustificativa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ig_justificativa`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_local`
--

DROP TABLE IF EXISTS `ig_local`;
CREATE TABLE IF NOT EXISTS `ig_local` (
  `idLocal` int(3) NOT NULL AUTO_INCREMENT,
  `sala` varchar(60) NOT NULL,
  `lotacao` int(4) NOT NULL,
  `idInstituicao` int(3) DEFAULT NULL,
  PRIMARY KEY (`idLocal`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=41 ;

--
-- Extraindo dados da tabela `ig_local`
--

INSERT INTO `ig_local` (`idLocal`, `sala`, `lotacao`, `idInstituicao`) VALUES
(1, 'Sala Adoniran Barbosa', 681, 5),
(2, 'Sala Paulo Emilio Salles Gomes', 99, 5),
(3, 'Espaço Cênico Ademar Guerra', 0, 5),
(4, 'Sala Lima Barreto', 0, 5),
(5, 'Sala Tarsila do Amaral', 0, 5),
(6, 'Sala Jardel Filho', 0, 5),
(7, 'Sala de Debates', 0, 5),
(8, 'Espaço Mário Chamie (Praça das Bibliotecas)', 0, 5),
(9, 'Piso Caio Graco', 0, 5),
(10, 'Sala de Ensaio', 0, 5),
(11, 'Sala de Leitura Infanto-Juvenil', 0, 5),
(12, 'Piso Flávio de Carvalho', 0, 5),
(13, 'Área de Convivência', 0, 5),
(14, 'Espaço Flavio Império (Foyer)', 0, 5),
(15, 'Anexo Adoniran', 0, 5),
(16, 'Alameda', 0, 6),
(17, 'Anfiteatro', 0, 6),
(18, 'Área de Convivência', 0, 6),
(19, 'Arena', 0, 6),
(20, 'Ateliê', 0, 6),
(21, 'Biblioteca Jayme Cortez', 0, 6),
(22, 'Espaço Sarau', 0, 6),
(23, 'Estúdio', 0, 6),
(24, 'Foyer do Anfiteatro', 0, 6),
(25, 'Hall de Entrada', 0, 6),
(26, 'HQTeca', 0, 6),
(27, 'Internet Livre', 0, 6),
(28, 'Laboratório de Edição', 0, 6),
(29, 'Laboratório de Pesquisa', 0, 6),
(30, 'Mirante', 0, 6),
(31, 'Sala de Projetos', 0, 6),
(32, 'Varanda do Anfiteatro', 0, 6),
(33, 'Brinquedoteca', 0, 6),
(34, 'Cozinha Experimental', 0, 6),
(35, 'Varanda do Arena', 0, 6),
(36, 'Horta Comunitária', 0, 6),
(37, 'Local Externo', 0, 6),
(38, 'Terminal Vila Nova Cachoeirinha	', 0, 6),
(39, 'Largo do Japonês', 0, 6),
(40, 'Praça em frente ao CCJ', 0, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_log`
--

DROP TABLE IF EXISTS `ig_log`;
CREATE TABLE IF NOT EXISTS `ig_log` (
  `idLog` int(8) NOT NULL AUTO_INCREMENT,
  `ig_usuario_idUsuario` int(3) NOT NULL,
  `enderecoIP` varchar(20) NOT NULL,
  `dataLog` datetime NOT NULL,
  `descricao` longtext NOT NULL,
  PRIMARY KEY (`idLog`),
  KEY `ig_log_FKIndex1` (`ig_usuario_idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=91 ;

--
-- Extraindo dados da tabela `ig_log`
--

INSERT INTO `ig_log` (`idLog`, `ig_usuario_idUsuario`, `enderecoIP`, `dataLog`, `descricao`) VALUES
(8, 1, '152.250.161.200', '2015-05-27 00:58:55', 'Fez login.'),
(9, 8, '177.139.245.56', '2015-05-27 12:10:14', 'Fez login.'),
(10, 8, '177.22.136.213', '2015-05-27 12:10:26', 'Fez login.'),
(11, 1, '177.139.245.56', '2015-05-27 12:10:40', 'Fez login.'),
(12, 1, '177.139.245.56', '2015-05-27 12:31:52', 'Fez login.'),
(13, 8, '177.139.245.56', '2015-05-27 18:52:22', 'Fez login.'),
(14, 8, '177.139.245.56', '2015-05-27 18:52:32', 'Fez login.'),
(15, 1, '152.250.161.200', '2015-05-28 11:27:29', 'Fez login.'),
(16, 1, '152.250.161.200', '2015-05-28 11:30:56', 'Fez login.'),
(17, 1, '177.139.245.56', '2015-05-28 18:45:21', 'Fez login.'),
(18, 1, '152.250.161.200', '2015-05-28 22:33:17', 'Fez login.'),
(19, 1, '152.250.161.200', '2015-05-29 00:04:57', 'Fez login.'),
(20, 1, '152.250.161.200', '2015-05-29 00:14:45', 'Fez login.'),
(21, 7, '191.188.64.114', '2015-05-29 01:00:29', 'Fez login.'),
(22, 7, '191.188.64.114', '2015-05-29 01:05:27', 'Fez login.'),
(23, 7, '191.188.64.114', '2015-05-29 01:06:16', 'Fez login.'),
(24, 7, '191.188.64.114', '2015-05-29 01:14:41', 'Fez login.'),
(25, 1, '191.247.231.57', '2015-05-29 10:31:26', 'Fez login.'),
(26, 7, '177.22.136.213', '2015-05-29 11:46:58', 'Fez login.'),
(27, 7, '177.22.136.213', '2015-05-29 11:46:59', 'Fez login.'),
(28, 7, '177.22.136.213', '2015-05-29 11:56:38', 'Fez login.'),
(29, 7, '177.139.245.56', '2015-05-29 15:23:35', 'Fez login.'),
(30, 7, '177.139.245.56', '2015-05-29 15:28:17', 'Fez login.'),
(31, 1, '177.139.245.56', '2015-05-29 18:02:24', 'Fez login.'),
(32, 1, '177.139.245.56', '2015-05-29 18:40:01', 'Fez login.'),
(33, 7, '191.188.64.114', '2015-05-29 21:51:44', 'Fez login.'),
(34, 7, '191.188.64.114', '2015-05-29 21:53:49', 'Fez login.'),
(35, 1, '152.250.161.200', '2015-05-29 21:57:36', 'Fez login.'),
(36, 1, '152.250.161.200', '2015-05-30 10:31:24', 'Fez login.'),
(37, 1, '152.250.161.200', '2015-05-30 10:35:28', 'Fez login.'),
(38, 1, '152.250.161.200', '2015-05-30 11:49:55', 'Fez login.'),
(39, 1, '152.250.161.200', '2015-05-30 13:17:38', 'Fez login.'),
(40, 1, '152.250.161.200', '2015-05-30 14:10:30', 'Fez login.'),
(41, 1, '152.250.161.200', '2015-05-30 17:28:32', 'Fez login.'),
(42, 1, '152.250.161.200', '2015-05-30 18:18:15', 'Fez login.'),
(43, 1, '152.250.161.200', '2015-05-30 19:38:22', 'Fez login.'),
(44, 1, '152.250.161.200', '2015-05-30 21:54:37', 'Fez login.'),
(45, 1, '152.250.161.200', '2015-05-31 08:20:57', 'Fez login.'),
(46, 1, '152.250.161.200', '2015-05-31 10:28:03', 'Fez login.'),
(47, 1, '152.250.161.200', '2015-05-31 15:59:01', 'UPDATE `ig_evento` SET \r\n	`nomeEvento` = ''Teste123'', \r\n	`projeto` = '''', \r\n	`projetoEspecial` = ''3'', \r\n	`idResponsavel` = ''8'', \r\n	`suplente` = ''1'', \r\n	`ig_modalidade_IdModalidade` = 	''1'',\r\n	`ig_tipo_evento_idTipoEvento` = ''4'' \r\n	WHERE `ig_evento`.`idEvento` = 114;'),
(48, 1, '152.250.161.200', '2015-05-31 15:59:01', 'UPDATE `ig_evento` SET \r\n	`nomeEvento` = ''Teste123'', \r\n	`projeto` = '''', \r\n	`projetoEspecial` = ''3'', \r\n	`idResponsavel` = ''8'', \r\n	`suplente` = ''1'', \r\n	`ig_modalidade_IdModalidade` = 	''1'',\r\n	`ig_tipo_evento_idTipoEvento` = ''4'' \r\n	WHERE `ig_evento`.`idEvento` = 114;'),
(49, 1, '152.250.161.200', '2015-05-31 16:00:20', 'UPDATE `ig_evento` SET \r\n	`nomeEvento` = ''Teste123'', \r\n	`projeto` = '''', \r\n	`projetoEspecial` = ''3'', \r\n	`idResponsavel` = ''8'', \r\n	`suplente` = ''1'', \r\n	`ig_modalidade_IdModalidade` = 	''1'',\r\n	`ig_tipo_evento_idTipoEvento` = ''4'' \r\n	WHERE `ig_evento`.`idEvento` = 114;'),
(50, 1, '152.250.161.200', '2015-05-31 16:00:20', 'UPDATE `ig_evento` SET \r\n	`nomeEvento` = ''Teste123'', \r\n	`projeto` = '''', \r\n	`projetoEspecial` = ''3'', \r\n	`idResponsavel` = ''8'', \r\n	`suplente` = ''1'', \r\n	`ig_modalidade_IdModalidade` = 	''1'',\r\n	`ig_tipo_evento_idTipoEvento` = ''4'' \r\n	WHERE `ig_evento`.`idEvento` = 114;'),
(51, 1, '152.250.161.200', '2015-05-31 16:00:56', 'UPDATE `ig_evento` SET \r\n	`nomeEvento` = ''Teste123'', \r\n	`projeto` = '''', \r\n	`projetoEspecial` = ''3'', \r\n	`idResponsavel` = ''8'', \r\n	`suplente` = ''1'', \r\n	`ig_modalidade_IdModalidade` = 	''1'',\r\n	`ig_tipo_evento_idTipoEvento` = ''4'' \r\n	WHERE `ig_evento`.`idEvento` = 114;'),
(52, 1, '152.250.161.200', '2015-05-31 16:00:56', 'UPDATE `ig_evento` SET \r\n	`nomeEvento` = ''Teste123'', \r\n	`projeto` = '''', \r\n	`projetoEspecial` = ''3'', \r\n	`idResponsavel` = ''8'', \r\n	`suplente` = ''1'', \r\n	`ig_modalidade_IdModalidade` = 	''1'',\r\n	`ig_tipo_evento_idTipoEvento` = ''4'' \r\n	WHERE `ig_evento`.`idEvento` = 114;'),
(53, 1, '152.250.161.200', '2015-05-31 16:04:48', 'INSERT INTO `ig_ocorrencia` (`idOcorrencia`, `idTipoOcorrencia`, `ig_comunicao_idCom`, `local`, `idEvento`, `segunda`, `terca`, `quarta`, `quinta`, `sexta`, `sabado`, `domingo`, `dataInicio`, `dataFinal`, `horaInicio`, `horaFinal`, `timezone`, `diaInteiro`, `diaEspecial`, `libras`, `audiodescricao`, `valorIngresso`, `retiradaIngresso`, `localOutros`, `lotacao`, `reservados`, `duracao`, `precoPopular`, `frequencia`) VALUES (NULL, ''4'', NULL, ''6'', ''114'', ''0'', ''0'', ''0'', ''0'', ''on'', ''on'', ''0'', ''2015-05-02'', ''2015-05-24'', ''20:00:00'', ''00:00:00'', ''-3'', ''0'', ''0'', ''0'', ''0'', ''12,00'', ''5'', ''0'', '''', '''', ''180'', ''0'', ''0'');'),
(54, 1, '152.250.161.200', '2015-05-31 16:49:21', 'Fez login.'),
(55, 1, '152.250.161.200', '2015-05-31 16:54:04', 'UPDATE `ig_evento` SET \r\n	`nomeEvento` = ''Teste123'', \r\n	`projeto` = '''', \r\n	`projetoEspecial` = ''1'', \r\n	`idResponsavel` = ''1'', \r\n	`suplente` = ''1'', \r\n	`ig_modalidade_IdModalidade` = 	''1'',\r\n	`ig_tipo_evento_idTipoEvento` = ''1'' \r\n	WHERE `ig_evento`.`idEvento` = 115;'),
(56, 1, '152.250.161.200', '2015-05-31 17:10:24', 'UPDATE `ig_evento` SET \r\n	`nomeEvento` = '''', \r\n	`projeto` = '''', \r\n	`projetoEspecial` = '''', \r\n	`idResponsavel` = '''', \r\n	`suplente` = '''', \r\n	`ig_modalidade_IdModalidade` = 	'''',\r\n	`ig_tipo_evento_idTipoEvento` = '''' \r\n	WHERE `ig_evento`.`idEvento` = 115;'),
(57, 1, '152.250.161.200', '2015-05-31 17:16:43', 'UPDATE `ig_evento` SET \r\n	`nomeEvento` = '''', \r\n	`projeto` = '''', \r\n	`projetoEspecial` = '''', \r\n	`idResponsavel` = '''', \r\n	`suplente` = '''', \r\n	`ig_modalidade_IdModalidade` = 	'''',\r\n	`ig_tipo_evento_idTipoEvento` = '''' \r\n	WHERE `ig_evento`.`idEvento` = 115;'),
(58, 1, '152.250.161.200', '2015-05-31 17:17:29', 'UPDATE `ig_evento` SET \r\n	`autor` = ''teste123            '', \r\n	`fichaTecnica` = ''teste123             '', \r\n	`faixaEtaria` = ''1'' \r\n	WHERE `ig_evento`.`idEvento` = 115;'),
(59, 1, '152.250.161.200', '2015-05-31 17:17:46', 'UPDATE `ig_evento` SET \r\n	`autor` = ''teste123                                '', \r\n	`fichaTecnica` = ''teste123                                 '', \r\n	`faixaEtaria` = ''1'' \r\n	WHERE `ig_evento`.`idEvento` = 115;'),
(60, 1, '152.250.161.200', '2015-05-31 17:19:14', 'UPDATE `ig_evento` SET \r\n	`autor` = ''Retorna uma string com barras invertidas antes de caracteres que precisam ser escapados para serem escapados em query a banco de dados, etc. Estes caracteres são aspas simples (\\''), aspas duplas (\\"), barra invertida (\\\\) e NUL (o byte NULL).\r\n\r\nUm exemplo do uso de addslashes() é quando você esta entrando com dados em um banco de dados. Por exemplo, para inserir o nome O\\''reilly em um banco de dados, você vai precisar escapa-lo. A maior parte dos banco de dados faz isto com \\\\ o que nos leva a O\\\\\\''reilly. Isto é apenas para colocar os dados no banco de dados, a \\\\ não será inserida. Tendo a diretiva do PHP magic_quotes_sybase em on fará com que \\'' seja escapada com outra \\''.\r\n\r\nA diretiva do PHP magic_quotes_gpc é on por padrão, e ela essencialmente executa addslashes() para todos dados de GET, POST e COOKIE. Não use addslashes() em strings que já foram escapadas com magic_quotes_gpc já que você acabara escapando duas vezes. A função get_magic_quotes_gpc() pode dar uma mão para conferir isto.'', \r\n	`fichaTecnica` = ''Retorna uma string com barras invertidas antes de caracteres que precisam ser escapados para serem escapados em query a banco de dados, etc. Estes caracteres são aspas simples (\\''), aspas duplas (\\"), barra invertida (\\\\) e NUL (o byte NULL).\r\n\r\nUm exemplo do uso de addslashes() é quando você esta entrando com dados em um banco de dados. Por exemplo, para inserir o nome O\\''reilly em um banco de dados, você vai precisar escapa-lo. A maior parte dos banco de dados faz isto com \\\\ o que nos leva a O\\\\\\''reilly. Isto é apenas para colocar os dados no banco de dados, a \\\\ não será inserida. Tendo a diretiva do PHP magic_quotes_sybase em on fará com que \\'' seja escapada com outra \\''.\r\n\r\nA diretiva do PHP magic_quotes_gpc é on por padrão, e ela essencialmente executa addslashes() para todos dados de GET, POST e COOKIE. Não use addslashes() em strings que já foram escapadas com magic_quotes_gpc já que você acabara escapando duas vezes. A função get_magic_quotes_gpc() pode dar uma mão para conferir isto.'', \r\n	`faixaEtaria` = ''1'' \r\n	WHERE `ig_evento`.`idEvento` = 115;'),
(61, 1, '152.250.161.200', '2015-05-31 17:19:24', 'UPDATE `ig_evento` SET \r\n	`autor` = ''Retorna uma string com barras invertidas antes de caracteres que precisam ser escapados para serem escapados em query a banco de dados, etc. Estes caracteres são aspas simples (\\''), aspas duplas (\\"), barra invertida (\\\\) e NUL (o byte NULL).\r\n\r\nUm exemplo do uso de addslashes() é quando você esta entrando com dados em um banco de dados. Por exemplo, para inserir o nome O\\''reilly em um banco de dados, você vai precisar escapa-lo. A maior parte dos banco de dados faz isto com \\\\ o que nos leva a O\\\\\\''reilly. Isto é apenas para colocar os dados no banco de dados, a \\\\ não será inserida. Tendo a diretiva do PHP magic_quotes_sybase em on fará com que \\'' seja escapada com outra \\''.\r\n\r\nA diretiva do PHP magic_quotes_gpc é on por padrão, e ela essencialmente executa addslashes() para todos dados de GET, POST e COOKIE. Não use addslashes() em strings que já foram escapadas com magic_quotes_gpc já que você acabara escapando duas vezes. A função get_magic_quotes_gpc() pode dar uma mão para conferir isto.'', \r\n	`fichaTecnica` = ''Retorna uma string com barras invertidas antes de caracteres que precisam ser escapados para serem escapados em query a banco de dados, etc. Estes caracteres são aspas simples (\\''), aspas duplas (\\"), barra invertida (\\\\) e NUL (o byte NULL).\r\n\r\nUm exemplo do uso de addslashes() é quando você esta entrando com dados em um banco de dados. Por exemplo, para inserir o nome O\\''reilly em um banco de dados, você vai precisar escapa-lo. A maior parte dos banco de dados faz isto com \\\\ o que nos leva a O\\\\\\''reilly. Isto é apenas para colocar os dados no banco de dados, a \\\\ não será inserida. Tendo a diretiva do PHP magic_quotes_sybase em on fará com que \\'' seja escapada com outra \\''.\r\n\r\nA diretiva do PHP magic_quotes_gpc é on por padrão, e ela essencialmente executa addslashes() para todos dados de GET, POST e COOKIE. Não use addslashes() em strings que já foram escapadas com magic_quotes_gpc já que você acabara escapando duas vezes. A função get_magic_quotes_gpc() pode dar uma mão para conferir isto.'', \r\n	`faixaEtaria` = ''1'' \r\n	WHERE `ig_evento`.`idEvento` = 115;'),
(62, 1, '152.250.161.200', '2015-05-31 17:19:54', 'UPDATE `ig_evento` SET \r\n	`nomeEvento` = ''Teste PHPMySQL'', \r\n	`projeto` = '''', \r\n	`projetoEspecial` = ''4'', \r\n	`idResponsavel` = ''1'', \r\n	`suplente` = ''8'', \r\n	`ig_modalidade_IdModalidade` = 	''7'',\r\n	`ig_tipo_evento_idTipoEvento` = ''16'' \r\n	WHERE `ig_evento`.`idEvento` = 115;'),
(63, 1, '152.250.161.200', '2015-05-31 17:41:15', 'UPDATE `ig_evento` SET \r\n	`sinopse` = ''Para compartilhar esse conteúdo, por favor utilize o link http://www1.folha.uol.com.br/ilustrada/2015/05/1635367-documentario-constroi-colagem-sensivel-e-divertida-da-vida-de-cauby-peixoto.shtml ou as ferramentas oferecidas na página. Textos, fotos, artes e vídeos da Folha estão protegidos pela legislação brasileira sobre direito autoral. Não reproduza o conteúdo do jornal em qualquer meio de comunicação, eletrônico ou impresso, sem autorização da Folhapress (pesquisa@folhapress.com.br). As regras têm como objetivo proteger o investimento que a Folha faz na qualidade de seu jornalismo. Se precisa copiar trecho de texto da Folha para uso privado, por favor logue-se como assinante ou cadastrado.'', \r\n	`releaseCom` = ''Para compartilhar esse conteúdo, por favor utilize o link http://www1.folha.uol.com.br/ilustrada/2015/05/1635367-documentario-constroi-colagem-sensivel-e-divertida-da-vida-de-cauby-peixoto.shtml ou as ferramentas oferecidas na página. Textos, fotos, artes e vídeos da Folha estão protegidos pela legislação brasileira sobre direito autoral. Não reproduza o conteúdo do jornal em qualquer meio de comunicação, eletrônico ou impresso, sem autorização da Folhapress (pesquisa@folhapress.com.br). As regras têm como objetivo proteger o investimento que a Folha faz na qualidade de seu jornalismo. Se precisa copiar trecho de texto da Folha para uso privado, por favor logue-se como assinante ou cadastrado.'', \r\n	`parecerArtistico` = '''', \r\n	`linksCom` = ''http://futebol.placar.esporte.uol.com.br/futebol/brasileirao/2015/05/31/internacional-x-sao-paulo.htm''\r\n	WHERE `ig_evento`.`idEvento` = 115;'),
(64, 1, '152.250.161.200', '2015-05-31 17:41:24', 'UPDATE `ig_evento` SET \r\n	`sinopse` = ''Para compartilhar esse conteúdo, por favor utilize o link http://www1.folha.uol.com.br/ilustrada/2015/05/1635367-documentario-constroi-colagem-sensivel-e-divertida-da-vida-de-cauby-peixoto.shtml ou as ferramentas oferecidas na página. Textos, fotos, artes e vídeos da Folha estão protegidos pela legislação brasileira sobre direito autoral. Não reproduza o conteúdo do jornal em qualquer meio de comunicação, eletrônico ou impresso, sem autorização da Folhapress (pesquisa@folhapress.com.br). As regras têm como objetivo proteger o investimento que a Folha faz na qualidade de seu jornalismo. Se precisa copiar trecho de texto da Folha para uso privado, por favor logue-se como assinante ou cadastrado.'', \r\n	`releaseCom` = ''Para compartilhar esse conteúdo, por favor utilize o link http://www1.folha.uol.com.br/ilustrada/2015/05/1635367-documentario-constroi-colagem-sensivel-e-divertida-da-vida-de-cauby-peixoto.shtml ou as ferramentas oferecidas na página. Textos, fotos, artes e vídeos da Folha estão protegidos pela legislação brasileira sobre direito autoral. Não reproduza o conteúdo do jornal em qualquer meio de comunicação, eletrônico ou impresso, sem autorização da Folhapress (pesquisa@folhapress.com.br). As regras têm como objetivo proteger o investimento que a Folha faz na qualidade de seu jornalismo. Se precisa copiar trecho de texto da Folha para uso privado, por favor logue-se como assinante ou cadastrado.'', \r\n	`parecerArtistico` = '''', \r\n	`linksCom` = ''http://futebol.placar.esporte.uol.com.br/futebol/brasileirao/2015/05/31/internacional-x-sao-paulo.htm''\r\n	WHERE `ig_evento`.`idEvento` = 115;'),
(65, 1, '152.250.161.200', '2015-05-31 17:42:36', 'UPDATE `ig_evento` SET \r\n	`sinopse` = ''Para compartilhar esse conteúdo, por favor utilize o link http://www1.folha.uol.com.br/ilustrada/2015/05/1635367-documentario-constroi-colagem-sensivel-e-divertida-da-vida-de-cauby-peixoto.shtml ou as ferramentas oferecidas na página. Textos, fotos, artes e vídeos da Folha estão protegidos pela legislação brasileira sobre direito autoral. Não reproduza o conteúdo do jornal em qualquer meio de comunicação, eletrônico ou impresso, sem autorização da Folhapress (pesquisa@folhapress.com.br). As regras têm como objetivo proteger o investimento que a Folha faz na qualidade de seu jornalismo. Se precisa copiar trecho de texto da Folha para uso privado, por favor logue-se como assinante ou cadastrado.'', \r\n	`releaseCom` = ''Para compartilhar esse conteúdo, por favor utilize o link http://www1.folha.uol.com.br/ilustrada/2015/05/1635367-documentario-constroi-colagem-sensivel-e-divertida-da-vida-de-cauby-peixoto.shtml ou as ferramentas oferecidas na página. Textos, fotos, artes e vídeos da Folha estão protegidos pela legislação brasileira sobre direito autoral. Não reproduza o conteúdo do jornal em qualquer meio de comunicação, eletrônico ou impresso, sem autorização da Folhapress (pesquisa@folhapress.com.br). As regras têm como objetivo proteger o investimento que a Folha faz na qualidade de seu jornalismo. Se precisa copiar trecho de texto da Folha para uso privado, por favor logue-se como assinante ou cadastrado.'', \r\n	`parecerArtistico` = '''', \r\n	`linksCom` = ''http://futebol.placar.esporte.uol.com.br/futebol/brasileirao/2015/05/31/internacional-x-sao-paulo.htm''\r\n	WHERE `ig_evento`.`idEvento` = 115;'),
(66, 1, '152.250.161.200', '2015-05-31 17:43:45', 'UPDATE `ig_evento` SET \r\n	`sinopse` = ''Para compartilhar esse conteúdo, por favor utilize o link http://www1.folha.uol.com.br/ilustrada/2015/05/1635367-documentario-constroi-colagem-sensivel-e-divertida-da-vida-de-cauby-peixoto.shtml ou as ferramentas oferecidas na página. Textos, fotos, artes e vídeos da Folha estão protegidos pela legislação brasileira sobre direito autoral. Não reproduza o conteúdo do jornal em qualquer meio de comunicação, eletrônico ou impresso, sem autorização da Folhapress (pesquisa@folhapress.com.br). As regras têm como objetivo proteger o investimento que a Folha faz na qualidade de seu jornalismo. Se precisa copiar trecho de texto da Folha para uso privado, por favor logue-se como assinante ou cadastrado.'', \r\n	`releaseCom` = ''Para compartilhar esse conteúdo, por favor utilize o link http://www1.folha.uol.com.br/ilustrada/2015/05/1635367-documentario-constroi-colagem-sensivel-e-divertida-da-vida-de-cauby-peixoto.shtml ou as ferramentas oferecidas na página. Textos, fotos, artes e vídeos da Folha estão protegidos pela legislação brasileira sobre direito autoral. Não reproduza o conteúdo do jornal em qualquer meio de comunicação, eletrônico ou impresso, sem autorização da Folhapress (pesquisa@folhapress.com.br). As regras têm como objetivo proteger o investimento que a Folha faz na qualidade de seu jornalismo. Se precisa copiar trecho de texto da Folha para uso privado, por favor logue-se como assinante ou cadastrado.'', \r\n	`parecerArtistico` = ''http://futebol.placar.esporte.uol.com.br/futebol/brasileirao/2015/05/31/internacional-x-sao-paulo.htm'', \r\n	`linksCom` = ''http://futebol.placar.esporte.uol.com.br/futebol/brasileirao/2015/05/31/internacional-x-sao-paulo.htm''\r\n	WHERE `ig_evento`.`idEvento` = 115;'),
(67, 1, '152.250.161.200', '2015-05-31 17:44:46', 'UPDATE `ig_evento` SET \r\n	`sinopse` = ''Para compartilhar esse conteúdo, por favor utilize o link http://www1.folha.uol.com.br/ilustrada/2015/05/1635367-documentario-constroi-colagem-sensivel-e-divertida-da-vida-de-cauby-peixoto.shtml ou as ferramentas oferecidas na página. Textos, fotos, artes e vídeos da Folha estão protegidos pela legislação brasileira sobre direito autoral. Não reproduza o conteúdo do jornal em qualquer meio de comunicação, eletrônico ou impresso, sem autorização da Folhapress (pesquisa@folhapress.com.br). As regras têm como objetivo proteger o investimento que a Folha faz na qualidade de seu jornalismo. Se precisa copiar trecho de texto da Folha para uso privado, por favor logue-se como assinante ou cadastrado.'', \r\n	`releaseCom` = ''Para compartilhar esse conteúdo, por favor utilize o link http://www1.folha.uol.com.br/ilustrada/2015/05/1635367-documentario-constroi-colagem-sensivel-e-divertida-da-vida-de-cauby-peixoto.shtml ou as ferramentas oferecidas na página. Textos, fotos, artes e vídeos da Folha estão protegidos pela legislação brasileira sobre direito autoral. Não reproduza o conteúdo do jornal em qualquer meio de comunicação, eletrônico ou impresso, sem autorização da Folhapress (pesquisa@folhapress.com.br). As regras têm como objetivo proteger o investimento que a Folha faz na qualidade de seu jornalismo. Se precisa copiar trecho de texto da Folha para uso privado, por favor logue-se como assinante ou cadastrado.'', \r\n	`parecerArtistico` = ''Workshop de propostas para o desenvolvimento de políticas públicas para a Inovação Cidadã\r\n30 de julho de 2014\r\nCentro Cultural São Paulo\r\nRua Vergueiro 1000\r\nSão Paulo, Brasil\r\n\r\nRepresentantes de governos locais e nacionais, empresas, organismos internacionais, academia e coletivos sociais reúnem-se em São Paulo para debater sobre propostas para o desenvolvimento de políticas públicas para o impulso da Inovação Cidadã em Ibero-América.\r\nDos aportes feitos no workshop vão sistematizar-se as idéias para a conformação do documento que será entregue às Chefas e aos Chefes de Estado e de Governo na Cúpula de Veracruz de este ano.\r\n\r\nPrograma\r\n9:00 Bem-vinda e introdução: Políticas públicas e inovação cidadã\r\nJuca Ferreira, Secretário de Cultura da Prefeitura de São Paulo\r\n9:15 Apresentação Cidadania 2.0 / Inovação Cidadã\r\nCidadania 2.0 \r\n9:25 Objetivos e metodologia do workshop: \r\nCidadania 2.0 \r\n9:30 Inicio workshop \r\nTrabalho em subgrupos sobre propostas do documento, e novas propostas\r\n12:00 Almoço\r\n13:00 Sessão plenária \r\nDebate coletivo sobre propostas do documento e novas propostas:\r\n13:00-13:30 conexão com Madrid (Medialab-Prado): propostas documento e novas propostas\r\n13:30-15:00 debate propostas documento (SPaulo)\r\n15:00-16:30 apresentação e debate de propostas novas (SPaulo)  \r\n17:00 Orientações futuras e encerramento\r\nJuca Ferreira, Secretário de Cultura da Prefeitura de São Paulo e Cidadania 2.0 \r\n\r\n\r\n\r\nMetodología do Workshop\r\n\r\n1.	Objetivo \r\nDebater sobre propostas para o desenvolvimento de políticas públicas para o impulso da inovação cidadã, realizadas pelos participantes da Equipe de trabalho. O objetivo e criar um documento de propostas numa base consensual para entregar as Chefas e Chefes de Estado ibero-americanos durante a Cúpula de Veracruz.\r\n\r\n2.	Processo\r\nAs propostas realizadas previamente via Web no formulário http://www.ciudadania20.org/politicaspublicas/ pela Equipe de trabalho e cidadãos em geral vão ser categorizadas previamente em temáticas principais por Cidadania 2.0 e levadas ao workshop de São Paulo para trabalhar sobre elas num documento.\r\nOs participantes vão reunir-se em grupos heterogêneos (representantes de movimentos sociais, empresas, academia, organismos internacionais e governos) e vão debater sobre cada uma das propostas do documento, além de gerar novas propostas que posteriormente podam ser incluídas no documento para as Chefas e os Chefes de Estado. Dado que não todos os participantes estarão presentes em São Paulo, serão incluídos nos grupos mediante Skype através de dispositivo portátil. \r\nSimultaneamente vai reunir-se um grupo no Medialab-Prado em Madrid com o mesmo objetivo de debater e gerar novas propostas.\r\nSeguidamente, vai haver um espaço de apresentação coletiva das propostas de cada grupo mediante o seu porta-voz (incluindo o grupo de Madrid), e um debate entre todos os participantes, com o fim de gerar uma visão coletiva das propostas. \r\nFinalmente, o workshop vai finalizar com conclusões de Juca Ferreira e a equipe de Cidadania 2.0. \r\n\r\n3.	Ferramenta \r\nCommentpress vai ser a ferramenta a utilizar (a mesma utilizada durante todos os processos colaborativos de Inovação Cidadã), onde cada grupo vai funcionar como um usuário (grupo 1, grupo 2, etc.) plasmando em forma de comentário os seus aportes a cada proposta. Também os comentários sobre o debate coletivo vão ser incluídos em commentpress como um novo usuário. \r\nDe esta forma, a relatoria se irá construindo in situ de forma aberta e online. Isso permite que cidadãos não presentes no workshop também podam incluir os seus comentários em forma de propostas que vão ser incorporados ao debate.\r\n\r\n4.	Produto esperado \r\nAs propostas numa base consensual surgidas no workshop vão ser sistematizadas nos dias posteriores por Cidadania 2.0 para conformar o documento de propostas para o desenvolvimento de políticas públicas para as Chefas e os Chefes de Estado que vamos levar a Veracruz. O documento estará online até novembro.\r\n'', \r\n	`linksCom` = ''http://futebol.placar.esporte.uol.com.br/futebol/brasileirao/2015/05/31/internacional-x-sao-paulo.htm''\r\n	WHERE `ig_evento`.`idEvento` = 115;'),
(68, 1, '152.250.161.200', '2015-05-31 18:38:41', 'Fez login.'),
(69, 1, '152.250.161.200', '2015-05-31 18:57:16', 'UPDATE `ig_evento` SET \r\n	`nomeEvento` = ''Teste PHPMySQL'', \r\n	`projeto` = '''', \r\n	`projetoEspecial` = ''4'', \r\n	`idResponsavel` = ''1'', \r\n	`suplente` = ''8'', \r\n	`ig_modalidade_IdModalidade` = 	''7'',\r\n	`ig_tipo_evento_idTipoEvento` = ''2'' \r\n	WHERE `ig_evento`.`idEvento` = 115;'),
(70, 1, '152.250.161.200', '2015-05-31 19:39:51', 'UPDATE `ig_evento` SET \r\n	`nomeEvento` = ''Teste PHPMySQL'', \r\n	`projeto` = '''', \r\n	`projetoEspecial` = ''4'', \r\n	`idResponsavel` = ''1'', \r\n	`suplente` = ''8'', \r\n	`ig_modalidade_IdModalidade` = 	''7'',\r\n	`ig_tipo_evento_idTipoEvento` = ''3'' \r\n	WHERE `ig_evento`.`idEvento` = 115;'),
(71, 1, '152.250.161.200', '2015-05-31 19:47:25', 'UPDATE `ig_evento` SET \r\n	`nomeEvento` = ''Teste PHPMySQL'', \r\n	`projeto` = '''', \r\n	`projetoEspecial` = ''4'', \r\n	`idResponsavel` = ''1'', \r\n	`suplente` = ''8'', \r\n	`ig_modalidade_IdModalidade` = 	''7'',\r\n	`ig_tipo_evento_idTipoEvento` = ''12'' \r\n	WHERE `ig_evento`.`idEvento` = 115;'),
(72, 1, '152.250.161.200', '2015-05-31 20:33:42', 'UPDATE `ig_evento` SET \r\n	`nomeEvento` = ''Teste PHPMySQL'', \r\n	`projeto` = '''', \r\n	`projetoEspecial` = ''4'', \r\n	`idResponsavel` = ''1'', \r\n	`suplente` = ''8'', \r\n	`ig_modalidade_IdModalidade` = 	''7'',\r\n	`ig_tipo_evento_idTipoEvento` = ''4'' \r\n	WHERE `ig_evento`.`idEvento` = 115;'),
(73, 1, '152.250.161.200', '2015-05-31 21:20:15', 'UPDATE `ig_evento` SET \r\n	`nomeEvento` = ''Teste PHPMySQL'', \r\n	`projeto` = '''', \r\n	`projetoEspecial` = ''2'', \r\n	`idResponsavel` = ''1'', \r\n	`suplente` = ''8'', \r\n	`ig_modalidade_IdModalidade` = 	''7'',\r\n	`ig_tipo_evento_idTipoEvento` = ''7'' \r\n	WHERE `ig_evento`.`idEvento` = 115;'),
(74, 1, '152.250.161.200', '2015-06-01 01:00:58', 'Fez login.'),
(75, 1, '152.250.161.200', '2015-06-01 01:05:34', 'UPDATE `ig_evento` SET \r\n	`nomeEvento` = ''teste123'', \r\n	`projeto` = '''', \r\n	`projetoEspecial` = ''1'', \r\n	`idResponsavel` = ''1'', \r\n	`suplente` = ''1'', \r\n	`ig_modalidade_IdModalidade` = 	''1'',\r\n	`ig_tipo_evento_idTipoEvento` = ''1'' \r\n	WHERE `ig_evento`.`idEvento` = 121;'),
(76, 1, '152.250.161.200', '2015-06-01 10:35:49', 'Fez login.'),
(77, 1, '152.250.161.200', '2015-06-01 10:39:35', 'UPDATE `ig_evento` SET \r\n	`nomeEvento` = ''The Beatles'', \r\n	`projeto` = ''Quinta na faixa'', \r\n	`projetoEspecial` = ''7'', \r\n	`idResponsavel` = ''1'', \r\n	`suplente` = ''7'', \r\n	`ig_modalidade_IdModalidade` = 	''7'',\r\n	`ig_tipo_evento_idTipoEvento` = ''12'' \r\n	WHERE `ig_evento`.`idEvento` = 123;'),
(78, 1, '152.250.161.200', '2015-06-01 10:40:21', 'UPDATE `ig_evento` SET \r\n	`autor` = ''The Beatles'', \r\n	`fichaTecnica` = ''John, Paul, George e Ringo'', \r\n	`faixaEtaria` = ''6'' \r\n	WHERE `ig_evento`.`idEvento` = 123;'),
(79, 1, '152.250.161.200', '2015-06-01 10:42:05', 'UPDATE `ig_evento` SET \r\n	`sinopse` = ''The Beatles foi uma banda de rock britânica, formada em Liverpool em 1960. É o grupo musical mais bem-sucedido e aclamado da história da música popular.1 A partir de 1962, o grupo era formado por John Lennon (guitarra rítmica e vocal), Paul McCartney (baixo, piano e vocal), George Harrison (guitarra solo e vocal) e Ringo Starr (bateria e vocal). Enraizada do skiffle e do rock and roll da década de 1950, a banda veio mais tarde a assumir diversos gêneros que vão do folk rock ao rock psicodélico, muitas vezes incorporando elementos da música clássica e outros, em formas inovadoras e criativas. Sua crescente popularidade, que a imprensa britânica chamava de \\"Beatlemania\\", fez com que eles crescessem em sofisticação. Os Beatles vieram a ser percebidos como a encarnação de ideais progressistas e sua influência se estendeu até as revoluções sociais e culturais da década de 1960.\r\n\r\nCom a formação inicial de Lennon, McCartney, Harrison, Stuart Sutcliffe (baixo) e Pete Best (bateria), os Beatles construíram sua reputação nos pubs de Liverpool e Hamburgo durante um período de três anos a partir de 1960. Sutcliffe deixou o grupo em 61, e Best foi substituído por Starr no ano seguinte. Abastecida de equipamentos profissionais moldados por Brian Epstein, que depois se ofereceu para gerenciar a banda, e com seu potencial reforçado pela criatividade do produtor George Martin, os Beatles alcançaram um sucesso imediato no Reino Unido com seu primeiro single \\"Love Me Do\\". Ganhando popularidade internacional a partir do ano seguinte, excursionaram extensivamente até 1966, quando retiraram-se para trabalhar em estúdio até sua dissolução definitiva em 1970. Cada músico então seguiu para uma carreira independente. McCartney e Starr continuam ativos; Lennon foi assassinado em 1980, e Harrison morreu de câncer em 2001.'', \r\n	`releaseCom` = ''Durante seus anos de estúdio, os Beatles produziram o que a crítica considera um dos seus melhores materiais, incluindo o álbum Sgt. Pepper\\''s Lonely Hearts Club Band (1967), amplamente visto como uma obra-prima. Quatro décadas após sua dissolução, a música do grupo continua a ser muito popular. Os Beatles tiveram mais álbuns em número 1 nas paradas britânicas do que qualquer outro grupo musical.2 De acordo com a RIAA, eles venderam mais álbuns nos Estados Unidos do que qualquer outro artista.3 Em 2008, a Billboard divulgou uma lista dos top-selling de todos os tempos dos artistas Hot 100 para celebrar o cinquentenário das paradas de singles dos Estados Unidos, e a banda permaneceu em primeiro lugar.4 Eles já foram honrados com 8 Grammy Awards,5 e 15 Ivor Novello Awards da BASCA.6 . Já venderam mais de um bilhão de discos. Os Beatles foram coletivamente incluídos na compilação da revista Time das 100 pessoas mais importantes e influentes do século XX.7'', \r\n	`parecerArtistico` = ''Em Março de 1957, empolgado com o skiffle que Lonnie Donegan popularizou com seus sons improvisados, John Lennon criou uma banda composta por colegas da escola Quarry Bank School — que incluía seu melhor amigo na época, Pete Shotton — primeiramente chamada de The Black Jacks, mas logo definida como The Quarrymen (em homenagem à escola).12 Inicialmente, além dos dois, a banda era composta por Eric Griffths (violão), Bill Smith (baixo improvisado) e Rod Davis (banjo). Em 6 de julho de 1957, Paul McCartney havia assistido uma apresentação da banda em uma festa na Igreja St. Peter, e Ivan Vaughan, amigo de John Lennon e colega de classe de Paul, apresentou-lhe a Lennon; Paul foi convidado a ingressar na banda e, no mesmo ano, mostrou a Lennon a composição \\"I\\''ve Lost My Little Girl\\".12 Em 6 de fevereiro de 1958, o jovem guitarrista George Harrison juntou-se à banda,13 apresentado por Paul que o teria conhecido por acaso num ônibus.14 Apesar da relutância inicial de Lennon pelo fato de Harrison ser três anos mais novo que ele (na época, com quinze anos),14 McCartney insistiu depois de uma demonstração de George e este terminou ingressando no grupo. Lennon e McCartney desempenharam a guitarra rítmica durante esse período e, após o baterista oficial do Quarrymen, Colin Hanton deixar a banda, em 1959, depois de uma discussão com os outros membros, teve uma alta rotatividade de bateristas. Stuart Sutcliffe, colega de Lennon numa escola de arte de Liverpool, aderiu ao baixo em janeiro de 1960, a pedido do amigo.12'', \r\n	`linksCom` = ''http://pt.wikipedia.org/wiki/The_Beatles''\r\n	WHERE `ig_evento`.`idEvento` = 123;'),
(80, 1, '152.250.161.200', '2015-06-01 11:25:30', 'Fez login.'),
(81, 1, '152.250.161.200', '2015-06-01 12:03:48', 'Fez login.'),
(82, 1, '152.250.161.200', '2015-06-01 12:04:01', 'UPDATE `ig_evento` SET \r\n	`nomeEvento` = ''Teste123'', \r\n	`projeto` = '''', \r\n	`projetoEspecial` = ''1'', \r\n	`idResponsavel` = ''1'', \r\n	`suplente` = ''1'', \r\n	`ig_modalidade_IdModalidade` = 	''1'',\r\n	`ig_tipo_evento_idTipoEvento` = ''1'' \r\n	WHERE `ig_evento`.`idEvento` = 125;'),
(83, 1, '152.250.161.200', '2015-06-01 13:12:19', 'UPDATE `ig_evento` SET \r\n	`nomeEvento` = ''The Beatles'', \r\n	`projeto` = '''', \r\n	`projetoEspecial` = ''1'', \r\n	`idResponsavel` = ''1'', \r\n	`suplente` = ''1'', \r\n	`ig_modalidade_IdModalidade` = 	''1'',\r\n	`ig_tipo_evento_idTipoEvento` = ''1'' \r\n	WHERE `ig_evento`.`idEvento` = 125;'),
(84, 1, '152.250.161.200', '2015-06-01 15:26:34', 'Fez login.'),
(85, 1, '152.250.161.200', '2015-06-01 15:32:25', 'UPDATE `ig_evento` SET \r\n	`autor` = ''Blur é uma banda inglesa de rock alternativo. Formada em 1989, em Londres, o grupo é formado pelo vocalista Damon Albarn, o guitarrista Graham Coxon, o baixista Alex James e o baterista Dave Rowntree.'', \r\n	`fichaTecnica` = ''Blur é uma banda inglesa de rock alternativo. Formada em 1989, em Londres, o grupo é formado pelo vocalista Damon Albarn, o guitarrista Graham Coxon, o baixista Alex James e o baterista Dave Rowntree.'', \r\n	`faixaEtaria` = ''5'' \r\n	WHERE `ig_evento`.`idEvento` = 111;');
INSERT INTO `ig_log` (`idLog`, `ig_usuario_idUsuario`, `enderecoIP`, `dataLog`, `descricao`) VALUES
(86, 1, '152.250.161.200', '2015-06-01 15:33:06', 'UPDATE `ig_evento` SET \r\n	`sinopse` = ''Leisure (1991)[editar | editar código-fonte]\r\nO primeiro álbum da banda estilisticamente não se diferenciava muito do que se fazia na época na Inglaterra, explorava letras curtas, simples e diretas, por vezes sem refrões, com os vocais de Damon Albarn se fundindo com a guitarra de Graham Coxon, estes sim já se destacando, junto com a combinação do baixo de Alex James e a bateria de Rowntree. As músicas exploravam uma sonoridade inclinada ao psicodelismo advindo dos Stone Roses e outros representantes da cena musical “Madchester”, que já mostrava declínio naquele ano de 1991. A primeira faixa, e também o primeiro single da banda, She’s So High abria o álbum de forma musicalmente fantástica, com sua letra curta e vaga, o que era uma regra poucas vezes desobedecida no álbum. Aqui é explorado um dos lados mais sombrios de Blur, com a canção Sing, que pode ser considerada um dos grandes clássicos da banda e já apresentava um lado diferenciado de Blur, e talvez o seu potencial, que seria melhor explorado a partir do álbum “Blur”. Sing seria incluída, bem posteriormente, na trilha sonora do filme Trainspotting.\r\n\r\nModern Life Is Rubbish (1993)[editar | editar código-fonte]\r\nO segundo álbum da banda abandonou boa parte da psicodelia e as letras curtas de Leisure e mostrou letras que indicam uma localização e uma época. For Tomorrow abre o disco, onde são citados vários pontos de Londres. Em Blue Jeans mais um passeio por Londres, supostamente retratando o relacionamento de Damon Albarn com Justine (Elastica). Neste álbum começam a aparecer as músicas centradas em personagens, retratados de forma irônica, sendo Colin Zeal o mais famoso. Destaque neste álbum também para Chemical World e Sunday Sunday. Chemical World merece destaque por si só, é um retrato da vida moderna nas grandes cidades, trabalhos ingratos, dificuldades para pagar o aluguel, falta de perspectivas e a solidão, ironicamente em um lugar superpopuloso.\r\n\r\nParklife (1994)[editar | editar código-fonte]\r\nParklife, praticamente uma continuação de Modern Life Is Rubbish, abria com Girls & Boys, um dos maiores \\"hits\\" da banda. Os personagens que retratam a sociedade continuam, um Inglês que sonha em se mudar para os USA em Magic America e Tracy Jacks, um funcionário público. As críticas ou ironias com a sociedada inglesa também aparecem em London Loves. Porém, há também a melancolia de This is a Low, Badhead, To the End eEnd of Century. Parklife é um álbum consistente em termos musicais, embora seja uma coletânea de histórias que nem sempre se interligam.\r\n\r\nThe Great Escape (1995)[editar | editar código-fonte]\r\nThe Great Escape continua com os personagens, estereótipos satirizados em diversas faixas, não é a toa que o álbum abre com Stereotypes. O álbum, embora tenha tido relativo sucesso, já demonstrava uma queda na fórmula e indicava novos rumos em canções como He Thought of Cars e The Universal, uma das canções mais significativas da banda. The Great Escape recebeu boas avaliações, recebendo a nota 9 em 10 por parte da NME3 . Este álbum o último do que ficou conhecido como The Life Trilogy4 , complementando Modern Life Is Rubbish e Parklife.\r\n\r\nBlur (1997)[editar | editar código-fonte]\r\nBlur rompeu com a linha que a banda vinha seguindo nos três últimos álbuns, centrados em personagens da vida britânica pós-thatcherismo5 . Na sonoridade a banda buscou se aproximar do cenário independente dos Estados Unidos como o Pavement e Sonic Youth 6 , essa diferença fica clara em músicas como M.O.R., On Your Own e You\\''re So Great. O álbum conta com Song 2, o maior êxito radiofônico da banda, inclusive no Brasil. Pelo lado melancólico o álbum conta com Beetlebum, Death of a Party e a imensuravelmente triste Strange News From Another Star.\r\n\r\n13 (1999)[editar | editar código-fonte]\r\nEm 13 a banda continua sua mudança de sonoridade, o produtor de longa data Stephen Street foi substituído por Willian Orbit neste álbum. O resultado foi adição de mais elementos experimentais e eletrônicos, se distanciando do rótulo Britpop. 13 abre com Tender, canção que virou hino em praticamente todas as apresentações da banda e, supostamente, mais uma canção dedicada a amada ex-companheira de Damon Albarn, Justine Frischmann. No entanto, 13 é um álbum com temática diversa, com canções novamente baseadas em personagens como Bugman e canções mais leves sobre a infância na cidade natal da banda, como Coffee & TV, que deu luz a um dos vídeo clipes mais famosos da banda, em que uma caixa de leite se aventura pela cidade. Neste álbum também se encontram dois grandes B-Sides do lado mais sombrios da banda Caramel e Battle. Blur teve boa receptividade por parte da crítica especializada7 .\r\n\r\nThink Tank (2003)[editar | editar código-fonte]\r\nGraham Coxon se afasta da banda para se dedicar a seus trabalhos solos. \\"Think Tank\\" é lançado em 2003. Para o lugar de Coxon, foi recrutado Simon Tong, ex-guitarrista do Verve. A única faixa que Coxon participa deste álbum é a última, chamada Battery in your Leg. \\"Think Tank\\" foi aclamado pela crítica, sendo citado em vigésimo lugar nos melhores álbuns da década, pela revista NME. Out of Time, Crazy Beat e Battery in Your Leg são os destaques desse trabalho.\r\n\r\nThe Magic Whip (2015)[editar | editar código-fonte]\r\nApós 12 anos sem criar álbuns de estúdio, já com a volta de Graham Coxon, a banda anuncia seu novo álbum, The Magic Whip, previsto para lançamento em 27 de Abril de 2015, e o lançamento do single Go Out junto com seu videoclipe, capa do álbum e o nome de todas as faixas.'', \r\n	`releaseCom` = ''Leisure (1991)[editar | editar código-fonte]\r\nO primeiro álbum da banda estilisticamente não se diferenciava muito do que se fazia na época na Inglaterra, explorava letras curtas, simples e diretas, por vezes sem refrões, com os vocais de Damon Albarn se fundindo com a guitarra de Graham Coxon, estes sim já se destacando, junto com a combinação do baixo de Alex James e a bateria de Rowntree. As músicas exploravam uma sonoridade inclinada ao psicodelismo advindo dos Stone Roses e outros representantes da cena musical “Madchester”, que já mostrava declínio naquele ano de 1991. A primeira faixa, e também o primeiro single da banda, She’s So High abria o álbum de forma musicalmente fantástica, com sua letra curta e vaga, o que era uma regra poucas vezes desobedecida no álbum. Aqui é explorado um dos lados mais sombrios de Blur, com a canção Sing, que pode ser considerada um dos grandes clássicos da banda e já apresentava um lado diferenciado de Blur, e talvez o seu potencial, que seria melhor explorado a partir do álbum “Blur”. Sing seria incluída, bem posteriormente, na trilha sonora do filme Trainspotting.\r\n\r\nModern Life Is Rubbish (1993)[editar | editar código-fonte]\r\nO segundo álbum da banda abandonou boa parte da psicodelia e as letras curtas de Leisure e mostrou letras que indicam uma localização e uma época. For Tomorrow abre o disco, onde são citados vários pontos de Londres. Em Blue Jeans mais um passeio por Londres, supostamente retratando o relacionamento de Damon Albarn com Justine (Elastica). Neste álbum começam a aparecer as músicas centradas em personagens, retratados de forma irônica, sendo Colin Zeal o mais famoso. Destaque neste álbum também para Chemical World e Sunday Sunday. Chemical World merece destaque por si só, é um retrato da vida moderna nas grandes cidades, trabalhos ingratos, dificuldades para pagar o aluguel, falta de perspectivas e a solidão, ironicamente em um lugar superpopuloso.\r\n\r\nParklife (1994)[editar | editar código-fonte]\r\nParklife, praticamente uma continuação de Modern Life Is Rubbish, abria com Girls & Boys, um dos maiores \\"hits\\" da banda. Os personagens que retratam a sociedade continuam, um Inglês que sonha em se mudar para os USA em Magic America e Tracy Jacks, um funcionário público. As críticas ou ironias com a sociedada inglesa também aparecem em London Loves. Porém, há também a melancolia de This is a Low, Badhead, To the End eEnd of Century. Parklife é um álbum consistente em termos musicais, embora seja uma coletânea de histórias que nem sempre se interligam.\r\n\r\nThe Great Escape (1995)[editar | editar código-fonte]\r\nThe Great Escape continua com os personagens, estereótipos satirizados em diversas faixas, não é a toa que o álbum abre com Stereotypes. O álbum, embora tenha tido relativo sucesso, já demonstrava uma queda na fórmula e indicava novos rumos em canções como He Thought of Cars e The Universal, uma das canções mais significativas da banda. The Great Escape recebeu boas avaliações, recebendo a nota 9 em 10 por parte da NME3 . Este álbum o último do que ficou conhecido como The Life Trilogy4 , complementando Modern Life Is Rubbish e Parklife.\r\n\r\nBlur (1997)[editar | editar código-fonte]\r\nBlur rompeu com a linha que a banda vinha seguindo nos três últimos álbuns, centrados em personagens da vida britânica pós-thatcherismo5 . Na sonoridade a banda buscou se aproximar do cenário independente dos Estados Unidos como o Pavement e Sonic Youth 6 , essa diferença fica clara em músicas como M.O.R., On Your Own e You\\''re So Great. O álbum conta com Song 2, o maior êxito radiofônico da banda, inclusive no Brasil. Pelo lado melancólico o álbum conta com Beetlebum, Death of a Party e a imensuravelmente triste Strange News From Another Star.\r\n\r\n13 (1999)[editar | editar código-fonte]\r\nEm 13 a banda continua sua mudança de sonoridade, o produtor de longa data Stephen Street foi substituído por Willian Orbit neste álbum. O resultado foi adição de mais elementos experimentais e eletrônicos, se distanciando do rótulo Britpop. 13 abre com Tender, canção que virou hino em praticamente todas as apresentações da banda e, supostamente, mais uma canção dedicada a amada ex-companheira de Damon Albarn, Justine Frischmann. No entanto, 13 é um álbum com temática diversa, com canções novamente baseadas em personagens como Bugman e canções mais leves sobre a infância na cidade natal da banda, como Coffee & TV, que deu luz a um dos vídeo clipes mais famosos da banda, em que uma caixa de leite se aventura pela cidade. Neste álbum também se encontram dois grandes B-Sides do lado mais sombrios da banda Caramel e Battle. Blur teve boa receptividade por parte da crítica especializada7 .\r\n\r\nThink Tank (2003)[editar | editar código-fonte]\r\nGraham Coxon se afasta da banda para se dedicar a seus trabalhos solos. \\"Think Tank\\" é lançado em 2003. Para o lugar de Coxon, foi recrutado Simon Tong, ex-guitarrista do Verve. A única faixa que Coxon participa deste álbum é a última, chamada Battery in your Leg. \\"Think Tank\\" foi aclamado pela crítica, sendo citado em vigésimo lugar nos melhores álbuns da década, pela revista NME. Out of Time, Crazy Beat e Battery in Your Leg são os destaques desse trabalho.\r\n\r\nThe Magic Whip (2015)[editar | editar código-fonte]\r\nApós 12 anos sem criar álbuns de estúdio, já com a volta de Graham Coxon, a banda anuncia seu novo álbum, The Magic Whip, previsto para lançamento em 27 de Abril de 2015, e o lançamento do single Go Out junto com seu videoclipe, capa do álbum e o nome de todas as faixas.'', \r\n	`parecerArtistico` = ''Leisure (1991)[editar | editar código-fonte]\r\nO primeiro álbum da banda estilisticamente não se diferenciava muito do que se fazia na época na Inglaterra, explorava letras curtas, simples e diretas, por vezes sem refrões, com os vocais de Damon Albarn se fundindo com a guitarra de Graham Coxon, estes sim já se destacando, junto com a combinação do baixo de Alex James e a bateria de Rowntree. As músicas exploravam uma sonoridade inclinada ao psicodelismo advindo dos Stone Roses e outros representantes da cena musical “Madchester”, que já mostrava declínio naquele ano de 1991. A primeira faixa, e também o primeiro single da banda, She’s So High abria o álbum de forma musicalmente fantástica, com sua letra curta e vaga, o que era uma regra poucas vezes desobedecida no álbum. Aqui é explorado um dos lados mais sombrios de Blur, com a canção Sing, que pode ser considerada um dos grandes clássicos da banda e já apresentava um lado diferenciado de Blur, e talvez o seu potencial, que seria melhor explorado a partir do álbum “Blur”. Sing seria incluída, bem posteriormente, na trilha sonora do filme Trainspotting.\r\n\r\nModern Life Is Rubbish (1993)[editar | editar código-fonte]\r\nO segundo álbum da banda abandonou boa parte da psicodelia e as letras curtas de Leisure e mostrou letras que indicam uma localização e uma época. For Tomorrow abre o disco, onde são citados vários pontos de Londres. Em Blue Jeans mais um passeio por Londres, supostamente retratando o relacionamento de Damon Albarn com Justine (Elastica). Neste álbum começam a aparecer as músicas centradas em personagens, retratados de forma irônica, sendo Colin Zeal o mais famoso. Destaque neste álbum também para Chemical World e Sunday Sunday. Chemical World merece destaque por si só, é um retrato da vida moderna nas grandes cidades, trabalhos ingratos, dificuldades para pagar o aluguel, falta de perspectivas e a solidão, ironicamente em um lugar superpopuloso.\r\n\r\nParklife (1994)[editar | editar código-fonte]\r\nParklife, praticamente uma continuação de Modern Life Is Rubbish, abria com Girls & Boys, um dos maiores \\"hits\\" da banda. Os personagens que retratam a sociedade continuam, um Inglês que sonha em se mudar para os USA em Magic America e Tracy Jacks, um funcionário público. As críticas ou ironias com a sociedada inglesa também aparecem em London Loves. Porém, há também a melancolia de This is a Low, Badhead, To the End eEnd of Century. Parklife é um álbum consistente em termos musicais, embora seja uma coletânea de histórias que nem sempre se interligam.\r\n\r\nThe Great Escape (1995)[editar | editar código-fonte]\r\nThe Great Escape continua com os personagens, estereótipos satirizados em diversas faixas, não é a toa que o álbum abre com Stereotypes. O álbum, embora tenha tido relativo sucesso, já demonstrava uma queda na fórmula e indicava novos rumos em canções como He Thought of Cars e The Universal, uma das canções mais significativas da banda. The Great Escape recebeu boas avaliações, recebendo a nota 9 em 10 por parte da NME3 . Este álbum o último do que ficou conhecido como The Life Trilogy4 , complementando Modern Life Is Rubbish e Parklife.\r\n\r\nBlur (1997)[editar | editar código-fonte]\r\nBlur rompeu com a linha que a banda vinha seguindo nos três últimos álbuns, centrados em personagens da vida britânica pós-thatcherismo5 . Na sonoridade a banda buscou se aproximar do cenário independente dos Estados Unidos como o Pavement e Sonic Youth 6 , essa diferença fica clara em músicas como M.O.R., On Your Own e You\\''re So Great. O álbum conta com Song 2, o maior êxito radiofônico da banda, inclusive no Brasil. Pelo lado melancólico o álbum conta com Beetlebum, Death of a Party e a imensuravelmente triste Strange News From Another Star.\r\n\r\n13 (1999)[editar | editar código-fonte]\r\nEm 13 a banda continua sua mudança de sonoridade, o produtor de longa data Stephen Street foi substituído por Willian Orbit neste álbum. O resultado foi adição de mais elementos experimentais e eletrônicos, se distanciando do rótulo Britpop. 13 abre com Tender, canção que virou hino em praticamente todas as apresentações da banda e, supostamente, mais uma canção dedicada a amada ex-companheira de Damon Albarn, Justine Frischmann. No entanto, 13 é um álbum com temática diversa, com canções novamente baseadas em personagens como Bugman e canções mais leves sobre a infância na cidade natal da banda, como Coffee & TV, que deu luz a um dos vídeo clipes mais famosos da banda, em que uma caixa de leite se aventura pela cidade. Neste álbum também se encontram dois grandes B-Sides do lado mais sombrios da banda Caramel e Battle. Blur teve boa receptividade por parte da crítica especializada7 .\r\n\r\nThink Tank (2003)[editar | editar código-fonte]\r\nGraham Coxon se afasta da banda para se dedicar a seus trabalhos solos. \\"Think Tank\\" é lançado em 2003. Para o lugar de Coxon, foi recrutado Simon Tong, ex-guitarrista do Verve. A única faixa que Coxon participa deste álbum é a última, chamada Battery in your Leg. \\"Think Tank\\" foi aclamado pela crítica, sendo citado em vigésimo lugar nos melhores álbuns da década, pela revista NME. Out of Time, Crazy Beat e Battery in Your Leg são os destaques desse trabalho.\r\n\r\nThe Magic Whip (2015)[editar | editar código-fonte]\r\nApós 12 anos sem criar álbuns de estúdio, já com a volta de Graham Coxon, a banda anuncia seu novo álbum, The Magic Whip, previsto para lançamento em 27 de Abril de 2015, e o lançamento do single Go Out junto com seu videoclipe, capa do álbum e o nome de todas as faixas.'', \r\n	`linksCom` = ''''\r\n	WHERE `ig_evento`.`idEvento` = 111;'),
(87, 1, '152.250.161.200', '2015-06-01 15:33:16', 'UPDATE `ig_evento` SET \r\n	`sinopse` = ''Leisure (1991)[editar | editar código-fonte]\r\nO primeiro álbum da banda estilisticamente não se diferenciava muito do que se fazia na época na Inglaterra, explorava letras curtas, simples e diretas, por vezes sem refrões, com os vocais de Damon Albarn se fundindo com a guitarra de Graham Coxon, estes sim já se destacando, junto com a combinação do baixo de Alex James e a bateria de Rowntree. As músicas exploravam uma sonoridade inclinada ao psicodelismo advindo dos Stone Roses e outros representantes da cena musical “Madchester”, que já mostrava declínio naquele ano de 1991. A primeira faixa, e também o primeiro single da banda, She’s So High abria o álbum de forma musicalmente fantástica, com sua letra curta e vaga, o que era uma regra poucas vezes desobedecida no álbum. Aqui é explorado um dos lados mais sombrios de Blur, com a canção Sing, que pode ser considerada um dos grandes clássicos da banda e já apresentava um lado diferenciado de Blur, e talvez o seu potencial, que seria melhor explorado a partir do álbum “Blur”. Sing seria incluída, bem posteriormente, na trilha sonora do filme Trainspotting.\r\n\r\nModern Life Is Rubbish (1993)[editar | editar código-fonte]\r\nO segundo álbum da banda abandonou boa parte da psicodelia e as letras curtas de Leisure e mostrou letras que indicam uma localização e uma época. For Tomorrow abre o disco, onde são citados vários pontos de Londres. Em Blue Jeans mais um passeio por Londres, supostamente retratando o relacionamento de Damon Albarn com Justine (Elastica). Neste álbum começam a aparecer as músicas centradas em personagens, retratados de forma irônica, sendo Colin Zeal o mais famoso. Destaque neste álbum também para Chemical World e Sunday Sunday. Chemical World merece destaque por si só, é um retrato da vida moderna nas grandes cidades, trabalhos ingratos, dificuldades para pagar o aluguel, falta de perspectivas e a solidão, ironicamente em um lugar superpopuloso.\r\n\r\nParklife (1994)[editar | editar código-fonte]\r\nParklife, praticamente uma continuação de Modern Life Is Rubbish, abria com Girls & Boys, um dos maiores \\"hits\\" da banda. Os personagens que retratam a sociedade continuam, um Inglês que sonha em se mudar para os USA em Magic America e Tracy Jacks, um funcionário público. As críticas ou ironias com a sociedada inglesa também aparecem em London Loves. Porém, há também a melancolia de This is a Low, Badhead, To the End eEnd of Century. Parklife é um álbum consistente em termos musicais, embora seja uma coletânea de histórias que nem sempre se interligam.\r\n\r\nThe Great Escape (1995)[editar | editar código-fonte]\r\nThe Great Escape continua com os personagens, estereótipos satirizados em diversas faixas, não é a toa que o álbum abre com Stereotypes. O álbum, embora tenha tido relativo sucesso, já demonstrava uma queda na fórmula e indicava novos rumos em canções como He Thought of Cars e The Universal, uma das canções mais significativas da banda. The Great Escape recebeu boas avaliações, recebendo a nota 9 em 10 por parte da NME3 . Este álbum o último do que ficou conhecido como The Life Trilogy4 , complementando Modern Life Is Rubbish e Parklife.\r\n\r\nBlur (1997)[editar | editar código-fonte]\r\nBlur rompeu com a linha que a banda vinha seguindo nos três últimos álbuns, centrados em personagens da vida britânica pós-thatcherismo5 . Na sonoridade a banda buscou se aproximar do cenário independente dos Estados Unidos como o Pavement e Sonic Youth 6 , essa diferença fica clara em músicas como M.O.R., On Your Own e You\\''re So Great. O álbum conta com Song 2, o maior êxito radiofônico da banda, inclusive no Brasil. Pelo lado melancólico o álbum conta com Beetlebum, Death of a Party e a imensuravelmente triste Strange News From Another Star.\r\n\r\n13 (1999)[editar | editar código-fonte]\r\nEm 13 a banda continua sua mudança de sonoridade, o produtor de longa data Stephen Street foi substituído por Willian Orbit neste álbum. O resultado foi adição de mais elementos experimentais e eletrônicos, se distanciando do rótulo Britpop. 13 abre com Tender, canção que virou hino em praticamente todas as apresentações da banda e, supostamente, mais uma canção dedicada a amada ex-companheira de Damon Albarn, Justine Frischmann. No entanto, 13 é um álbum com temática diversa, com canções novamente baseadas em personagens como Bugman e canções mais leves sobre a infância na cidade natal da banda, como Coffee & TV, que deu luz a um dos vídeo clipes mais famosos da banda, em que uma caixa de leite se aventura pela cidade. Neste álbum também se encontram dois grandes B-Sides do lado mais sombrios da banda Caramel e Battle. Blur teve boa receptividade por parte da crítica especializada7 .\r\n\r\nThink Tank (2003)[editar | editar código-fonte]\r\nGraham Coxon se afasta da banda para se dedicar a seus trabalhos solos. \\"Think Tank\\" é lançado em 2003. Para o lugar de Coxon, foi recrutado Simon Tong, ex-guitarrista do Verve. A única faixa que Coxon participa deste álbum é a última, chamada Battery in your Leg. \\"Think Tank\\" foi aclamado pela crítica, sendo citado em vigésimo lugar nos melhores álbuns da década, pela revista NME. Out of Time, Crazy Beat e Battery in Your Leg são os destaques desse trabalho.\r\n\r\nThe Magic Whip (2015)[editar | editar código-fonte]\r\nApós 12 anos sem criar álbuns de estúdio, já com a volta de Graham Coxon, a banda anuncia seu novo álbum, The Magic Whip, previsto para lançamento em 27 de Abril de 2015, e o lançamento do single Go Out junto com seu videoclipe, capa do álbum e o nome de todas as faixas.'', \r\n	`releaseCom` = ''Leisure (1991)[editar | editar código-fonte]\r\nO primeiro álbum da banda estilisticamente não se diferenciava muito do que se fazia na época na Inglaterra, explorava letras curtas, simples e diretas, por vezes sem refrões, com os vocais de Damon Albarn se fundindo com a guitarra de Graham Coxon, estes sim já se destacando, junto com a combinação do baixo de Alex James e a bateria de Rowntree. As músicas exploravam uma sonoridade inclinada ao psicodelismo advindo dos Stone Roses e outros representantes da cena musical “Madchester”, que já mostrava declínio naquele ano de 1991. A primeira faixa, e também o primeiro single da banda, She’s So High abria o álbum de forma musicalmente fantástica, com sua letra curta e vaga, o que era uma regra poucas vezes desobedecida no álbum. Aqui é explorado um dos lados mais sombrios de Blur, com a canção Sing, que pode ser considerada um dos grandes clássicos da banda e já apresentava um lado diferenciado de Blur, e talvez o seu potencial, que seria melhor explorado a partir do álbum “Blur”. Sing seria incluída, bem posteriormente, na trilha sonora do filme Trainspotting.\r\n\r\nModern Life Is Rubbish (1993)[editar | editar código-fonte]\r\nO segundo álbum da banda abandonou boa parte da psicodelia e as letras curtas de Leisure e mostrou letras que indicam uma localização e uma época. For Tomorrow abre o disco, onde são citados vários pontos de Londres. Em Blue Jeans mais um passeio por Londres, supostamente retratando o relacionamento de Damon Albarn com Justine (Elastica). Neste álbum começam a aparecer as músicas centradas em personagens, retratados de forma irônica, sendo Colin Zeal o mais famoso. Destaque neste álbum também para Chemical World e Sunday Sunday. Chemical World merece destaque por si só, é um retrato da vida moderna nas grandes cidades, trabalhos ingratos, dificuldades para pagar o aluguel, falta de perspectivas e a solidão, ironicamente em um lugar superpopuloso.\r\n\r\nParklife (1994)[editar | editar código-fonte]\r\nParklife, praticamente uma continuação de Modern Life Is Rubbish, abria com Girls & Boys, um dos maiores \\"hits\\" da banda. Os personagens que retratam a sociedade continuam, um Inglês que sonha em se mudar para os USA em Magic America e Tracy Jacks, um funcionário público. As críticas ou ironias com a sociedada inglesa também aparecem em London Loves. Porém, há também a melancolia de This is a Low, Badhead, To the End eEnd of Century. Parklife é um álbum consistente em termos musicais, embora seja uma coletânea de histórias que nem sempre se interligam.\r\n\r\nThe Great Escape (1995)[editar | editar código-fonte]\r\nThe Great Escape continua com os personagens, estereótipos satirizados em diversas faixas, não é a toa que o álbum abre com Stereotypes. O álbum, embora tenha tido relativo sucesso, já demonstrava uma queda na fórmula e indicava novos rumos em canções como He Thought of Cars e The Universal, uma das canções mais significativas da banda. The Great Escape recebeu boas avaliações, recebendo a nota 9 em 10 por parte da NME3 . Este álbum o último do que ficou conhecido como The Life Trilogy4 , complementando Modern Life Is Rubbish e Parklife.\r\n\r\nBlur (1997)[editar | editar código-fonte]\r\nBlur rompeu com a linha que a banda vinha seguindo nos três últimos álbuns, centrados em personagens da vida britânica pós-thatcherismo5 . Na sonoridade a banda buscou se aproximar do cenário independente dos Estados Unidos como o Pavement e Sonic Youth 6 , essa diferença fica clara em músicas como M.O.R., On Your Own e You\\''re So Great. O álbum conta com Song 2, o maior êxito radiofônico da banda, inclusive no Brasil. Pelo lado melancólico o álbum conta com Beetlebum, Death of a Party e a imensuravelmente triste Strange News From Another Star.\r\n\r\n13 (1999)[editar | editar código-fonte]\r\nEm 13 a banda continua sua mudança de sonoridade, o produtor de longa data Stephen Street foi substituído por Willian Orbit neste álbum. O resultado foi adição de mais elementos experimentais e eletrônicos, se distanciando do rótulo Britpop. 13 abre com Tender, canção que virou hino em praticamente todas as apresentações da banda e, supostamente, mais uma canção dedicada a amada ex-companheira de Damon Albarn, Justine Frischmann. No entanto, 13 é um álbum com temática diversa, com canções novamente baseadas em personagens como Bugman e canções mais leves sobre a infância na cidade natal da banda, como Coffee & TV, que deu luz a um dos vídeo clipes mais famosos da banda, em que uma caixa de leite se aventura pela cidade. Neste álbum também se encontram dois grandes B-Sides do lado mais sombrios da banda Caramel e Battle. Blur teve boa receptividade por parte da crítica especializada7 .\r\n\r\nThink Tank (2003)[editar | editar código-fonte]\r\nGraham Coxon se afasta da banda para se dedicar a seus trabalhos solos. \\"Think Tank\\" é lançado em 2003. Para o lugar de Coxon, foi recrutado Simon Tong, ex-guitarrista do Verve. A única faixa que Coxon participa deste álbum é a última, chamada Battery in your Leg. \\"Think Tank\\" foi aclamado pela crítica, sendo citado em vigésimo lugar nos melhores álbuns da década, pela revista NME. Out of Time, Crazy Beat e Battery in Your Leg são os destaques desse trabalho.\r\n\r\nThe Magic Whip (2015)[editar | editar código-fonte]\r\nApós 12 anos sem criar álbuns de estúdio, já com a volta de Graham Coxon, a banda anuncia seu novo álbum, The Magic Whip, previsto para lançamento em 27 de Abril de 2015, e o lançamento do single Go Out junto com seu videoclipe, capa do álbum e o nome de todas as faixas.'', \r\n	`parecerArtistico` = ''Leisure (1991)[editar | editar código-fonte]\r\nO primeiro álbum da banda estilisticamente não se diferenciava muito do que se fazia na época na Inglaterra, explorava letras curtas, simples e diretas, por vezes sem refrões, com os vocais de Damon Albarn se fundindo com a guitarra de Graham Coxon, estes sim já se destacando, junto com a combinação do baixo de Alex James e a bateria de Rowntree. As músicas exploravam uma sonoridade inclinada ao psicodelismo advindo dos Stone Roses e outros representantes da cena musical “Madchester”, que já mostrava declínio naquele ano de 1991. A primeira faixa, e também o primeiro single da banda, She’s So High abria o álbum de forma musicalmente fantástica, com sua letra curta e vaga, o que era uma regra poucas vezes desobedecida no álbum. Aqui é explorado um dos lados mais sombrios de Blur, com a canção Sing, que pode ser considerada um dos grandes clássicos da banda e já apresentava um lado diferenciado de Blur, e talvez o seu potencial, que seria melhor explorado a partir do álbum “Blur”. Sing seria incluída, bem posteriormente, na trilha sonora do filme Trainspotting.\r\n\r\nModern Life Is Rubbish (1993)[editar | editar código-fonte]\r\nO segundo álbum da banda abandonou boa parte da psicodelia e as letras curtas de Leisure e mostrou letras que indicam uma localização e uma época. For Tomorrow abre o disco, onde são citados vários pontos de Londres. Em Blue Jeans mais um passeio por Londres, supostamente retratando o relacionamento de Damon Albarn com Justine (Elastica). Neste álbum começam a aparecer as músicas centradas em personagens, retratados de forma irônica, sendo Colin Zeal o mais famoso. Destaque neste álbum também para Chemical World e Sunday Sunday. Chemical World merece destaque por si só, é um retrato da vida moderna nas grandes cidades, trabalhos ingratos, dificuldades para pagar o aluguel, falta de perspectivas e a solidão, ironicamente em um lugar superpopuloso.\r\n\r\nParklife (1994)[editar | editar código-fonte]\r\nParklife, praticamente uma continuação de Modern Life Is Rubbish, abria com Girls & Boys, um dos maiores \\"hits\\" da banda. Os personagens que retratam a sociedade continuam, um Inglês que sonha em se mudar para os USA em Magic America e Tracy Jacks, um funcionário público. As críticas ou ironias com a sociedada inglesa também aparecem em London Loves. Porém, há também a melancolia de This is a Low, Badhead, To the End eEnd of Century. Parklife é um álbum consistente em termos musicais, embora seja uma coletânea de histórias que nem sempre se interligam.\r\n\r\nThe Great Escape (1995)[editar | editar código-fonte]\r\nThe Great Escape continua com os personagens, estereótipos satirizados em diversas faixas, não é a toa que o álbum abre com Stereotypes. O álbum, embora tenha tido relativo sucesso, já demonstrava uma queda na fórmula e indicava novos rumos em canções como He Thought of Cars e The Universal, uma das canções mais significativas da banda. The Great Escape recebeu boas avaliações, recebendo a nota 9 em 10 por parte da NME3 . Este álbum o último do que ficou conhecido como The Life Trilogy4 , complementando Modern Life Is Rubbish e Parklife.\r\n\r\nBlur (1997)[editar | editar código-fonte]\r\nBlur rompeu com a linha que a banda vinha seguindo nos três últimos álbuns, centrados em personagens da vida britânica pós-thatcherismo5 . Na sonoridade a banda buscou se aproximar do cenário independente dos Estados Unidos como o Pavement e Sonic Youth 6 , essa diferença fica clara em músicas como M.O.R., On Your Own e You\\''re So Great. O álbum conta com Song 2, o maior êxito radiofônico da banda, inclusive no Brasil. Pelo lado melancólico o álbum conta com Beetlebum, Death of a Party e a imensuravelmente triste Strange News From Another Star.\r\n\r\n13 (1999)[editar | editar código-fonte]\r\nEm 13 a banda continua sua mudança de sonoridade, o produtor de longa data Stephen Street foi substituído por Willian Orbit neste álbum. O resultado foi adição de mais elementos experimentais e eletrônicos, se distanciando do rótulo Britpop. 13 abre com Tender, canção que virou hino em praticamente todas as apresentações da banda e, supostamente, mais uma canção dedicada a amada ex-companheira de Damon Albarn, Justine Frischmann. No entanto, 13 é um álbum com temática diversa, com canções novamente baseadas em personagens como Bugman e canções mais leves sobre a infância na cidade natal da banda, como Coffee & TV, que deu luz a um dos vídeo clipes mais famosos da banda, em que uma caixa de leite se aventura pela cidade. Neste álbum também se encontram dois grandes B-Sides do lado mais sombrios da banda Caramel e Battle. Blur teve boa receptividade por parte da crítica especializada7 .\r\n\r\nThink Tank (2003)[editar | editar código-fonte]\r\nGraham Coxon se afasta da banda para se dedicar a seus trabalhos solos. \\"Think Tank\\" é lançado em 2003. Para o lugar de Coxon, foi recrutado Simon Tong, ex-guitarrista do Verve. A única faixa que Coxon participa deste álbum é a última, chamada Battery in your Leg. \\"Think Tank\\" foi aclamado pela crítica, sendo citado em vigésimo lugar nos melhores álbuns da década, pela revista NME. Out of Time, Crazy Beat e Battery in Your Leg são os destaques desse trabalho.\r\n\r\nThe Magic Whip (2015)[editar | editar código-fonte]\r\nApós 12 anos sem criar álbuns de estúdio, já com a volta de Graham Coxon, a banda anuncia seu novo álbum, The Magic Whip, previsto para lançamento em 27 de Abril de 2015, e o lançamento do single Go Out junto com seu videoclipe, capa do álbum e o nome de todas as faixas.'', \r\n	`linksCom` = ''http://pt.wikipedia.org/wiki/Blur''\r\n	WHERE `ig_evento`.`idEvento` = 111;'),
(88, 1, '152.250.161.200', '2015-06-01 15:34:25', 'UPDATE `ig_evento` SET \r\n	`nomeEvento` = ''Blur no CCSP'', \r\n	`projeto` = '''', \r\n	`projetoEspecial` = '''', \r\n	`idResponsavel` = '''', \r\n	`suplente` = '''', \r\n	`ig_modalidade_IdModalidade` = 	'''',\r\n	`ig_tipo_evento_idTipoEvento` = ''12'',\r\n	 `publicado` = 1\r\n	WHERE `ig_evento`.`idEvento` = 111;'),
(89, 1, '152.250.161.200', '2015-06-01 15:38:27', 'INSERT INTO  `ig_produtor` (`idProdutor` ,`nome` ,`email` ,`telefone` ,`idSpCultura`\r\n) VALUES ( NULL ,  ''Marcio Yonamine'',  ''Notice: Undefined index: email in /var/www/igsis/perfil/evento.php on line 1023'',  '''',  '''' )'),
(90, 1, '152.250.161.200', '2015-06-01 15:38:36', 'INSERT INTO  `ig_produtor` (`idProdutor` ,`nome` ,`email` ,`telefone` ,`idSpCultura`\r\n) VALUES ( NULL ,  ''Marcio Yonamine'',  ''Notice: Undefined index: email in /var/www/igsis/perfil/evento.php on line 1023'',  '''',  '''' )');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `ig_modalidade`
--

INSERT INTO `ig_modalidade` (`idModalidade`, `modalidade`, `financa`, `contratos`) VALUES
(1, 'Fomentos', 0, 0),
(2, 'Parceria', 0, 0),
(3, 'Doação de serviços', 0, 0),
(4, 'Cessão de espaço', 0, 0),
(5, 'Contratação artística', 0, 0),
(6, 'Reversão de bilheteria', 0, 0),
(7, 'Reversão de bilheteria e cachê', 0, 0),
(8, 'Programa de rádio, tv e site', 0, 0),
(9, 'Prefeitura / SMC', 0, 0),
(10, 'Evento interno sem público', 0, 0),
(11, 'Contratação de serviço sem evento', 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_modulo`
--

DROP TABLE IF EXISTS `ig_modulo`;
CREATE TABLE IF NOT EXISTS `ig_modulo` (
  `idModulo` int(2) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `pag` varchar(30) DEFAULT NULL,
  `descricao` longtext,
  PRIMARY KEY (`idModulo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `ig_modulo`
--

INSERT INTO `ig_modulo` (`idModulo`, `nome`, `pag`, `descricao`) VALUES
(1, 'Administrador Geral', 'admin', 'Administrador geral - tem acesso a todas as funcionalidades.'),
(2, 'Administrador Local', 'administrador', 'Gerencia espaços, eventos e usuários de determinada instituição.'),
(3, 'Comunicação', 'comunicacao', 'Gerencia a comunicação da instituição e envia informações para o SPCultura.'),
(4, 'Contratos', 'contratos', 'Gerencia a produção de contratos artísticos.'),
(5, 'Documentação', 'documentacao', 'Gerencia informações sobre a memória da instituição.'),
(6, 'Evento', 'evento', 'Inserir, editar e enviar pedidos de eventos artísticos a serem realizados na instituição.'),
(7, 'Finanças', 'financa', 'gerencia questões financeiras acerca das contratações artísticas.'),
(8, 'Jurídico', 'juridico', 'gerencia pareceres artísticos e outros documentos de cunho jurídico.'),
(9, 'Contabilidade', 'pagamento', 'gerencia questões de pagamento como notas de empenho.'),
(10, 'Produção', 'producao', 'gerencia a estrutura de produção artística da casa.');

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

--
-- Extraindo dados da tabela `ig_musica`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_ocorrencia`
--

DROP TABLE IF EXISTS `ig_ocorrencia`;
CREATE TABLE IF NOT EXISTS `ig_ocorrencia` (
  `idOcorrencia` int(8) NOT NULL AUTO_INCREMENT,
  `idTipoOcorrencia` int(8) DEFAULT NULL,
  `ig_comunicao_idCom` int(8) DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `ig_ocorrencia`
--

INSERT INTO `ig_ocorrencia` (`idOcorrencia`, `idTipoOcorrencia`, `ig_comunicao_idCom`, `local`, `idEvento`, `segunda`, `terca`, `quarta`, `quinta`, `sexta`, `sabado`, `domingo`, `dataInicio`, `dataFinal`, `horaInicio`, `horaFinal`, `timezone`, `diaInteiro`, `diaEspecial`, `libras`, `audiodescricao`, `valorIngresso`, `retiradaIngresso`, `localOutros`, `lotacao`, `reservados`, `duracao`, `precoPopular`, `frequencia`) VALUES
(1, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00', '0000-00-00', '00:00:00', '00:00:00', 0, 0, 0, 0, 0, '0.00', 0, '$localOutros', 0, 0, 0, '0.00', '$frequencia'),
(2, 3, NULL, 1, 113, 0, 0, 0, 0, 0, 0, 0, '2015-05-01', '0000-00-00', '20:00:00', '00:00:00', -3, 0, 0, 0, 0, '15.00', 5, '0', 0, 0, 90, '0.00', '0'),
(3, 4, NULL, 6, 114, 0, 0, 0, 0, 0, 0, 0, '2015-05-02', '2015-05-24', '20:00:00', '00:00:00', -3, 0, 0, 0, 0, '12.00', 5, '0', 0, 0, 180, '0.00', '0'),
(4, 4, NULL, 6, 114, 0, 0, 0, 0, 0, 0, 0, '2015-05-02', '2015-05-24', '20:00:00', '00:00:00', -3, 0, 0, 0, 0, '12.00', 5, '0', 0, 0, 180, '0.00', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_oficinas`
--

DROP TABLE IF EXISTS `ig_oficinas`;
CREATE TABLE IF NOT EXISTS `ig_oficinas` (
  `idOficinas` int(4) NOT NULL AUTO_INCREMENT,
  `idEvento` int(6) NOT NULL,
  `certificado` tinyint(1) DEFAULT NULL,
  `vagas` int(3) DEFAULT NULL,
  `publico` longtext,
  `material` longtext,
  `inscricao` varchar(60) DEFAULT NULL,
  `valorHora` varchar(12) DEFAULT NULL,
  `venda` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idOficinas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `ig_oficinas`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_pais`
--

DROP TABLE IF EXISTS `ig_pais`;
CREATE TABLE IF NOT EXISTS `ig_pais` (
  `paisId` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `paisNome` varchar(50) NOT NULL,
  `paisName` varchar(50) NOT NULL,
  PRIMARY KEY (`paisId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=253 ;

--
-- Extraindo dados da tabela `ig_pais`
--

INSERT INTO `ig_pais` (`paisId`, `paisNome`, `paisName`) VALUES
(1, 'AFEGANISTÃO', 'AFGHANISTAN'),
(2, 'ACROTÍRI E DECELIA', 'AKROTIRI E DEKÉLIA'),
(3, 'ÁFRICA DO SUL', 'SOUTH AFRICA'),
(4, 'ALBÂNIA', 'ALBANIA'),
(5, 'ALEMANHA', 'GERMANY'),
(6, 'AMERICAN SAMOA', 'AMERICAN SAMOA'),
(7, 'ANDORRA', 'ANDORRA'),
(8, 'ANGOLA', 'ANGOLA'),
(9, 'ANGUILLA', 'ANGUILLA'),
(10, 'ANTÍGUA E BARBUDA', 'ANTIGUA AND BARBUDA'),
(11, 'ANTILHAS NEERLANDESAS', 'NETHERLANDS ANTILLES'),
(12, 'ARÁBIA SAUDITA', 'SAUDI ARABIA'),
(13, 'ARGÉLIA', 'ALGERIA'),
(14, 'ARGENTINA', 'ARGENTINA'),
(15, 'ARMÉNIA', 'ARMENIA'),
(16, 'ARUBA', 'ARUBA'),
(17, 'AUSTRÁLIA', 'AUSTRALIA'),
(18, 'ÁUSTRIA', 'AUSTRIA'),
(19, 'AZERBAIJÃO', 'AZERBAIJAN'),
(20, 'BAHAMAS', 'BAHAMAS, THE'),
(21, 'BANGLADECHE', 'BANGLADESH'),
(22, 'BARBADOS', 'BARBADOS'),
(23, 'BARÉM', 'BAHRAIN'),
(24, 'BASSAS DA ÍNDIA', 'BASSAS DA INDIA'),
(25, 'BÉLGICA', 'BELGIUM'),
(26, 'BELIZE', 'BELIZE'),
(27, 'BENIM', 'BENIN'),
(28, 'BERMUDAS', 'BERMUDA'),
(29, 'BIELORRÚSSIA', 'BELARUS'),
(30, 'BOLÍVIA', 'BOLIVIA'),
(31, 'BÓSNIA E HERZEGOVINA', 'BOSNIA AND HERZEGOVINA'),
(32, 'BOTSUANA', 'BOTSWANA'),
(33, 'BRASIL', 'BRAZIL'),
(34, 'BRUNEI DARUSSALAM', 'BRUNEI DARUSSALAM'),
(35, 'BULGÁRIA', 'BULGARIA'),
(36, 'BURQUINA FASO', 'BURKINA FASO'),
(37, 'BURUNDI', 'BURUNDI'),
(38, 'BUTÃO', 'BHUTAN'),
(39, 'CABO VERDE', 'CAPE VERDE'),
(40, 'CAMARÕES', 'CAMEROON'),
(41, 'CAMBOJA', 'CAMBODIA'),
(42, 'CANADÁ', 'CANADA'),
(43, 'CATAR', 'QATAR'),
(44, 'CAZAQUISTÃO', 'KAZAKHSTAN'),
(45, 'CENTRO-AFRICANA REPÚBLICA', 'CENTRAL AFRICAN REPUBLIC'),
(46, 'CHADE', 'CHAD'),
(47, 'CHILE', 'CHILE'),
(48, 'CHINA', 'CHINA'),
(49, 'CHIPRE', 'CYPRUS'),
(50, 'COLÔMBIA', 'COLOMBIA'),
(51, 'COMORES', 'COMOROS'),
(52, 'CONGO', 'CONGO'),
(53, 'CONGO REPÚBLICA DEMOCRÁTICA', 'CONGO DEMOCRATIC REPUBLIC'),
(54, 'COREIA DO NORTE', 'KOREA NORTH'),
(55, 'COREIA DO SUL', 'KOREA SOUTH'),
(56, 'COSTA DO MARFIM', 'IVORY COAST'),
(57, 'COSTA RICA', 'COSTA RICA'),
(58, 'CROÁCIA', 'CROATIA'),
(59, 'CUBA', 'CUBA'),
(60, 'DINAMARCA', 'DENMARK'),
(61, 'DOMÍNICA', 'DOMINICA'),
(62, 'EGIPTO', 'EGYPT'),
(63, 'EMIRADOS ÁRABES UNIDOS', 'UNITED ARAB EMIRATES'),
(64, 'EQUADOR', 'ECUADOR'),
(65, 'ERITREIA', 'ERITREA'),
(66, 'ESLOVÁQUIA', 'SLOVAKIA'),
(67, 'ESLOVÉNIA', 'SLOVENIA'),
(68, 'ESPANHA', 'SPAIN'),
(69, 'ESTADOS UNIDOS', 'UNITED STATES'),
(70, 'ESTÓNIA', 'ESTONIA'),
(71, 'ETIÓPIA', 'ETHIOPIA'),
(72, 'FAIXA DE GAZA', 'GAZA STRIP'),
(73, 'FIJI', 'FIJI'),
(74, 'FILIPINAS', 'PHILIPPINES'),
(75, 'FINLÂNDIA', 'FINLAND'),
(76, 'FRANÇA', 'FRANCE'),
(77, 'GABÃO', 'GABON'),
(78, 'GÂMBIA', 'GAMBIA'),
(79, 'GANA', 'GHANA'),
(80, 'GEÓRGIA', 'GEORGIA'),
(81, 'GIBRALTAR', 'GIBRALTAR'),
(82, 'GRANADA', 'GRENADA'),
(83, 'GRÉCIA', 'GREECE'),
(84, 'GRONELÂNDIA', 'GREENLAND'),
(85, 'GUADALUPE', 'GUADELOUPE'),
(86, 'GUAM', 'GUAM'),
(87, 'GUATEMALA', 'GUATEMALA'),
(88, 'GUERNSEY', 'GUERNSEY'),
(89, 'GUIANA', 'GUYANA'),
(90, 'GUIANA FRANCESA', 'FRENCH GUIANA'),
(91, 'GUINÉ', 'GUINEA'),
(92, 'GUINÉ EQUATORIAL', 'EQUATORIAL GUINEA'),
(93, 'GUINÉ-BISSAU', 'GUINEA-BISSAU'),
(94, 'HAITI', 'HAITI'),
(95, 'HONDURAS', 'HONDURAS'),
(96, 'HONG KONG', 'HONG KONG'),
(97, 'HUNGRIA', 'HUNGARY'),
(98, 'IÉMEN', 'YEMEN'),
(99, 'ILHA BOUVET', 'BOUVET ISLAND'),
(100, 'ILHA CHRISTMAS', 'CHRISTMAS ISLAND'),
(101, 'ILHA DE CLIPPERTON', 'CLIPPERTON ISLAND'),
(102, 'ILHA DE JOÃO DA NOVA', 'JUAN DE NOVA ISLAND'),
(103, 'ILHA DE MAN', 'ISLE OF MAN'),
(104, 'ILHA DE NAVASSA', 'NAVASSA ISLAND'),
(105, 'ILHA EUROPA', 'EUROPA ISLAND'),
(106, 'ILHA NORFOLK', 'NORFOLK ISLAND'),
(107, 'ILHA TROMELIN', 'TROMELIN ISLAND'),
(108, 'ILHAS ASHMORE E CARTIER', 'ASHMORE AND CARTIER ISLANDS'),
(109, 'ILHAS CAIMAN', 'CAYMAN ISLANDS'),
(110, 'ILHAS COCOS (KEELING)', 'COCOS (KEELING) ISLANDS'),
(111, 'ILHAS COOK', 'COOK ISLANDS'),
(112, 'ILHAS DO MAR DE CORAL', 'CORAL SEA ISLANDS'),
(113, 'ILHAS FALKLANDS (ILHAS MALVINAS)', 'FALKLAND ISLANDS (ISLAS MALVINAS)'),
(114, 'ILHAS FEROE', 'FAROE ISLANDS'),
(115, 'ILHAS GEÓRGIA DO SUL E SANDWICH DO SUL', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS'),
(116, 'ILHAS MARIANAS DO NORTE', 'NORTHERN MARIANA ISLANDS'),
(117, 'ILHAS MARSHALL', 'MARSHALL ISLANDS'),
(118, 'ILHAS PARACEL', 'PARACEL ISLANDS'),
(119, 'ILHAS PITCAIRN', 'PITCAIRN ISLANDS'),
(120, 'ILHAS SALOMÃO', 'SOLOMON ISLANDS'),
(121, 'ILHAS SPRATLY', 'SPRATLY ISLANDS'),
(122, 'ILHAS VIRGENS AMERICANAS', 'UNITED STATES VIRGIN ISLANDS'),
(123, 'ILHAS VIRGENS BRITÂNICAS', 'BRITISH VIRGIN ISLANDS'),
(124, 'ÍNDIA', 'INDIA'),
(125, 'INDONÉSIA', 'INDONESIA'),
(126, 'IRÃO', 'IRAN'),
(127, 'IRAQUE', 'IRAQ'),
(128, 'IRLANDA', 'IRELAND'),
(129, 'ISLÂNDIA', 'ICELAND'),
(130, 'ISRAEL', 'ISRAEL'),
(131, 'ITÁLIA', 'ITALY'),
(132, 'JAMAICA', 'JAMAICA'),
(133, 'JAN MAYEN', 'JAN MAYEN'),
(134, 'JAPÃO', 'JAPAN'),
(135, 'JERSEY', 'JERSEY'),
(136, 'JIBUTI', 'DJIBOUTI'),
(137, 'JORDÂNIA', 'JORDAN'),
(138, 'KIRIBATI', 'KIRIBATI'),
(139, 'KOWEIT', 'KUWAIT'),
(140, 'LAOS', 'LAOS'),
(141, 'LESOTO', 'LESOTHO'),
(142, 'LETÓNIA', 'LATVIA'),
(143, 'LÍBANO', 'LEBANON'),
(144, 'LIBÉRIA', 'LIBERIA'),
(145, 'LÍBIA', 'LIBYAN ARAB JAMAHIRIYA'),
(146, 'LISTENSTAINE', 'LIECHTENSTEIN'),
(147, 'LITUÂNIA', 'LITHUANIA'),
(148, 'LUXEMBURGO', 'LUXEMBOURG'),
(149, 'MACAU', 'MACAO'),
(150, 'MACEDÓNIA', 'MACEDONIA'),
(151, 'MADAGÁSCAR', 'MADAGASCAR'),
(152, 'MALÁSIA', 'MALAYSIA'),
(153, 'MALAVI', 'MALAWI'),
(154, 'MALDIVAS', 'MALDIVES'),
(155, 'MALI', 'MALI'),
(156, 'MALTA', 'MALTA'),
(157, 'MARROCOS', 'MOROCCO'),
(158, 'MARTINICA', 'MARTINIQUE'),
(159, 'MAURÍCIA', 'MAURITIUS'),
(160, 'MAURITÂNIA', 'MAURITANIA'),
(161, 'MAYOTTE', 'MAYOTTE'),
(162, 'MÉXICO', 'MEXICO'),
(163, 'MIANMAR', 'MYANMAR BURMA'),
(164, 'MICRONÉSIA', 'MICRONESIA'),
(165, 'MOÇAMBIQUE', 'MOZAMBIQUE'),
(166, 'MOLDÁVIA', 'MOLDOVA'),
(167, 'MÓNACO', 'MONACO'),
(168, 'MONGÓLIA', 'MONGOLIA'),
(169, 'MONTENEGRO', 'MONTENEGRO'),
(170, 'MONTSERRAT', 'MONTSERRAT'),
(171, 'NAMÍBIA', 'NAMIBIA'),
(172, 'NAURU', 'NAURU'),
(173, 'NEPAL', 'NEPAL'),
(174, 'NICARÁGUA', 'NICARAGUA'),
(175, 'NÍGER', 'NIGER'),
(176, 'NIGÉRIA', 'NIGERIA'),
(177, 'NIUE', 'NIUE'),
(178, 'NORUEGA', 'NORWAY'),
(179, 'NOVA CALEDÓNIA', 'NEW CALEDONIA'),
(180, 'NOVA ZELÂNDIA', 'NEW ZEALAND'),
(181, 'OMÃ', 'OMAN'),
(182, 'PAÍSES BAIXOS', 'NETHERLANDS'),
(183, 'PALAU', 'PALAU'),
(184, 'PALESTINA', 'PALESTINE'),
(185, 'PANAMÁ', 'PANAMA'),
(186, 'PAPUÁSIA-NOVA GUINÉ', 'PAPUA NEW GUINEA'),
(187, 'PAQUISTÃO', 'PAKISTAN'),
(188, 'PARAGUAI', 'PARAGUAY'),
(189, 'PERU', 'PERU'),
(190, 'POLINÉSIA FRANCESA', 'FRENCH POLYNESIA'),
(191, 'POLÓNIA', 'POLAND'),
(192, 'PORTO RICO', 'PUERTO RICO'),
(193, 'PORTUGAL', 'PORTUGAL'),
(194, 'QUÉNIA', 'KENYA'),
(195, 'QUIRGUIZISTÃO', 'KYRGYZSTAN'),
(196, 'REINO UNIDO', 'UNITED KINGDOM'),
(197, 'REPÚBLICA CHECA', 'CZECH REPUBLIC'),
(198, 'REPÚBLICA DOMINICANA', 'DOMINICAN REPUBLIC'),
(199, 'ROMÉNIA', 'ROMANIA'),
(200, 'RUANDA', 'RWANDA'),
(201, 'RÚSSIA', 'RUSSIAN FEDERATION'),
(202, 'SAHARA OCCIDENTAL', 'WESTERN SAHARA'),
(203, 'SALVADOR', 'EL SALVADOR'),
(204, 'SAMOA', 'SAMOA'),
(205, 'SANTA HELENA', 'SAINT HELENA'),
(206, 'SANTA LÚCIA', 'SAINT LUCIA'),
(207, 'SANTA SÉ', 'HOLY SEE'),
(208, 'SÃO CRISTÓVÃO E NEVES', 'SAINT KITTS AND NEVIS'),
(209, 'SÃO MARINO', 'SAN MARINO'),
(210, 'SÃO PEDRO E MIQUELÃO', 'SAINT PIERRE AND MIQUELON'),
(211, 'SÃO TOMÉ E PRÍNCIPE', 'SAO TOME AND PRINCIPE'),
(212, 'SÃO VICENTE E GRANADINAS', 'SAINT VINCENT AND THE GRENADINES'),
(213, 'SEICHELES', 'SEYCHELLES'),
(214, 'SENEGAL', 'SENEGAL'),
(215, 'SERRA LEOA', 'SIERRA LEONE'),
(216, 'SÉRVIA', 'SERBIA'),
(217, 'SINGAPURA', 'SINGAPORE'),
(218, 'SÍRIA', 'SYRIA'),
(219, 'SOMÁLIA', 'SOMALIA'),
(220, 'SRI LANCA', 'SRI LANKA'),
(221, 'SUAZILÂNDIA', 'SWAZILAND'),
(222, 'SUDÃO', 'SUDAN'),
(223, 'SUÉCIA', 'SWEDEN'),
(224, 'SUÍÇA', 'SWITZERLAND'),
(225, 'SURINAME', 'SURINAME'),
(226, 'SVALBARD', 'SVALBARD'),
(227, 'TAILÂNDIA', 'THAILAND'),
(228, 'TAIWAN', 'TAIWAN'),
(229, 'TAJIQUISTÃO', 'TAJIKISTAN'),
(230, 'TANZÂNIA', 'TANZANIA'),
(231, 'TERRITÓRIO BRITÂNICO DO OCEANO ÍNDICO', 'BRITISH INDIAN OCEAN TERRITORY'),
(232, 'TERRITÓRIO DAS ILHAS HEARD E MCDONALD', 'HEARD ISLAND AND MCDONALD ISLANDS'),
(233, 'TIMOR-LESTE', 'TIMOR-LESTE'),
(234, 'TOGO', 'TOGO'),
(235, 'TOKELAU', 'TOKELAU'),
(236, 'TONGA', 'TONGA'),
(237, 'TRINDADE E TOBAGO', 'TRINIDAD AND TOBAGO'),
(238, 'TUNÍSIA', 'TUNISIA'),
(239, 'TURKS E CAICOS', 'TURKS AND CAICOS ISLANDS'),
(240, 'TURQUEMENISTÃO', 'TURKMENISTAN'),
(241, 'TURQUIA', 'TURKEY'),
(242, 'TUVALU', 'TUVALU'),
(243, 'UCRÂNIA', 'UKRAINE'),
(244, 'UGANDA', 'UGANDA'),
(245, 'URUGUAI', 'URUGUAY'),
(246, 'USBEQUISTÃO', 'UZBEKISTAN'),
(247, 'VANUATU', 'VANUATU'),
(248, 'VENEZUELA', 'VENEZUELA'),
(249, 'VIETNAME', 'VIETNAM'),
(250, 'WALLIS E FUTUNA', 'WALLIS AND FUTUNA'),
(251, 'ZÂMBIA', 'ZAMBIA'),
(252, 'ZIMBABUÉ', 'ZIMBABWE');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_papelusuario`
--

DROP TABLE IF EXISTS `ig_papelusuario`;
CREATE TABLE IF NOT EXISTS `ig_papelusuario` (
  `idPapelUsuario` int(3) NOT NULL AUTO_INCREMENT,
  `nomePapelUsuario` varchar(60) NOT NULL,
  `acesso` longtext,
  `admin` tinyint(1) DEFAULT NULL,
  `administrador` tinyint(1) DEFAULT NULL,
  `comunicacao` tinyint(1) DEFAULT NULL,
  `contratos` tinyint(1) DEFAULT NULL,
  `documentacao` tinyint(1) DEFAULT NULL,
  `evento` tinyint(1) DEFAULT NULL,
  `financa` tinyint(1) DEFAULT NULL,
  `juridico` tinyint(1) DEFAULT NULL,
  `pagamento` tinyint(1) DEFAULT NULL,
  `producao` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idPapelUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `ig_papelusuario`
--

INSERT INTO `ig_papelusuario` (`idPapelUsuario`, `nomePapelUsuario`, `acesso`, `admin`, `administrador`, `comunicacao`, `contratos`, `documentacao`, `evento`, `financa`, `juridico`, `pagamento`, `producao`) VALUES
(1, 'Root', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 'Administrador local', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
  `registroAudio` int(1) DEFAULT NULL,
  `registroFotografia` int(1) DEFAULT NULL,
  `registroVideo` int(1) DEFAULT NULL,
  PRIMARY KEY (`idProducao`),
  KEY `ig_producao_FKIndex1` (`ig_evento_idEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `ig_producao`
--


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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `ig_produtor`
--

INSERT INTO `ig_produtor` (`idProdutor`, `nome`, `email`, `telefone`, `idSpCultura`) VALUES
(2, 'Marcio Yonamine', 'marcioyonamine@gmail.com', '20943389', 0),
(3, 'Marcio Harum', 'marcioharum@gmail.com', '33974066', 0),
(4, 'teste123', 'marcioyonamine@gmail.com', '20943389', 0),
(5, 'teste123', 'marcioyonamine@gmail.com', '20943389', 0),
(6, 'teste123', 'marcioyonamine@gmail.com', '20943389', 0),
(7, 'Marcio Yonamine', 'Notice: Undefined index: email in /var/www/igsis/perfil/even', '', 0),
(8, 'Marcio Yonamine', 'Notice: Undefined index: email in /var/www/igsis/perfil/even', '', 0);

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

--
-- Extraindo dados da tabela `ig_programa`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_projeto_especial`
--

DROP TABLE IF EXISTS `ig_projeto_especial`;
CREATE TABLE IF NOT EXISTS `ig_projeto_especial` (
  `idProjetoEspecial` int(3) NOT NULL AUTO_INCREMENT,
  `projetoEspecial` varchar(120) NOT NULL,
  `apresentacao` longtext NOT NULL,
  `idInstituicao` int(3) DEFAULT NULL,
  PRIMARY KEY (`idProjetoEspecial`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `ig_projeto_especial`
--

INSERT INTO `ig_projeto_especial` (`idProjetoEspecial`, `projetoEspecial`, `apresentacao`, `idInstituicao`) VALUES
(1, 'Não pertence a nenhum projeto especial', '', 999),
(2, 'Mês da Cultura Independente (MCI)', '', 999),
(3, '50 anos do golpe', '', 5),
(4, 'Edital Programa de Exposições CCSP', '', 5),
(5, 'Edital de Mediação em Arte', '', 5),
(6, 'Edital Novos Coreógrafos', '', 5),
(7, 'Aniversário do CCSP', '', 5),
(8, 'Semanas de Dança', '', 5),
(9, 'Mostra de Fomento', '', 5),
(10, 'Outuro Mês da Criança', '', 5),
(11, 'Dezembro Acessível', '', 5),
(12, 'Circuito Cultural', '', 999);

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

--
-- Extraindo dados da tabela `ig_protocolo`
--


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
  PRIMARY KEY (`idResponsavel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `ig_responsavel`
--

INSERT INTO `ig_responsavel` (`idResponsavel`, `ig_spcultura_idSPCultura`, `tipo`, `nomeResponsavel`, `emailResponsavel`, `telResponsavel`) VALUES
(2, 0, 0, 'Marcio Yonamine', 'marcioyonamine@gmail.com', '112094-3389');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_retirada`
--

DROP TABLE IF EXISTS `ig_retirada`;
CREATE TABLE IF NOT EXISTS `ig_retirada` (
  `idRetirada` int(2) NOT NULL AUTO_INCREMENT,
  `retirada` varchar(120) NOT NULL,
  PRIMARY KEY (`idRetirada`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `ig_retirada`
--

INSERT INTO `ig_retirada` (`idRetirada`, `retirada`) VALUES
(1, 'SEM NECESSIDADE DE RETIRADA DE INGRESSOS'),
(2, 'INGRESSOS GRÁTIS'),
(3, 'INGRESSOS PAGOS'),
(4, 'INGRESSO CINEMA'),
(5, 'INGRESSOS GRÁTIS - 2 HORAS ANTES'),
(6, 'EVENTO FECHADO AO PÚBLICO');

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

--
-- Extraindo dados da tabela `ig_servico`
--


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

--
-- Extraindo dados da tabela `ig_spcultura`
--


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

--
-- Extraindo dados da tabela `ig_status`
--


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
  PRIMARY KEY (`idSubEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `ig_sub_evento`
--


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

--
-- Extraindo dados da tabela `ig_teatro_danca`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_tipo_evento`
--

DROP TABLE IF EXISTS `ig_tipo_evento`;
CREATE TABLE IF NOT EXISTS `ig_tipo_evento` (
  `idTipoEvento` int(3) NOT NULL AUTO_INCREMENT,
  `tipoEvento` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`idTipoEvento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=18 ;

--
-- Extraindo dados da tabela `ig_tipo_evento`
--

INSERT INTO `ig_tipo_evento` (`idTipoEvento`, `tipoEvento`) VALUES
(1, 'Mostra de Cinema'),
(2, 'Exposição'),
(3, 'Espetáculo de dança'),
(4, 'Oficinas'),
(5, 'Palestras e debates'),
(6, 'Recital de poesia e literatura'),
(7, 'Espetáculo teatral'),
(8, 'Contação de histórias'),
(9, 'Teatro infanto-juvenil'),
(10, 'Sarau'),
(11, 'Concerto'),
(12, 'Espetáculo Musical / Show'),
(13, 'Outros'),
(14, 'Teatro Adulto'),
(15, 'Leitura dramática'),
(16, 'Espetáculo de Circo'),
(17, 'Teatro jovem');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ig_tipo_ocorrencia`
--

DROP TABLE IF EXISTS `ig_tipo_ocorrencia`;
CREATE TABLE IF NOT EXISTS `ig_tipo_ocorrencia` (
  `idTipoOcorrencia` int(4) NOT NULL AUTO_INCREMENT,
  `tipoOcorrencia` varchar(60) NOT NULL,
  PRIMARY KEY (`idTipoOcorrencia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `ig_tipo_ocorrencia`
--

INSERT INTO `ig_tipo_ocorrencia` (`idTipoOcorrencia`, `tipoOcorrencia`) VALUES
(1, 'Período de Inscrição de Oficinas'),
(2, 'Divulgação de resultado de Oficinas'),
(3, 'Evento data única'),
(4, 'Evento de temporada'),
(5, 'Sessão de cinema'),
(6, 'Sub-evento');

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
  `email` varchar(60) DEFAULT NULL,
  `nomeCompleto` varchar(120) DEFAULT NULL,
  `idInstituicao` int(3) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `ig_usuario_FKIndex1` (`ig_papelusuario_idPapelUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `ig_usuario`
--

INSERT INTO `ig_usuario` (`idUsuario`, `ig_papelusuario_idPapelUsuario`, `senha`, `receberNotificacao`, `nomeUsuario`, `email`, `nomeCompleto`, `idInstituicao`) VALUES
(1, 1, 'e44313433d93ce4d00143f4773be2dfc', 1, 'marcioyonamine', 'marcioyonamine@gmail.com', 'Marcio Yonamine', 5),
(7, 1, '7f4b4dfa7bab4f7c29d400db2a12fc21', 1, 'ccsplab', 'igccsp2015@gmail.com', 'CCSP Lab', 5),
(8, 1, 'c15d309c76c545bccff133852eebbd07', 1, 'junior', 'juzenhu@gmail.com', 'Junior Ramalho', 5);

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `ig_alteracao`
--
ALTER TABLE `ig_alteracao`
  ADD CONSTRAINT `fk_{F4B41A4D-A75E-4B4F-B291-3E196EE08469}` FOREIGN KEY (`ig_evento_idEvento`) REFERENCES `ig_evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `ig_anexos`
--
ALTER TABLE `ig_anexos`
  ADD CONSTRAINT `fk_{A0BA7468-62E8-4D1D-8857-22784B101B5D}` FOREIGN KEY (`ig_evento_idEvento`) REFERENCES `ig_evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_{BC876EDC-82DE-47D0-89D9-A9618CA3BECC}` FOREIGN KEY (`ig_alteracao_idAlteracao`) REFERENCES `ig_alteracao` (`idAlteracao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `ig_arquivo`
--
ALTER TABLE `ig_arquivo`
  ADD CONSTRAINT `fk_{79A43DE5-3D61-434A-BAEC-9A60B9D86D16}` FOREIGN KEY (`ig_evento_idEvento`) REFERENCES `ig_evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `ig_log`
--
ALTER TABLE `ig_log`
  ADD CONSTRAINT `fk_{E062B9E4-E44A-4C2C-94D4-052FE04DB721}` FOREIGN KEY (`ig_usuario_idUsuario`) REFERENCES `ig_usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `ig_musica`
--
ALTER TABLE `ig_musica`
  ADD CONSTRAINT `fk_{F67D3205-E0B0-42E3-A800-B15585C351C6}` FOREIGN KEY (`ig_evento_idEvento`) REFERENCES `ig_evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `ig_producao`
--
ALTER TABLE `ig_producao`
  ADD CONSTRAINT `fk_{A21FE65D-9B78-489F-AC84-A970111E6351}` FOREIGN KEY (`ig_evento_idEvento`) REFERENCES `ig_evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `ig_protocolo`
--
ALTER TABLE `ig_protocolo`
  ADD CONSTRAINT `fk_{4EFEDB61-453C-4F3F-B985-F15FEDD987FE}` FOREIGN KEY (`ig_evento_idEvento`) REFERENCES `ig_evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `ig_servico`
--
ALTER TABLE `ig_servico`
  ADD CONSTRAINT `fk_{394B952E-8AB1-42C8-B375-C0D33E589D96}` FOREIGN KEY (`ig_evento_idEvento`) REFERENCES `ig_evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `ig_status`
--
ALTER TABLE `ig_status`
  ADD CONSTRAINT `fk_{EF836E01-763F-4D16-BE2E-61495590A941}` FOREIGN KEY (`ig_evento_idEvento`) REFERENCES `ig_evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `ig_teatro_danca`
--
ALTER TABLE `ig_teatro_danca`
  ADD CONSTRAINT `fk_{64CC3230-DE9D-4674-A6A5-F1B87A12D87D}` FOREIGN KEY (`ig_evento_idEvento`) REFERENCES `ig_evento` (`idEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `ig_usuario`
--
ALTER TABLE `ig_usuario`
  ADD CONSTRAINT `ig_usuario_ibfk_1` FOREIGN KEY (`ig_papelusuario_idPapelUsuario`) REFERENCES `ig_papelusuario` (`idPapelUsuario`);
