<template>
    <Head title="Pengaturan Diskon" />

    <div class="h-full px-10 pt-8 pb-16 bg-gray-100 overflow-y-auto">
        <div class="text-xl font-semibold mb-6">Atur Diskon</div>

        <div class="bg-white shadow-sm rounded-sm mb-4">
            <table class="w-full">
                <thead class="border-b-2 border-gray-100">
                    <tr class="text-left text-xs font-semibold">
                        <td class="py-4 px-8">DETAIL PRODUK</td>
                        <td class="py-4 px-8">HARGA</td>
                        <td class="py-4 px-8">HARGA DISKON</td>
                        <td class="py-4 px-8">DISKON</td>
                        <td class="py-4 px-8">AKTIF</td>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y">
                    <tr v-for="(shoe, i) in shoes">
                        <td class="py-4 px-8">
                            <div class="flex gap-4">
                                <div class="border border-gray-200 p-1 rounded-md overflow-hidden">
                                    <img :src="'/storage/shoes/' + shoe.code + '/' + shoe.photo + '/' + shoe.mainPhoto"
                                        class="w-16 h-16">
                                </div>
                                <div>
                                    <div class="font-medium line-clamp-2">{{ shoe.name }}</div>
                                    <div>{{ shoe.category.name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-8">{{ shoe.formatted_price }}</td>
                        <td class="py-4 px-8">Rp {{ discount_price[i] }}</td>
                        <td class="py-4 px-8">
                            <div
                                class="flex items-center border border-gray-200 bg-gray-100 rounded-md overflow-hidden w-28">
                                <div class="text-sm text-gray-500 font-semibold px-3">%</div>
                                <input type="number" class="text-sm border-0 focus:ring-0 w-full" v-model="form.discount[i]"
                                    @change="discountPrice(shoe.price, i)">
                            </div>
                        </td>
                        <td class="py-4 px-8">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" v-model="form.is_discount[i]"
                                    :disabled="form.discount[i] < 1" :checked="form.is_discount[i]">
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600 peer-disabled:cursor-not-allowed">
                                </div>
                            </label>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="flex justify-end gap-3 py-2 text-sm font-medium">
            <Link :href="route('shoes.index')" class="border bg-white py-2 px-10 rounded-sm">
            Batal
            </Link>
            <button type="button" @click="updateDiscount"
                class="bg-lime-600 disabled:bg-lime-500/50 text-white py-2 px-10 rounded-sm">
                Simpan
            </button>
        </div>
    </div>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { useForm } from '@inertiajs/vue3';

export default {
    data() {
        return {
            discount_price: []
        }
    },
    props: {
        shoes: Object
    },
    methods: {
        discountPrice(price, i) {
            const discount_price = price - (price * (this.form.discount[i] / 100))
            this.form.discount_price[i] = discount_price
            this.discount_price[i] = discount_price.toLocaleString("id-ID")
        },
        updateDiscount() {
            this.form.put(route('shoes.update-discount'))
        }
    },
    mounted() {
        this.shoes.forEach((element, i) => {
            this.form.shoe_id[i] = element.id
            this.form.discount_price[i] = element.discount_price ?? 0
            this.discount_price[i] = element.discount_price ? element.discount_price.toLocaleString("id-ID") : 0
            this.form.discount[i] = element.discount ?? 0
            this.form.is_discount[i] = element.is_discount
        });
    },
    setup() {
        const form = useForm({
            shoe_id: [],
            discount_price: [],
            discount: [],
            is_discount: []
        })

        return { form }
    },
    layout: AdminLayout
}
</script>

<style lang="scss" scoped></style>