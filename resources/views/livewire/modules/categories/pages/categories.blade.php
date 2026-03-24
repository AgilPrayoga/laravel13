<div>
    <div class="w-full grid lg:grid-cols-2 md:grid-cols-1 gap-3 transition">
        <div class="order-last lg:order-first">
            <div class="m-3 h-40">

                <livewire:modules.categories.components.infobox />
            </div>
            <div class="m-3">

                <livewire:modules.categories.components.table />
            </div>
        </div>
        <div class="order-first lg:order-last">
            <div class="m-3 h-40">
                @if ($isEdit)
                    <livewire:modules.categories.components.button-options />
                @endif
            </div>
            <div class="m-3">
                <div>
                    <livewire:modules.categories.components.form />
                </div>

            </div>
        </div>
    </div>
</div>
