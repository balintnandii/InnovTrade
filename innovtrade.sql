-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Már 24. 22:32
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `innovtrade`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `autok`
--

CREATE TABLE `autok` (
  `id` int(11) NOT NULL,
  `nev` varchar(100) NOT NULL,
  `kategoria` varchar(50) NOT NULL,
  `napi_dij` int(11) NOT NULL,
  `leiras` text DEFAULT NULL,
  `kep_utvonal` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `id` int(11) NOT NULL,
  `felhasznalonev` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `jelszo` varchar(255) NOT NULL,
  `regisztracio_datum` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `felhasznalonev`, `email`, `jelszo`, `regisztracio_datum`) VALUES
(1, 'aa', 'aa@gmail.com', '$2y$10$LYgSh85jpSQZlOIBBwKIZeESjNRvgGpUS8CPLyarxMAx7IUB1b1T6', '2025-02-11 16:42:50'),
(2, 'gg', 'gg@gmail.com', '$2y$10$3leKtgVso0zjpQjiQyWU7ecOvdgrOJsbv/dDegtcJHeKOUebZgVrm', '2025-02-11 16:46:38'),
(3, 'Gipsz Jakab', 'mrclrozsa@gmail.com', '$2y$10$CNCKP5xvVtjo5yGa.lm5b.udJwwS/ss/J2lD2mSnsMqid3fllTHwy', '2025-02-11 16:58:51'),
(4, 'Gipsz Jakab', 'mrclrozsa@gmail.com', '$2y$10$Gv3LCuF0nhq8IY8mpDOlFukBxg4Cg6NXXX/E4kX9BKrRzwCzUEtFK', '2025-02-11 17:10:14'),
(5, 'Gipsz Jakab', 'mrclrozsa@gmail.com', '$2y$10$b29Dekkr2K/8pXb380LRfud/P3uHgQcuLWS34QP./u8gF4FMAbOEK', '2025-02-11 17:20:30'),
(6, 'Bajnok', 'bajnok@gmail.com', '$2y$10$wS4JfwTKyXr0XWzR8Pp/YuwM4zNRcan3eWdA93b.PcCCECgGLtDGS', '2025-02-11 17:44:21'),
(7, 'Bajnok', 'bajnok@gmail.com', '$2y$10$urJWTwp8WfEfz.ZkRmAxPeugO1btgYUuFes90WojJKFnPWy.WSir.', '2025-02-11 17:45:25'),
(8, 'Bajnok', 'bajnok@gmail.com', '$2y$10$wiMbcFzxo6XaO0w5AhyiGuxAQytkx2.gGHh9tf2Y6vahEK8VDH8vW', '2025-02-11 17:45:26'),
(9, 'Bajnok', 'bajnok@gmail.com', '$2y$10$5eGWFJXMyGLPTXL.E6j91.FXCaeNdC71emQyZBWcnLT2EjOxDhecK', '2025-02-11 17:45:27'),
(10, 'Bajnok', 'bajnok@gmail.com', '$2y$10$yYrIbSkC2wlgk7Q3LBR4BeZ3xmiOGX39bI64iaYwc1Tu93QsmwsVm', '2025-02-11 17:45:31'),
(11, 'Bajnok', 'bajnok@gmail.com', '$2y$10$6T7KphKK9i/81azG9VEJcu3HtB8p3txcblIZl.20NO3k6RAjCqr.i', '2025-02-11 17:45:32'),
(12, 'Bajnok', 'bajnok@gmail.com', '$2y$10$.fXglLA24k71ucq5x8M0LOXZwOxhQGe5JT9AtwI6hWZTBWcvmqR8y', '2025-02-11 17:45:34'),
(13, 'Gipsz Jakab1', 'bajnok1@gmail.com', '$2y$10$CLjdVqeYX57Wi7fn6sUxbeUAHBv40wqvQOIb1vfr1iCGY4XrNItq.', '2025-02-11 17:53:29'),
(14, 'Gipsz Jakab1', 'bajnok1@gmail.com', '$2y$10$4OrMoyoB7mqO3hadl18gbOSCzKvRfjcyC48ac3fqEoh84gnGOoGbW', '2025-02-11 17:53:30'),
(15, 'Gipsz Jakab1', 'bajnok1@gmail.com', '$2y$10$vUGGPFV7Sc0s1yB.S3CPdOiIaMxfSGCB.cmpxliWFa1QFU3TgJ3Mi', '2025-02-11 17:53:31'),
(16, 'Gipsz Jakab1', 'bajnok1@gmail.com', '$2y$10$TMjDCJN1.PC/XX1w0eLZzO/9USFbBJbLocLiKocuqwHH6msh1R2Le', '2025-02-11 17:53:31'),
(17, 'Gipsz Jakab1', 'bajnok1@gmail.com', '$2y$10$1HcMNsYiAEJQTHQGYpbbQeOSLBLJCFCsdo.IygDKZpL8J.A1YTuVi', '2025-02-11 17:53:31'),
(18, 'Gipsz Jakab1', 'bajnok1@gmail.com', '$2y$10$wZ/fV6Ru5jcjbIphDVjg3ui/Rylw5N03Y8mFcBsly50i3dRAtcqPO', '2025-02-11 17:53:31'),
(19, 'Gipsz Jakab1', 'bajnok1@gmail.com', '$2y$10$l773KZaoF4NBAcCJj0ujwONctUNIbEJ4LzvoNwbDyBN/K8v2X27.u', '2025-02-11 17:53:31'),
(20, 'Gipsz Jakab1', 'bajnok1@gmail.com', '$2y$10$cyzTDkldYaZxb95PMqjPOOED8TLwVmGWgAntyFtoiTQPQQkmAFf/y', '2025-02-11 17:53:32'),
(21, 'Gipsz Jakab1', 'bajnok1@gmail.com', '$2y$10$DS.Gj8qOAUtUQfmZKXPBru6ThLwJb6iU4Qo9BX8cNM6modsNdOWka', '2025-02-11 17:55:50'),
(22, 'Gipsz Jakab1', 'bajnok1@gmail.com', '$2y$10$XmvE3g1D2iC13.ds5wY6Q.P8mV4X/8bMrrt1XKt7ME.gHSWvaV77m', '2025-02-11 17:55:53'),
(23, 'Bajnok', 'bajnok1@gmail.com', '$2y$10$xulqASt0ZKalMM8UH5Ko7ORaot0a7.AfCMCvkMVeUT5VUJVV31AHu', '2025-02-11 17:57:10'),
(24, 'Bajnok', 'bajnok1@gmail.com', '$2y$10$GLfCgVP8IFpaIq8pGf6j3e5ySmeNABl/mWQMrn2VjdS9hJGba0Gdy', '2025-02-11 17:57:11'),
(25, 'Bajnok', 'bajnok1@gmail.com', '$2y$10$wX.30jVf64WF1Jel8pAYhukUR.8cpezANXgBmzR8BBjop7lNeXMFW', '2025-02-11 17:57:12'),
(26, 'Bajnok', 'bajnok1@gmail.com', '$2y$10$5I/VCk60R1KPZUt9di981.AzrQft1qEBFp8M/sWj5KmmcMQKDy2bW', '2025-02-11 17:57:12'),
(27, 'Gipsz ', 'bajno@gmail.com', '$2y$10$G4NVf9PrAaOvcq2Hm2ECqO.1mpS05BTIt6ej44fLtNp.Sh.otTjCW', '2025-02-11 18:10:47'),
(28, 'Gipsz ', 'bajno@gmail.com', '$2y$10$cuadZL3rQenEyBO.aVFuzuxJOjZdtAkIlZVVN65xRldDTb0lJOLQu', '2025-02-11 18:18:06'),
(29, 'GipszJ', 'bajnokJ@gmail.com', '$2y$10$JSzB1YK3GUnwOApt6JNrmOGmE/FpuIqtwBCbSwt5xPsGGTipjtS3u', '2025-02-11 18:18:30'),
(30, 'm', 'm@gmail.com', '$2y$10$.XwsDcsKU5VMhNPqEW83n.YcFulJIMfgZ7y7IzQbUJiK8F4yL8z2e', '2025-02-11 18:20:48'),
(31, 'GG2', 'GG2@gmail.com', '$2y$10$ONkTwTHrHf0NG0SsFhvj3ehHTLs2yQNbXXrXFqqNAbgLpR2Xva3wy', '2025-02-11 19:30:38'),
(32, 'asd', 'asd@gmail.com', '$2y$10$glYJLAucSg0fbvu/1TDnFeYaGmYk5XXxXMiLwqZEQ2r96XtWl3a2y', '2025-02-11 19:38:45'),
(33, 'asd', 'gg@gmail.com', '$2y$10$SRcvMLYJlKj.dEfQG6V/A.4Ut3hkEu4jGpNn/nBdT4H8DCMBIAeYe', '2025-02-11 19:39:26'),
(34, 'gg3', 'gg3@gmail.com', '$2y$10$rxNpktAuzi8zOf2IYdJvx.ZVt9hsYoWIohVxgTGilvlzdWt6srqVK', '2025-02-13 13:06:46'),
(35, 'gg4', 'gg4@gmail.com', '$2y$10$i2xNRDHlZHnxaBtZTeVUz.wsJGkbIbCLcyUIRLWc8h.1pu/GNe5u.', '2025-02-13 13:16:29'),
(36, 'gg4', 'gg4@gmail.com', '$2y$10$oS8vRmRTyLQjGhesMdP/1eL7LuvBFDRjIDRLpDJwPClMMd1yQVg7e', '2025-02-13 14:00:03'),
(37, 'Gipsz Jakab', 'bajnok1@gmail.com', '$2y$10$X4Lh2D45MeIljdYvYYdiOenP7VlmEtqZ6aaeN0uf9thhfKkr1YRH6', '2025-02-13 16:09:09'),
(38, 'Gipsz Jakab2', 'bajnok@gmail.com', '$2y$10$1PQ/lrzPUI.I.oDtQMi47eCbCMVEQu95l3zEkpvnTUeCUpZGw.7hW', '2025-02-13 17:30:49'),
(39, 'aa', 'aa@gmail.com', '$2y$10$7BBoF2th3GLdDofuRdvcguaa7Pz3VH.6861WF3.Ao.EM25d6Bg2ju', '2025-02-18 22:22:52');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `foglalasok`
--

