<div>
    <div class="  h-15 p-5 d-flex border-b items-center justify-center border-gray-300 flex-row ">
        <div class="flex justify-between">
            <div>
                <div wire:click="toggleSidebar"
                    class="{{ !$sidebarOpened ? 'flex' : 'hidden' }} sm:hidden font-bold text-xl text-gray-600 cursor-pointer w-8 h-8 justify-center items-center p-1 rounded-lg hover:bg-gray-200">
                    <i class="bi bi-list-nested"></i>
                </div>
            </div>

            <livewire:templates.topbar.components.profile-menu />
        </div>
    </div>
</div>
