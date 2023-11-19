<template>
    <Head title="Pembelian" />

    <OrderShow v-if="order" :isOpen="isOpen" @closeModal="closeModal" :order="order" />

    <div class="xl:px-20 pt-6 xl:pt-10 flex flex-col xl:flex-row xl:gap-24">
        <Sidebar />

        <div class="flex-1 p-4 xl:p-0">
            <div class="hidden xl:block text-2xl font-semibold mb-6">Pembelian</div>

            <div class="flex items-center gap-4 text-sm mb-6">
                <div class="hidden xl:block font-semibold">Status</div>
                <div class="flex gap-2 overflow-x-auto">
                    <Link :href="route('orders.index')"
                        class="block px-4 py-2.5 border rounded-full text-gray-600 whitespace-nowrap"
                        :class="{ 'bg-lime-100 border-lime-500 text-lime-700': $page.url === '/orders' }">
                    Semua
                    </Link>
                    <Link :href="route('orders.index', { status: 'menunggu_konfirmasi' })"
                        class="block px-4 py-2.5 border rounded-full text-gray-600 whitespace-nowrap"
                        :class="{ 'bg-lime-100 border-lime-500 text-lime-700': $page.url === '/orders?status=menunggu_konfirmasi' }">
                    Menunggu Konfirmasi
                    </Link>
                    <Link :href="route('orders.index', { status: 'diproses' })"
                        class="block px-4 py-2.5 border rounded-full text-gray-600 whitespace-nowrap"
                        :class="{ 'bg-lime-100 border-lime-500 text-lime-700': $page.url === '/orders?status=diproses' }">
                    Diproses
                    </Link>
                    <Link :href="route('orders.index', { status: 'dikirim' })"
                        class="block px-4 py-2.5 border rounded-full text-gray-600 whitespace-nowrap"
                        :class="{ 'bg-lime-100 border-lime-500 text-lime-700': $page.url === '/orders?status=dikirim' }">
                    Dikirim
                    </Link>
                    <Link :href="route('orders.index', { status: 'selesai' })"
                        class="block px-4 py-2.5 border rounded-full text-gray-600 whitespace-nowrap"
                        :class="{ 'bg-lime-100 border-lime-500 text-lime-700': $page.url === '/orders?status=selesai' }">
                    Selesai
                    </Link>
                    <Link :href="route('orders.index', { status: 'dibatalkan' })"
                        class="block px-4 py-2.5 border rounded-full text-gray-600 whitespace-nowrap"
                        :class="{ 'bg-lime-100 border-lime-500 text-lime-700': $page.url === '/orders?status=dibatalkan' }">
                    Dibatalkan
                    </Link>
                </div>
            </div>

            <div v-if="orders.length > 0" class="space-y-4">
                <button type="button" v-for="order in orders" class="border rounded-2xl p-4 xl:p-6 text-start w-full"
                    @click="openModal(order)">
                    <div class="flex gap-2 mb-4">
                        <div class="text-sm">{{ order.formatted_created_at }}</div>
                        <Status :status="order.status" />
                    </div>
                    <div class="flex flex-col xl:flex-row gap-4">
                        <div class="flex-1 flex gap-3">
                            <div>
                                <img :src="'/storage/shoes/' + order.order_details[0].code + '/' + order.order_details[0].photo"
                                    class="w-16 border border-gray-200 bg-white rounded-lg p-1">
                            </div>
                            <div class="flex-1">
                                <div class="line-clamp-1 text-sm font-medium mb-1">{{ order.order_details[0].name }}</div>
                                <div class="flex gap-4 text-zinc-500 text-xs mb-2">
                                    <div>
                                        {{ order.order_details[0].quantity }}x {{ order.order_details[0].color }},
                                        {{ order.order_details[0].size }}
                                    </div>
                                    <div>
                                        Rp{{ order.order_details[0].price.toLocaleString("id-ID") }}
                                    </div>
                                </div>
                                <div v-if="order.order_details.length > 1" class="text-xs">
                                    +{{ order.order_details.length - 1 }} produk lainnya
                                </div>
                            </div>
                        </div>
                        <div class="xl:px-8 xl:border-s flex items-center">
                            <div>
                                <div class="text-zinc-600 text-sm">Total Pembelian</div>
                                <div class="font-semibold">Rp{{ order.total_payment.toLocaleString("id-ID") }}</div>
                            </div>
                        </div>
                    </div>
                </button>
            </div>

            <div v-else class="text-center py-10 text-xl text-zinc-600 font-semibold">
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

export default {
    data() {
        return {
            isOpen: false,
            order: ''
        }
    },
    components: {
        Sidebar, Status, OrderShow
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
    },
    layout: UserLayout
}
</script>

<style lang="scss" scoped></style>