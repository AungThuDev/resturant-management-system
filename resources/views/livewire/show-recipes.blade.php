<div>
    <div class="d-flex">
        <input class="form-control mb-3" style="width: 300px;" wire:model="search" type="text"
            placeholder="Search recipe..." />
        <select style="width: 300px;" class="form-control ml-3" wire:model="filter">
            <option value="" selected>Filter by Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->name }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="row">

        <div class="col-6">
            <div class="card">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Recipe</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recipes as $recipe)
                            <tr>
                                <td>
                                    <img src="{{ asset('/assets/img/' . $recipe->image) }}" style="width: 70px"alt="">
                                </td>
                                <td>{{ $recipe->name }}</td>
                                <td>{{ $recipe->price }} MMK</td>
                                <td><button wire:click="addToCart({{ $recipe->id }})"
                                        class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $recipes->links() }}
                </div>
            </div>
        </div>
        <livewire:show-cart />
    </div>
</div>
