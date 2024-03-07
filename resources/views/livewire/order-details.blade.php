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
    <div class="col-4">
        <select wire:model="discount" class="form-control" id="">
            <option value="0">No Discounts</option>
            @foreach ($combined_discounts as $discount)
                <option value="{{ $discount['name'] }}">
                    {{ $discount['name'] }}</option>
            @endforeach
        </select>
    </div>
    <div class="d-flex justify-content-between mt-5">
        <h3>Total - <span class="text-success" style="font-size: 25px">{{ $discounted_total }} MMK</span></h3>
        <a href="" class="btn btn-primary float-right">Checkout</a>
    </div>
</div>
