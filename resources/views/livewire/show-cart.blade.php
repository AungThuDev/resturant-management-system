<div class="col-6">
    <div class="card">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->price }} MMK</td>

                        <td class="d-flex">
                            <button wire:click="increment({{ $item->id }})"
                                class="btn btn-sm btn-primary mr-2">+</button>
                            <span class="mt-1">{{ $item->quantity }}</span>
                            <button wire:click="decrement({{ $item->id }})"
                                class="btn btn-sm btn-primary ml-2">-</button>
                        </td>
                        <td>
                            <button wire:click="delete({{ $item->id }})" class="btn btn-sm btn-danger"><i
                                    class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if ($cost && $total)
        <div class="d-flex justify-content-between">
            <div>

                <h2 class="text-success">Cost - {{ $cost }} MMK</h2>
                <h4 class="text-danger">Tax - 10%</h4>
            </div>
            <h2 class="text-success">Total - {{ $total }} MMK</h2>
        </div>
        <a href="{{ route('ordered') }}" class="btn btn-primary float-right">Order</a>
    @endif

</div>
