<aside
    class="flex-shrink-0 hidden w-64 bg-white border-r dark:border-primary-darker dark:bg-darker md:block">
    <div class="flex flex-col h-full">
        <!-- Sidebar links -->
        <nav aria-label="Main" class="flex-1 px-2 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto">
            <!-- Dashboards links -->
            <div x-data="{ isActive: true, open: true}">
                <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->
                <a href="{{ route('anak') }}"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary mb-3"
                    :class="{'bg-primary-100 dark:bg-primary': isActive || open}"
                    aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                    <span class="flex" aria-hidden="true">
                        <ion-icon name="happy-outline"></ion-icon>
                    </span>
                    <span class="ml-2 text-sm">Anak</span>
                </a>
                <a href="{{ route('orangTua') }}"
                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary mb-3"
                    aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                    <span class="flex" aria-hidden="true">
                        <ion-icon name="people-outline"></ion-icon>
                    </span>
                    <span class="ml-2 text-sm">Orang tua</span>
                </a>
            </div>
        </nav>
    </div>
</aside>