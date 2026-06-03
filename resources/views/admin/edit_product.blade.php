@extends('admin.layout')

@section('content')
    <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>

            <p class="uppercase tracking-[5px] text-[#b08b68] text-xs mb-3">
                Admin Products
            </p>

            <h1 class="hero-title text-4xl md:text-5xl xl:text-[70px] leading-none text-[#1a1a1a]">
                Edit Product
            </h1>

        </div>

        <a href="{{ route('admin.products') }}"
            class="h-[48px] md:h-[58px] px-6 md:px-8 rounded-[22px] bg-black text-white flex items-center justify-center hover:bg-neutral-800 transition">

            Back

        </a>

    </div>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data"
        class="bg-white border border-[#ece5dc] rounded-[24px] md:rounded-[36px] p-5 md:p-8 xl:p-10">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-8">

            <!-- Name -->
            <div>

                <label class="block text-sm tracking-[3px] uppercase text-[#8b8175] mb-4">
                    Product Name
                </label>

                <input type="text" name="name" value="{{ $product->name }}"
                    class="w-full h-[52px] md:h-[58px] rounded-2xl border border-[#ece5dc] bg-[#f8f4ef] px-5 focus:ring-0 focus:border-black/20">

            </div>

            <!-- Price -->
            <div>

                <label class="block text-sm tracking-[3px] uppercase text-[#8b8175] mb-4">
                    Price
                </label>

                <input type="number" step="0.01" name="price" value="{{ $product->price }}"
                    class="w-full h-[52px] md:h-[58px] rounded-2xl border border-[#ece5dc] bg-[#f8f4ef] px-5 focus:ring-0 focus:border-black/20">

            </div>

            <!-- Stock -->
            <div>

                <p class="uppercase tracking-[3px] text-[#8b8175] text-xs mb-3">
                    Stock Quantity
                </p>

                <input type="number" name="stock" min="0" value="{{ $product->stock }}"
                    class="w-full h-[52px] md:h-[58px] rounded-2xl border border-black/10 bg-[#f3f1ec] px-5 focus:ring-0 focus:border-black">

            </div>

            <!-- Category -->
            <div>

                <label class="block text-sm tracking-[3px] uppercase text-[#8b8175] mb-4">
                    Category
                </label>

                <select name="category_id"
                    class="w-full h-[52px] md:h-[58px] rounded-2xl border border-[#ece5dc] bg-[#f8f4ef] px-5 focus:ring-0 focus:border-black/20">

                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>

                            {{ $cat->name }}

                        </option>
                    @endforeach

                </select>

            </div>

            <!-- Gender -->
            <div>

                <label class="block text-sm tracking-[3px] uppercase text-[#8b8175] mb-4">
                    Gender
                </label>

                <select name="gender"
                    class="w-full h-[52px] md:h-[58px] rounded-2xl border border-[#ece5dc] bg-[#f8f4ef] px-5 focus:ring-0 focus:border-black/20">

                    <option value="male" {{ $product->gender == 'male' ? 'selected' : '' }}>

                        Male

                    </option>

                    <option value="female" {{ $product->gender == 'female' ? 'selected' : '' }}>

                        Female

                    </option>

                    <option value="unisex" {{ $product->gender == 'unisex' ? 'selected' : '' }}>

                        Unisex

                    </option>

                </select>

            </div>

        </div>

        <!-- Sizes -->
        <div class="mt-8">

            <label class="block text-sm tracking-[3px] uppercase text-[#8b8175] mb-4">
                Sizes
            </label>

            <input type="text" name="sizes" value="{{ $product->sizes->pluck('size')->implode(', ') }}"
                class="w-full h-[52px] md:h-[58px] rounded-2xl border border-[#ece5dc] bg-[#f8f4ef] px-5 focus:ring-0 focus:border-black/20">

        </div>

        <!-- Description -->
        <div class="mt-8">

            <label class="block text-sm tracking-[3px] uppercase text-[#8b8175] mb-4">
                Description
            </label>

            <textarea name="description" rows="5" placeholder="Write product description..."
                class="w-full rounded-2xl md:rounded-3xl border border-[#ece5dc] bg-[#f8f4ef] px-5 py-4 resize-none focus:ring-0 focus:border-black/20">{{ $product->description }}</textarea>

        </div>

        <!-- Current Image -->
        @if ($product->images->count())
            <div class="mt-8">

                <label class="block text-sm tracking-[3px] uppercase text-[#8b8175] mb-4">

                    Current Images

                </label>

                <div class="flex flex-wrap gap-4">

                    @foreach ($product->images as $image)
                        <div class="relative image-card">

                            <img src="{{ asset('storage/' . $image->image) }}"
                                class="w-[110px] h-[140px] md:w-[140px] md:h-[170px] object-cover rounded-2xl md:rounded-3xl border border-[#ece5dc]">

                            <button type="button" onclick="deleteImage({{ $image->id }}, this)"
                                class="absolute -top-2 -right-2 w-8 h-8 rounded-full bg-red-500 text-white text-sm hover:bg-red-600 transition">

                                ×

                            </button>

                        </div>
                    @endforeach

                </div>

            </div>
        @endif

        <!-- Upload Image -->
        <div class="mt-8">

            <label class="block text-sm tracking-[3px] uppercase text-[#8b8175] mb-4">
                Add New Images (Optional)
            </label>

            <input type="file" name="images[]" multiple
                class="block w-full overflow-hidden text-sm text-[#6f675d] file:mr-4 file:rounded-2xl file:border-0 file:bg-black file:px-6 file:py-3 file:text-white hover:file:bg-neutral-800">

            <br>
            <div class="mb-3 p-4 rounded-2xl bg-amber-50 border border-amber-200">
                <p class="text-sm text-amber-800">
                    ⚠️ Important: Upload product images using a 4:5 ratio for the best display quality across the website.
                </p>
            </div>
        </div>

        <!-- Submit -->
        <div class="mt-10 flex justify-center md:justify-end">

            <button type="submit"
                class="hero-title h-[52px] md:h-[58px] px-8 md:px-10 rounded-[22px] bg-black text-white hover:bg-neutral-800 transition">

                Update Product

            </button>

        </div>

    </form>
    <script>
        function deleteImage(imageId, button) {

            fetch(`/admin/products/images/${imageId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {

                    button.closest('.image-card').remove();

                })
                .catch(error => {

                    console.error(error);

                });
        }
    </script>

@endsection
