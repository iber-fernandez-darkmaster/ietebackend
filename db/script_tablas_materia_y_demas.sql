-- tabla de materia
CREATE TABLE `db_iete`.`materia` ( `id` INT NOT NULL AUTO_INCREMENT , `nombre` VARCHAR(100) NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- estdiante
CREATE TABLE `db_iete`.`estudiante` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `nombre_completo` VARCHAR(50) NOT NULL, 
    `dni` VARCHAR(50) NOT NULL, 
    `auth_key` VARCHAR(32) NOT NULL, 
    `password_hash` VARCHAR(255) NOT NULL , 
    `password_reset_token` VARCHAR(255) NULL , 
    `email` VARCHAR(255) NOT NULL , 
    `centro_id` INT NOT NULL , 
    `status` INT NULL , 
    `created_at` INT NULL , 
    `updated_at` INT NULL , 
    `foto` VARCHAR(100) NULL , 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;


-- tabla centro
CREATE TABLE `db_iete`.`centro` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `numero_id` INT NULL, 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- examen
CREATE TABLE `db_iete`.`examen` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `materia_id` DATE NOT NULL, 
    `fecha` DATE NOT NULL, 
    `titulo` VARCHAR(100) NOT NULL, 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- preguntas
CREATE TABLE `db_iete`.`preguntas` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `examen_id` INT NOT NULL, 
    `pregunta` VARCHAR(300) NOT NULL, 
    `respuesta_correcta` INT NOT NULL, 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- respuestas
CREATE TABLE `db_iete`.`respuestas` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `pregunta_id` INT NOT NULL, 
    `respuesta` INT NOT NULL, 
    `estudiante_id` INT NOT NULL, 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;