CREATE TABLE `foglalasok` (
  `id` int(11) NOT NULL,
  `felhasznalo_id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `ido` int(11) NOT NULL,
  `osszeg` int(11) NOT NULL,
  `foglalas_datum` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kapcsolatok`
--

CREATE TABLE `kapcsolatok` (
  `id` int(11) NOT NULL,
  `nev` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `uzenet` text NOT NULL,
  `kuldes_datum` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `velemenyek`
--

CREATE TABLE `velemenyek` (
  `id` int(11) NOT NULL,
  `auto_nev` varchar(100) NOT NULL,
  `szoveg` text NOT NULL,
  `felhasznalo_id` int(11) NOT NULL,
  `letrehozas_datum` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `autok`
--
ALTER TABLE `autok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `foglalasok`
--
ALTER TABLE `foglalasok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `felhasznalo_id` (`felhasznalo_id`);

--
-- A tábla indexei `kapcsolatok`
--
ALTER TABLE `kapcsolatok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `velemenyek`
--
ALTER TABLE `velemenyek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `felhasznalo_id` (`felhasznalo_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `autok`
--
ALTER TABLE `autok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT a táblához `foglalasok`
--
ALTER TABLE `foglalasok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `kapcsolatok`
--
ALTER TABLE `kapcsolatok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `velemenyek`
--
ALTER TABLE `velemenyek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `foglalasok`
--
ALTER TABLE `foglalasok`
  ADD CONSTRAINT `foglalasok_ibfk_1` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalok` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `velemenyek`
--
ALTER TABLE `velemenyek`
  ADD CONSTRAINT `velemenyek_ibfk_1` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalok` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
