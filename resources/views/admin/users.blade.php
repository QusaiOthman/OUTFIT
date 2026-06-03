@extends('admin.layout')

@section('content')
    <div class="mb-10">

        <p class="uppercase tracking-[5px] text-[#b08b68] text-xs mb-3">
            Admin Users
        </p>

        <h1 class="hero-title text-4xl md:text-5xl xl:text-[70px] leading-none text-[#1a1a1a]">
            Users
        </h1>

    </div>

    <!-- Filters -->
    <form method="GET" class="mb-8 bg-white border border-[#ece5dc] rounded-[24px] p-5 flex flex-col lg:flex-row gap-3">

        <!-- Search -->
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email or phone..."
            class="flex-1 h-[54px] rounded-2xl border border-[#ece5dc] bg-[#faf7f3] px-5">

        <!-- Sort -->
        <select name="sort" class="h-[54px] rounded-2xl border border-[#ece5dc] bg-[#faf7f3] px-5">

            <option value="newest">Newest</option>
            <option value="oldest" @selected(request('sort') == 'oldest')>
                Oldest
            </option>

        </select>

        <!-- Role -->
        <select name="role" class="h-[54px] rounded-2xl border border-[#ece5dc] bg-[#faf7f3] px-5">

            <option value="">All Users</option>

            <option value="admin" @selected(request('role') == 'admin')>
                Admins
            </option>

            <option value="customer" @selected(request('role') == 'customer')>
                Customers
            </option>

        </select>

        <!-- Status -->
        <select name="status" class="h-[54px] rounded-2xl border border-[#ece5dc] bg-[#faf7f3] px-5">

            <option value="">All Statuses</option>

            <option value="active" @selected(request('status') == 'active')>
                Active
            </option>

            <option value="suspended" @selected(request('status') == 'suspended')>
                Suspended
            </option>

        </select>

        <!-- Verification -->
        <select name="verification" class="h-[54px] rounded-2xl border border-[#ece5dc] bg-[#faf7f3] px-5">

            <option value="">All Emails</option>

            <option value="verified" @selected(request('verification') == 'verified')>
                Verified
            </option>

            <option value="not_verified" @selected(request('verification') == 'not_verified')>
                Not Verified
            </option>

        </select>

        <button type="submit" class="hero-title h-[54px] px-8 rounded-2xl bg-black text-white">

            Filter

        </button>
        <a href="{{ route('admin.users') }}"
            class="hero-title h-[54px] px-8 rounded-2xl border border-[#ece5dc] flex items-center justify-center">

            Reset

        </a>

    </form>

    <div class="bg-white border border-[#ece5dc] rounded-[24px] md:rounded-[36px] overflow-hidden">

        @foreach ($users as $user)
            <a href="{{ route('admin.users.show', $user->id) }}"
                class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 px-5 md:px-8 py-6 border-b border-[#f3eee8] hover:bg-[#faf7f3] transition">

                <div class="min-w-0">

                    <h2 class="hero-title text-2xl md:text-3xl text-[#1f1f1f] break-words">

                        {{ $user->name }}

                    </h2>

                    <p class="text-[#8b8175] mt-2 break-all">

                        {{ $user->email }}

                    </p>
                    <p class="text-xs text-[#b08b68] mt-2 uppercase tracking-[2px]">

                        Joined {{ $user->created_at->format('d M Y') }}

                    </p>
                    <div class="flex flex-wrap gap-2 mt-3">

                        @if ($user->is_admin)
                            <span class="px-3 py-1 rounded-full bg-black text-white text-xs uppercase tracking-[2px]">

                                Admin

                            </span>
                        @endif

                        @if ($user->is_suspended)
                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs uppercase tracking-[2px]">

                                Suspended

                            </span>
                        @endif

                        @if (!$user->email_verified_at)
                            <span
                                class="px-3 py-1 rounded-full bg-amber-100 text-amber-700 text-xs uppercase tracking-[2px]">

                                Not Verified

                            </span>
                        @endif

                    </div>

                </div>

                <div class="text-left md:text-right">

                    <p class="text-xs uppercase tracking-[3px] text-[#b08b68] mb-2">
                        Orders
                    </p>

                    <h3 class="number-font text-2xl md:text-3xl text-[#1f1f1f]">

                        {{ $user->orders->count() }}

                    </h3>

                    <span class="px-3 py-1 rounded-full bg-purple-400 text-black text-xs uppercase tracking-[2px]">

                        {{ $user->customer_level }}

                    </span>

                </div>

            </a>
        @endforeach

    </div>
@endsection
