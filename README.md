But : Créer une application Web, sous PHP/MySQL, pour gérer un magazine en ligne (Tech Horizons). Il s’agit de permettre à un ensemble d’utilisateurs de consulter les thèmes auxquels ils sont abonnés, gérer leur historique de navigation et proposer des articles à publier. Il s’agit de faire une analyse et une conception convenables, créer et gérer une base de données puis proposer une interface Web pour se servir des fonctionnalités offertes par l'application. 

L’application Web permettra de gérer un magazine en ligne et offrira aux utilisateurs une interface intuitive et sécurisée, donnant la possibilité de consulter les articles liés aux thèmes auxquels ils sont abonnés ( Intelligence artificielle, Internet des objets, Cybersécurité, Réalité virtuelle et augmentée ... ). L'application permet aussi de recommander des articles à  l'utilisateur connecté en se basant sur son historique et ses centres d’intérêt. Lors de la consultation, l’utilisateur voit défiler les images du numéro sélectionné, un clic sur une image l’envoi vers l’article correspondant.

 Le site est consulté par quatre types d’utilisateurs : 

     Invité : Il ne peut que consulter les informations sur les thèmes, déposer une demande d’inscription au magazine et consulter les numéros publics. 
     Abonné : Il dispose d’un espace personnalisé où il peut visualiser tous les numéros du magazine, gérer ses abonnements aux thèmes, gérer l’historique de navigation en utilisant des filtres pour retrouver des articles précédemment consultés et proposer des articles à publier, avec un système de suivi pour consulter son état (Refus, En cours, Retenu, Publié). Il peut aussi attribuer une note de 1 à 5 aux articles et ajouter des messages aux conversations (Chat) liées aux articles. 
    Responsable d’un thème : Il gère les abonnements liés à son thème et ses articles, consulte les articles postés par les abonnés, peut éventuellement les proposer pour la publication dans les prochains numéros, et voir les statistiques sur les articles et les abonnés de son thème. Il joue aussi le rôle du modérateur des conversations liées aux articles de son thème. 
    Editeur de Tech Horizons  : peut gérer les numéros( publier un numéro, rendre public … ) et ajouter/modifier/bloquer ou supprimer des abonnés ou des responsables d’un thème. Après publication, il peut activer/désactiver un numéro ou un article. Aussi, il peut voir les statistiques sur les abonnés, les responsables de thèmes, les numéros, les thèmes et les articles.  

Tech Horizons  vise donc à explorer les innovations technologiques les plus marquantes, tout en mettant en lumière leurs enjeux éthiques et sociétaux. Ainsi, d'autres fonctionnalités peuvent être ajoutés pour subvenir aux besoins des passionnés, professionnels et curieux, désireux d'appréhender ou partager les transformations technologiques du futur. Toutefois, lors du développement de cette application Web, donner la priorité au cahier des charges en haut avant de penser à ajouter d'autres fonctionnalités.  

Important: 

    Utiliser le Framework Laravel pour mettre en place l'application Web. Fournir un code CSS/JavaScript personnalisé (Sans utiliser JQuery ou un Framework CSS(Bootstrap ou autre)).  
    Des ateliers Laravel seront programmés au cours de la semaine prochaine

  Observations : 

     La liste des groupes de travail est mentionnée sur le fichier Google Sheet partagé.   
    Le compte rendu comprend : 

               o Répertoire contenant les pages de votre projet ou un Google Drive ou un lien Github.
                 (Ne pas oublier d'activer le partage du dossier partagé avec : maitkbir@uae.ac.ma et yelyusufi@uae.ac.ma)  
               o Rapport (discussion qui porte sur les choix faits et les fonctionnalités prises en compte). 
               o Remise avant le dimanche 19/1/2025.


## Installation
composer install
copy .env 
php artisan migrate:fresh 
php artisan db:seed

## Run
php artisan serve