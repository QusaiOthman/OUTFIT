@extends('admin.layout')

@section('content')
    <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>

            <p class="uppercase tracking-[5px] text-[#b08b68] text-xs mb-3">
                Admin Categories
            </p>

            <h1 class="hero-title text-4xl md:text-5xl xl:text-[70px] leading-none text-[#1a1a1a]">
                Create Category
            </h1>

        </div>

        <a href="{{ route('admin.categories') }}"
            class="h-[48px] md:h-[58px] px-6 md:px-8 rounded-[22px] bg-black text-white flex items-center justify-center hover:bg-neutral-800 transition">

            Back

        </a>

    </div>

    <form enctype="multipart/form-data" action="{{ route('categories.store') }}" method="POST"
        class="bg-white border border-[#ece5dc] rounded-[24px] md:rounded-[36px] p-5 md:p-8 xl:p-10">

        @csrf

        <!-- Category Name -->
        <div>

            <label class="block text-sm tracking-[3px] uppercase text-[#8b8175] mb-4">
                Category Name
            </label>

            <input type="text" required name="name" placeholder="Enter category name"
                class="w-full h-[52px] md:h-[58px] rounded-2xl border border-[#ece5dc] bg-[#f8f4ef] px-5 focus:ring-0 focus:border-black/20">

        </div>

        <!-- Category Image -->
        <div class="mt-8">

            <label class="block text-sm tracking-[3px] uppercase text-[#8b8175] mb-4">
                Category Image
            </label>

            <input type="file" name="image" required
                class="block w-full overflow-hidden text-sm text-[#6f675d] file:mr-4 file:rounded-2xl file:border-0 file:bg-black file:px-6 file:py-3 file:text-white hover:file:bg-neutral-800">

            <br>
            <div class="mb-3 p-4 rounded-2xl bg-amber-50 border border-amber-200">
                <p class="text-sm text-amber-800">
                    ⚠️ Important: Upload category images using a 3:4 ratio for the best display quality.
                </p>
            </div>
        </div>

        <!-- Submit -->
        <div class="mt-10 flex justify-center md:justify-end">

            <button type="submit"
                class="hero-title h-[52px] md:h-[58px] px-8 md:px-10 rounded-[22px] bg-black text-white hover:bg-neutral-800 transition">

                Save Category

            </button>

        </div>

    </form>
@endsection
