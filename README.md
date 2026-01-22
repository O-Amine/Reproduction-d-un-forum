# Forum d'Entraide & Gestion de Tickets

Ce projet est une plateforme web de gestion de tickets et d'entraide communautaire. Il permet aux utilisateurs de poster des tickets (problèmes), de commenter pour apporter des solutions, et de gérer leur profil membre.

Le projet a été conçu pour être **responsive**, **sécurisé** et **facile à installer**.

## Fonctionnalités

### Gestion des Utilisateurs

- **Inscription & Connexion :** Système complet avec hachage des mots de passe (`password_hash`) pour la sécurité.
- **Expérience Utilisateur :** Bouton pour afficher/masquer le mot de passe (icône œil) lors de l'inscription.
- **Espace Membre :** Menu personnalisé affichant le pseudo de l'utilisateur connecté.
- **Déconnexion :** Gestion propre de la fin de session.

### Système de Tickets (Billets)

- **Création :** Formulaire pour poster un nouveau ticket (titre, contenu, pseudo automatique si connecté).
- **Consultation :** Affichage des 5 derniers tickets sur l'accueil sous forme de cartes modernes.
- **Archives :** Page dédiée listant tous les tickets avec un système de **pagination** (5 tickets par page).
- **Réinitialisation :** Fonctionnalité (Admin) pour supprimer tous les tickets en un clic.

### Système de Commentaires

- Possibilité de répondre à un ticket spécifique.
- Affichage chronologique des échanges.

### Design & Technique

- **Responsive Design :** Le site s'adapte aux ordinateurs et aux mobiles (Menu burger automatique en CSS).
- **Auto-Installation :** La base de données et les tables se créent automatiquement au premier lancement.
- **Architecture MVC (Inspirée) :** Séparation claire entre les fichiers de vue, le style (`assets/css`) et la logique PHP.

## Technologies utilisées

- **Langage :** PHP 7/8
- **Base de données :** MySQL (PDO)
- **Frontend :** HTML5, CSS3 (Flexbox/Grid), JavaScript (Vanilla)
- **Serveur local recommandé :** WAMP, XAMPP ou MAMP.

## Installation

Ce projet est conçu pour être "Plug & Play".

1. **Cloner le projet**

   ```bash
   git clone [https://github.com/ton-pseudo/nom-du-projet.git](https://github.com/ton-pseudo/nom-du-projet.git)
   ```

2. **Configurer le serveur**

- Placez les fichiers dans le dossier `www` (WAMP) ou `htdocs` (XAMPP).
- Lancez votre serveur Apache et MySQL.

3. **Base de données**

- Ouvrez le fichier `ouverture_bdd.php`.
- Vérifiez que les identifiants (`root` / `     ` sans mot de passe) correspondent à votre configuration locale.
- **C'est tout !** Lancez la page d'accueil (`index.php`). Le script détectera l'absence de la base de données et créera automatiquement :
- La BDD `bdd_projet_forum`
- Les tables `membres`, `billets` et `commentaires`.

## Structure du projet

```text
/
├── assets/
│   ├── css/      # Feuilles de style (style.css)
│   └── img/      # Images (icones, fonds)
├── ouverture_bdd.php  # Connexion & Création auto de la BDD
├── index.php          # Page d'accueil
├── archives.php       # Liste complète des tickets
├── inscription.php    # Formulaire d'inscription
└── ...

```

## Projet réalisé par :

- **OUARTI Amine**
