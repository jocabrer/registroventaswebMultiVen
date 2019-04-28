/*
* Formatea un monto como divisa
*/




function PriceFormatter(data) {
	
	if (data == null)
		return null;	
	var num = data;//.value.replace(/\./g,'');
	if(!isNaN(num)){
	num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
	num = num.split('').reverse().join('').replace(/^[\.]/,'');
	return "$ " + num;
	}
	 
	else{/* alert('Solo se permiten numeros');*/
	return "$ " + num;
	}
}

/*
Crea columnas con el boton de eliminar
*/
function operateFormatter(value, row, index) {
return [
   /*'<a class="like" href="javascript:void(0)" title="Like">',
    '<i class="glyphicon glyphicon-heart"></i>',
    '</a>  ',*/
    '<a class="remove" id="cl_remove" href="javascript:void(0)" title="Remove">',
    '<i class="glyphicon glyphicon-remove"></i>',
    '</a>'
].join('');
}


/*
Crea columnas con el boton de eliminar
*/
function formatoVerDetalle(value, row, index) {
return [
    '<a class="ver" id="btnVerDetalle" href="javascript:void(0)" title="Ver detalle">',
    '<i class="glyphicon glyphicon-search"></i>',
    '</a>'
].join('');
}


/*
 * Funcion que formatea la vista de detalle de una bootstrap table
 */
function detailFormatter(index, row) {
    var html = [];
    $.each(row, function (key, value) {
        html.push('<p><b>' + key + ':</b> ' + value + '</p>');
    });
    return html.join('');
}


/*
 *Fomatea el estado abreviado. 
 */
function FormatoEstado(value, row, index)
{
	
	var data = value;
	var url = base_url+"seguimiento/ver/"+row.numeroPedido+"/"+row.cli_id
	switch(data)
	{
		case "0": return "<a href="+url+" target='blank'><span class='label label-danger'>Ingresado</span></a>";
		case "1": return "<a href="+url+" target='blank'><span class='label label-info'>En Fabricacion.<span></a>";
		case "2": return "<a href="+url+" target='blank'><span class='label label-warning'>Esperando</span></a>";
		case "3": return "<a href="+url+" target='blank'><span class='label label-success'>Listo</span></a>";
		case "4": return "<a href="+url+" target='blank'><span class='label label-danger'>Problem</span></a>";
		case "5": return "<a href="+url+" target='blank'><span class='label label-success'>Calculando</span></a>"
	}
}


function diasTranscurridosFormater(data)
{
	
	if(data>=10)
		return "<small class='label label-danger pull-right'><i class='fa fa-clock-o'></i> "+data+" días</small>";
	else
		return "<small class='label label-success pull-right'><i class='fa fa-clock-o'></i> "+data+" días</small>";
}

/*
 * Fomatea el formato del valor en BD de si es comisión o no
 */
function FormatoComision(data)
{
	switch(data)
	{
		case "0": return "<span class='label label-danger'>NO</span>";
		case "1": return "<span class='label label-warning'>SI<span>";
	
	}	
}

/*
 * Formateo de tabla el link hacia el detalle del pedido
 */
function f_idpedido(data){
	return['<a href="'+base_url+'Pedido/editarPedido/',data,'">',data,'</a>'].join('');
}

/*
 * Formateo de tabla el link hacia el detalle del pedido
 */
function f_idpedidoLabel(data,label){
	return['<a href="'+base_url+'Pedido/editarPedido/',data,'">',label,'</a>'].join('');
}

/*
 * Formateo de tabla con el numero de comprobante
 */
function f_comprobante(data){
	return['<a href="'+base_url+'Comprobante/verComprobante/',data,'">','<i class="fa fa-fw fa-file-o"></i>','</a>'].join('');
}
/*
 * Formateo de tablacliente con nombre  
 */
function f_cliente(value, row, index){
	return['<a href="'+base_url+'Cliente/edicion/',row.cli_id,'">',row.cli_nom,'</a>'].join('');
}
/*
 *  Formateo de tabla cliente con id
 */
function i_cliente(data)
{
	return['<a href="'+base_url+'Cliente/edicion/',data,'">',data,'</a>'].join('');
}
/*
 * Formateo de tabla  producto
 */
function i_prod(data)
{
	return['<a href="'+base_url+'Productos/agregar/',data,'">',data,'<i class="fa fa-fw fa-file-o"></i>','</a>'	].join('');
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}





function runningFormatter(value, row, index) {
    return index
}

function totalTextFormatter(data) {
    return 'Total';
}

function totalFormatter(data) {
    return data.length;
}

function sumFormatter(data){
    field = this.field;
    return PriceFormatter(data.reduce(function(sum, row) { 
        return sum + (+row[field]);
    }, 0));
}

function avgFormatter(data){
    return sumFormatter.call(this, data) / data.length;
}



function tiempoTranscurrido(fecha)
{
	
	//asignar el valor de las unidades en milisegundos
	var msecPerMinute = 1000 * 60;
	var msecPerHour = msecPerMinute * 60;
	var msecPerDay = msecPerHour * 24;
	
	var dateMsec = new Date().getTime();
	
	
	// asignar la fecha en milisegundos
	var date =new Date(fecha);
	// Obtener la diferencia en milisegundos
	var interval = dateMsec - date.getTime();
	
	// Calcular cuentos días contiene el intervalo. Substraer cuantos días
	//tiene el intervalo para determinar el sobrante
	var days = Math.floor(interval / msecPerDay );
	interval = interval - (days * msecPerDay );
	
	// Calcular las horas , minutos y segundos
	var hours = Math.floor(interval / msecPerHour );
	interval = interval - (hours * msecPerHour );
	
	var minutes = Math.floor(interval / msecPerMinute );
	interval = interval - (minutes * msecPerMinute );
	
	var seconds = Math.floor(interval / 1000 );
	
	// Mostrar el resultado.
	//document.write(days + " days, " + hours + " hours, " + minutes + " minutes, " + seconds + " seconds.");
	document.write(days + " dias y " + hours + " horas " + minutes + " minutes.");
	
	//Output: 164 días, 23 horas, 0 minutos, 0 segundos.
}


function pad(input, length, padding) { 
	  var str = input + "";
	  return (length <= str.length) ? str : pad(str+padding, length, padding);
	}



function MuestraMensaje(titulo,mensaje){
	
	 var modal = $('#modalDinamico');
	  modal.find('.modal-title').text(titulo)
	  modal.find('.modal-body').html(mensaje)
	  modal.modal('show');
}


