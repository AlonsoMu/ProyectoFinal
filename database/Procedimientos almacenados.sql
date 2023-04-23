USE senatimat;

DELIMITER $$
CREATE PROCEDURE spu_estudiantes_listar()
BEGIN
	SELECT	EST.idestudiante,
				EST.apellidos, EST.nombres,
				EST.tipodocumento, EST.nrodocumento,
				EST.fechanacimiento,
				ESC.escuela,
				CAR.carrera,
				SED.sede,
				EST.fotografia
		FROM estudiantes EST
		INNER JOIN carreras CAR ON CAR.idcarrera = EST.idcarrera
		INNER JOIN sedes SED ON SED.idsede = EST.idsede
		INNER JOIN escuelas ESC ON ESC.idescuela = CAR.idescuela
		WHERE EST.estado = '1';
END $$

CALL spu_estudiantes_listar();

DELIMITER $$
CREATE PROCEDURE spu_estudiantes_registrar
(
	IN _apellidos 			VARCHAR(40),
	IN _nombres 			VARCHAR(40),
	IN _tipodocumento		CHAR(1),
	IN _nrodocumento		CHAR(8),
	IN _fechanacimiento	DATE,
	IN _idcarrera 			INT,
	IN _idsede 				INT,
	IN _fotografia 		VARCHAR(100)
)
BEGIN
	-- Validar el contenido de _fotografia
	IF _fotografia = '' THEN 
		SET _fotografia = NULL;
	END IF;

	INSERT INTO estudiantes 
	(apellidos, nombres, tipodocumento, nrodocumento, fechanacimiento, idcarrera, idsede, fotografia) VALUES
	(_apellidos, _nombres, _tipodocumento, _nrodocumento, _fechanacimiento, _idcarrera, _idsede, _fotografia);
END $$

/*
CALL spu_estudiantes_registrar('Francia Minaya', 'Jhon', 'D', '12345678', '1984-09-20', 5, 1, '');
CALL spu_estudiantes_registrar('Munayco', 'José', 'D', '77779999', '1999-09-20', 3, 2, NULL);
CALL spu_estudiantes_registrar('Prada', 'Teresa', 'C', '01234567', '2002-09-25', 3, 2, '');
SELECT * FROM estudiantes;
*/

DELIMITER $$
CREATE PROCEDURE spu_sedes_listar()
BEGIN
	SELECT * FROM sedes ORDER BY 2;
END $$

DELIMITER $$
CREATE PROCEDURE spu_escuelas_listar()
BEGIN 
	SELECT * FROM escuelas ORDER BY 2;
END $$

DELIMITER $$
CREATE PROCEDURE spu_carreras_listar(IN _idescuela INT)
BEGIN
	SELECT idcarrera, carrera 
		FROM carreras
		WHERE idescuela = _idescuela;
END $$

CALL spu_carreras_listar(3);


-- LISTA MULTITABLA COLABORADORES
DELIMITER $$
CREATE PROCEDURE spu_colaboradores_listar()
BEGIN
	SELECT 	COL.idcolaborador,
				COL.apellidos, COL.nombres,
				CARG.cargo, SED.sede,
				COL.telefono, COL.direccion,
				COL.tipocontrato, COL.cv
			FROM colaboradores COL
			INNER JOIN sedes SED ON SED.idsede = COL.idsede
			INNER JOIN cargos CARG ON CARG.idcargo = COL.idcargo
			WHERE COL.estado = '1';
END $$

CALL spu_colaboradores_listar();


-- REGISTRAR COLABORADORES
DELIMITER $$
CREATE PROCEDURE spu_colaboradores_registrar
(
	IN _apellidos		VARCHAR(30),
	IN _nombres			VARCHAR(30),
	IN _idcargo			INT,
	IN _idsede			INT,
	IN _telefono		CHAR(9),
	IN _direccion 		VARCHAR(100),
	IN _tipocontrato	CHAR(1),
	IN _cv				VARCHAR(100)
)
BEGIN
	IF _cv = '' THEN
		SET _cv = NULL;
	END IF;
	
	INSERT INTO colaboradores
	(apellidos, nombres, idcargo, idsede, telefono, direccion, tipocontrato, cv) VALUES
	(_apellidos, _nombres, _idcargo, _idsede, _telefono, _direccion, _tipocontrato, _cv);
END $$

CALL spu_colaboradores_registrar('Francia Minaya','Jhon',1,1,'975842565','Jiron Santa Rosa','P','');

-- CARGOS LISTAR
DELIMITER $$
CREATE PROCEDURE spu_cargos_listar()
BEGIN
	SELECT * FROM cargos ORDER BY 1;
END $$

CALL spu_cargos_listar();

-- ELIMINAR COLABORADORES
DELIMITER $$
CREATE PROCEDURE spu_colaboradores_eliminar(
IN _idcolaborador 	INT
)
BEGIN
	DELETE FROM colaboradores WHERE idcolaborador = _idcolaborador;
END $$


CALL spu_colaboradores_eliminar(5);

-- ELIMINAR ESTUDIANTE
DELIMITER $$
CREATE PROCEDURE spu_estudiantes_eliminar(
IN _idestudiante	INT
)
BEGIN
	DELETE FROM estudiantes WHERE idestudiante = _idestudiante;
END $$

CALL spu_estudiantes_eliminar();

-- LOGIN USUARIO
DELIMITER $$
CREATE PROCEDURE spu_usuarios_login(IN nombreusuario_ VARCHAR(30))
BEGIN
	SELECT 	idusuario, nombreusuario, claveacceso,
				apellidos, nombres, nivelacceso
	FROM usuarios
	WHERE nombreusuario = nombreusuario_ AND estado = '1';
END $$

CALL spu_usuarios_login('INSTRUCTOR');

-- OBTENER COLABORADOR
DELIMITER $$
CREATE PROCEDURE spu_obtener_colaboradores (IN _idcolaborador INT)
BEGIN
    SELECT cv FROM colaboradores 
	WHERE idcolaborador = _idcolaborador;
END $$ 

CALL spu_obtener_colaboradores(12);

-- OBTENER ESTUDIANTES

DELIMITER $$
CREATE PROCEDURE spu_obtener_estudiantes (IN _idestudiante INT)
BEGIN
    SELECT fotografia FROM estudiantes 
	WHERE idestudiante = _idestudiante;
END $$ 

CALL spu_obtener_estudiantes(9);
