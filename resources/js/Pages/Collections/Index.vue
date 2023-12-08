<template>
    <Head title="Koleksi Produk" />

    <Notif v-if="flash.error || flash.success" :flash="flash" />

    <div class="w-3/4 mx-auto pt-6 pb-12">
        <div class="flex items-center justify-between mb-6">
            <div class="text-xl font-semibold">Koleksi Produk</div>
            <div>
                <Link :href="route('collections.create')"
                    class="flex gap-1 items-center ps-3 pe-4 py-2 rounded bg-lime-600 hover:bg-lime-700 text-sm font-medium text-white">
                <PlusIcon class="w-5 h-5" /> Tambah Koleksi
                </Link>
            </div>
        </div>

        <div v-if="collections.data.length > 0" class="bg-white shadow rounded-md mb-4">
            <table class="w-full">
                <thead class="border-b">
                    <tr class="text-left text-xs font-semibold">
                        <td class="py-4 px-6">NAMA KOLEKSI</td>
                        <td class="py-4 px-6">JUMLAH PRODUK</td>
                        <td class="py-4 px-6"></td>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                    <tr v-for="collection in collections.data">
                        <td class="py-4 px-6">
                            {{ collection.name }}
                        </td>
                        <td class="py-4 px-6">
                            {{ collection.collection_products_count }}
                        </td>
                        <td class="py-4 px-6 flex justify-end">
                            <Dropdown :collection="collection" />
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="border-t flex items-center justify-end gap-3 px-6 py-4">
                <Pagination :links="collections.links" />
                <!-- <div>
                    <select class="border-gray-200 rounded text-gray-500 text-sm font-medium py-1">
                        <option value="">12 / halaman</option>
                        <option value="">24 / halaman</option>
                    </select>
                </div> -->
            </div>
        </div>

        <div v-else class="text-center py-16 text-2xl text-slate-500 font-semibold">
            Koleksi tidak ditemukan
        </div>
    </div>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import Dropdown from '@/Components/Dropdown/Collection.vue'
import Pagination from '@/Components/Pagination.vue'
import { PlusIcon } from '@heroicons/vue/20/solid'

export default {
    props: {
        collections: Object,
        flash: Object
    },
    components: {
        Dropdown, Pagination, PlusIcon
    },
    layout: AdminLayout
}
</script>

<style lang="scss" scoped></style>