# 🎓 BDE Events Management System

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php)

## 📝 Description
**BDE Events** est une plateforme web complète développée pour la gestion des événements du Bureau Des Étudiants (BDE). Ce projet permet de digitaliser le processus de création des événements et la réservation des billets par les étudiants, tout en assurant une gestion stricte des places disponibles (Jauge maximale) et en évitant les surréservations.

## ✨ Fonctionnalités Principales

### 🛡️ Espace Administrateur (Membre BDE)
* **CRUD des Événements :** Créer, lire, modifier et supprimer des événements (Titre, Description, Date, Heure, Lieu, Prix, Jauge maximale).
* **Sécurité & Intégrité :** Impossibilité de supprimer un événement si des réservations sont déjà associées (Protection de la base de données).
* **Tableau de bord :** Suivi en temps réel du nombre de réservations par événement.

### 🎓 Espace Étudiant
* **Réservation intelligente :** Bouton de réservation dynamique (se désactive automatiquement si l'événement est complet ou si l'étudiant a déjà réservé).
* **Gestion des conflits (Race Condition) :** Utilisation de la méthode de décrémentation sécurisée pour garantir qu'aucune place fantôme n'est attribuée.
* **Mes Tickets (Pass Numérique) :** Accès à un espace personnel listant les réservations "À venir" avec génération d'un code de réservation unique (ex: `RES-123456789`).

## 🏗️ Architecture & Conception (UML)
Le système repose sur une conception orientée objet (OOP) solide :
* **Héritage (Generalization) :** Les entités `Admin` et `Student` héritent de la super-classe `User`, permettant de centraliser l'authentification tout en séparant les logiques métiers (Création d'événements vs Réservation).
* **Base de données relationnelle :** Utilisation du système de contraintes et des jointures SQL pour lier les utilisateurs, les événements et les réservations.

## 🚀 Technologies Utilisées
* **Backend :** Laravel 11 (PHP)
* **Frontend :** Blade, Tailwind CSS, JavaScript
* **Base de données :** MySQL
* **Authentification :** Laravel Breeze (Architecture Multi-Rôles avec Middlewares personnalisés `is_admin` et `is_student`)

## 🛠️ Installation en Local (Pour le Jury)

Suivez ces étapes pour lancer le projet sur votre machine locale :

**1. Cloner le dépôt :**
```bash
git clone [https://github.com/votre-nom-utilisateur/bde-events.git](https://github.com/votre-nom-utilisateur/bde-events.git)
cd bde-events
