<?php

namespace App\Http\Controllers;

use App\Exports\OrderExport;
use App\Models\Cart;
use App\Exports\ItemExport;
use App\Exports\VolumeExport;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\SiteInformation;
use App\Services\CartService;
use App\Services\OrderService;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

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

    public function exportOrders()
    {
        $file = 'order-list-' . date('dis') . '.xlsx';

        return Excel::download(new OrderExport, $file);
    }

    public function cartPDF()
    {
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

    public function invoicePDF($id)
    {
        $order = Order::find($id);

        if(is_null($order) || $order->user_id != auth()->user()->id) {
            return redirect()->back()->with('message', 'Selected order is invalid.');
        }

        $data = array(
            'order' => (new OrderService())->getOrderData($id),
            'general' => SiteInformation::find(1),
        );

        $pdf = PDF::loadView('ecommerce.pdf.invoice', $data);

        return $pdf->stream('invoice-'.uniqid().'.pdf');
    }
}
