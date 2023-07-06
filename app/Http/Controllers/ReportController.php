<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Exports\ItemExport;
use App\Exports\VolumeExport;
use App\Models\GeneralSetting;
use App\Models\SiteInformation;
use App\Services\CartService;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use PDF;

class ReportController extends Controller
{
    public function exportSeries()
    {
        $file = 'series-list-' . date('dis') . '.xlsx';

        return Excel::download(new ItemExport, $file);
    }

    public function exportVolumes()
    {
        $file = 'volumes-list-' . date('dis') . '.xlsx';

        return Excel::download(new VolumeExport, $file);
    }

    public function cartPDF()
    {
        set_time_limit(300);

        $data = array(
            'cart' => (new CartService(new Cart()))->getCart(),
            'general' => SiteInformation::find(1),
            'title' => Session::get('customer_unique_id')
        );

        if(is_null($data['cart']))
        {
            return redirect()->back()->with('message', 'Your cart is currently empty.');
        }

        // return response()->json(array('data' => $data));
        $pdf = PDF::loadView('ecommerce.pdf.cart-detail', $data);

        return $pdf->stream('cart-details-'.uniqid().'.pdf');
    }
}
