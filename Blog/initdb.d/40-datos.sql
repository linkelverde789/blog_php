\connect bdjuegos;

INSERT INTO usuarios(id,nombre, usuario, correo, password) VALUES
(1,'Juan Pérez', 'juanperez', 'juan@example.com', 'juan1234'),
(2,'María López', 'marialopez', 'maria@example.com', 'maria5678'),
(3,'Carlos García', 'carlosgarcia', 'carlos@example.com', 'carlosabcd'),
(4,'Laura Martínez', 'lauramartinez', 'laura@example.com', 'laura9876'),
(5,'Pedro Rodríguez', 'pedrorodriguez', 'pedro@example.com', 'pedro5432'),
(6,'Ana Gómez', 'anagomez', 'ana@example.com', 'anaabcd123'),
(7,'Sergio Hernández', 'sergiohernandez', 'sergio@example.com', 'sergio7890'),
(8,'Elena Díaz', 'elenadiaz', 'elena@example.com', 'elenaabcd123'),
(9,'David Vázquez', 'davidvazquez', 'david@example.com', 'david5678abcd'),
(10, 'Sofía Ruiz', 'sofiaruiz', 'sofia@example.com', 'sofiaabcd987'),
(11, 'Javier Sánchez', 'javiersanchez', 'javier@example.com', 'javier1234abcd'),
(12, 'Isabel Flores', 'isabelflores', 'isabel@example.com', 'isabelabcd567'),
(13,'Miguel Castro', 'miguelcastro', 'miguel@example.com', 'miguelabcd123'),
(14, 'Paula Ortiz', 'paulaortiz', 'paula@example.com', 'paula5678abcd'),
(15,'Alejandro Ramírez', 'alejandroramirez', 'alejandro@example.com', 'alejandroabcd987'),
(16, 'Administrador','admin','admin@admin.com','admin');

INSERT INTO articulos (titulo, texto, id_usuario) VALUES
('Primer artículo', 'Este es el texto del primer artículo.', 1),
('Segundo artículo', 'Texto del segundo artículo con más detalles.', 2),
('Tercer artículo', 'Aquí va el texto del tercer artículo.', 3),
('Cuarto artículo', 'Texto detallado del cuarto artículo.', 1),
('Quinto artículo', 'Un breve texto para el quinto artículo.', 2);