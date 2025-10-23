// un apoderado no puede entregar poderes, se invalidan
UPDATE periodo p
JOIN (
    SELECT DISTINCT representante_cc
    FROM periodo
    WHERE representante_cc IS NOT NULL
) r ON p.cedula = r.representante_cc and 
SET p.valido = 1, observacion='Anulado por tener poderes a su nombre.'


    // validar duplicidad
    UPDATE periodo
      SET valido = 1, observacion = "Anulado por duplicidad"
      WHERE (cedula, CAST(num_radicado AS UNSIGNED)) NOT IN (
          SELECT cedula, MAX(CAST(num_radicado AS UNSIGNED)) AS max_radicado
          FROM periodo
          GROUP BY cedula
      );
    
// EXCEL DE RELACION DE PODERES

SELECT 
    p.fecha_registro as "FECHA DE REGISTRO",

    a1.folio AS FOLIO,
    a1.cedula as CEDULA,
    a1.nombre AS NOMBRE,

    CASE
        WHEN p.valido = 1 AND observacion <> "" THEN 0
        ELSE a1.acciones
    END AS ACCIONES,
    
    a1.email AS CORREO,
    a1.telefono AS TELEFONO,

    a2.folio AS FOLIO,
    a2.cedula AS CEDULA,
    a2.nombre AS NOMBRE,
    a2.acciones AS ACCIONES,
    a2.email AS CORREO,
    a2.telefono AS TELEFONO,

    p.num_radicado as RADICADO,

    CASE 
        WHEN p.valido = 1 AND p.observacion <> "" THEN 'No'
        ELSE 'Si'
    END AS VALIDO,

    p.observacion as OBSERVACION

FROM 
    periodo p
JOIN accionistas a1 ON p.cedula = a1.cedula
JOIN accionistas a2 ON p.representante_cc = a2.cedula

ORDER BY a2.cedula;

// EXCEL CONVOCATORIA TOTAL
SELECT 
    a1.nombre AS NOMBRE,
    a1.cedula as CEDULA,
    a1.folio as FOLIO,

    CASE
        WHEN p.valido = 1 AND observacion <> "" THEN 0
        ELSE a1.acciones
    END AS ACC,

    a2.nombre AS NOMBRE,
    a2.cedula AS CEDULA,

    p.fecha_registro as FECHA,
    p.num_radicado as RADICADO,

    a2.acciones AS ACC,

    p.observacion as OBSERVACION

FROM 
    periodo p
JOIN accionistas a1 ON p.cedula = a1.cedula
JOIN accionistas a2 ON p.representante_cc = a2.cedula

ORDER BY a2.cedula;