/* ---------------------------------------------------- */
/*  Generated by Enterprise Architect Version 12.1 		*/
/*  Created On : 03-jul.-2017 3:01:50 p. m. 				*/
/*  DBMS       : PostgreSQL 						*/
/* ---------------------------------------------------- */

/* Drop Sequences for Autonumber Columns */

DROP SEQUENCE IF EXISTS sequence_pkcodigo
;

/* Drop Tables */

DROP TABLE IF EXISTS spCodigo CASCADE
;

/* Create Tables */

CREATE TABLE spCodigo
(
	pkCodigo integer NOT NULL   DEFAULT NEXTVAL(('sequence_pkcodigo'::text)::regclass),
	codigo varchar(10) NOT NULL,
	descripcion varchar(25),
	fkCodigoPadre integer
)
;

/* Create Primary Keys, Indexes, Uniques, Checks */

ALTER TABLE spCodigo ADD CONSTRAINT PK_spCodigo
	PRIMARY KEY (pkCodigo)
;

/* Create Table Comments, Sequences for Autonumber Columns */

CREATE SEQUENCE sequence_pkcodigo INCREMENT 1 START 1
;
