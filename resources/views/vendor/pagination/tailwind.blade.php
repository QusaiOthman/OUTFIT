@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}">

        <div class="flex justify-center gap-3 sm:hidden">

            @if ($paginator->onFirstPage())
                <span
                    class="px-4 h-10 flex items-center justify-center rounded-full border border-black/10 bg-white text-black text-sm hover:bg-black hover:text-white transition duration-300">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                    class="px-4 h-10 flex items-center justify-center rounded-full border border-black/10 bg-white text-black text-sm hover:bg-black hover:text-white transition duration-300">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                    class="px-4 h-10 flex items-center justify-center rounded-full border border-black/10 bg-white text-black text-sm hover:bg-black hover:text-white transition duration-300">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span
                    class="px-4 h-10 flex items-center justify-center rounded-full border border-black/10 bg-white text-black text-sm hover:bg-black hover:text-white transition duration-300">
                    {!! __('pagination.next') !!} </span>
            @endif

        </div>

        <div class="hidden sm:flex justify-center items-center">



            <div>
                <span class="inline-flex items-center gap-2">

                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span
                                class="w-10 h-10 flex items-center justify-center rounded-full border border-black/10 bg-white text-gray-400 cursor-not-allowed"
                                aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                            class="w-10 h-10 flex items-center justify-center rounded-full border border-black/10 bg-white text-black hover:bg-black hover:text-white transition duration-300"
                            aria-label="{{ __('pagination.previous') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span class="px-2 text-gray-500">
                                {{ $element }}
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span
                                            class="w-10 h-10 flex items-center justify-center rounded-full bg-black text-white text-sm font-medium">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                        class="w-10 h-10 flex items-center justify-center rounded-full border border-black/10 bg-white text-black text-sm hover:bg-black hover:text-white transition duration-300"
                                        aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                            class="w-10 h-10 flex items-center justify-center rounded-full border border-black/10 bg-white text-black hover:bg-black hover:text-white transition duration-300"
                            aria-label="{{ __('pagination.next') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span
                                class="w-10 h-10 flex items-center justify-center rounded-full border border-black/10 bg-white text-gray-400 cursor-not-allowed"
                                aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
