<template>
    <Head title="Daftar Pesanan" />

    <Notif v-if="flash.error || flash.success" :flash="flash" />

    <Sidebar />

    <div class="w-[85%] ms-auto px-10 pt-6 pb-12">
        <div class="text-xl font-semibold mb-6">Daftar Pesanan</div>

        <div class="flex text-sm font-medium bg-white shadow rounded overflow-hidden px-4 mb-6">
            <Link :href="route('orders.manage')" class="relative p-4"
                :class="$page.url === '/orders/manage' ? 'text-lime-600 after:bottom-0 after:left-0 after:border-b-[3px] after:absolute after:w-full after:border-lime-600' : 'text-gray-500'">
            Semua
            </Link>

            <Link :href="route('orders.manage', { status: 'perlu_dikirim' })" class="relative p-4"
                :class="$page.url === '/orders/manage?status=perlu_dikirim' ? 'text-lime-600 after:bottom-0 after:left-0 after:border-b-[3px] after:absolute after:w-full after:border-lime-600' : 'text-gray-500'">
            Perlu Dikirim
            </Link>

            <Link :href="route('orders.manage', { status: 'dikirim' })" class="relative p-4"
                :class="$page.url === '/orders/manage?status=dikirim' ? 'text-lime-600 after:bottom-0 after:left-0 after:border-b-[3px] after:absolute after:w-full after:border-lime-600' : 'text-gray-500'">
            Dikirim
            </Link>

            <Link :href="route('orders.manage', { status: 'selesai' })" class="relative p-4"
                :class="$page.url === '/orders/manage?status=selesai' ? 'text-lime-600 after:bottom-0 after:left-0 after:border-b-[3px] after:absolute after:w-full after:border-lime-600' : 'text-gray-500'">
            Selesai
            </Link>

            <Link :href="route('orders.manage', { status: 'pembatalan' })" class="relative p-4"
                :class="$page.url === '/orders/manage?status=pembatalan' ? 'text-lime-600 after:bottom-0 after:left-0 after:border-b-[3px] after:absolute after:w-full after:border-lime-600' : 'text-gray-500'">
            Pembatalan
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
import Sidebar from '@/Components/Sidebar/Admin.vue'

export default {
    components: {
        TabGroup, TabList, Tab, TabPanels, TabPanel,
        OrderCard,
        Sidebar
    },
    props: {
        orders: Object,
        flash: Object
    },
    layout: AdminLayout
}
</script>

<style lang="scss" scoped></style>