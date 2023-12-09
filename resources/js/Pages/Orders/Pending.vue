<template>
    <Head title="Pembelian" />

    <OrderShow :isOpen="isOpen" @closeModal="closeModal" :order="order" />

    <div class="xl:px-36 py-10 flex flex-col xl:flex-row xl:gap-20">
        <Sidebar />

        <div class="flex-1 p-4 xl:p-0">
            <div class="hidden xl:block text-xl font-semibold mb-6">Menunggu Pembayaran</div>

            <div v-if="orders.length > 0" class="space-y-4">
                <div v-for="order in orders" class="border rounded-2xl w-full text-start">
                    <div @click="openModal(order)" class="cursor-pointer p-4 xl:p-6">
                        <div class="flex gap-4 mb-4 text-xs">
                            <div>{{ order.formatted_created_at }}</div>
                            <div>{{ order.code }}</div>
                        </div>
                        <div class="flex flex-col xl:flex-row gap-4">
                            <div class="flex-1 flex gap-3">
                                <div>
                                    <img :src="'/storage/products/' + order.order_details[0].code + '/' + order.order_details[0].photo"
                                        class="w-16 border border-gray-200 bg-white rounded-lg p-1">
                                </div>
                                <div class="flex-1">
                                    <div class="line-clamp-1 font-semibold text-sm mb-0.5">
                                        {{ order.order_details[0].name }}
                                    </div>
                                    <div class="flex gap-4 text-xs text-slate-600 mb-2">
                                        <div>
                                            {{ order.order_details[0].quantity }}x {{ order.order_details[0].color }}
                                            {{ order.order_details[0].size }}
                                        </div>
                                        <div>
                                            Rp {{ order.order_details[0].price.toLocaleString("id-ID") }}
                                        </div>
                                    </div>
                                    <div v-if="order.order_details.length > 1" class="text-xs">
                                        +{{ order.order_details.length - 1 }} produk lainnya
                                    </div>
                                </div>
                            </div>
                            <div class="xl:px-8 xl:border-s flex items-center">
                                <div>
                                    <div class="text-slate-600 text-xs xl:text-sm">Total Pembelian</div>
                                    <div class="font-semibold text-sm xl:text-base">Rp {{
                                        order.total_payment.toLocaleString("id-ID") }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex flex-col xl:flex-row justify-between gap-3 text-center items-center text-xs xl:text-sm font-semibold p-4 pt-0 xl:p-6 xl:pt-0">
                        <div class="bg-red-100 text-red-600 rounded px-4 py-2 w-full xl:w-auto">
                            Bayar sebelum {{ order.expiredDueTime }}
                        </div>
                        <a :href="order.redirect_url" target="_blank"
                            class="block rounded-full bg-lime-600 hover:bg-lime-700 text-white px-6 py-3 xl:py-2 w-full xl:w-auto">
                            Lanjut Bayar
                        </a>
                    </div>
                </div>
            </div>

            <div v-else class="text-center py-10 text-xl text-slate-600 font-semibold">
                Transaksi Tidak Ditemukan
            </div>
        </div>
    </div>
</template>

<script>
import UserLayout from '@/Layouts/UserLayout.vue';
import Sidebar from '@/Components/Sidebar/Account.vue';
import Status from '@/Components/Status.vue';
import OrderShow from '@/Pages/Orders/Show.vue'
import { EllipsisHorizontalIcon } from '@heroicons/vue/24/solid';

export default {
    data() {
        return {
            isOpen: false,
            order: null
        }
    },
    components: {
        Sidebar, Status, OrderShow, EllipsisHorizontalIcon
    },
    props: {
        orders: Object
    },
    methods: {
        openModal(order) {
            this.order = order
            this.isOpen = true
        },
        closeModal() {
            this.isOpen = false
        },
        cancelOrder(order) {
            this.$inertia.put(route('orders.cancel', order))
        }
    },
    layout: UserLayout
}
</script>

<style lang="scss" scoped></style>