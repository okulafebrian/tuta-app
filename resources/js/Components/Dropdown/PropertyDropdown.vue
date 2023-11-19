<template>
    <Menu as="div" class="relative inline-block text-left h-full">
        <div class="flex items-center h-full bg-white rounded-lg divide-x ring-1 ring-gray-200">
            <div class="px-4 text-sm font-semibold">Edit Properti Produk</div>
            <MenuButton class="hover:bg-gray-50 px-2 h-full rounded-r-lg">
                <ChevronDownIcon class="w-6 h-6 text-zinc-600" />
            </MenuButton>
        </div>

        <transition enter-active-class="transition duration-100 ease-out" enter-from-class="transform scale-95 opacity-0"
            enter-to-class="transform scale-100 opacity-100" leave-active-class="transition duration-75 ease-in"
            leave-from-class="transform scale-100 opacity-100" leave-to-class="transform scale-95 opacity-0">
            <MenuItems
                class="absolute right-0 mt-2 w-36 origin-top-right z-50 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                <div class="p-1">
                    <MenuItem v-slot="{ active }">
                    <Link :href="route('categories.index')" :class="[
                        active ? 'bg-gray-100' : '',
                        'block w-full items-center rounded-md py-2 px-3 text-sm',
                    ]">
                    Kategori
                    </Link>
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                    <Link :href="route('colors.index')" :class="[
                        active ? 'bg-gray-100' : '',
                        'block w-full items-center rounded-md py-2 px-3 text-sm',
                    ]">
                    Warna
                    </Link>
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                    <Link :href="route('sizes.index')" :class="[
                        active ? 'bg-gray-100' : '',
                        'block w-full items-center rounded-md py-2 px-3 text-sm',
                    ]">
                    Ukuran
                    </Link>
                    </MenuItem>
                </div>
            </MenuItems>
        </transition>
    </Menu>
</template>

<script>
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import { ChevronDownIcon } from '@heroicons/vue/20/solid'
import { PencilIcon, TrashIcon } from '@heroicons/vue/24/outline'

export default {
    components: {
        Menu, MenuButton, MenuItems, MenuItem,
        ChevronDownIcon, PencilIcon, TrashIcon
    },
}

</script>
