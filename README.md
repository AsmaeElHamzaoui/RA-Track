# RA-Track

## Contexte du projet
  L'application de gestion des vols (SGA) doit permettre de gérer l'ensemble des opérations aériennes pour une compagnie aérienne, un aéroport ou une agence de gestion des vols. Le système sera conçu pour gérer les réservations, la planification des vols, la gestion des ressources, le suivi en temps réel des vols, ainsi que les opérations de maintenance et de sécurité.

## Fonctionnalités principales
   
   - Gestion des Vols : Suivi des horaires des vols, gestion des réservations et des annulations.
   
   - Planification et Optimisation : Optimisation des horaires des avions et des équipages.
   
   - Suivi des Vols en Temps Réel : Suivi des positions des vols et des statistiques de performance.
   
   - Gestion des Ressources : Allocation des avions, gestion de la maintenance et du carburant.
   
   - Conformité et Sécurité : Garantir la conformité des opérations avec les normes aéronautiques (OACI, FAA, etc.).

**Intégration UI et Ajout Dynamique**

- Formulaires permettant l'ajout des utilisateurs avec des champs .
- Formulaires permettant l'ajout des avions avec des champs .
- Formulaires permettant l'ajout des vols avec des champs .
- Formulaires permettant l'ajout des aéroports avec des champs .
- Formulaires permettant d'éffectuer une réservation  des avions avec des champs .


**L'affichage des interfaces**
-   Permettre l'affichage des utilisateurs
-   Permettre l'affichage des avions
-   Permettre l'affichage des reservations éffecutées
-   Permettre l'affichage des aéroports
-   Permettre l'affichage des vols


## Technologies Requises
-   HTML
-   CSS natif 
-   JS  natif
-   Framework CSS (tailwind)
-   Framework PHP (Laravel)
-   SQL ( base de donnée PostgreSQL)

## Table des matières

-  Lien vers le repository GitHub contenant :[Repo · Asmae_Elhamzaoui_RA-Track](https://github.com/AsmaeElHamzaoui/RA-Track)

-  Le diagramme du cas d'utilisation :
 ![Structure du projet](./asset/vidéo/USUser.png)

-  Le diagramme de classe :
 ![Structure du projet](./asset/vidéo/class.png)

## Installation

### Cloner le dépôt

Pour installer et démarrer l'application, commencez par cloner ce dépôt sur votre machine locale :
 

# Installation et Configuration du Projet

## Prérequis

Avant de cloner ce projet, assurez-vous d'avoir les outils suivants installés :

1. **Serveur Web** : Apache (inclus dans XAMPP, WAMP, ou MAMP).
2. **Base de Données** : PostgreSQL (ou MySQL) pour stocker les données de l'application.
3. **PHP** : Version compatible avec les scripts utilisés (au minimum PHP 7.4 recommandé).
4. **Git** : Pour cloner le dépôt.

## Installation

### Étape 1 : Cloner le projet

```bash
git clone https://github.com/AsmaeElHamzaoui/RA-Track
cd RA-Track
```

### Étape 2 : Configuration de l'environnement

1. **avoir Composer installé**
   ```bash
   composer install
   ```
2. **FCopier le fichier .env**  
   - Vérifiez le fichier `.env` et mettez à jour les paramètres de connexion à la base de données si nécessaire :
    
    ```bash
    cp .env.example .env
    ```
3. **Générer la clé de l'application**  
    ```bash
    php artisan key:generate
    ```
4. **Configurer la base de données**  
   ```env
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=nom_de_la_base
    DB_USERNAME=postgres
    DB_PASSWORD=
    ```
5. **Démarrer le serveur**  
   ```bash
    php artisan serve
   ```



## Structure du Projet
 ![Structure du projet](./asset/vidéo/structure.png)
