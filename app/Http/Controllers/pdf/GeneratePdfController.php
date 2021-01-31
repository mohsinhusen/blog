<?php

namespace App\Http\Controllers\pdf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect;
use PDF;

class GeneratePdfController extends Controller
{
    public function exportPdf(Request $request, $id) {

        $installment_details = DB::table('loan_installment')
                                 ->join('loan','loan_installment.loan_id','loan.id')
                                 ->join('member','loan.member_id','member.id')
                                 ->select('loan_installment.*','loan.*','member.*') 
                                 ->where('loan_installment.loan_id', array($id))
                                 ->get()->first();
        if ($installment_details != null) {                        
                    $installment_statement = DB::table('loan_installment')
                                 ->join('loan','loan_installment.loan_id','loan.id')
                                 ->join('member','loan.member_id','member.id')
                                 ->select('loan_installment.*','loan.*','member.*','loan_installment.id') 
                                 ->where('loan_installment.loan_id', array($id))
                                 ->get();

                    
                $current_profit = DB::table("loan_installment")
                                ->select(
                                        DB::raw("
                                        SUM(loan_installment.amount_profit) as current_profit,
                                        SUM(loan_installment.taxable_amount+loan_installment.amount_profit) as totalpaid_amount,
                                        SUM(loan_installment.taxable_amount) as paid_amount,
                                        COUNT(loan_installment.loan_id) as total_paid_installment,
                                        loan.loan_no,loan.member_id, member.name, loan.loan_date "))
                                        ->leftJoin('member', 'loan_installment.member_id', '=', 'member.id')
                                        ->leftJoin('loan', 'loan.id', '=', 'loan_installment.loan_id')
                                        ->groupBy(DB::raw("loan_installment.loan_id, member.name, loan.member_id, loan.loan_no, loan.loan_date"))
                                        ->where('loan_installment.loan_id', array($id))
                                        ->get()->first();

                            return view('pdfview.pdfview')->with([
                                                'installment_details'=>$installment_details,
                                                'installment_statement'=>$installment_statement,
                                                'current_profit'=>$current_profit,
                                                'id'=>$id
                                               
                                ]);

                                $pdf = PDF::loadView('pdfview.pdfview'); // <--- load your view into theDOM wrapper;
                                $path = public_path('pdf_docs/'); // <--- folder to store the pdf documents into the server;
                                $fileName =  time().'.'. 'pdf' ; // <--giving the random filename,
                                $pdf->save($path . '/' . $fileName);
                                $generated_pdf_link = url('pdf_docs/'.$fileName);
                                return response()->json($generated_pdf_link);

                        }else {                             
                          echo  $msg = "No Paid any installment";
                         }

      
    }
}
