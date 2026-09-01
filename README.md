<div align="center">

# BDE Events

**Plateforme de Gestion des Événements**

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwindcss&logoColor=white)

</div>

> **BDE Events** est une application web moderne développée pour digitaliser et optimiser la gestion des événements parascolaires du Bureau Des Étudiants (BDE).

---

## À propos du projet

Ce projet permet au BDE de créer des événements avec des capacités limitées (jauges maximales) et offre aux étudiants une interface fluide pour réserver leurs places. Le système intègre des sécurités avancées pour gérer les accès concurrents (*Race Conditions*) et empêcher les surréservations, garantissant ainsi l'intégrité des données.

---

## Fonctionnalités principales

### Espace Administrateur (BDE)

* **Tableau de Bord Intégré :** Suivi en temps réel des statistiques et du chiffre d'affaires des événements.
* **Gestion des Événements (CRUD) :** Création, modification et suppression sécurisée des événements (Titre, Date, Prix, Jauge).
* **Sécurité de la Data :** Blocage des suppressions si l'événement contient déjà des étudiants inscrits.

### Espace Étudiant

* **Réservation Intelligente :** Bouton d'action dynamique (s'adapte si l'événement est complet ou déjà réservé).
* **Pass Numérique :** Espace "Mes Tickets" listant les événements à venir avec génération d'un code de réservation unique (ex: `RES-123456789`).

---

## Modélisation et conception (UML)

Pour garantir une architecture solide, compréhensible et évolutive, la conception de ce projet s'est appuyée sur des modélisations UML précises avant toute ligne de code.

### 1. Diagramme de Classes (UML)

Ce diagramme met en évidence la conception orientée objet (OOP). On y retrouve le concept d'**Héritage** (Generalization) où l'Admin et l'Étudiant héritent de la classe centrale `User`.

<div align="center">
  <img src="public/BDE%20UML.png" alt="Diagramme de Classes UML" width="800">
</div>

### 2. Diagramme des Cas d'Utilisation (Use Case)

Ce diagramme définit les rôles et les périmètres d'action des différents acteurs interagissant avec le système, en séparant strictement l'authentification et les droits métiers (Middlewares).

<div align="center">
  <img src="public/BDE%20use%20casse.png" alt="Diagramme des Cas d'Utilisation" width="800">
</div>

### 3. Modèle Entité-Association (ERD)

Ce schéma illustre la structure de la base de données relationnelle, mettant en avant les clés étrangères et les jointures nécessaires pour lier les utilisateurs, les événements et les réservations.

<div align="center">
  <img src="public/BDE%20ERD.png" alt="Entity Relationship Diagram" width="800">
</div>

---

## Stack technique

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![Blade](https://img.shields.io/badge/Blade-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=flat-square&logo=tailwindcss&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=flat-square&logo=mysql&logoColor=white)
![Laravel Breeze](https://img.shields.io/badge/Laravel_Breeze-FF2D20?style=flat-square&logo=laravel&logoColor=white)

</div>

* **Framework Backend :** Laravel 12 (Architecture MVC)
* **Base de données :** MySQL
* **Frontend :** Moteur de template Blade & Tailwind CSS
* **Authentification :** Laravel Breeze (Multi-rôles personnalisés)

---

## Installation en local

Pour tester le projet sur votre machine, veuillez suivre les instructions ci-dessous :

**1. Cloner le dépôt :**

```bash
git clone https://github.com/votre-nom-utilisateur/bde-events.git
cd bde-events
```

**2. Installer les dépendances :**

```bash
composer install
npm install
npm run build
```

**3. Configurer l'environnement :**

```bash
cp .env.example .env
```

(Ouvrez le fichier `.env` et configurez votre connexion MySQL)

**4. Générer la clé de l'application et migrer :**

```bash
php artisan key:generate
php artisan migrate
```

**5. Lancer le serveur local :**

```bash
php artisan serve
```
## 6. Liens du projet

- [Live Demo ](https://frontend-bde.vercel.app/)
- [Tableau Trello](https://trello.com/b/wbcyius2/gamevault)
- [Dépôt GitHub](https://github.com/AITABBOUyoussef/bde-events)
- [Moodboard Canva](https://www.canva.com/design/DAHQTnu7JXM/_wyJhjQcrmujG4TyqG1Agw/edit?ui=e30)
---

## Auteur

**Youssef Ait Abbou**
Étudiant en Développement Web Full-Stack | École Numérique Ahmed El Hansali

Passionné par l'architecture logicielle, les bases de données et la création d'interfaces intuitives.
