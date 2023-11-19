<template>
    <Head title="Keranjang" />

    <div class="px-4 xl:px-16 pt-6 xl:pt-10">
        <div v-if="carts.length > 0">
            <div class="text-xl xl:text-2xl font-semibold mb-6">Keranjang</div>

            <div class="flex flex-col xl:flex-row gap-8 xl:gap-10">
                <div class="flex-1 space-y-5">
                    <div v-for="(cart, i) in carts" class="flex gap-6 h-fit" :class="{ 'border-t pt-5': i > 0 }">
                        <div>
                            <img :src="'/storage/shoes/' + cart.code + '/' + cart.variantPhoto"
                                class="w-28 border rounded-lg p-2">
                        </div>
                        <div class="flex-1 flex flex-col xl:flex-row justify-between gap-3 xl:gap-6">
                            <div class="space-y-1 text-sm">
                                <Link :href="route('shop.shoe', [cart.category_slug, cart.shoe_slug])"
                                    class="font-medium line-clamp-1">
                                {{ cart.name }}
                                </Link>
                                <div class="text-slate-600">{{ cart.color }}, {{ cart.size }}</div>
                                <div>
                                    <div v-if="cart.is_discount" class="flex gap-2">
                                        <span>Rp{{ cart.discount_price.toLocaleString("id-ID") }}</span>
                                        <div class="flex gap-1">
                                            <div
                                                class="font-semibold bg-rose-100 text-rose-600 rounded-md px-2 py-0.5 text-xs">
                                                {{ cart.discount }}%
                                            </div>
                                            <span class="text-slate-400 line-through">
                                                Rp{{ cart.price.toLocaleString("id-ID") }}
                                            </span>
                                        </div>
                                    </div>
                                    <div v-else>Rp{{ cart.price.toLocaleString("id-ID") }}</div>
                                </div>
                            </div>
                            <div class="flex items-end h-full">
                                <NumberInput v-model="cart.quantity" :id="cart.id" :max="cart.stock" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="xl:w-1/3">
                    <section class="border rounded-xl p-6">
                        <div class="text-lg font-semibold">Ringkasan Belanja</div>
                        <div class="space-y-2 text-slate-600 my-4">
                            <div class="flex justify-between">
                                <div>Total Harga</div>
                                <div>Rp {{ totalPrice.toLocaleString("id-ID") }}</div>
                            </div>
                        </div>
                        <div class="border-t py-4 mb-4 flex justify-between text-lg font-semibold">
                            <div>Total Belanja</div>
                            <div>Rp {{ totalPrice.toLocaleString("id-ID") }}</div>
                        </div>
                        <Link :href="route('checkout')"
                            class="block bg-lime-600 hover:bg-lime-700 py-3 w-full rounded-full font-medium text-white text-center xl:text-lg">
                        Beli
                        </Link>
                    </section>
                </div>
            </div>
        </div>

        <div v-else class="text-center py-10">
            <div class="flex justify-center mb-6">
                <div class="bg-lime-100 rounded-full p-6">
                    <Cart class="h-24 w-24" />
                </div>
            </div>

            <div class=" mb-8">
                <div class="text-2xl font-semibold mb-2">Keranjang Belanjamu Kosong</div>
                <div class="text-slate-500">Yuk, cari sepatu wanita favoritmu di sini</div>
            </div>

            <Link :href="route('shop')"
                class="text-white font-medium bg-lime-600 hover:bg-lime-700 px-10 py-3 text-lg rounded-full">
            Belanja Sekarang
            </Link>
        </div>
    </div>
</template>

<script>
import UserLayout from '@/Layouts/UserLayout.vue'
import NumberInput from '@/Components/NumberInput/Custom.vue';
import { TrashIcon } from '@heroicons/vue/24/outline';
import Cart from '@/Components/Icon/Cart.vue'

export default {
    data() {
        return {
            createIsOpen: true
        }
    },
    props: {
        carts: Object,
        totalPrice: Number,
        provinces: Object,
    },
    components: {
        NumberInput, TrashIcon, Cart
    },
    layout: UserLayout
}

</script>

<style lang="scss" scoped></style>