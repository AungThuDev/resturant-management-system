<div>
    <div class="d-flex">
        <div class="form-group mr-4">
            <label for="" class="mb-0">From</label>
            <input type="date" style="width: 150px" class="form-control mb-3" wire:model="from">
        </div>

        <div class="form-group">
            <label for="" class="mb-0">To</label>
            <input type="date" style="width: 150px" class="form-control mb-3" wire:model="to">
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Amount</th>
                <th>Discounted Amount</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $record)
                <tr>
                    <td>{{ $record->order_id }}</td>
                    <td>{{ $record->amount }} MMK</td>
                    <td>{{ $record->discounted_amount }} MMK</td>
                    <td>{{ $record->order_date }}</td>
                    <td>
                        <a href="{{ route('sales-records.show', $record->id) }}" class="btn btn-outline-primary"><i
                                class="fa fa-eye" style="margin-right: 10px"></i>Details</a>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    <div class="mt-2">{{ $records->links() }}</div>
</div>
