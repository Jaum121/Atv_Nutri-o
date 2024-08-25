-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08/07/2024 às 07:15
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
-- Banco de dados: `meubanco`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacao_nutricional`
--

CREATE TABLE `avaliacao_nutricional` (
  `id` int(11) NOT NULL,
  `nome_paciente` varchar(100) NOT NULL,
  `id_profissional` int(11) NOT NULL,
  `codigo_procedimento` int(11) NOT NULL,
  `data_avaliacao` date NOT NULL,
  `historico_clinico` text NOT NULL,
  `exames` text NOT NULL,
  `avaliacao_antropometrica` text NOT NULL,
  `circunferencia_cefalica` float NOT NULL,
  `circunferencia_braco` float NOT NULL,
  `circunferencia_punho` float NOT NULL,
  `circunferencia_cintura` float NOT NULL,
  `circunferencia_quadril` float NOT NULL,
  `circunferencia_panturrilha` float NOT NULL,
  `dobra_cutanea` float NOT NULL,
  `dobra_cutanea_subescapular` float NOT NULL,
  `dobra_cutanea_abdominal` float NOT NULL,
  `circunferencia_suprailiaca` float NOT NULL,
  `dobra_cutanea_panturrilha` float NOT NULL,
  `dobra_cutanea_coxa` float NOT NULL,
  `plano_alimentar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `avaliacao_nutricional`
--

INSERT INTO `avaliacao_nutricional` (`id`, `nome_paciente`, `id_profissional`, `codigo_procedimento`, `data_avaliacao`, `historico_clinico`, `exames`, `avaliacao_antropometrica`, `circunferencia_cefalica`, `circunferencia_braco`, `circunferencia_punho`, `circunferencia_cintura`, `circunferencia_quadril`, `circunferencia_panturrilha`, `dobra_cutanea`, `dobra_cutanea_subescapular`, `dobra_cutanea_abdominal`, `circunferencia_suprailiaca`, `dobra_cutanea_panturrilha`, `dobra_cutanea_coxa`, `plano_alimentar`) VALUES
(1, 'joaao', 23, 78048343, '0000-00-00', '23232323', '23232323', '232323', 23, 232, 232, 34, 342, 3454, 4523, 23542, 454, 234523, 24534, 234, '2rwetc wrtf4v5cyw4v56usetrgcvwr6bh wrthvret6uwea5tgwr6hwvrthscrth rthwcrthesrtdsvcjohaSDVBhjasdyuvibEASDCBIHwevhjkobwERVIUHOBGWERTQWRTCQVERHHWERYHE5HVSETGHCSRTHCVSETR GHWSRTHJCWE5YVHGSERW5VBHCAERGCVRTYJKTE7RJQCHERTJDSRYVHGCAERHCSRYV');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ficha_nutricional`
--

CREATE TABLE `ficha_nutricional` (
  `id` int(11) NOT NULL,
  `nome_paciente` varchar(255) NOT NULL,
  `idade_paciente` int(11) NOT NULL,
  `refeicao` varchar(255) NOT NULL,
  `alimento` varchar(255) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `calorias` int(11) NOT NULL,
  `cpf_paciente` varchar(11) NOT NULL,
  `data_avaliacao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ficha_nutricional`
--

INSERT INTO `ficha_nutricional` (`id`, `nome_paciente`, `idade_paciente`, `refeicao`, `alimento`, `quantidade`, `calorias`, `cpf_paciente`, `data_avaliacao`) VALUES
(25, 'joa', 544, '43524534', 'carro', 465563, 3454, '33344455510', '2453-05-31T03:34'),
(27, 'joaao89879', 34, '345345', '225245', 235234, 2253523, '33344455510', '5454-04-12T04:03');

-- --------------------------------------------------------

--
-- Estrutura para tabela `informacoes`
--

CREATE TABLE `informacoes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `idade` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `prognostico` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `informacoes`
--

INSERT INTO `informacoes` (`id`, `nome`, `idade`, `email`, `prognostico`) VALUES
(1, 'Evandro Oliveira Ferraz da Costa', 22, 'Ferrazra@terra.com.br', 'dfdfdfdf');

-- --------------------------------------------------------

--
-- Estrutura para tabela `procedimento`
--

CREATE TABLE `procedimento` (
  `id_procedimento` int(11) NOT NULL,
  `nome_procedimento` varchar(100) NOT NULL,
  `descricao_procedimento` text NOT NULL,
  `valor_procedimento` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `profissional`
--

CREATE TABLE `profissional` (
  `cod_profissional` int(11) NOT NULL,
  `nome_profissional` varchar(100) NOT NULL,
  `tipo_profissional` varchar(50) NOT NULL,
  `supervisor_profissional` varchar(100) NOT NULL,
  `situacao_profissional` varchar(50) NOT NULL,
  `conselho_profissional` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `prontuario`
--

CREATE TABLE `prontuario` (
  `cpf_paciente` bigint(11) NOT NULL,
  `cod_especialidade` int(10) NOT NULL,
  `cod_profissional` int(10) NOT NULL,
  `cod_procedimento` int(10) NOT NULL,
  `data_procedimento` date NOT NULL,
  `descr_procedimento` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `prontuario`
--

INSERT INTO `prontuario` (`cpf_paciente`, `cod_especialidade`, `cod_profissional`, `cod_procedimento`, `data_procedimento`, `descr_procedimento`) VALUES
(11134543212, 23, 34, 122, '4243-05-04', '34343fgfg'),
(12345678901, 1, 2, 3, '2023-01-01', 'Procedimento de Exemplo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `is_admin`) VALUES
(15, 'Evandro', '12345', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `avaliacao_nutricional`
--
ALTER TABLE `avaliacao_nutricional`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ficha_nutricional`
--
ALTER TABLE `ficha_nutricional`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `informacoes`
--
ALTER TABLE `informacoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `procedimento`
--
ALTER TABLE `procedimento`
  ADD PRIMARY KEY (`id_procedimento`);

--
-- Índices de tabela `profissional`
--
ALTER TABLE `profissional`
  ADD PRIMARY KEY (`cod_profissional`);

--
-- Índices de tabela `prontuario`
--
ALTER TABLE `prontuario`
  ADD PRIMARY KEY (`cpf_paciente`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `avaliacao_nutricional`
--
ALTER TABLE `avaliacao_nutricional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `ficha_nutricional`
--
ALTER TABLE `ficha_nutricional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `informacoes`
--
ALTER TABLE `informacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `procedimento`
--
ALTER TABLE `procedimento`
  MODIFY `id_procedimento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `profissional`
--
ALTER TABLE `profissional`
  MODIFY `cod_profissional` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
