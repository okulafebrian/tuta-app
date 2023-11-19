<template>
    <Head title="Daftar Alamat" />

    <AddressCreate :isOpen="createIsOpen" @closeModal="closeCreateModal" :provinces="provinces" />
    <AddressEdit v-if="address" :isOpen="editIsOpen" @closeModal="closeEditModal" :address="address"
        :provinces="provinces" />

    <div class="xl:px-20 pt-6 xl:pt-10 flex flex-col xl:flex-row xl:gap-24">
        <Sidebar />

        <div class="flex-1 p-4 xl:p-0">
            <div class="hidden xl:flex text-2xl font-semibold mb-6">Daftar Alamat</div>

            <button type="button" @click="openCreateModal"
                class="text-lime-600 border border-lime-600 font-medium py-3 w-full rounded-full mb-6">
                Tambah Alamat
            </button>

            <div v-if="addresses.length > 0" class="space-y-4">
                <div v-for="address in addresses"
                    class="flex flex-col xl:flex-row justify-between xl:items-center border rounded-2xl p-4 xl:p-6">
                    <div class="flex-1 mb-2 xl:mb-0">
                        <div class="flex items-center gap-2">
                            <div class="font-medium">{{ address.name }}</div>
                            <div v-if="address.is_main"
                                class="bg-lime-600 text-white text-xs font-semibold px-2 py-0.5 rounded-md">
                                Utama
                            </div>
                        </div>
                        <div class="text-zinc-600 text-sm">{{ address.phone }}</div>
                        <div class="text-zinc-600 line-clamp-1 text-sm">{{ address.detail }}</div>
                    </div>
                    <div class="flex gap-6">
                        <button v-if="!address.is_main" type="button" @click="setMain(address)"
                            class="text-sm font-semibold text-lime-600 hover:text-lime-700">
                            Atur sebagai utama
                        </button>
                        <button type="button" @click="openEditModal(address)"
                            class="text-sm font-semibold text-lime-600 hover:text-lime-700">
                            Edit
                        </button>
                        <button v-if="!address.is_main" type="button" @click="deleteAddress(address)"
                            class="text-sm font-semibold text-lime-600 hover:text-lime-700">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import UserLayout from '@/Layouts/UserLayout.vue';
import AddressCreate from '@/Pages/Addresses/Create.vue'
import AddressEdit from '@/Pages/Addresses/Edit.vue'
import Sidebar from '@/Components/Sidebar/Account.vue';

export default {
    data() {
        return {
            createIsOpen: false,
            editIsOpen: false,
            address: '',
        }
    },
    components: {
        Sidebar, AddressCreate, AddressEdit
    },
    props: {
        provinces: Object,
        addresses: Object,
    },
    methods: {
        openCreateModal() {
            this.createIsOpen = true
        },
        closeCreateModal() {
            this.createIsOpen = false
        },
        openEditModal(address) {
            this.address = address
            this.editIsOpen = true
        },
        closeEditModal() {
            this.editIsOpen = false
        },
        setMain(address) {
            this.$inertia.put(route('addresses.set-main', address), {}, {
                preserveScroll: true
            })
        },
        deleteAddress(address) {
            this.$inertia.delete(route('addresses.destroy', address), {}, {
                preserveScroll: true
            })
        },
    },
    layout: UserLayout
}
</script>

<style lang="scss" scoped></style>