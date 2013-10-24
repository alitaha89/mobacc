mobacc
======

Gestion des depenses personnelle Android + web.


1-L'application Android permet de saisir les dépense par catégorie (sans connection internet),quand on à accés au wifi on synchronise les données avec le serveur de donnée

2-L'application permet d'afficher les rapports de dépenses


-Requirement:

-android enviroment minSdkVirsion:8.
-PHP server whith mysql DB.

-android application name:mobacc
-android application package name:com.example.mobacc


-php folder: mobacc web application
-myssql data base folder: mobacc web application/mobacc.sql

-web application is located under: www.linteractif.com/mobacc  whith demo user 

-user name:cnam
-password:SMB215

-by default application send http request to www.linteractif.com/mobacc/api can be edited from "mobacc / src / com / example / mobacc / SendRequest.java"
