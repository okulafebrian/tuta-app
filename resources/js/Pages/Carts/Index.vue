<template>
    <Head title="Keranjang" />

    <div class="h-full px-4 xl:px-24 py-10">
        <div v-if="carts.length > 0">
            <div class="text-xl font-bold mb-6">Keranjang</div>

            <div class="flex flex-col xl:flex-row gap-8 xl:gap-10">
                <div class="flex-1 divide-y">
                    <div v-for="(cart, index) in carts" class="flex gap-6 py-6" :class="{ 'pt-0': index == 0 }">
                        <Link :href="route('shop.product', [cart.product.category, cart.product])">
                        <img :src="'/storage/products/' + cart.product.code + '/' + cart.photo"
                            class="w-24 border rounded-lg p-2">
                        </Link>
                        <div class="flex-1 flex flex-col xl:flex-row justify-between gap-3 xl:gap-6">
                            <div class="text-sm">
                                <Link :href="route('shop.product', [cart.product.category, cart.product])"
                                    class="font-semibold line-clamp-1">
                                {{ cart.product.name }}
                                </Link>
                                <div class="text-slate-600">{{ cart.color.name }}, {{ cart.size.name }}</div>
                                <div>
                                    <div v-if="cart.product.is_discount" class="flex gap-2">
                                        <div class="text-red-600 font-semibold">
                                            Rp{{ cart.product.discount_price.toLocaleString("id-ID") }}
                                        </div>
                                        <div class="text-slate-400 line-through">
                                            Rp{{ cart.product.price.toLocaleString("id-ID") }}
                                        </div>
                                    </div>
                                    <div v-else class="font-semibold">Rp{{ cart.product.price.toLocaleString("id-ID") }}
                                    </div>
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
                        <div class="font-semibold">Ringkasan Belanja</div>
                        <div class="flex justify-between text-sm text-slate-600 my-4">
                            <div>Total Harga</div>
                            <div>Rp{{ totalPrice.toLocaleString("id-ID") }}</div>
                        </div>
                        <div class="border-t py-4 mb-4 flex justify-between font-semibold">
                            <div>Total Belanja</div>
                            <div>Rp{{ totalPrice.toLocaleString("id-ID") }}</div>
                        </div>
                        <Link :href="route('checkout')"
                            class="block bg-lime-600 hover:bg-lime-700 py-3 w-full rounded-full font-semibold text-white text-center">
                        Beli
                        </Link>
                    </section>
                </div>
            </div>
        </div>

        <div v-else class="h-full flex items-center justify-center">
            <div class="text-center">
                <div class="flex justify-center mb-8">
                    <div class="bg-lime-100 rounded-full p-6">
                        <Cart class="h-16 w-16 xl:h-20 xl:w-20" />
                    </div>
                </div>

                <div class="mb-8">
                    <div class="text-xl xl:text-2xl font-bold mb-2">Keranjang Belanjamu Kosong</div>
                    <div class="text-sm xl:text-base">Yuk, cari sepatu wanita favoritmu di sini</div>
                </div>

                <Link :href="route('shop')"
                    class="text-white font-semibold bg-lime-600 hover:bg-lime-700 px-8 py-3 rounded-full">
                Belanja Sekarang
                </Link>
            </div>
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
        totalPrice: Number
    },
    components: {
        NumberInput, TrashIcon, Cart
    },
    layout: UserLayout
}

</script>

<style lang="scss" scoped></style>