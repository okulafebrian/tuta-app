<template>
    <Head title="Edit Koleksi" />

    <ProductList v-if="isOpen" :isOpen="isOpen" @closeModal="closeModal" :products="products" :selected="form.products" />

    <div class="w-3/4 mx-auto pt-6 pb-12">
        <div class="flex items-center justify-between mb-6">
            <div class="text-xl font-semibold">Edit Koleksi</div>
            <div>
                <button type="button" @click="addCollection" :disabled="isDisabled"
                    class="px-8 py-2 rounded bg-lime-600 hover:bg-lime-700 disabled:bg-slate-300 disabled:text-slate-500 text-sm font-semibold text-white">
                    Selesai
                </button>
            </div>
        </div>

        <div class="bg-white p-8 rounded-md shadow mb-4">
            <div class="text-sm font-medium mb-2">Nama Koleksi</div>
            <input v-model="form.name" type="text" class="border-gray-300 rounded-lg w-full text-sm"
                placeholder="Tulis nama koleksi disini">
        </div>

        <div v-if="form.products.length > 0" class="bg-white p-8 rounded-md shadow">
            <div class="flex justify-between items-center mb-4">
                <div class="text-lg font-semibold">Produk Terpilih</div>
                <div>
                    <button type="button" @click="openModal"
                        class="border border-lime-600 rounded-md px-4 py-2 font-semibold text-sm text-lime-600">
                        Tambah Produk
                    </button>
                </div>
            </div>
            <div>
                <table class="w-full">
                    <thead class="border-y">
                        <tr class="text-left text-xs font-semibold">
                            <td class="py-4 px-6">NAMA PRODUK</td>
                            <td class="py-4 px-6">HARGA</td>
                            <td class="py-4 px-6">PENJUALAN</td>
                            <td class="py-4 ps-6"></td>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        <tr v-for="(product, index) in form.products">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <img :src="'/storage/products/' + product.code + '/main/' + product.mainPhoto"
                                        class="border rounded p-1 w-16 h-16">
                                    <div>
                                        <div class="font-semibold line-clamp-2">{{ product.name }}</div>
                                        <div class="text-xs">{{ product.category.name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                Rp{{ product.price.toLocaleString("id-ID") }}
                            </td>
                            <td class="py-4 px-6">
                                2
                            </td>
                            <td class="py-4 px-6">
                                <button type="button" @click="removeProduct(index)"
                                    class="flex items-center gap-1 font-semibold text-xs hover:text-lime-600 p-2 ms-auto">
                                    <TrashIcon class="w-4 h-4 stroke-2 text-gray-500" /> Hapus
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div v-else class="bg-white py-12 rounded-md shadow text-center">
            <div class="mb-6">
                <div class="text-lg font-semibold">Isi dulu koleksinya</div>
                <div class="text-sm">Pilih produk yang sesuai dengan nama koleksi</div>
            </div>
            <button type="button" @click="openModal"
                class="bg-lime-600 hover:bg-lime-700 text-white font-semibold px-10 py-2 rounded">
                Tambah Produk
            </button>
        </div>
    </div>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { useForm } from '@inertiajs/vue3';
import ProductList from '@/Pages/Collections/ProductList.vue'
import { TrashIcon } from '@heroicons/vue/24/outline';

export default {
    data() {
        return {
            isOpen: false,
            isDisabled: !this.form.products ?? true
        }
    },
    props: {
        collection: Object,
        products: Object
    },
    components: {
        ProductList, TrashIcon
    },
    watch: {
        'form.products'() {
            this.isDisabled = this.form.products.length > 0 ? false : true
        }
    },
    methods: {
        openModal() {
            this.isOpen = true
        },
        closeModal(selectedProducts) {
            this.isOpen = false

            if (selectedProducts) {
                this.form.products = selectedProducts
            }
        },
        addCollection() {
            this.form.post(route('collections.store'))
        },
        removeProduct(index) {
            this.form.products.splice(index, 1)

            this.isDisabled = this.form.products.length > 0 ? false : true
        }
    },
    setup(props) {
        const form = useForm({
            name: props.collection.name,
            products: props.collection.products
        })

        return { form }
    },
    layout: AdminLayout
}
</script>

<style lang="scss" scoped></style>