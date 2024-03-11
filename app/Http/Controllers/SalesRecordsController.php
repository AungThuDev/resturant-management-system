<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\SaleRecord;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SalesRecordsController extends Controller
{
    public function index()
    {
        return view('sales-records.index');
    }

    public function details(SaleRecord $salerecord)
    {
        $details = OrderDetail::where('order_id', $salerecord->order_id)->with('recipes')->get();
        return view('sales-records.details', compact('details'));
    }

    public function print(SaleRecord $receipt)
    {
        $order_details = OrderDetail::where('order_id', $receipt->order_id)->with('recipes')->get();

        return view('receipt.print', compact('order_details', 'receipt'));
    }
}
