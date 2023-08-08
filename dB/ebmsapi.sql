-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 26 jan. 2023 à 09:48
-- Version du serveur : 10.4.20-MariaDB
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ebmsapi`
--

-- --------------------------------------------------------

--
-- Structure de la table ` cancelled_inv`
--

CREATE TABLE ` cancelled_inv` (
  `cancelled_inv_ref` int(11) NOT NULL,
  `inv_ref` int(11) NOT NULL,
  `cn_motif` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_TIN` varchar(50) DEFAULT NULL,
  `customer_address` varchar(100) DEFAULT NULL,
  `vat_customer_payer` enum('0','1') NOT NULL DEFAULT '0',
  `created` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tbl_customer`
--

INSERT INTO `tbl_customer` (`customer_id`, `customer_name`, `customer_TIN`, `customer_address`, `vat_customer_payer`, `created`) VALUES
(1, 'Passager', '', '', '0', '2023-01-21'),
(2, 'MUGIRANEZA Aimable', '4000039521', 'Asiatique', '1', '2023-01-21');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_interconnect`
--

CREATE TABLE `tbl_interconnect` (
  `con_id` int(11) NOT NULL,
  `con_url` varchar(100) NOT NULL,
  `con_username` varchar(50) NOT NULL,
  `con_password` varchar(50) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tbl_interconnect`
--

INSERT INTO `tbl_interconnect` (`con_id`, `con_url`, `con_username`, `con_password`, `created_at`) VALUES
(1, 'https://ebms.obr.gov.bi:9443/ebms_api/', 'ws400170448700446\n', 'iY<.6qF7\n', '2023-01-11'),
(2, 'https://ebms.obr.gov.bi:8443/ebms_api/', 'wsl400003952100197', '69mH,c#L', '2023-01-20');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_inv_order`
--

CREATE TABLE `tbl_inv_order` (
  `order_id` int(11) NOT NULL,
  `invoice_number` varchar(30) NOT NULL,
  `invoice_date` date NOT NULL,
  `invoice_type` enum('FN','FA','RC','RHC') NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_total_before_tax` float NOT NULL DEFAULT 0,
  `order_total_tax1` float NOT NULL DEFAULT 0,
  `order_total_tax2` float NOT NULL DEFAULT 0,
  `order_total_tax3` float NOT NULL DEFAULT 0,
  `order_total_tax` float NOT NULL DEFAULT 0,
  `order_total_after_tax` float NOT NULL DEFAULT 0,
  `order_datetime` int(11) NOT NULL,
  `invoice_signature` varchar(90) DEFAULT NULL,
  `statut` enum('0','1') DEFAULT '0',
  `annuler` enum('0','1') DEFAULT '0',
  `payment_type` enum('1','2','3','4') DEFAULT '1',
  `iduser` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_inv_order_item`
--

CREATE TABLE `tbl_inv_order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_name` varchar(250) NOT NULL,
  `order_item_quantity` float NOT NULL DEFAULT 0,
  `order_item_price` float NOT NULL DEFAULT 0,
  `order_item_actual_amount` float NOT NULL DEFAULT 0,
  `order_item_tax1_rate` float NOT NULL DEFAULT 0,
  `order_item_tax1_amount` float NOT NULL DEFAULT 0,
  `order_item_tax2_rate` float NOT NULL DEFAULT 0,
  `order_item_tax2_amount` float NOT NULL DEFAULT 0,
  `order_item_tax3_rate` float NOT NULL DEFAULT 0,
  `order_item_tax3_amount` float NOT NULL DEFAULT 0,
  `order_item_final_amount` float NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_society`
--

CREATE TABLE `tbl_society` (
  `tp_id` int(11) NOT NULL,
  `tp_type` enum('1','2') NOT NULL DEFAULT '1',
  `tp_name` varchar(100) DEFAULT NULL,
  `tp_TIN` varchar(30) DEFAULT NULL,
  `tp_trade_number` varchar(20) DEFAULT NULL,
  `tp_postal_number` varchar(20) NOT NULL,
  `tp_phone_number` varchar(20) DEFAULT NULL,
  `tp_address_province` varchar(50) DEFAULT NULL,
  `tp_address_commune` varchar(50) DEFAULT NULL,
  `tp_address_quartier` varchar(50) DEFAULT NULL,
  `tp_address_avenue` varchar(50) DEFAULT NULL,
  `tp_address_rue` varchar(50) DEFAULT NULL,
  `tp_address_number` varchar(50) DEFAULT NULL,
  `vat_taxpayer` enum('0','1') NOT NULL DEFAULT '0',
  `ct_taxpayer` enum('0','1') NOT NULL DEFAULT '0',
  `tl_taxpayer` enum('0','1') NOT NULL DEFAULT '0',
  `tp_fiscal_center` enum('DGC','DMC','DPMC') NOT NULL DEFAULT 'DGC',
  `tp_activity_sector` varchar(200) DEFAULT NULL,
  `tp_legal_form` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tbl_society`
--

INSERT INTO `tbl_society` (`tp_id`, `tp_type`, `tp_name`, `tp_TIN`, `tp_trade_number`, `tp_postal_number`, `tp_phone_number`, `tp_address_province`, `tp_address_commune`, `tp_address_quartier`, `tp_address_avenue`, `tp_address_rue`, `tp_address_number`, `vat_taxpayer`, `ct_taxpayer`, `tl_taxpayer`, `tp_fiscal_center`, `tp_activity_sector`, `tp_legal_form`) VALUES
(1, '1', 'SPACELINE', '4001704487', '65143', '0000', '61867542', 'BUJUMBURA', 'MUKAZA', 'ASIATIQUE', 'BLD NDADAYE MELCHIOR', '9', '1', '1', '0', '0', 'DGC', 'SERVICE MARCHAND', 'suprl');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `nom`, `prenom`, `tel`, `email`, `password`, `created`) VALUES
(7, 'Placide', 'Waki', '12345678', 'placidewaki@gmail.com', 'MTIzNDU2', '2023-01-20 22:06:03');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table ` cancelled_inv`
--
ALTER TABLE ` cancelled_inv`
  ADD PRIMARY KEY (`cancelled_inv_ref`);

--
-- Index pour la table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Index pour la table `tbl_interconnect`
--
ALTER TABLE `tbl_interconnect`
  ADD PRIMARY KEY (`con_id`);

--
-- Index pour la table `tbl_inv_order`
--
ALTER TABLE `tbl_inv_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Index pour la table `tbl_inv_order_item`
--
ALTER TABLE `tbl_inv_order_item`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Index pour la table `tbl_society`
--
ALTER TABLE `tbl_society`
  ADD PRIMARY KEY (`tp_id`);

--
-- Index pour la table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table ` cancelled_inv`
--
ALTER TABLE ` cancelled_inv`
  MODIFY `cancelled_inv_ref` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `tbl_interconnect`
--
ALTER TABLE `tbl_interconnect`
  MODIFY `con_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tbl_inv_order`
--
ALTER TABLE `tbl_inv_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tbl_inv_order_item`
--
ALTER TABLE `tbl_inv_order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tbl_society`
--
ALTER TABLE `tbl_society`
  MODIFY `tp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
