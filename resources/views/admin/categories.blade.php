@extends('admin.layout')

@section('content')
    <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>

            <p class="uppercase tracking-[5px] text-[#b08b68] text-xs mb-3">
                Admin Categories
            </p>

            <h1 class="hero-title text-4xl md:text-5xl xl:text-[70px] leading-none text-[#1a1a1a]">
                Categories
            </h1>

        </div>

        <a href="{{ route('categories.create') }}"
            class="hero-title h-[48px] md:h-[58px] px-6 md:px-8 rounded-[22px] bg-black text-white flex items-center justify-center hover:bg-neutral-800 transition">

            Add Category

        </a>

    </div>
    @if (session('success'))
        <div class="mb-6 px-6 py-4 rounded-[24px] bg-green-50 border border-green-200 text-green-700">

            {{ session('success') }}

        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 px-6 py-4 rounded-[24px] bg-red-50 border border-red-200 text-red-700">

            {{ session('error') }}

        </div>
    @endif

    <!-- Categories Table -->
    <div class="bg-white rounded-[24px] md:rounded-[32px] border border-[#ece5dc] overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full min-w-[700px]">

                <thead class="bg-[#f8f4ef]">

                    <tr>

                        <th class="px-8 py-5 text-left text-sm uppercase tracking-[3px] text-[#9c8772]">
                            Category
                        </th>

                        <th class="px-8 py-5 text-left text-sm uppercase tracking-[3px] text-[#9c8772]">
                            Products
                        </th>

                        <th class="px-8 py-5 text-left text-sm uppercase tracking-[3px] text-[#9c8772]">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($categories as $category)
                        <tr class="border-t border-[#f1ebe4]">

                            <!-- Category -->
                            <td class="px-8 py-6">

                                <div class="flex items-center gap-5">

                                    @if ($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}"
                                            class="w-16 h-16 md:w-20 md:h-20 rounded-2xl object-cover">
                                    @endif

                                    <div class="min-w-0">

                                        <h3 class="text-[#1f1f1f] font-semibold text-lg truncate">
                                            {{ $category->name }}
                                        </h3>

                                        <p class="text-[#8b8175] text-sm mt-1">
                                            ID #{{ $category->id }}
                                        </p>

                                    </div>

                                </div>

                            </td>

                            <!-- Products Count -->
                            <td class="px-8 py-6">

                                <span class="px-4 py-2 rounded-full bg-[#f6f1ea] text-[#8b7355] text-sm">

                                    {{ $category->products_count }} Products

                                </span>

                            </td>

                            <!-- Actions -->
                            <td class="px-8 py-6">

                                <div class="flex flex-col xl:flex-row gap-2">

                                    <!-- Edit -->
                                    <a href="{{ route('categories.edit', $category->id) }}"
                                        class="h-[42px] px-5 rounded-xl bg-[#181818] text-white flex items-center justify-center hover:bg-black transition">

                                        Edit

                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="h-[42px] px-5 rounded-xl border border-red-200 text-red-500 hover:bg-red-50 transition">

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>
@endsection
