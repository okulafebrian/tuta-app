<template>
    <Head title="Pengaturan Produk" />

    <div class="h-full px-10 pt-8 pb-16 bg-gray-100 overflow-y-auto">
        <div class="flex items-center justify-between mb-6">
            <div class="text-xl font-semibold">Daftar Produk</div>
            <div class="flex gap-3">
                <Link v-if="shoes.data.length > 0" :href="route('shoes.manage-discount')"
                    class="px-4 py-2 rounded-sm border text-[13px] font-medium bg-white">
                Atur Diskon
                </Link>
                <Link :href="route('shoes.create')"
                    class="px-4 py-2 rounded-sm bg-lime-600 text-[13px] font-medium text-white">
                Tambah Produk
                </Link>
            </div>
        </div>

        <div class="flex justify-between mb-6">
            <div class="w-[40%]">
                <input v-model="search" @keyup.enter="filter" type="text"
                    class="border-0 text-sm shadow-sm rounded-md w-full" placeholder="Cari nama sepatu...">
            </div>
            <Pagination :links="shoes.links" />
        </div>

        <div v-if="shoes.data.length > 0" class="bg-white shadow-sm rounded-md mb-4">
            <table class="w-full">
                <thead class="border-b-2 border-gray-100">
                    <tr class="text-left text-xs font-semibold">
                        <td class="py-4 px-6 w-1/3">DETAIL PRODUK</td>
                        <td class="py-4 px-6">HARGA</td>
                        <td class="py-4 px-6">STOK</td>
                        <td class="py-4 px-6">AKTIF</td>
                        <td class="py-4 px-6 rounded-se-md"></td>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y">
                    <tr v-for="shoe in shoes.data">
                        <td class="py-4 px-6">
                            <div class="flex gap-4">
                                <div class="border p-1 rounded-md overflow-hidden">
                                    <img :src="'/storage/shoes/' + shoe.code + '/main/' + shoe.mainPhoto"
                                        class="max-w-none h-16">
                                </div>
                                <div>
                                    <div class="font-medium line-clamp-2">{{ shoe.name }}</div>
                                    <div>{{ shoe.category.name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div>
                                <span class="text-zinc-500 mr-2">Normal</span>
                                <span>{{ shoe.price ? shoe.formatted_price : '-' }}</span>
                            </div>
                            <div>
                                <span class="text-zinc-500 mr-2">Diskon</span>
                                <span>{{ shoe.discount_price ? shoe.formatted_discount_price : '-' }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-6">{{ shoe.total_stock }}</td>
                        <td class="py-4 px-6">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" :checked="shoe.is_active === 1">
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                </div>
                            </label>
                        </td>
                        <td class="py-4 px-6">
                            <Dropdown :shoe="shoe" />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div v-else class="text-center py-16 text-2xl text-slate-500 font-semibold">
            Produk tidak ditemukan
        </div>
    </div>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Dropdown from '@/Components/Dropdown/Manage.vue'
import PropertyDropdown from '@/Components/Dropdown/PropertyDropdown.vue';
import Pagination from '@/Components/Pagination.vue';

export default {
    data() {
        return {
            search: '',
        }
    },
    components: {
        Dropdown, PropertyDropdown, Pagination
    },
    methods: {
        filter() {
            if (this.search) {
                this.$inertia.get(route('shoes.index'), {
                    search: this.search,
                }, {
                    preserveState: true
                })
            } else {
                this.$inertia.get(route('shoes.index'))
            }
        }
    },
    props: {
        shoes: Object
    },
    layout: AdminLayout
}
</script>

<style lang="scss" scoped></style>