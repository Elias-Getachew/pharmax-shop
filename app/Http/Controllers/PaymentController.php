<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Chapa\Chapa\Facades\Chapa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{

 public function downloadReceipt($orderCode)
    {
        $order = Order::where('order_code', $orderCode)->firstOrFail();

        $pdf = PDF::loadView('ecommerce.receipts.order', compact('order'));

        $pdfPath = 'receipts/' . $orderCode . '.pdf';
        Storage::put($pdfPath, $pdf->output());

        return $pdf->download('receipt_' . $orderCode . '.pdf');
    }


    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $details) {
            $total += $details['price'] * $details['quantity'];
        }
        return $total;
    }
}
