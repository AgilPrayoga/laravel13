<div>
    <div class="w-full grid lg:grid-cols-2 md:grid-cols-1 gap-3 transition">
        <div class="order-last lg:order-first">
            <div class="m-3 h-40">

                <livewire:modules.roles.components.infobox />
            </div>
            <div class="m-3">

                <livewire:modules.roles.components.table />
            </div>
        </div>
        <div class="order-first lg:order-last">
            <div class="m-3 h-40">
                @if ($isEdit)
                    <livewire:modules.roles.components.button-option />
                @endif
            </div>
            <div class="m-3">
                <div>
                    <livewire:modules.roles.components.form />
                </div>
                @if ($isEdit)
                    <div class="my-3">
                        <livewire:modules.roles.components.dual-list-box />
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
