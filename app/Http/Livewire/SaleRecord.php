<?php

namespace App\Http\Livewire;

use App\Models\SaleRecord as ModelsSaleRecord;
use Livewire\Component;
use Livewire\WithPagination;

class SaleRecord extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';

    public $from;

    public $to;

    public function render()
    {
        if($this->from && $this->to)
        {
            $records = ModelsSaleRecord::whereBetween('order_date', [$this->from, $this->to])->orderBy('order_id', 'desc')->paginate(5);
        }
        elseif($this->from)
        {
            $records = ModelsSaleRecord::where('order_date', $this->from)->orderBy('order_id', 'desc')->paginate(5);
        }
        else
        {
            $records = ModelsSaleRecord::latest()->paginate(5);
        }
        
        return view('livewire.sale-record', ['records' => $records]);
    }
}
