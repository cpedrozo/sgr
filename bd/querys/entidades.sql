SELECT e.apellido, e.nombre, e.razonsocial, e.dni, e.fnac, e.sexo, e.cuit, e.dpto, e.empleado,
d.barrio, d.calle, d.num, d.piso,
c.correo,
r.id_rol,
t.prefijo, t.numero, t.interno
FROM sgr.entidad e
INNER JOIN sgr.domicilio d
ON e.id_entidad = d.id_entidad
INNER JOIN sgr.correo c
ON e.id_entidad = c.id_entidad
INNER JOIN sgr.rol_persona r
ON e.id_entidad = r.id_entidad
INNER JOIN sgr.telefono t
on e.id_entidad = t.id_entidad
WHERE apellido LIKE '%a%'
ORDER BY e.apellido, e.nombre asc