<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\transaction;

use PDF;

class PDFController extends Controller
{
    public function streamPDF($id)
    {
        $transaction = transaction::find($id);
        $foods = $transaction->foodRequest()->get();
        $pdf = PDF::loadview('pdf.pdf_transaksi', [
            'transaction' => $transaction,
            'foods' => $foods,
        ]);
        return $pdf->stream();
    }

    public function downloadPDF($id)

    {
        $transaction = transaction::where('id', $id)->first();
        $foods = $transaction->foodRequest()->get();
        $pdf = PDF::loadview('pdf.pdf_transaksi', [
            'transaction' => $transaction,
            'foods' => $foods,
        ]);
        return $pdf->download('pdf_transaksi' . "_" . $transaction->nama . ".pdf");
    }
}
