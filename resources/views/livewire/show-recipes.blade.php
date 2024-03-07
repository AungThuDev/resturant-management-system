<div>
    <div class="d-flex">
        <input class="form-control mb-3" style="width: 300px;" wire:model="search" type="text"
            placeholder="Search recipe..." />
        <select style="width: 300px;" class="form-control ml-3" wire:model="filter">
            <option value="" selected>Filter by Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="row">
        <div class="col-6">
            {{-- <div class="card">
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
            </div> --}}
            @foreach ($recipes as $recipe)
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="{{ asset('/images/' . $recipe->image) }}" style="width: 100%" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-7">
                                        <h3 class="card-title">{{ $recipe->name }}</h3>
                                        <h3>{{ $recipe->price }} MMK</h3>

                                        <select wire:model="taste.{{ $recipe->id }}" class="form-control">
                                            <option value="">Choose Taste</option>
                                            @foreach ($tastes as $t)
                                                <option value="{{ $t->name }}">{{ $t->name }}</option>
                                            @endforeach
                                        </select>


                                    </div>
                                    <div class="col-5 mt-4">
                                        @if (!empty($taste[$recipe->id]))
                                            <button wire:click="addToCart({{ $recipe->id }})"
                                                class="btn btn-primary"><i class="fa fa-plus"></i></button>
                                        @else
                                            <button disabled wire:click="addToCart({{ $recipe->id }})"
                                                class="btn btn-primary"><i class="fa fa-plus"></i></button>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        @livewire('show-cart', ['table' => $table])
    </div>
</div>
