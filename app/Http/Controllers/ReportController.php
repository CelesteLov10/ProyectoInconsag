<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;
use Svg\Tag\Rect;
use Illuminate\Database\Eloquent\Builder;
class ReportController extends Controller
{
    //
  /*esta es solo para comprobar si el usuario esta autorizado, si no lo esta lo redirigira a la pagina login!! 
  /**Lo dejo para el futuro 
  public function _construct()
    {
        $this->middleware('auth');
        $this->middleware([
            'permission:report.reports_day',
            'permission:reports.reports_date',
            'permission:report.report_results'
        ]);
    }*/


    public function reportsDay(Request $request){
       // se puso con "fechaVenta" porque si coloco fechaVenta no me trae los registros
       //puse fecha de mexico, no me daba con la de Honduras
        $ventas = Venta::WhereDate('fechaVenta', Carbon::today('America/Mexico_City'))->get();
     
        
        $valorPrima = $ventas->sum('valorPrima');
       return view('report.reports_day', compact('ventas', 'valorPrima'));
      // dd($ventas);
      
    }
    /**Crear el controlador BusquedaController con el método index que devuelva la vista de búsqueda: */
    public function reportsDate(){
      $busqueda = Venta::whereDate('fechaVenta', Carbon::today('America/Mexico_City')->format('d-m-Y'))->get();
        $valorPrima = $busqueda->sum('valorPrima');
        return view('report.reports_date', compact('busqueda', 'valorPrima'));
  
    }
    public function reportResults(Request $request){
      $fi = $request->input('fecha_ini');
      $ff = $request->input('fecha_fin');

      $busqueda = Venta::whereBetween('fechaVenta', [$fi, $ff])->get();

      $valorPrima = $busqueda->sum('valorPrima');

     return view('report.reports_date', compact('busqueda', 'valorPrima'));

     

   
    }
        // Metodo para mostrar pdf por dia
    public function pdfDia (){
        $ventas = Venta::WhereDate('fechaVenta', Carbon::today('America/Mexico_City'))->get();
            // Aqui hacemos uso de la libreria PDF para que genere el documento pdf
        $pdf = PDF::loadView('report.pdfReportDia', compact('ventas'));
            //download('reporte_del_dia.pdf');
        return $pdf -> stream();
        
            
  }
            // Metodo para mostrar pdf por fecha
   public function pdfFecha (Request $request){
  //consulta pa traer los datos seleccionados
  /*$fi = $request->input('fecha_ini'). ' 00:00:00';
  $ff = $request->input('fecha_fin'). ' 23:59:59';
  $ventas = Venta::whereBetween('fechaVenta', [$fi, $ff])->get();
    // $ventas = Venta::WhereDate('fechaVenta', Carbon::today('America/Mexico_City'))->get();

        // Aqui hacemos uso de la libreria PDF para que genere el documento pdf
        $pdf = PDF::loadView('report.pdfReportFecha', compact('ventas'));
        return $pdf -> stream();*/
       // $ventas = Venta::WhereDate('fechaVenta', Carbon::today('America/Mexico_City'))->get();



        // Aqui hacemos uso de la libreria PDF para que genere el documento pdf
       // $pdf = PDF::loadView('report.pdfReportFecha', compact('ventas'));
       // return $pdf -> stream();
        
       //probando si este funciona
   /*   $fecha_ini = $request->input('fecha_ini');
       $fecha_fin = $request->input('fecha_fin');
       
       $ventas = Venta::whereBetween('fechaVenta', [$fecha_ini, $fecha_fin])->get();
       $data = [
        'ventas' => $ventas
    ];
       
       $pdf = PDF::loadView('report.pdfReportFecha', $data);
       
       return $pdf->stream('reporte-busquedas.pdf');*/

       //PRUEBA FINAL
     //  $fecha_inicio = request()->input('fecha_inicio');
       //$fecha_fin = request()->input('fecha_fin');

       $busqueda = $request->input('busqueda');
      
        return view('report.pdfReportFecha', ['busqueda' => $busqueda]);
      //  dd($busqueda);

         // Query the database for search records during the given date range
 /* $ventas = Venta::whereBetween('created_at', [$fecha_ini, $fecha_fin])->get();

  // Create a new Dompdf object and generate the PDF
  $pdf = new PDF();
  $pdf->loadHtml(view('report.pdfReportFecha', ['ventas' => $ventas]));
  $pdf->render();

  // Return the PDF file as a download
  return $pdf->stream('reportFecha.pdf');*/
    }

 
}
