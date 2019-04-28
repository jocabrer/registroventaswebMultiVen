SELECT
	c.`id` AS pedido
	,e.`descripcion` AS estado
	,d.`cantidad` 
	,p.`Nombre`
	,ce.`estado`
	
FROM detalle d 
     INNER JOIN cabecera c  ON c.`id` = d.`id_cabecera`
     INNER JOIN `cambioestado` ce ON c.`estadoActual` = ce.`id`
     INNER JOIN `estado` e ON ce.`estado` = e.`secuencia` 
     INNER JOIN `producto` p ON d.`id_producto` = p.`id`
WHERE ce.`estado` IN (0,1,2)  
