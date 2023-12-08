<template>
    <Head title="Kategori Produk" />

    <Notif v-if="flash.error || flash.success" :flash="flash" />

    <CategoryCreate :isOpen="createIsOpen" @closeModal="closeCreateModal" />

    <div class="w-3/4 mx-auto pt-6 pb-12">
        <div class="flex items-center justify-between mb-6">
            <div class="text-xl font-semibold">Kategori Produk</div>
            <div>
                <button type="button" @click="openCreateModal"
                    class="flex gap-1 items-center ps-3 pe-4 py-2 rounded bg-lime-600 hover:bg-lime-700 text-sm font-medium text-white">
                    <PlusIcon class="w-5 h-5" /> Tambah Kategori
                </button>
            </div>
        </div>

        <div v-if="categories.data.length > 0" class="bg-white shadow rounded-md mb-4">
            <table class="w-full">
                <thead class="border-b">
                    <tr class="text-left text-xs font-semibold">
                        <td class="py-4 px-6">NAMA KATEGORI</td>
                        <td class="py-4 px-6 rounded-se-md"></td>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                    <tr v-for="category in categories.data">
                        <td class="py-4 px-6">
                            {{ category.name }}
                        </td>
                        <td class="py-4 px-6 flex justify-end">
                            <Dropdown :category="category" />
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="border-t flex items-center justify-end gap-3 px-6 py-4">
                <Pagination :links="categories.links" />
                <!-- <div>
                    <select class="border-gray-200 rounded text-gray-500 text-sm font-medium py-1">
                        <option value="">12 / halaman</option>
                        <option value="">24 / halaman</option>
                    </select>
                </div> -->
            </div>
        </div>

        <div v-else class="text-center py-16 text-2xl text-slate-500 font-semibold">
            Kategori tidak ditemukan
        </div>
    </div>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import Dropdown from '@/Components/Dropdown/Category.vue'
import Pagination from '@/Components/Pagination.vue'
import { PlusIcon } from '@heroicons/vue/20/solid'
import CategoryCreate from '@/Pages/Categories/Create.vue'

export default {
    data() {
        return {
            createIsOpen: false,
        }
    },
    props: {
        categories: Object,
        flash: Object
    },
    components: {
        Dropdown, Pagination, PlusIcon, CategoryCreate
    },
    methods: {
        openCreateModal() {
            this.createIsOpen = true
        },
        closeCreateModal() {
            this.createIsOpen = false
        },
    },
    layout: AdminLayout
}
</script>

<style lang="scss" scoped></style>