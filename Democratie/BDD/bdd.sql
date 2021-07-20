DROP TABLE vote;
DROP TABLE commentaires;
DROP TABLE propositions;
DROP TABLe users;

--------------- Mirror ----------------

CREATE TABLE users
(
    id_user INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    pseudo VARCHAR(25),
    mdp VARCHAR(60),
    email VARCHAR(25),
    actif BOOLEAN DEFAULT 0
);

CREATE TABLE propositions
(
    id_proposition INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT,
    title VARCHAR(25),
    text_proposition VARCHAR(3000),
    soumission BOOLEAN,
    nb_pour INT DEFAULT 1,
    nb_contre INT,

    CONSTRAINT FK_PROPOSITION FOREIGN KEY (id_user) REFERENCES users(id_user)
);

CREATE TABLE commentaires
(
    id_commentaire INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT,
    id_proposition INT,
    text_commentaire VARCHAR(3000),
    jour DATE,

    CONSTRAINT FK_COMMENTAIRE_USER FOREIGN KEY (id_user) REFERENCES users(id_user),
    CONSTRAINT FK_COMMENTAIRE_PROPOSITION FOREIGN KEY (id_proposition) REFERENCES propositions(id_proposition)
);

CREATE TABLE vote
(
    id_user INT,
    id_proposition INT,
    a_vote BOOLEAN,

    CONSTRAINT FK_VOTE_USER FOREIGN KEY (id_user) REFERENCES users(id_user),
    CONSTRAINT FK_VOTE_PROPOSITION FOREIGN KEY (id_proposition) REFERENCES propositions(id_proposition),
    CONSTRAINT FK_VOTE PRIMARY KEY (id_user, id_proposition)
);