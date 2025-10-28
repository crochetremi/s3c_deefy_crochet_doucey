use deefy;

-- Users table
CREATE TABLE IF NOT EXISTS User (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    passwd VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Playlists table
CREATE TABLE IF NOT EXISTS playlist (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- User to playlist junction table
CREATE TABLE IF NOT EXISTS user2playlist (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_pl INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES User(id) ON DELETE CASCADE,
    FOREIGN KEY (id_pl) REFERENCES playlist(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_playlist (id_user, id_pl)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tracks table (supports both podcasts and albums)
CREATE TABLE IF NOT EXISTS track (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    filename VARCHAR(255) NOT NULL,
    type VARCHAR(50) NOT NULL,
    duree INT,
    genre VARCHAR(100),
    -- Podcast fields
    auteur_podcast VARCHAR(255),
    date_podcast DATE,
    -- Album fields
    artiste_album VARCHAR(255),
    titre_album VARCHAR(255),
    annee_album INT,
    numero_album INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_type (type)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Playlist to track junction table
CREATE TABLE IF NOT EXISTS playlist2track (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pl INT NOT NULL,
    id_track INT NOT NULL,
    numero_piste INT DEFAULT 0,
    FOREIGN KEY (id_pl) REFERENCES playlist(id) ON DELETE CASCADE,
    FOREIGN KEY (id_track) REFERENCES track(id) ON DELETE CASCADE,
    UNIQUE KEY unique_track_playlist (id_pl, id_track)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Utilisateur 1 : Rémi Crochet (admin)
INSERT INTO User (nom, email, passwd, role)
VALUES ('Rémi Crochet', 'remi.crochet@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Utilisateur 2 : Alix Doucey (user)
INSERT INTO User (nom, email, passwd, role)
VALUES ('Alix Doucey', 'alix.doucey@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user');

-- Utilisateur 3 : Test User (user)
INSERT INTO User (nom, email, passwd, role)
VALUES ('Test User', 'test.user@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user');

-- Playlist 1 : "Mes Favoris" (Rémi Crochet)
INSERT INTO playlist (nom) VALUES ('Mes Favoris');

-- Playlist 2 : "Podcasts" (Rémi Crochet)
INSERT INTO playlist (nom) VALUES ('Podcasts');

-- Playlist 3 : "Musique Électro" (Alix Doucey)
INSERT INTO playlist (nom) VALUES ('Musique Électro');

-- Playlist 4 : "Rock Classique" (Test User)
INSERT INTO playlist (nom) VALUES ('Rock Classique');

-- Rémi Crochet possède "Mes Favoris" et "Podcasts"
INSERT INTO user2playlist (id_user, id_pl)
VALUES (1, 1), (1, 2);

-- Alix Doucey possède "Musique Électro"
INSERT INTO user2playlist (id_user, id_pl)
VALUES (2, 3);

-- Test User possède "Rock Classique"
INSERT INTO user2playlist (id_user, id_pl)
VALUES (3, 4);

-- Piste 1 : Podcast
INSERT INTO track (titre, filename, type, duree, genre, auteur_podcast, date_podcast)
VALUES ('Le Podcast Tech', 'podcast_tech.mp3', 'podcast', 1800, 'Technologie', 'Jean Tech', '2023-10-15');

-- Piste 2 : Musique (album)
INSERT INTO track (titre, filename, type, duree, genre, artiste_album, titre_album, annee_album, numero_album)
VALUES ('Bohemian Rhapsody', 'bohemian_rhapsody.mp3', 'musique', 354, 'Rock', 'Queen', 'A Night at the Opera', 1975, 1);

-- Piste 3 : Musique (album)
INSERT INTO track (titre, filename, type, duree, genre, artiste_album, titre_album, annee_album, numero_album)
VALUES ('Strobe', 'strobe.mp3', 'musique', 636, 'Électro', 'Deadmau5', 'Random Album Title', 2009, 2);

-- Piste 4 : Musique (album)
INSERT INTO track (titre, filename, type, duree, genre, artiste_album, titre_album, annee_album, numero_album)
VALUES ('Smells Like Teen Spirit', 'smells_like_teen_spirit.mp3', 'musique', 301, 'Rock', 'Nirvana', 'Nevermind', 1991, 3);


-- Ajout des pistes aux playlists
INSERT INTO playlist2track (id_pl, id_track, numero_piste)
VALUES
    -- Rémi Crochet : "Mes Favoris"
    (1, 2, 1), -- Bohemian Rhapsody
    (1, 4, 2), -- Smells Like Teen Spirit
    -- Rémi Crochet : "Podcasts"
    (2, 1, 1), -- Le Podcast Tech
    -- Alix Doucey : "Musique Électro"
    (3, 3, 1), -- Strobe
    -- Test User : "Rock Classique"
    (4, 2, 1), -- Bohemian Rhapsody
    (4, 4, 2); -- Smells Like Teen Spirit

