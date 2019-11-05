CREATE DATABASE edtextos CHARACTER SET utf8 COLLATE utf8_general_ci;
USE edtextos;

CREATE TABLE usuarios(
  id INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(50),
  password VARCHAR(16),
  PRIMARY KEY (id)
);

CREATE TABLE textos(
  id INT NOT NULL AUTO_INCREMENT,
  usuarios_id INT NOT NULL,
  titulo VARCHAR(255) NOT NULL,
  criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
  texto TEXT NOT NULL,
  cursor_inicio_sel INT,
  cursor_fim_sel INT,
  CONSTRAINT `fk_usuarios_id`
    FOREIGN KEY (usuarios_id) REFERENCES usuarios (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  PRIMARY KEY (id)
);
