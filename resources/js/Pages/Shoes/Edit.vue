<template>
    <Head title="Edit Produk" />

    <AuthenticatedLayout>
        <div class="py-10">
            <form @submit.prevent="form.put(route('shoes.update', shoe))">
                <h2 class="text-xl font-semibold mb-6">Edit Produk</h2>

                <div class="bg-white p-8 rounded-md mb-4">
                    <h3 class="font-semibold mb-6">Informasi Produk</h3>
                    <div class="text-sm flex items-center mb-6">
                        <div class="w-1/6 text-sm">Foto Produk</div>
                        <div class="w-5/6">
                            <form @submit.prevent="img.post(route('shoes.update-photo'))">
                                <div class="flex justify-between">
                                    <input @input="img.photos = $event.target.files" type="file" multiple="multiple"
                                        class="focus:outline-0 focus:ring-0 file:font-medium file:rounded-md file:border-solid file:border file:border-gray-300 file:bg-neutral-100 file:hover:bg-neutral-200 file:py-1 file:px-2 file:mr-2">
                                    <button type="submit"
                                        class="px-2 py-1 font-medium border border-gray-300 bg-neutral-100 hover:bg-gray-200 rounded-md">
                                        Ganti Foto
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="text-sm flex items-center mb-6">
                        <div class="w-1/6">Nama Produk</div>
                        <input v-model="form.name" type="text" class="w-5/6 text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="text-sm flex items-center mb-6">
                        <div class="w-1/6">Kategori Produk</div>
                        <select v-model="form.category" class="text-sm border-gray-300 rounded-md w-5/6">
                            <option disabled value="">Pilih kategori</option>
                            <option v-for="category in categories" :value="category.id" :key="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                    </div>
                    <div class="text-sm flex items-center mb-6">
                        <div class="w-1/6">Harga</div>
                        <input v-model="form.price" type="number" class="w-5/6 text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="text-sm flex items-center mb-6">
                        <div class="w-1/6">Harga Diskon</div>
                        <input v-model="form.discount_price" type="number" class="w-5/6 text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="text-sm flex items-start">
                        <div class="w-1/6">Deskripsi Produk</div>
                        <Editor v-model="form.description" class="w-5/6" />
                    </div>
                </div>

                <div class="bg-white p-6 rounded-md mb-6">
                    <h3 class="font-semibold mb-6">Informasi Penjualan</h3>
                    <div class="flex items-start mb-6">
                        <div class="w-1/6 text-sm">Warna</div>
                        <div class="w-5/6 grid grid-cols-7 gap-y-4">
                            <div v-for="color in colors" class="flex items-center">
                                <input v-model="form.colors" :value="color" :id="color.id" type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label :for="color.id" class="ml-2 text-sm">{{ color.name }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center mb-6">
                        <div class="w-1/6 text-sm">Ukuran</div>
                        <div class="w-5/6 grid grid-cols-7">
                            <div v-for="size in sizes" class="flex items-center">
                                <input v-model="form.sizes" :value="size" :id="size.id" type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label :for="size.id" class="ml-2 text-sm">{{ size.name }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-1/6 text-sm">Daftar variasi</div>
                        <div class="w-5/6">
                            <div class="border overflow-hidden rounded-lg text-sm">
                                <table class="table-fixed w-full">
                                    <thead class="font-semibold bg-gray-100">
                                        <tr class="divide-x">
                                            <td class="px-4 py-2">Warna</td>
                                            <td class="px-4 py-2">Ukuran</td>
                                            <td class="px-4 py-2">Harga</td>
                                            <td class="px-4 py-2">Harga Diskon</td>
                                            <td class="px-4 py-2">Stok</td>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y">
                                        <template v-for="color in form.colors">
                                            <tr v-for="size in form.sizes" :key="`${color}-${size}`" class="divide-x">
                                                <td class="px-4 py-2">{{ color.name }}</td>
                                                <td class="px-4 py-2">{{ size.name }}</td>
                                                <td class="px-4 py-2">
                                                    <input v-model="form.prices[color.id][size.id]" type="number"
                                                        class="border-gray-300 rounded-md text-sm w-full">
                                                </td>
                                                <td class="px-4 py-2">
                                                    <input v-model="form.discount_prices[color.id][size.id]" type="number"
                                                        class="border-gray-300 rounded-md text-sm w-full">
                                                </td>
                                                <td class="px-4 py-2">
                                                    <input v-model="form.stocks[color.id][size.id]" type="number"
                                                        class="border-gray-300 rounded-md text-sm w-full">
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-2 text-sm">
                    <Link :href="route('shoes.index')"
                        class="border border-gray-300 bg-white hover:bg-gray-50 font-medium py-2 px-10 rounded-md">
                    Batal
                    </Link>
                    <button type="submit"
                        class="border bg-lime-500 hover:bg-lime-600 text-white font-medium py-2 px-10 rounded-md">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from "@inertiajs/vue3"
import Editor from "@/Components/Editor.vue"

export default {
    components: {
        AuthenticatedLayout, Link, useForm, Editor, Head
    },
    props: {
        shoe: Object,
        categories: Object,
        colors: Object,
        sizes: Object,
        selectedColors: Object,
        selectedSizes: Object,
        variants: Object,
        prices: Object,
        discountPrices: Object,
        stocks: Object,
    },
    watch: {
        'form.sizes': 'initializeColorsPrices',
        'form.colors'(colors) {
            this.initializeColorsPrices()
            if (colors.length < 1) {
                this.form.sizes = []
            }
        }
    },
    methods: {
        initializeColorsPrices() {
            for (const color of this.form.colors) {
                if (!this.form.prices[color.id]) {
                    this.form.prices[color.id] = {};
                    this.form.discount_prices[color.id] = {};
                    this.form.stocks[color.id] = {};
                }

                for (const size of this.form.sizes) {
                    if (this.prices[color.id] && this.prices[color.id][size.id] !== undefined) {
                        this.form.prices[color.id][size.id] = this.prices[color.id][size.id];
                    } else {
                        this.form.prices[color.id][size.id] = 0;
                    }

                    if (this.discountPrices[color.id] && this.discountPrices[color.id][size.id] !== undefined) {
                        this.form.discount_prices[color.id][size.id] = this.discountPrices[color.id][size.id];
                    } else {
                        this.form.discount_prices[color.id][size.id] = 0;
                    }

                    if (this.stocks[color.id] && this.stocks[color.id][size.id] !== undefined) {
                        this.form.stocks[color.id][size.id] = this.stocks[color.id][size.id];
                    } else {
                        this.form.stocks[color.id][size.id] = 0;
                    }
                }
            }
        },
    },
    created() {
        this.initializeColorsPrices()
    },
    setup(props) {
        const form = useForm({
            category: props.shoe.category_id,
            name: props.shoe.name,
            price: props.shoe.price,
            discount_price: props.shoe.discount_price,
            description: props.shoe.description,
            colors: props.selectedColors.map(obj => ({
                id: obj.id,
                name: obj.name
            })),
            sizes: props.selectedSizes.map(obj => ({
                id: obj.id,
                name: obj.name
            })),
            prices: {},
            discount_prices: {},
            stocks: {}
        })

        const img = useForm({
            code: props.shoe.code,
            photos: ""
        })

        return { form, img }
    }
}
</script>

<style lang="scss" scoped></style>