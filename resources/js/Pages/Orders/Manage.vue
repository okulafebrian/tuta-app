<template>
    <Head title="Daftar Pesanan" />

    <div class="h-full px-10 pt-8 pb-16 bg-gray-100 overflow-y-auto">
        <div class="text-xl font-semibold mb-6">Daftar Pesanan</div>

        <div class="flex text-sm font-medium bg-white shadow-sm rounded-md overflow-hidden mb-6">
            <Link :href="route('orders.manage')" class="relative p-4"
                :class="$page.url === '/orders/manage' ? 'text-lime-600 after:bottom-0 after:left-0 after:border-b-[3px] after:absolute after:w-full after:border-lime-600' : 'text-gray-400'">
            Semua Pesanan
            </Link>

            <Link :href="route('orders.manage', { status: 'baru' })" class="relative p-4"
                :class="$page.url === '/orders/manage?status=baru' ? 'text-lime-600 after:bottom-0 after:left-0 after:border-b-[3px] after:absolute after:w-full after:border-lime-600' : 'text-gray-400'">
            Pesanan Baru
            </Link>

            <Link :href="route('orders.manage', { status: 'siap_dikirim' })" class="relative p-4"
                :class="$page.url === '/orders/manage?status=siap_dikirim' ? 'text-lime-600 after:bottom-0 after:left-0 after:border-b-[3px] after:absolute after:w-full after:border-lime-600' : 'text-gray-400'">
            Siap Dikirim
            </Link>

            <Link :href="route('orders.manage', { status: 'dalam_pengiriman' })" class="relative p-4"
                :class="$page.url === '/orders/manage?status=dalam_pengiriman' ? 'text-lime-600 after:bottom-0 after:left-0 after:border-b-[3px] after:absolute after:w-full after:border-lime-600' : 'text-gray-400'">
            Dalam Pengiriman
            </Link>

            <Link :href="route('orders.manage', { status: 'selesai' })" class="relative p-4"
                :class="$page.url === '/orders/manage?status=selesai' ? 'text-lime-600 after:bottom-0 after:left-0 after:border-b-[3px] after:absolute after:w-full after:border-lime-600' : 'text-gray-400'">
            Pesanan Selesai
            </Link>

            <Link :href="route('orders.manage', { status: 'dibatalkan' })" class="relative p-4"
                :class="$page.url === '/orders/manage?status=dibatalkan' ? 'text-lime-600 after:bottom-0 after:left-0 after:border-b-[3px] after:absolute after:w-full after:border-lime-600' : 'text-gray-400'">
            Dibatalkan
            </Link>
        </div>

        <div v-if="orders.length > 0" class="space-y-4">
            <div v-for="order in orders">
                <OrderCard :order="order" />
            </div>
        </div>

        <div v-else class="text-center py-16 text-2xl text-slate-500 font-semibold">
            Pesanan tidak ditemukan
        </div>
    </div>
</template>

<script>
import OrderCard from '@/Components/OrderCard.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue'

export default {
    components: {
        TabGroup, TabList, Tab, TabPanels, TabPanel,
        OrderCard
    },
    props: {
        orders: Object
    },
    layout: AdminLayout
}
</script>

<style lang="scss" scoped></style>