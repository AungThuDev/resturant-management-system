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
                        @foreach ($item->recipes as $recipe)
                            <td>{{ $recipe->name }}
                                <span class="text-success">({{ $item->taste }})</span>
                            </td>
                        @endforeach
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
        <div>
            <div class="d-flex justify-content-between">
                <h4 class="text-success">Sub - <span style="font-size: 30px">{{ $cost }}</span> MMK</h4>

                <h4 class="text-success">Total - <span style="font-size: 30px">{{ $total }}</span> MMK</h4>
            </div>

            <h4 class="text-danger">Tax - <span style="font-size: 20px">10%</span></h4>
        </div>
        <form action="{{ route('ordered', $table->id) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-6">
                    <select name="discount_name" class="form-control">
                        <option value="">Choose Discounts</option>
                        @foreach ($combined_discounts as $discount)
                            <option value="{{ $discount['name'] }}">{{ $discount['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <button type="submit" class="btn btn-primary float-right">Order</button>
                </div>
            </div>
        </form>
    @endif

</div>
