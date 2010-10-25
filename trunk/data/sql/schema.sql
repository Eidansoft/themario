CREATE TABLE contenido (id INT AUTO_INCREMENT, titulo TEXT NOT NULL, tema_id INT NOT NULL, orden INT NOT NULL, INDEX tema_id_idx (tema_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE contenidoTipoCuestionario (id INT AUTO_INCREMENT, contenido_id INT NOT NULL, INDEX contenido_id_idx (contenido_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE contenidoTipoTexto (id INT AUTO_INCREMENT, texto TEXT, contenido_id INT NOT NULL, INDEX contenido_id_idx (contenido_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE cuestion (id INT AUTO_INCREMENT, pregunta TEXT, cuestionario_id INT NOT NULL, INDEX cuestionario_id_idx (cuestionario_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE curso (id INT AUTO_INCREMENT, nombre TEXT NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE respuestaAlternativa (id INT AUTO_INCREMENT, cuestion_id INT NOT NULL, texto TEXT NOT NULL, INDEX cuestion_id_idx (cuestion_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE respuestaCorta (id INT AUTO_INCREMENT, cuestion_id INT NOT NULL, texto TEXT, INDEX cuestion_id_idx (cuestion_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE tema (id INT AUTO_INCREMENT, nombre TEXT NOT NULL, curso_id INT NOT NULL, INDEX curso_id_idx (curso_id), PRIMARY KEY(id)) ENGINE = INNODB;
ALTER TABLE contenido ADD CONSTRAINT contenido_tema_id_tema_id FOREIGN KEY (tema_id) REFERENCES tema(id);
ALTER TABLE contenidoTipoCuestionario ADD CONSTRAINT contenidoTipoCuestionario_contenido_id_contenido_id FOREIGN KEY (contenido_id) REFERENCES contenido(id);
ALTER TABLE contenidoTipoTexto ADD CONSTRAINT contenidoTipoTexto_contenido_id_contenido_id FOREIGN KEY (contenido_id) REFERENCES contenido(id);
ALTER TABLE cuestion ADD CONSTRAINT cuestion_cuestionario_id_contenidoTipoCuestionario_id FOREIGN KEY (cuestionario_id) REFERENCES contenidoTipoCuestionario(id);
ALTER TABLE respuestaAlternativa ADD CONSTRAINT respuestaAlternativa_cuestion_id_cuestion_id FOREIGN KEY (cuestion_id) REFERENCES cuestion(id);
ALTER TABLE respuestaCorta ADD CONSTRAINT respuestaCorta_cuestion_id_cuestion_id FOREIGN KEY (cuestion_id) REFERENCES cuestion(id);
ALTER TABLE tema ADD CONSTRAINT tema_curso_id_curso_id FOREIGN KEY (curso_id) REFERENCES curso(id);
