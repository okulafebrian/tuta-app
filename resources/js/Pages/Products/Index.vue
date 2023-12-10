<template>
    <Head title="Daftar Produk" />

    <Notif v-if="flash.error || flash.success" :flash="flash" />

    <Sidebar />

    <div class="w-[85%] ms-auto px-10 pt-6 pb-12">
        <div class="text-xl font-semibold">Daftar Produk</div>

        <div class="flex justify-between items-center gap-3 my-6">
            <div class="w-1/3 flex items-center ps-3 rounded overflow-hidden shadow bg-white">
                <MagnifyingGlassIcon class="w-5 h-5 stroke-2 text-gray-400" />
                <input v-model="search" @keyup.enter="filter" type="text" class="border-0 focus:ring-0 text-sm w-full"
                    placeholder="Cari nama sepatu">
            </div>
            <div class="flex gap-3">
                <div>
                    <Link :href="route('collections.index')"
                        class="block px-4 py-2 rounded border text-sm font-medium bg-white">
                    <InboxStackIcon class="w-5 h-5" />
                    </Link>
                </div>
                <div>
                    <Link :href="route('products.manage-discount')"
                        class="block px-4 py-2 rounded border text-sm font-medium bg-white">
                    Atur Diskon
                    </Link>
                </div>
                <div>
                    <Link :href="route('products.create')"
                        class="flex gap-1 items-center ps-3 pe-4 py-2 rounded bg-lime-600 hover:bg-lime-700 text-sm font-medium text-white">
                    <PlusIcon class="w-5 h-5" /> Tambah Produk
                    </Link>
                </div>
            </div>
        </div>

        <div v-if="products.data.length > 0" class="bg-white shadow rounded-md mb-4">
            <table class="w-full">
                <thead class="border-b">
                    <tr class="text-left text-xs font-semibold">
                        <td class="py-4 px-6 w-1/2">DETAIL PRODUK</td>
                        <td class="py-4 px-6">HARGA</td>
                        <td class="py-4 px-6">STOK</td>
                        <td class="py-4 px-6">AKTIF</td>
                        <td class="py-4 px-6"></td>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                    <tr v-for="product in products.data">
                        <td class="py-4 px-6">
                            <div class="flex gap-4">
                                <img :src="product.main_photos[0].url" class="border rounded p-1 w-16 h-16">
                                <div>
                                    <div class="font-semibold line-clamp-2">{{ product.name }}</div>
                                    <div>{{ product.category.name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div>
                                <span class="text-zinc-500 mr-2">Normal</span>
                                <span>{{ product.price ? 'Rp' + product.price.toLocaleString("id-ID") : '-' }}</span>
                            </div>
                            <div>
                                <span class="text-zinc-500 mr-2">Diskon</span>
                                <span>
                                    {{ product.discount_price ? 'Rp' + product.discount_price.toLocaleString("id-ID") : '-'
                                    }}
                                </span>
                            </div>
                        </td>
                        <td class="py-4 px-6">{{ product.stock }}</td>
                        <td class="py-4 px-6">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" :checked="product.is_active === 1">
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                </div>
                            </label>
                        </td>
                        <td class="py-4 px-6">
                            <Dropdown :product="product" />
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="border-t flex items-center justify-end gap-3 px-6 py-4">
                <Pagination :links="products.meta.links" />
                <!-- <div>
                    <select class="border-gray-200 rounded text-gray-500 text-sm font-medium py-1">
                        <option value="">12 / halaman</option>
                        <option value="">24 / halaman</option>
                    </select>
                </div> -->
            </div>
        </div>

        <div v-else class="text-center py-16 text-2xl text-slate-500 font-semibold">
            Produk tidak ditemukan
        </div>
    </div>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Dropdown from '@/Components/Dropdown/Product.vue'
import Pagination from '@/Components/Pagination.vue';
import { PlusIcon } from '@heroicons/vue/20/solid';
import { MagnifyingGlassIcon, InboxStackIcon } from '@heroicons/vue/24/outline';
import Sidebar from '@/Components/Sidebar/Admin.vue'

export default {
    data() {
        return {
            search: '',
        }
    },
    components: {
        Sidebar,
        Dropdown,
        Pagination,
        PlusIcon,
        MagnifyingGlassIcon,
        InboxStackIcon
    },
    methods: {
        filter() {
            if (this.search) {
                this.$inertia.get(route('products.index'), {
                    search: this.search,
                }, {
                    preserveState: true
                })
            } else {
                this.$inertia.get(route('products.index'))
            }
        }
    },
    props: {
        products: Object,
        flash: Object
    },
    layout: AdminLayout
}
</script>

<style lang="scss" scoped></style>