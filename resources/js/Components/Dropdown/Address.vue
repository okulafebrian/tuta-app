<template>
    <Menu as="div" class="relative inline-block text-left">
        <div>
            <MenuButton class="border rounded-lg p-1.5">
                <EllipsisHorizontalIcon class="w-5 h-5" />
            </MenuButton>
        </div>

        <transition enter-active-class="transition duration-100 ease-out" enter-from-class="transform scale-95 opacity-0"
            enter-to-class="transform scale-100 opacity-100" leave-active-class="transition duration-75 ease-in"
            leave-from-class="transform scale-100 opacity-100" leave-to-class="transform scale-95 opacity-0">
            <MenuItems
                class="absolute right-0 mt-2 w-44 origin-top-right z-50 rounded bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                <div class="p-1 divide-y">
                    <MenuItem v-slot="{ active }">
                    <button type="button" @click="updateMain" :class="[
                        active ? 'bg-gray-100' : '',
                        'font-semibold text-start w-full rounded-sm py-2 px-3 text-xs',
                    ]">
                        Jadikan Alamat Utama
                    </button>
                    </MenuItem>

                    <MenuItem v-slot="{ active }">
                    <button type="button" @click="destroy" :class="[
                        active ? 'bg-gray-100' : '',
                        'font-semibold text-start w-full rounded-sm py-2 px-3 text-xs',
                    ]">
                        Hapus Alamat
                    </button>
                    </MenuItem>
                </div>
            </MenuItems>
        </transition>
    </Menu>
</template>

<script>
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import { EllipsisHorizontalIcon } from '@heroicons/vue/24/solid';

export default {
    components: {
        Menu, MenuButton, MenuItems, MenuItem,
        EllipsisHorizontalIcon
    },
    props: {
        address: Object
    },
    methods: {
        updateMain() {
            this.$inertia.put(route('addresses.update-main', this.address))
        },
        destroy() {
            if (window.confirm('Apakah Anda yakin ingin menghapus alamat ini?')) {
                this.$inertia.delete(route('addresses.destroy', this.address))
            }
        }
    }
}

</script>
