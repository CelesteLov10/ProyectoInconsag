/*Script para tener el*/
var boton = document.getElementById('agregar');
var guardar = document.getElementById('guardar');
var lista = document.getElementById('lista');
var data=[];
/*cuenta cuantos se han ingresados*/
var cant = 0;

boton.addEventListener("click", agregar);
guardar.addEventListener("click", save);

/*No tiene parametros por eso va vacio (no se que significa)*/
function agregar(){
  var numLote = document.getElementById('numLote').value;
  var medidaLateralR = parseFloat(document.getElementById('medidaLateralR').value);
  var medidaLateralL = parseFloat(document.getElementById('medidaLateralL').value);
  var medidaEnfrente = parseFloat(document.getElementById('medidaEnfrente').value);
  var medidaAtras = parseFloat(document.getElementById('medidaAtras').value);
  var colindanciaN = parseFloat(document.getElementById('colindanciaN').value);
  var colindanciaS = parseFloat(document.getElementById('colindanciaS').value);
  var colindanciaE = parseFloat(document.getElementById('colindanciaE').value);
  var colindanciaO = parseFloat(document.getElementById('colindanciaO').value);
  //agregar ese elemento al arreglo
  data.push(
    {
    "id":cant,
    "numLote":numLote,
    "medidaLateralR":medidaLateralR,
    "medidaLateralL":medidaLateralL,
    "medidaEnfrente":medidaEnfrente,
    "medidaAtras":medidaAtras,
    "colindanciaN":colindanciaN,
    "colindanciaS":colindanciaS,
    "colindanciaE":colindanciaE,
    "colindanciaO":colindanciaO
     }
  );
  var id_row = 'row'+cant;
  var fila = '<tr id=' + id_row +'><td>'+ numLote +'</td><td>'+ medidaLateralR + ' </td><td>'+ medidaLateralL + '</td><td>' + medidaEnfrente + '</td><td>' + medidaAtras + '</td><td>' + colindanciaN + '</td><td>' + colindanciaS + '</td><td>' + colindanciaE + '</td><td>' +colindanciaO + '</td></tr>'
          //JQuery
          //agregar a la tabla
          $("#lista").append(fila);
          //si no hay nada en la lista que muestre vacio
          $("#numLote").val('');
          $("#medidaLateralR").val('');
          $("#medidaLateralL").val('');
          $("#medidaEnfrente").val('');
          $("#medidaAtras").val('');
          $("#colindanciaN").val('');
          $("#colindanciaS").val('');
          $("#colindanciaE").val('');
          $("#colindanciaO").val('');
          $("#numLote").focus();

          //cant controla la cantidad de lotes que se van a gregando
          cant++;

}

/*funcion para guardar todo lo que se esta haciendo en la vista*/
function save(){

}