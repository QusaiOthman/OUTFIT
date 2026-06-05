<x-app-layout>

    <div class="bg-[#f3f0f8] min-h-screen">

        <section class="max-w-7xl mx-auto px-6 lg:px-10 py-20">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-14 items-start">

                <!-- Product Gallery -->
                <div>

                    <!-- Main Image -->
                    <div
                        class="relative overflow-hidden rounded-[40px] bg-gradient-to-br from-[#f8f7f4] to-[#ece7df] min-h-[420px] sm:min-h-[520px] lg:min-h-[700px] flex items-center justify-center">

                        @if ($product->images->count())
                            <img id="main-product-image" src="{{ $product->images->first()->image_url }}"
                                class="w-full h-auto transition-opacity duration-300">
                        @endif

                        <!-- Favorite -->
                        <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST"
                            class="absolute top-4 right-4 z-20">

                            @csrf

                            <button
                                class="w-9 h-9 rounded-full bg-white/15 backdrop-blur-md border border-white/20 text-white hover:bg-white hover:text-black hover:scale-110 transition duration-300 flex items-center justify-center">

                                @if (auth()->check() && auth()->user()->wishlistItems->where('product_id', $product->id)->count())
                                    ♥
                                @else
                                    ♡
                                @endif

                            </button>

                        </form>

                        <!-- Gender -->
                        @if ($product->gender)
                            <span
                                class="absolute top-6 left-6 text-[11px] uppercase tracking-[3px] bg-black text-white px-4 py-2 rounded-full">

                                {{ $product->gender }}

                            </span>
                        @endif

                    </div>

                    <!-- Thumbnails -->
                    @if ($product->images->count() > 1)

                        <div class="flex flex-wrap gap-3 mt-4">

                            @foreach ($product->images as $image)
                                <button type="button" onclick="changeImage('{{ $image->image_url }}', this)"
                                    class="gallery-thumb overflow-hidden rounded-2xl border transition duration-300 {{ $loop->first ? 'border-black scale-105' : 'border-[#ece5dc]' }}">

                                    <img src="{{ $image->image_url }}" class="w-20 h-24 object-cover">

                                </button>
                            @endforeach

                        </div>

                    @endif

                </div>


                <!-- Product Info -->
                <div class="pt-6">

                    <!-- Category -->
                    @if ($product->category)
                        <p
                            class="uppercase tracking-[4px]
                                   text-[#8b8175]
                                   text-sm mb-5">

                            {{ $product->category->name }}

                        </p>
                    @endif

                    <!-- Title -->
                    <h1
                        class="hero-title text-[38px] sm:text-[48px] lg:text-[64px] leading-[0.95] text-[#1f1f1f] mb-5 sm:mb-8">

                        {{ $product->name }}

                    </h1>

                    <!-- Description -->
                    <p
                        class="section-description-font text-[#6f675d] text-[15px] sm:text-lg lg:text-xl leading-relaxed mb-8 sm:mb-10 max-w-[600px]">

                        {{ $product->description }}

                    </p>

                    <!-- STOCK STATUS -->
                    <div class="mt-6 mb-10">

                        @if ($product->stock <= 5 && $product->stock > 0)
                            <div
                                class="inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-yellow-100 text-yellow-700">

                                <span class="w-3 h-3 rounded-full bg-yellow-500"></span>

                                Low Stock ({{ $product->stock }} left)

                            </div>
                        @endif

                    </div>

                    <!-- Price -->
                    <div class="number-font text-3xl sm:text-4xl lg:text-5xl text-[#1f1f1f] mb-8">

                        {{ $product->price }}<span class="text-[6px] sm:text-[8px] text-[#6f675d]">SAR</span>


                    </div>

                    <!-- Sizes -->
                    <div class="mb-12">

                        <p
                            class="uppercase tracking-[3px]
                                   text-[#8b8175]
                                   text-sm mb-5">

                            Select Size

                        </p>

                        <div class="flex flex-wrap gap-3">

                            @foreach ($product->sizes as $size)
                                <button type="button"
                                    class="size-btn
                                           w-11 h-11 sm:w-14 sm:h-14 rounded-2xl
                                           border border-black/10
                                           bg-white
                                           text-[#1f1f1f]
                                           hover:bg-black
                                           hover:text-white
                                           focus:bg-black
                                           transition duration-300"
                                    data-size="{{ $size->size }}">

                                    {{ $size->size }}

                                </button>
                            @endforeach

                        </div>

                    </div>

                    <!-- Add To Cart -->
                    @auth

                        <form action="{{ url('/cart/add/' . $product->id) }}" method="POST"
                            onsubmit="return validateSize()" class="inline-block">

                            @csrf

                            <input type="hidden" name="size" id="selected-size" required>
                            <p id="size-error" class="text-red-500 text-sm mt-3 hidden">

                                Please select a size

                            </p>

                            @if ($product->stock > 0)
                                <button type="submit"
                                    class="hero-title h-[48px] sm:h-[58px] px-6 sm:px-10 rounded-xl sm:rounded-2xl bg-black text-white text-sm sm:text-base hover:bg-neutral-800 transition">

                                    Add To Cart

                                </button>
                            @else
                                <button disabled
                                    class="hero-title h-[58px] px-10 rounded-2xl bg-gray-300 text-gray-500 cursor-not-allowed">

                                    Out Of Stock

                                </button>
                            @endif

                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center justify-center
                                   w-full h-[64px]
                                   rounded-2xl
                                   bg-black text-white
                                   text-lg font-medium
                                   hover:bg-neutral-800
                                   transition duration-300">

                            Login to Purchase

                        </a>

                    @endauth

                    <!-- Extra Info -->
                    <div
                        class="mt-16 pt-10
                               border-t border-black/10
                               grid grid-cols-1 sm:grid-cols-2 gap-6 sm:gap-8">

                        <div>

                            <p
                                class="text-sm uppercase tracking-[3px]
                                       text-[#8b8175] mb-3">

                                Material

                            </p>

                            <p class="text-[#1f1f1f] text-lg">
                                Premium Fabric
                            </p>

                        </div>

                        <div>

                            <p
                                class="text-sm uppercase tracking-[3px]
                                       text-[#8b8175] mb-3">

                                Shipping

                            </p>

                            <p class="text-[#1f1f1f] text-lg">
                                Worldwide Delivery
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </div>

    <!-- Related Products -->
    @if ($relatedProducts->count())

        <section class="max-w-7xl mx-auto px-6 mt-6 lg:px-10 pb-24">

            <!-- Header -->
            <div class="flex items-end justify-between mb-14">

                <div>

                    <p class="uppercase tracking-[4px] text-[#8b8175] text-sm mb-4">

                        Discover More

                    </p>

                    <h2 class="hero-title text-3xl sm:text-4xl lg:text-5xl text-[#1f1f1f]">

                        You May Also Like

                    </h2>

                </div>

            </div>

            <!-- Products -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8">

                @foreach ($relatedProducts as $related)
                    <div class="group relative h-[240px] sm:h-[320px] lg:h-[380px] rounded-[30px] overflow-hidden">

                        <!-- Link -->
                        <a href="{{ route('products.show', $related->id) }}" class="absolute inset-0 z-10">


                            <!-- Image -->
                            @if ($related->images->first())
                                <img src="{{ $related->images->first()->image_url }}"
                                    class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-700">
                            @endif


                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/20 to-transparent">
                            </div>

                            <!-- Content -->
                            <div class="absolute bottom-0 left-0
                               w-full p-6 z-20">

                                @if ($related->category)
                                    <p class="text-[10px] uppercase tracking-[3px] text-white/70 mb-2">

                                        {{ $related->category->name }}

                                    </p>
                                @endif

                                <h3 class="text-[24px] leading-tight font-bold text-white line-clamp-2">

                                    {{ $related->name }}

                                </h3>

                                <div class="mt-4">

                                    <span class="number-font text-lg font-semibold text-white">

                                        {{ $related->price }}<span class="text-[6px] sm:text-[8px]">SAR</span>

                                    </span>

                                </div>

                            </div>
                        </a>

                    </div>
                @endforeach

            </div>

        </section>

    @endif

    <!-- Size Selection -->
    <script>
        const buttons = document.querySelectorAll('.size-btn');
        const input = document.getElementById('selected-size');

        buttons.forEach(button => {

            button.addEventListener('click', () => {

                document.getElementById('size-error')
                    .classList.add('hidden');
                buttons.forEach(btn => {

                    btn.classList.remove('bg-black', 'text-white');

                });

                button.classList.add('bg-black', 'text-white');

                input.value = button.dataset.size;

            });

        });

        function validateSize() {

            const size = document.getElementById('selected-size').value;

            if (!size) {

                const error = document.getElementById('size-error');

                error.classList.remove('hidden');

                return false;

            }

            const btn = document.getElementById('add-to-cart-btn');

            btn.innerHTML = '✓ Added To Cart';

            btn.classList.remove('bg-black');

            btn.classList.add('bg-green-600');

            setTimeout(() => {

                btn.innerHTML = 'Add To Cart';

                btn.classList.remove('bg-green-600');

                btn.classList.add('bg-black');

            }, 2000);

            return true;

        }

        function changeImage(image, element) {

            const mainImage = document.getElementById('main-product-image');

            mainImage.style.opacity = 0;

            setTimeout(() => {

                mainImage.src = image;

                mainImage.style.opacity = 1;

            }, 150);

            document.querySelectorAll('.gallery-thumb').forEach(btn => {

                btn.classList.remove(
                    'border-black',
                    'scale-105'
                );

            });

            element.classList.add(
                'border-black',
                'scale-105'
            );
        }
    </script>

    @include('layouts.footer')

</x-app-layout>
