<template>
    <TransitionRoot appear :show="isOpen" as="template">
        <Dialog as="div" @close="closeModal" class="relative z-10">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
                leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-black bg-opacity-50" />
            </TransitionChild>

            <div class="fixed inset-0 top-0 overflow-y-auto">
                <div class="flex justify-center">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100" leave="duration-300 ease-out" leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95">
                        <DialogPanel
                            class="w-full xl:w-1/2 xl:rounded-2xl flex flex-col xl:my-5 transform bg-white align-middle shadow-xl transition-all">
                            <DialogTitle class="flex justify-between items-center px-8 pt-6">
                                <div class="text-xl font-semibold flex-1">
                                    Detail Transaksi
                                </div>
                                <button type="button" @click="closeModal">
                                    <XMarkIcon class="w-6 h-6" />
                                </button>
                            </DialogTitle>

                            <div class="px-8 py-6 divide-y divide-dashed">
                                <div class="text-sm space-y-2 pb-4">
                                    <div class="flex justify-between">
                                        <div class="text-slate-500">No. Invoice</div>
                                        <div>{{ order.code }}</div>
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="text-slate-500">Tanggal Pembelian</div>
                                        <div>{{ order.formatted_created_at }}</div>
                                    </div>
                                    <div v-if="order.status != 0" class="flex justify-between">
                                        <div class="text-slate-500">Status</div>
                                        <div>
                                            <Status :status="order.status" />
                                        </div>
                                    </div>
                                </div>

                                <div class="py-4">
                                    <div class="font-semibold mb-4">Detail Produk</div>
                                    <div class="space-y-4">
                                        <div v-for="(orderDetail, i) in order.order_details"
                                            class="flex gap-4 p-4 border rounded-xl">
                                            <div>
                                                <img v-if="orderDetail.photo"
                                                    :src="'/storage/shoes/' + orderDetail.code + '/' + orderDetail.photo"
                                                    class="w-14 border border-gray-200 bg-white rounded-lg p-1">
                                            </div>
                                            <div class="flex-1 text-xs space-y-0.5">
                                                <div class="line-clamp-1 font-medium">{{ orderDetail.name }}</div>
                                                <div class="text-sm text-slate-600">
                                                    {{ orderDetail.quantity }}x {{ orderDetail.color }},
                                                    {{ orderDetail.size }}
                                                </div>
                                                <div class="text-xs">
                                                    <div v-if="orderDetail.is_discount" class="space-x-2">
                                                        <span>Rp {{ orderDetail.discount_price.toLocaleString("id-ID")
                                                        }}</span>
                                                        <span class="text-slate-400 line-through">
                                                            Rp {{ orderDetail.price.toLocaleString("id-ID") }}
                                                        </span>
                                                    </div>
                                                    <div v-else>Rp {{ orderDetail.price.toLocaleString("id-ID") }}</div>
                                                </div>
                                            </div>
                                            <div class="border-s ps-6 flex items-center">
                                                <div>
                                                    <div class="text-xs">Total Harga</div>
                                                    <div class="text-sm font-semibold">
                                                        Rp {{ orderDetail.price.toLocaleString("id-ID") }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div v-if="order.shipping" class="py-4">
                                    <div class="font-semibold mb-4">Info Pengiriman</div>
                                    <div class="space-y-2 text-sm">
                                        <div class="flex gap-4">
                                            <div class="w-[15%]">Resi</div>
                                            <div>:</div>
                                            <div>{{ order.shipping.awb_no }}</div>
                                        </div>
                                        <div class="flex gap-4">
                                            <div class="w-[15%]">Alamat</div>
                                            <div>:</div>
                                            <div>
                                                <div class="font-semibold">Vincent Febrien</div>
                                                <div>085156028260</div>
                                                <div>Jl. Kartini No. 7D</div>
                                                <div>Cipondoh, Kota Tangerang</div>
                                                <div>Banten, 1234</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="py-4">
                                    <div class="font-semibold mb-4">Rincian Pembayaran</div>
                                    <div class="space-y-2 text-sm border-b border-dashed mb-3 pb-3">
                                        <div class="flex justify-between">
                                            <div class="text-slate-500">Total Harga</div>
                                            <div>Rp {{ order.total_price.toLocaleString("id-ID") }}</div>
                                        </div>
                                        <div class="flex justify-between">
                                            <div class="text-slate-500">Total Ongkos Kirim</div>
                                            <div>Rp {{ order.shipping_fee.toLocaleString("id-ID") }}</div>
                                        </div>
                                    </div>
                                    <div class="flex justify-between text-base font-semibold">
                                        <div>Total Belanja</div>
                                        <div>Rp {{ order.total_payment.toLocaleString("id-ID") }}</div>
                                    </div>
                                </div>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script>
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'
import { XMarkIcon } from '@heroicons/vue/24/outline';
import Status from '@/Components/Status.vue';

export default {
    components: {
        TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle,
        XMarkIcon,
        Status,
    },
    props: {
        isOpen: Boolean,
        order: Object,
    },
    methods: {
        closeModal() {
            this.$emit('closeModal')
        },
    },
}
</script>

<style lang="scss" scoped></style>