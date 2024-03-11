<div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Recipe</th>
                <th>Taste</th>
                <th>Amount</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($details as $detail)
                <tr>
                    <td>{{ $detail->order_id }}</td>
                    @foreach ($detail->recipes as $recipe)
                        <td>{{ $recipe->name }}</td>
                    @endforeach
                    <td>{{ $detail->taste }}</td>
                    <td>{{ $detail->amount }}</td>
                    <td>{{ $detail->quantity }}</td>


                </tr>
            @endforeach
        </tbody>

    </table>
    <div class="col-4 mt-5">
        <select wire:model="discount" class="form-control" id="">
            <option value="0">No Discounts</option>
            @foreach ($combined_discounts as $discount)
                <option value="{{ $discount['name'] }}">
                    {{ $discount['name'] }}</option>
            @endforeach
        </select>
    </div>
    <div class="mt-2">
        <div class="float-right">
            <h3>Total - <span class="text-success " style="font-size: 25px">{{ $discounted_total }}
                    MMK <span class="text-danger" style="font-size: 15px">(including tax 10%)</span></span></h3>
            <form action="{{ route('checkout', $order->id) }}" method="POST">
                @csrf
                <button class="btn btn-sm btn-dark">Checkout</button>
            </form>

        </div>
    </div>

</div>
