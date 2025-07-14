create database emprunt;
       use emprunt;
           create or replace table em_membre(
                 idmembre int PRIMARY KEY AUTO_INCREMENT,
                 nom varchar(200),
                 date_naissance date,
                 genre varchar(100),
                 mail varchar(200),
                 mdp varchar(200),
                 ville varchar(200),
                 image_profil varchar(200)

                 );

           create or replace table em_categorie_objet(
                  id_categorie int PRIMARY KEY AUTO_INCREMENT,
                  nom_categorie varchar(200)

           );

            create or replace table em_objet
                   (
                   id_objet int PRIMARY KEY AUTO_INCREMENT,
                   nom_objet varchar(200),
                   id_categorie int,
                 nom_image varchar(200),
                   FOREIGN KEY (id_categorie) REFERENCES em_categorie_objet(id_categorie)

                   );

            create or replace table em_emprunt(
                   id_emprunt int PRIMARY KEY AUTO_INCREMENT,
                   id_membre int,
                   id_objet int,
                   date_emprunt date,
                   date_retour date,
                   FOREIGN KEY (id_membre) REFERENCES em_membre(idmembre),
                   FOREIGN KEY (id_objet) REFERENCES em_objet(id_objet)
            );