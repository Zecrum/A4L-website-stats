# A4L website statistiques
#### Important : Site non officiel d'A4L pour voir ses heures de connexion et son nombre de joueurs tués

#### [Lien du site (https://a4l.zecrum.fr)](https://a4l.zecrum.fr)

![](images/home.png)


### Description du projet
Créer un site web en ligne pour afficher ses heures de connexion au jeu [Arma 3](https://store.steampowered.com/app/107410/Arma_3/) sur le serveur [Arma For life](https://www.mrratsuper.com/forum) créé par [mrratsuper](https://www.mrratsuper.com).

**Pour ce faire :**
- Implémentation d'une base de données (MYSQL) pour stocker les différents joueurs, ainsi que l'historique des connexions (voir partie [Base de données](#base-de-donn%C3%A9es)).
- Utilisation d'une API (merci [tomfcz](https://www.tomfcz.fr/)) pour récupérer la liste des joueurs connectés au serveur. Vous pouvez créer votre API grâce au repo suivant : [PHP-Source-Query](https://github.com/xPaw/PHP-Source-Query).
- Script qui est lancé toutes les minutes (sous forme de crontab ou autre sur un VPS) pour vérifier la liste des joueurs et les ajouter dans sa BDD pour garder l'historique de connexion de chacun.
- Reprise d'un template de site internet ([graygrids](https://graygrids.com/templates/agencio-free-bootstrap-5-startup-and-agency-template/)) en HTML / CSS / JS ([bootstrap 5](https://getbootstrap.com/)) pour l'adapter aux besoins du site.
- Création des pages du site ([recherche](https://a4l.zecrum.fr/recherche) / [classement-heure](https://a4l.zecrum.fr/classement-heure) / [classement-kill](https://a4l.zecrum.fr/classement-kill))


#### Base de données
Schéma de la base de données utilisé :
- Table: Player
    ```
    idP : int (clé primaire) (auto increment)
    playerName : varchar(50)
    temps : int (DEFAULT = NULL)
    connecte : enum('True','False') (DEFAULT = NULL)
    sp : enum('True', 'False')
    pn : enum('True', 'False')
    kills : int
    ban : int (DEFAULT = NULL)
    ```
- Table: Historique
    ```
    idH : int (clé primaire) (auto increment)
    dateCo : datetime (DEFAULT = NULL)
    dateDeco : datetime (DEFAULT = NULL)
    idP : int (clé étrangère : 'Player.idP')
    killH : int
    ```
 - Table: killCounter
    ```
    idK : int (clé primaire) (auto increment)
    dateK : timestamp
    killPlayerT : int
    killNb : int
    idP : int (clé étrangère : 'Player.idP')
    ```

 #### Récupérer le projet
```
git clone https://github.com/Zecrum/A4L-website-stats
cd A4L-website-stats
```


 ###### Copyright @Zecrum
