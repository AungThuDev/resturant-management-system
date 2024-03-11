<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\SaleRecord;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SalesRecordsController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $records = SaleRecord::query();
            return DataTables::of($records)
            ->addColumn('action',function($each){
                $details_icon = '<a href="'.route('sales-records.show',$each->id).'" class="btn btn-outline-warning" style="margin-right:10px;"><i class="fas fa-eye"></i>&nbsp;Details</a>';

                return '<div class="action-icon">' . $details_icon . '</div>';
            })
            ->editColumn('amount', function($each){
                return $each->amount . ' MMK';
            })
            ->editColumn('discounted_amount', function($each){
                return $each->discounted_amount . ' MMK';
            })
            ->rawColumns(['action'])
            ->make(true);
        }
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
