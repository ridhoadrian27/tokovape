<?php

namespace App\Http\Controllers;

Use PDF;
Use Storage;
use App\Marketplace;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function exportpdf($pemesanan, $invoice)
    {
      $pdf = PDF::loadView('export.userpdf', [
        'no_pemesanan' => $pemesanan,
        'no_invoice' => $invoice
      ]);
      return $pdf->download($invoice.'.pdf');
      // Storage::put('invoice.pdf', $pdf->output());
      // return $pdf->download('invoice.pdf');
      //$path = public_path('pdf/');
      //$pdf->save($path.'/invoice.pdf');

    }
}
