select e.apellido, e.nombre, e.razonsocial, e.dni, e.fnac, e.sexo, e.cuit, e.dpto, e.empleado, d.barrio, d.calle, d.num, d.piso --*
from sgr.entidad e
inner join sgr.domicilio d
on e.id_entidad = d.id_entidad
where apellido like '%a%'
order by e.apellido, e.nombre asc