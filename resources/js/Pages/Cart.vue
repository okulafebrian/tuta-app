<template>
    <GuestLayout>
        <div class="px-4 lg:px-20 py-24">
            <div class="flex gap-20">
                <div class="w-2/3">
                    <h2 class="text-xl font-semibold mb-2">Keranjang</h2>
                    <div v-if="shoes.length > 0" class="grid divide-y">
                        <div v-for="shoe in shoes" class="flex justify-between py-4">
                            <div>
                                <h5 class="font-medium">{{ shoe.name }}</h5>
                                <p>{{ shoe.category }}</p>
                                <p>{{ shoe.color }}</p>
                                <div class="flex gap-5">
                                    <div>Ukuran <span class="text-sm ml-1">{{ shoe.size }}</span></div>
                                    <div>Jumlah <span class="text-sm ml-1">{{ shoe.quantity }}</span></div>
                                </div>
                            </div>
                            <div class="flex flex-col justify-between items-end">
                                <div class="font-medium">
                                    Rp{{ formatNumber(shoe.discount_price ?? shoe.price) }}
                                </div>
                                <div>
                                    <button type="button" @click="remove(shoe.key)">
                                        <TrashIcon class="w-6 h-6" />
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else class="mt-4 text-zinc-500">
                        Keranjang anda masih kosong
                    </div>
                </div>
                <div class="w-1/3">
                    <h2 class="text-xl font-semibold mb-6">Ringkasan Belanja</h2>
                    <div class="flex justify-between">
                        <div>Subtotal</div>
                        <div>Rp{{ formatNumber(total) }}</div>
                    </div>
                    <hr class="my-2">
                    <div class="flex justify-between mb-8">
                        <div>Total</div>
                        <div>Rp{{ formatNumber(total) }}</div>
                    </div>
                    <button class="py-3 w-full font-medium text-white bg-lime-600 hover:bg-lime-700 rounded-full">
                        Beli
                    </button>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<script>
import GuestLayout from "@/Layouts/GuestLayout.vue"
import { TrashIcon } from '@heroicons/vue/24/outline'
import { router } from '@inertiajs/vue3'

export default {
    components: {
        GuestLayout, TrashIcon
    },
    props: {
        shoes: Object,
        total: Number
    },
    methods: {
        formatNumber(number) {
            return number.toLocaleString("id-ID")
        },
        remove(key) {
            router.delete(route('cart.remove', key))
        }
    }
}
</script>

<style lang="scss" scoped></style>