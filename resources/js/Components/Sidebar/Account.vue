<template>
    <div>
        <div class="px-4 xl:px-0 text-xl font-bold mb-4 xl:mb-6">Akun Saya</div>

        <div class="flex flex-row xl:flex-col overflow-x-auto border-b xl:border-0 xl:space-y-4 text-sm font-medium"
            scroll-region>
            <Link :href="route('account')" preserve-scroll
                :class="['block whitespace-nowrap p-4 xl:p-0', { 'text-lime-600': $page.component === 'Account' }]">
            Biodata Diri
            </Link>
            <Link :href="route('addresses.index')" preserve-scroll
                :class="['block whitespace-nowrap p-4 xl:p-0', { 'text-lime-600': $page.component === 'Addresses/Index' }]">
            Daftar Alamat
            </Link>
            <Link :href="route('orders.index')" preserve-scroll
                :class="['block whitespace-nowrap p-4 xl:p-0', { 'text-lime-600': $page.component === 'Orders/Index' }]">
            Pembelian
            </Link>
            <Link :href="route('orders.pending')" preserve-scroll
                :class="['block whitespace-nowrap p-4 xl:p-0', { 'text-lime-600': $page.component === 'Orders/Pending' }]">
            Menunggu Pembayaran
            </Link>
            <Link :href="route('logout')" method="post" class="hidden xl:flex items-center gap-2 font-medium" as="button">
            <div>Keluar</div>
            <ArrowLeftOnRectangleIcon class="w-5 h-5 stroke-2" />
            </Link>
        </div>
    </div>
</template>

<script>
import { ArrowLeftOnRectangleIcon } from '@heroicons/vue/24/outline';

export default {
    components: {
        ArrowLeftOnRectangleIcon
    }
}
</script>

<style lang="scss" scoped></style>