<template>
    <Head title="Daftar Alamat" />

    <Notif v-if="flash.error || flash.success" :flash="flash" />

    <CreateModal :isOpen="createModalOpen" @closeModal="closeCreateModal" :mainAddress="mainAddress" />
    <EditModal :isOpen="editModalOpen" @closeModal="closeEditModal" :address="address" />

    <div class="xl:px-36 py-10 flex flex-col xl:flex-row xl:gap-20">
        <Sidebar />

        <div class="flex-1 p-4 xl:p-0">
            <div class="flex items-center justify-between mb-6">
                <div class="hidden xl:flex text-xl font-semibold">Daftar Alamat</div>

                <button type="button" @click="openCreateModal"
                    class="flex-1 xl:flex-none text-lime-600 hover:text-lime-700 border border-lime-600 hover:border-lime-700 font-semibold text-sm px-6 py-2 rounded-full">
                    Tambah Alamat
                </button>
            </div>

            <div v-if="addresses.length > 0" class="space-y-4">
                <div v-for="address in addresses"
                    class="flex gap-4 flex-col xl:flex-row justify-between xl:items-center border rounded-2xl p-4 xl:p-6">
                    <div class="flex-1 space-y-1 text-sm">
                        <div class="flex items-center gap-2">
                            <div class="font-semibold">{{ address.name }}</div>
                            <div v-if="address.is_main"
                                class="bg-gray-200 text-gray-600 text-xs font-semibold px-2 rounded">
                                Utama
                            </div>
                        </div>
                        <div>{{ address.phone_number }}</div>
                        <div class="line-clamp-1">{{ address.detail }}</div>
                    </div>
                    <div class="flex gap-3">
                        <button type="button" @click="openEditModal(address)"
                            class="flex-1 border rounded-lg px-4 py-2 text-xs font-semibold">
                            Edit Alamat
                        </button>
                        <Dropdown v-if="!address.is_main" :address=address />
                    </div>
                </div>
            </div>
            <div v-else class="text-center py-16 text-2xl text-slate-500 font-semibold">
                Alamat tidak ditemukan
            </div>
        </div>
    </div>
</template>

<script>
import UserLayout from '@/Layouts/UserLayout.vue'
import CreateModal from '@/Pages/Addresses/Create.vue'
import EditModal from '@/Pages/Addresses/Edit.vue'
import Sidebar from '@/Components/Sidebar/Account.vue'
import Dropdown from '@/Components/Dropdown/Address.vue'

export default {
    data() {
        return {
            createModalOpen: false,
            editModalOpen: false,
            address: null,
        }
    },
    components: {
        Sidebar, CreateModal, EditModal, Dropdown
    },
    props: {
        addresses: Object,
        mainAddress: Object,
        flash: Object
    },
    methods: {
        openCreateModal() {
            this.createModalOpen = true
        },
        closeCreateModal() {
            this.createModalOpen = false
        },
        openEditModal(address) {
            this.address = address
            this.editModalOpen = true
        },
        closeEditModal() {
            this.editModalOpen = false
        },
        updateMain(address) {
            this.$inertia.put(route('addresses.update-main', address), {}, {
                preserveState: false,
                preserveScroll: true
            })
        },
        deleteAddress(address) {
            this.$inertia.delete(route('addresses.destroy', address), {}, {
                preserveState: false,
                preserveScroll: true
            })
        },
    },
    layout: UserLayout
}
</script>

<style lang="scss" scoped></style>