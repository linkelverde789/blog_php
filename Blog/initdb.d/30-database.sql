\connect bdjuegos;
create table usuarios (
    id serial primary key,
    nombre varchar(100),
    usuario varchar(50),
    correo varchar(100),
    password varchar(255)
);

create table articulos(
id serial primary key,
titulo varchar(20) not null,
texto text,
id_usuario int not null,
foreign key (id_usuario) references usuarios(id)
);

CREATE TABLE comentarios (
    id SERIAL PRIMARY KEY,          
    id_usuario INT NOT NULL,     
    id_articulo INT NOT NULL,
    comentario TEXT NOT NULL,        
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE, 
    FOREIGN KEY (id_articulo) REFERENCES articulos(id) ON DELETE CASCADE  
);


CREATE VIEW consulta AS SELECT articulos.id,usuario,titulo, texto FROM articulos INNER JOIN usuarios ON articulos.id_usuario = usuarios.id;

create view seccion_comentarios as select usuario, id_articulo, id_usuario, comentario, fecha_creacion
from comentarios inner join usuarios on (usuarios.id=comentarios.id_usuario);