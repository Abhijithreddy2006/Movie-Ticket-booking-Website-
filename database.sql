-- Create Tables
CREATE TABLE locations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

CREATE TABLE theaters (
    id INT AUTO_INCREMENT PRIMARY KEY,
    location_id INT,
    name VARCHAR(100) NOT NULL,
    address TEXT,
    FOREIGN KEY (location_id) REFERENCES locations(id)
);

CREATE TABLE movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    genre VARCHAR(50),
    poster VARCHAR(255),
    duration INT
);

CREATE TABLE showtimes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    movie_id INT,
    theater_id INT,
    show_date DATE NOT NULL,
    show_time TIME NOT NULL,
    FOREIGN KEY (movie_id) REFERENCES movies(id),
    FOREIGN KEY (theater_id) REFERENCES theaters(id)
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    showtime_id INT,
    seat_number VARCHAR(10) NOT NULL,
    booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (showtime_id) REFERENCES showtimes(id)
);

-- Insert Sample Data
INSERT INTO locations (name) VALUES
('Guntur'),
('Vijayawada'),
('Mangalagiri');

INSERT INTO theaters (location_id, name, address) VALUES
(1, 'Cinepolis Guntur', 'Mall Road, Guntur'),
(1, 'INOX Guntur', 'Brodipet, Guntur'),
(2, 'PVR Vijayawada', 'MG Road, Vijayawada'),
(2, 'INOX Vijayawada', 'LEPL Icon, Vijayawada'),
(3, 'Cinepolis Mangalagiri', 'NH16, Mangalagiri'),
(3, 'Srinivasa Theater', 'Tadepalle Road, Mangalagiri');

INSERT INTO movies (title, genre, poster, duration) VALUES
('RRR', 'Action', 'rrr.jpg', 180),
('Pushpa 2', 'Action', 'pushpa2.jpg', 160);

INSERT INTO showtimes (movie_id, theater_id, show_date, show_time) VALUES
(1, 1, '2025-04-15', '10:00:00'),
(1, 1, '2025-04-15', '14:00:00'),
(2, 2, '2025-04-15', '12:00:00'),
(2, 3, '2025-04-15', '15:00:00'),
(1, 4, '2025-04-15', '18:00:00'),
(2, 5, '2025-04-15', '20:00:00'); 