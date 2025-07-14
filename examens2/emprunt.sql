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

                   create or replace view v_objet_emprunt as
                          SELECT o.id_objet ,o.nom_objet,c.nom_categorie,m.nom,e.date_emprunt,e.date_retour, m.idmembre
                          FROM em_objet o INNER JOIN em_emprunt e ON o.id_objet = e.id_objet
                        JOIN em_categorie_objet c ON o.id_categorie = c.id_categorie
                          JOIN em_membre m ON e.id_membre = m.idmembre;

CREATE OR REPLACE VIEW v_object_and_images as
SELECT o.id_objet, oi.image_objet, o.nom_objet, o.nom_image
FROM em_objet o JOIN em_objet_image oi ON o.id_objet=oi.id_objet;


create or replace table em_objet_image(
              id_objet int,
              image_objet varchar(200),
              FOREIGN KEY (id_objet) REFERENCES em_objet(id_objet)
            );

INSERT INTO em_categorie_objet (nom_categorie) VALUES
                                                   ('Esthétique'),
                                                   ('Bricolage'),
                                                   ('Mécanique'),
                                                   ('Cuisine');

INSERT INTO em_objet (nom_objet, id_categorie, nom_image) VALUES
                                                              ('Sèche-cheveux', 1, 'seche.jpg'),
                                                              ('Pinceau maquillage', 1, 'pinceau.jpg'),
                                                              ('Tournevis', 2, 'tournevis.jpg'),
                                                              ('Perceuse', 2, 'perceuse.jpg'),
                                                              ('Clé à molette', 3, 'cle.jpg'),
                                                              ('Crick', 3, 'crick.jpg'),
                                                              ('Marmite', 4, 'marmite.jpg'),
                                                              ('Fouet cuisine', 4, 'fouet.jpg'),
                                                              ('Presse-ail', 4, 'presse.jpg'),
                                                              ('Brosse cheveux', 1, 'brosse.jpg');

INSERT INTO em_objet (nom_objet, id_categorie, nom_image) VALUES
                                                              ('Shampoing', 1, 'shampoing.jpg'),
                                                              ('Ciseaux', 2, 'ciseaux.jpg'),
                                                              ('Scie sauteuse', 2, 'scie.jpg'),
                                                              ('Clé anglaise', 3, 'anglaise.jpg'),
                                                              ('Pompe à vélo', 3, 'pompe.jpg'),
                                                              ('Poêle', 4, 'poele.jpg'),
                                                              ('Mixeur', 4, 'mixeur.jpg'),
                                                              ('Spatule', 4, 'spatule.jpg'),
                                                              ('Vernis à ongles', 1, 'vernis.jpg'),
                                                              ('Tondeuse', 1, 'tondeuse.jpg');

INSERT INTO em_objet (nom_objet, id_categorie, nom_image) VALUES
                                                              ('Lisseur', 1, 'lisseur.jpg'),
                                                              ('Pince', 2, 'pince.jpg'),
                                                              ('Marteau', 2, 'marteau.jpg'),
                                                              ('Compresseur', 3, 'compresseur.jpg'),
                                                              ('Crémaillère', 3, 'crema.jpg'),
                                                              ('Friteuse', 4, 'friteuse.jpg'),
                                                              ('Râpe', 4, 'rape.jpg'),
                                                              ('Casserole', 4, 'casserole.jpg'),
                                                              ('Fond de teint', 1, 'fond.jpg'),
                                                              ('Pinceau peinture', 2, 'pinceaupeint.jpg');

INSERT INTO em_objet (nom_objet, id_categorie, nom_image) VALUES
                                                              ('Lime', 1, 'lime.jpg'),
                                                              ('Scie circulaire', 2, 'sciecirc.jpg'),
                                                              ('Vérin', 3, 'verin.jpg'),
                                                              ('Bidon huile', 3, 'bidon.jpg'),
                                                              ('Cocotte-minute', 4, 'cocotte.jpg'),
                                                              ('Grille-pain', 4, 'grille.jpg'),
                                                              ('Batteur', 4, 'batteur.jpg'),
                                                              ('Gel coiffant', 1, 'gel.jpg'),
                                                              ('Pince universelle', 2, 'pinceuni.jpg'),
                                                              ('Tournevis électrique', 2, 'tournelec.jpg');

q

INSERT INTO em_membre (nom, date_naissance, genre, mail, mdp, ville, image_profil) VALUES
                                                                                       ('Alice', '1995-04-10', 'F', 'alice@mail.com', 'pass123', 'Antananarivo', 'alice.jpg'),
                                                                                       ('Bob', '1990-06-15', 'H', 'bob@mail.com', 'bobpass', 'Toamasina', 'bob.jpg'),
                                                                                       ('Claire', '2000-02-28', 'F', 'claire@mail.com', 'clairepass', 'Fianarantsoa', 'claire.jpg'),
                                                                                       ('David', '1992-12-01', 'H', 'david@mail.com', 'davidpass', 'Mahajanga', 'david.jpg');