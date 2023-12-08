<template>
    <div class="px-4 lg:px-20 py-10">
        <div v-if="status == 2">
            <div class="text-center mb-6">
                <CheckBadgeIcon class="text-lime-600 w-20 h-20 inline-block mb-6" />
                <div class="text-3xl font-semibold mb-2">Pesananmu Berhasil Dibuat</div>
                <div>Pembayaranmu telah berhasil diproses. Terimakasih telah berbelanja di TUTA Official Shop.</div>
            </div>

            <div class="flex justify-center gap-3">
                <Link :href="route('shop')" class="bg-lime-600 px-6 py-2.5 rounded-lg font-medium text-white text-center">
                Belanja Lagi
                </Link>
                <Link :href="route('orders.index')"
                    class="border border-lime-600 px-6 py-2.5 rounded-lg font-medium text-lime-600 text-center">
                Pesanan Saya
                </Link>
            </div>
        </div>

        <div v-if="status == 1">
            <div class="text-center mb-6">
                <ClockIcon class="text-lime-600 w-20 h-20 inline-block mb-6" />
                <div class="text-3xl font-semibold mb-2">Menunggu Pembayaran</div>
                <div>Selesaikan pembayaranmu untuk menghindari pembatalan otomatis.</div>
            </div>

            <div class="flex justify-center gap-3">
                <Link :href="route('shop')"
                    class="border border-lime-600 px-6 py-2.5 rounded-lg font-medium text-lime-600 text-center">
                Belanja Lagi
                </Link>
                <a :href="order.redirect_url" target="_blank"
                    class="bg-lime-600 px-6 py-2.5 rounded-lg font-medium text-white text-center">
                    Lanjut ke Pembayaran
                </a>
            </div>
        </div>

        <div v-if="status == 6">
            <div class="text-center mb-6">
                <XCircleIcon class="text-lime-600 w-20 h-20 inline-block mb-6" />
                <div class="text-3xl font-semibold mb-2">Pesananmu Gagal Dibuat</div>
                <div>Pembayaranmu gagal diproses.</div>
            </div>

            <div class="flex justify-center gap-3">
                <Link :href="route('home')" class="bg-lime-600 px-6 py-2.5 rounded-lg font-medium text-white text-center">
                Belanja Lagi
                </Link>
                <Link :href="route('orders')"
                    class="border border-lime-600 px-6 py-2.5 rounded-lg font-medium text-lime-600 text-center">
                Pesanan Saya
                </Link>
            </div>
        </div>
    </div>
</template>

<script>
import UserLayout from '@/Layouts/UserLayout.vue';
import { CheckBadgeIcon, ClockIcon, XCircleIcon } from '@heroicons/vue/20/solid';

export default {
    components: {
        CheckBadgeIcon, ClockIcon, XCircleIcon
    },
    props: {
        status: Number,
        order: Object
    },
    layout: UserLayout
}
</script>

<style lang="scss" scoped></style>