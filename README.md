# Projet Kumiai - Plateforme d'apprentissage linguistique

Bienvenue sur le dépôt du projet Kumiai. Cette application web a été développée pour structurer et faciliter l'apprentissage des langues, en mettant un accent particulier sur l'étude du japonais. Le système propose un environnement interactif pour maîtriser les Kanjis et le vocabulaire de manière progressive. 

Ce dépôt s'adresse aussi bien aux personnes souhaitant utiliser la plateforme au quotidien qu'aux développeurs désirant explorer son architecture ou y contribuer.

---

## Fonctionnalités principales

L'application est divisée en plusieurs modules distincts afin d'isoler les différentes étapes de l'apprentissage et de la gestion de compte :

*   **Module Kanjis :** Un espace entièrement dédié à la révision, la lecture et la mémorisation des caractères complexes.
*   **Module Vocabulaire :** Des outils conçus pour l'assimilation de nouveaux mots et leur intégration dans la pratique régulière.
*   **Espace Utilisateur :** Un système complet gérant l'inscription, l'authentification sécurisée et la personnalisation du profil.
*   **Tableau de bord :** Une interface centrale permettant à l'utilisateur de suivre son parcours et de naviguer fluidement entre les leçons.

---

## Architecture technique

Le projet repose sur des technologies web natives, garantissant une exécution rapide, une maintenance facilitée et une grande compatibilité avec les hébergements standards.

*   **Logique serveur (Backend) :** PHP
*   **Interface (Frontend) :** HTML5, CSS3
*   **Gestion des données :** MySQL / MariaDB

---

## Déploiement en environnement local

Le déploiement de Kumiai sur votre machine nécessite un environnement de développement local. Voici la procédure étape par étape pour initialiser le projet.

### 1. Prérequis système
Assurez-vous de disposer d'un serveur web local fonctionnel. Les solutions tout-en-un suivantes sont recommandées :
*   XAMPP (Windows, Linux, macOS)
*   WAMP (Windows)
*   MAMP (macOS)

### 2. Récupération du code source
Ouvrez votre interface en ligne de commande, placez-vous dans le répertoire public de votre serveur web (généralement `htdocs` ou `www`), puis clonez le dépôt :

```bash
git clone [https://github.com/Tenbatsu11/siteweb.git](https://github.com/Tenbatsu11/siteweb.git)
cd siteweb
