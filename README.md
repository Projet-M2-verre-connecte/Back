# Back

# Intallation :

1) installer xamp
2) cloner le repo front dans le fichier "C:/xampp/htdocs/"
(dans l'exemple décrit ci-dessous le projet a été cloné dans le fichier "C:/xampp/htdocs/projet/projet_TMS/Front")

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
