<template>
    <Head title="Atur Diskon" />

    <Notif v-if="flash.error || flash.success" :flash="flash" />

    <div class="w-3/4 mx-auto pt-6 pb-12">
        <div class="text-xl font-semibold mb-6">Atur Diskon</div>

        <div class="bg-white shadow-sm rounded-sm mb-6">
            <table class="w-full">
                <thead class="border-b-2 border-gray-100">
                    <tr class="text-left text-xs font-semibold">
                        <td class="py-4 px-6">DETAIL PRODUK</td>
                        <td class="py-4 px-6">HARGA</td>
                        <td class="py-4 px-6">HARGA DISKON</td>
                        <td class="py-4 px-6">DISKON</td>
                        <td class="py-4 px-6">AKTIF</td>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y">
                    <tr v-for="(product, i) in products">
                        <td class="py-4 px-6">
                            <div class="flex gap-4">
                                <img :src="product.main_photos[0].url" class="border rounded p-1 w-16 h-16">
                                <div>
                                    <div class="font-medium line-clamp-2">{{ product.name }}</div>
                                    <div>{{ product.category.name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">Rp{{ product.price.toLocaleString("id-ID") }}</td>
                        <td class="py-4 px-6">
                            <div v-if="form.discount[i] > 0">Rp{{ form.discount_price[i].toLocaleString("id-ID") }}</div>
                            <div v-else>-</div>
                        </td>
                        <td class="py-4 px-6">
                            <div
                                class="flex items-center border border-gray-200 bg-gray-100 rounded-md overflow-hidden w-28">
                                <div class="text-sm text-gray-500 font-semibold px-3">%</div>
                                <input type="number" class="text-sm border-0 focus:ring-0 w-full" v-model="form.discount[i]"
                                    @change="discountPrice(product.price, i)">
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" v-model="form.is_discount[i]"
                                    :disabled="!form.discount[i]">
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600 peer-disabled:cursor-not-allowed">
                                </div>
                            </label>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="flex justify-end gap-3 text-sm font-medium">
            <div>
                <Link :href="route('products.index')" class="block border bg-white py-2 px-10 rounded">
                Batal
                </Link>
            </div>
            <div>
                <button type="button" @click="updateDiscount"
                    class="bg-lime-600 hover:bg-lime-700 text-white py-2 px-10 rounded">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { useForm } from '@inertiajs/vue3';

export default {
    props: {
        products: Object,
        flash: Object
    },
    methods: {
        discountPrice(price, i) {
            this.form.discount_price[i] = price - (price * (this.form.discount[i] / 100))
        },
        updateDiscount() {
            this.form.put(route('products.update-discount'))
        }
    },
    setup(props) {
        const form = useForm({
            product_id: [],
            discount_price: [],
            discount: [],
            is_discount: []
        })

        props.products.forEach((product, i) => {
            form.product_id[i] = product.id
            form.discount_price[i] = product.discount_price ?? product.price
            form.discount[i] = product.discount ?? 0
            form.is_discount[i] = product.is_discount ? true : false
        });

        return { form }
    },
    layout: AdminLayout
}
</script>

<style lang="scss" scoped></style>