<template>
    <TransitionRoot appear :show="isOpen" as="template">
        <Dialog as="div" @close="close" class="relative z-10">
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
                            class="w-full xl:w-[45%] xl:rounded-md flex flex-col xl:my-5 transform bg-white align-middle shadow-xl transition-all">
                            <DialogTitle
                                class="flex items-center justify-between text-xl text-center font-bold px-4 xl:px-8 pt-6">
                                <div>Detail Transaksi</div>
                                <button type="button" @click="close">
                                    <XMarkIcon class="w-6 h-6" />
                                </button>
                            </DialogTitle>

                            <div class="px-4 xl:px-8 py-6">
                                <div class="text-xs space-y-2 pb-4 border-b">
                                    <div class="flex justify-between">
                                        <div class="text-slate-600">No. Invoice</div>
                                        <div>{{ order.code }}</div>
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="text-slate-600">Tanggal Pembelian</div>
                                        <div>{{ order.formatted_created_at }}</div>
                                    </div>
                                    <div v-if="order.status != 0" class="flex justify-between">
                                        <div class="text-slate-600">Status</div>
                                        <div>
                                            <Status :status="order.status" />
                                        </div>
                                    </div>
                                </div>

                                <div class="py-4 border-b">
                                    <div class="text-sm font-semibold mb-4">Detail Produk</div>
                                    <div class="space-y-4">
                                        <div v-for="(orderDetail, i) in order.order_details"
                                            class="flex gap-4 p-4 border rounded-xl">
                                            <div>
                                                <img v-if="orderDetail.photo"
                                                    :src="'/storage/products/' + orderDetail.code + '/' + orderDetail.photo"
                                                    class="w-14 bg-white rounded-lg">
                                            </div>
                                            <div class="flex-1 text-xs space-y-0.5">
                                                <div class="line-clamp-1 font-semibold">{{ orderDetail.name }}</div>
                                                <div class="text-slate-600">
                                                    {{ orderDetail.quantity }}x {{ orderDetail.color }},
                                                    {{ orderDetail.size }}
                                                </div>
                                                <div class="text-xs">
                                                    Rp{{ orderDetail.price.toLocaleString("id-ID") }}
                                                </div>
                                            </div>
                                            <div class="border-s ps-6 flex items-center">
                                                <div>
                                                    <div class="text-xs">Total Harga</div>
                                                    <div class="text-sm font-semibold">
                                                        Rp{{ orderDetail.price.toLocaleString("id-ID") }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div v-if="order.awb_no" class="py-4 border-b">
                                    <div class="text-sm font-bold mb-4">Info Pengiriman</div>
                                    <div class="space-y-2 text-xs">
                                        <div class="flex gap-4">
                                            <div class="w-[15%]">Resi</div>
                                            <div>:</div>
                                            <div>{{ order.awb_no }}</div>
                                        </div>
                                        <div class="flex gap-4">
                                            <div class="w-[15%]">Alamat</div>
                                            <div>:</div>
                                            <div>
                                                <div>
                                                    <span class="font-semibold">{{ order.receiver_name }}</span>
                                                    ({{ order.receiver_phone }})
                                                </div>
                                                <div>{{ order.receiver_address }}</div>
                                                <div>
                                                    {{ order.district.name }}, {{ order.city.name }}, {{ order.zip_code.name
                                                    }} {{ order.province.name }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-4 mb-8">
                                    <div class="text-sm font-bold mb-4">Rincian Pembayaran</div>
                                    <div class="text-xs space-y-2 border-b border-dashed mb-3 pb-3">
                                        <div class="flex justify-between">
                                            <div class="text-slate-600">Total Harga</div>
                                            <div>Rp{{ order.total_price.toLocaleString("id-ID") }}</div>
                                        </div>
                                        <div class="flex justify-between">
                                            <div class="text-slate-600">Total Ongkos Kirim</div>
                                            <div>Rp{{ order.shipping_fee.toLocaleString("id-ID") }}</div>
                                        </div>
                                    </div>
                                    <div class="flex justify-between text-sm font-bold">
                                        <div>Total Belanja</div>
                                        <div>Rp{{ order.total_payment.toLocaleString("id-ID") }}</div>
                                    </div>
                                </div>

                                <button type="button" @click="invoice"
                                    class="block text-center text-sm font-semibold bg-lime-600 text-white py-3 w-full rounded-full focus:ring-0">
                                    Download Invoice
                                </button>
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
        close() {
            this.$emit('closeModal')
        },
        invoice() {
            const url = route('orders.invoice', this.order);
            window.open(url, '_blank');
        },
    }
}
</script>

<style lang="scss" scoped></style>