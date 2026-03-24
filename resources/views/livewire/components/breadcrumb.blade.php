<div>
    <div class="flex text- ml-3 border bg-white p-2 w-fit rounded-full border-gray-300 justify-center items-center shadow-lg">

        <div class="w-[40px] h-[40px] flex justify-center items-center rounded-full  p-2 bg-gray-100">
            <i class="bi text-xl bi-{{ $icon }}"></i>
        </div>
        @if ($title)
            <div wire:navigate @if ($routePrefix != '') href='{{ route($routePrefix) }}' @endif class="cursor-pointer"><i class="bi mx-3 text-xl bi-chevron-right"></i><span
                    class="  px-3 py-2 @if ($subTitle == '') bg-blue-100 @endif  rounded-full hover:bg-blue-200">{{ $title ?? '' }}</span></div>
        @endif
        @if ($subTitle)
            <div class="cursor-pointer"><i class="bi mx-3 text-xl bi-chevron-right"></i><span class="  px-3 py-2 bg-blue-100 rounded-full hover:bg-blue-200">{{ $subTitle ?? '' }}</span></div>
        @endif
    </div>
</div>
