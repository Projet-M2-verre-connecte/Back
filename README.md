# Back

# Intallation :

1) installer xamp
2) cloner le repo front dans le fichier "C:/xampp/htdocs/"
(dans l'exemple décrit ci-dessous le projet a été cloné dans le fichier "C:/xampp/htdocs/projet/projet_TMS/Back")

# Configuration de Xampp pour l'environnement local :

1) aller dans le répertoire : C:\xampp\apache\conf\extra
2) ouvrir le fichier "httpd-vhosts.conf", et copier coller le texte ci-dessous :

```
<VirtualHost *:80>
    ServerName prj-TMS-web-back-api.fr
    DocumentRoot "C:/xampp/htdocs/projet/projet_TMS/Back"
</VirtualHost>
```
/!\ attention le path décrit pour le DocumentRoot est un exemple, si vous en utilisez un autre, modifiez cette partie /!\\
le path à écrire commencera forcément par : "C:/xampp/htdocs/" + l'arborescence de projet cloné sur votre machine

3) ouvrir bloc note en tant qu'administrateur
4) ouvrir le fichier "C:/Windows/System32/drivers/etc/.hosts", et copier coller le texte ci-dessous :
```
127.0.0.1	prj-tms-web-back-api.fr
```
/!\ attention, veuillez sélectionner "tout type de fichier .\* " /!\\

5) installer la bdd en lançant mysql et apache sur le panneau de contrôle xampp et en allant sur phpmyadmin : 
```
http://127.0.0.1/phpmyadmin
```
puis créé une nouvelle base de données :
```
projet_tms
```
et importer le fichier .sql
6) remplir le fichier constantes.php de cette manière :
```
  define('DB_USER', 'user');
  define('DB_PASSWORD', 'password');
  define('DB_NAME', 'projet_tms');
  define('DB_SERVER', 'localhost');
  Header('Access-Control-Allow-Origin:http://prj-tms-web-back-api.fr');
```
/!\ attention le user et le password son propre à votre machine, créez en un si nécessaire (onglet privilege avec pour nom d'hôte localhost).\* " /!\\
