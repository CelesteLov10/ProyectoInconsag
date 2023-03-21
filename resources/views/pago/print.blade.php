@can('Admin.pago.pdf')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recibo pdf</title>
    
    <style>
      body{
         font-family: 'Times New Roman', Times, serif;
      }

      #container{
         width: auto;
         height: 750px;
         margin: 0px;
         border: 2px solid black;
         padding: 15px;
      }

     #caja1{
        width:100%;
        height:100px;
        border: 1px solid black;
     }
     #caja2{
      float: right;
        width:150px;
        height:25px;
        border: 1px solid black;
        text-align: end;
     }

     .derecha{
      float: right;
      margin-right: 10px;
     }

     .caja3{
        width:350px;
        height:25px;
        border: 1px solid black;
        text-align: justify;
     }
     .caja4{
        width:350px;
        height:60px;
        border: 1px solid black;
        text-align: justify;
     }

     #firmas{
      float: right;
      margin-right: 5%;
     }

     .clearboth{
      list-style: none;
     }

    </style>
</head>
<body>
    <div id="container">

        <div id="caja1"></div>

        <hr>

            <div class="clearboth"></div>
            <h5 class="derecha">L. <u>{{$pago->saldoEnCuotas}}</u><div id="caja2"></div></h5>

            <h2>Recibo de pago</h2>
            <br>

            <form>
               <p>Recibimos de <u>{{$pago->venta->cliente->nombreCompleto}}</u> <br><br>
                  La cantidad de <u>{{$pago->saldoEnCuotas}}</u></p>
                  <br>
                  <p>En concepto de pago lote <div class="caja4" id="caja4"><u>{{$pago->venta->lote->nombreLote}}</u></u></div></p>
                  <p>Saldo pendiente<div class="caja4" id="caja4">{{$pago->valorTerrenoPagar}}</div></p>
            </form>
            
            <aside id="firmas">
            <h4>Firma y saluda atentamente en la fecha:<br><br>
               <u>{{$pago->fechaPago}}</u></h4>
               <br>
               <h4><u>Inconsag</u> <br>
               (Firma y aclaración)</h4>
            </aside>
    </div>
    
</body>
</html>
@endcan