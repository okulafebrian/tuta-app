<template>
    <Head title="Pembelian" />

    <OrderShow :isOpen="isOpen" @closeModal="closeModal" :order="order" />

    <div class="xl:px-36 py-10 flex flex-col xl:flex-row xl:gap-20">
        <Sidebar />

        <div class="flex-1 p-4 xl:p-0">
            <div class="hidden xl:block text-xl font-semibold mb-6">Pembelian</div>

            <div class="flex items-center gap-2 overflow-x-auto text-sm mb-6">
                <Link :href="route('orders.index')"
                    class="block px-4 py-2 border rounded-full text-gray-600 whitespace-nowrap"
                    :class="{ 'bg-lime-100 border-lime-600 text-lime-600': $page.url === '/orders' }">
                Semua
                </Link>
                <Link :href="route('orders.index', { status: 'dikemas' })"
                    class="block px-4 py-2 border rounded-full text-gray-600 whitespace-nowrap"
                    :class="{ 'bg-lime-100 border-lime-600 text-lime-600': $page.url === '/orders?status=diproses' }">
                Dikemas
                </Link>
                <Link :href="route('orders.index', { status: 'dikirim' })"
                    class="block px-4 py-2 border rounded-full text-gray-600 whitespace-nowrap"
                    :class="{ 'bg-lime-100 border-lime-600 text-lime-600': $page.url === '/orders?status=dikirim' }">
                Dikirim
                </Link>
                <Link :href="route('orders.index', { status: 'selesai' })"
                    class="block px-4 py-2 border rounded-full text-gray-600 whitespace-nowrap"
                    :class="{ 'bg-lime-100 border-lime-600 text-lime-600': $page.url === '/orders?status=selesai' }">
                Selesai
                </Link>
                <Link :href="route('orders.index', { status: 'dibatalkan' })"
                    class="block px-4 py-2 border rounded-full text-gray-600 whitespace-nowrap"
                    :class="{ 'bg-lime-100 border-lime-600 text-lime-600': $page.url === '/orders?status=dibatalkan' }">
                Dibatalkan
                </Link>
            </div>

            <div v-if="orders.length > 0" class="space-y-4">
                <button type="button" v-for="order in orders" class="border rounded-2xl p-4 xl:p-6 text-start w-full"
                    @click="openModal(order)">
                    <div class="text-xs flex gap-2 mb-4">
                        <div>{{ order.formatted_created_at }}</div>
                        <Status :status="order.status" />
                        <div>{{ order.code }}</div>
                    </div>
                    <div class="flex flex-col xl:flex-row gap-4">
                        <div class="flex-1 flex gap-3">
                            <div>
                                <img :src="'/storage/products/' + order.order_details[0].code + '/' + order.order_details[0].photo"
                                    class="w-16 border border-gray-200 bg-white rounded-lg p-1">
                            </div>
                            <div class="flex-1">
                                <div class="line-clamp-1 text-sm font-semibold mb-0.5">{{ order.order_details[0].name }}
                                </div>
                                <div class="flex gap-4 text-slate-600 text-xs mb-2">
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
                        <div class="xl:px-8 xl:border-s">
                            <div class="text-zinc-600 text-xs xl:text-sm">Total Pembelian</div>
                            <div class="font-semibold text-sm xl:text-base">
                                Rp{{ order.total_payment.toLocaleString("id-ID") }}
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
            order: null
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