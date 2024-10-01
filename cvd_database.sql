CREATE TABLE user_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_apellidos VARCHAR(255) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    ocupacion VARCHAR(255) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    nacionalidad VARCHAR(100) NOT NULL,
    nivel_ingles ENUM('básico', 'intermedio', 'avanzado', 'fluido') NOT NULL,
    lenguajes_programacion TEXT NOT NULL,
    aptitudes TEXT NOT NULL,
    habilidades TEXT NOT NULL,
    perfil TEXT NOT NULL
);

CREATE TABLE experiencia (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    titulo VARCHAR(255) NOT NULL,
    lugar VARCHAR(40) NOT NULL,
    inicio INT NOT NULL,
    fin INT NOT NULL,
    descripcion TEXT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user_info(id)
);

CREATE TABLE formacion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    titulo VARCHAR(255) NOT NULL,
    lugar VARCHAR(40) NOT NULL,
    inicio INT NOT NULL,
    fin INT NOT NULL,
    descripcion TEXT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user_info(id)
);

CREATE TABLE idiomas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    idioma VARCHAR(100) NOT NULL,
    nivel VARCHAR(50) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user_info(id)
);
