<template>
    <Menu as="div" class="relative inline-block text-left">
        <div>
            <MenuButton class="bg-white hover:bg-gray-50 border rounded-sm flex gap-2 px-2 py-1">
                <div class="font-medium text-sm">Atur</div>
                <ChevronDownIcon class="w-5 h-5 text-zinc-600" />
            </MenuButton>
        </div>

        <transition enter-active-class="transition duration-100 ease-out" enter-from-class="transform scale-95 opacity-0"
            enter-to-class="transform scale-100 opacity-100" leave-active-class="transition duration-75 ease-in"
            leave-from-class="transform scale-100 opacity-100" leave-to-class="transform scale-95 opacity-0">
            <MenuItems
                class="absolute right-0 mt-2 w-36 origin-top-right z-50 rounded-sm bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                <div class="p-1">
                    <MenuItem v-slot="{ active }">
                    <Link :href="route('shoes.edit', shoe)" :class="[
                        active ? 'bg-gray-100' : '',
                        'flex gap-3 w-full items-center rounded-sm py-2 px-3 text-sm',
                    ]">
                    <PencilIcon class="w-4 h-4" />
                    Edit
                    </Link>
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                    <button type="button" @click="destroy" :class="[
                        active ? 'bg-gray-100' : '',
                        'flex gap-3 w-full items-center rounded-sm py-2 px-3 text-sm',
                    ]">
                        <TrashIcon class="w-4 h-4" />
                        Hapus
                    </button>
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
    props: {
        shoe: Object
    },
    components: {
        Menu, MenuButton, MenuItems, MenuItem,
        ChevronDownIcon, PencilIcon, TrashIcon
    },
    methods: {
        destroy() {
            this.$inertia.delete(route('shoes.destroy', this.shoe))
        }
    }
}

</script>
