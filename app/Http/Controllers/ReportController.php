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
    public function reportsDate(){
      $ventas = Venta::whereDate('fechaVenta', Carbon::today('America/Mexico_City')->format('d-m-Y'))->get();
        $valorPrima = $ventas->sum('valorPrima');
        return view('report.reports_date', compact('ventas', 'valorPrima'));
  
    }
    public function reportResults(Request $request){
      $fi = $request->fecha_ini. ' 00:00:00';
      $ff = $request->fecha_fin. ' 23:59:59';
      $ventas = Venta::whereBetween('fechaVenta', [$fi, $ff])->get();
      $valorPrima = $ventas->sum('valorPrima');
     return view('report.reports_date', compact('ventas', 'valorPrima'));
      
   
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
  $fi = $request->input('fecha_ini'). ' 00:00:00';
  $ff = $request->input('fecha_fin'). ' 23:59:59';
  $ventas = Venta::whereBetween('fechaVenta', [$fi, $ff])->get();
    // $ventas = Venta::WhereDate('fechaVenta', Carbon::today('America/Mexico_City'))->get();

        // Aqui hacemos uso de la libreria PDF para que genere el documento pdf
        $pdf = PDF::loadView('report.pdfReportFecha', compact('ventas'));
        return $pdf -> stream();
       // $ventas = Venta::WhereDate('fechaVenta', Carbon::today('America/Mexico_City'))->get();



        // Aqui hacemos uso de la libreria PDF para que genere el documento pdf
       // $pdf = PDF::loadView('report.pdfReportFecha', compact('ventas'));
       // return $pdf -> stream();
        
    }

 
}
