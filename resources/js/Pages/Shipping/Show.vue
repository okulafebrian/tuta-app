<template>
    <TransitionRoot appear :show="isOpen" as="template">
        <Dialog as="div" class="relative z-10">
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
                            class="w-[35%] rounded-md overflow-y-auto flex flex-col my-6 transform bg-white align-middle shadow-xl transition-all">
                            <DialogTitle class="text-center text-xl font-bold p-6 pb-0">
                                Lacak Pesanan
                            </DialogTitle>
                            <div class="flex-1">
                                <div class="space-y-4 text-xs p-6 border-b-8 border-gray-100">
                                    <div>
                                        <div class="text-zinc-600">Nomor Resi</div>
                                        <div class="font-semibold">{{ tracking?.awb }}</div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <div class="text-zinc-600">Tanggal Pengiriman</div>
                                            <div class="font-semibold">
                                                {{ tracking?.detail?.shipped_date }}
                                            </div>
                                        </div>
                                        <div>
                                            <div class="text-zinc-600">Service Code</div>
                                            <div class="font-semibold">
                                                {{ tracking?.detail?.services_code }}
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-zinc-600">Estimasi Tiba</div>
                                        <div class="font-semibold">
                                            {{ order.shipping.formatted_etd_time }}
                                        </div>
                                    </div>
                                </div>

                                <div class="p-6">
                                    <div class="mb-3 pb-3 border-b">
                                        <div class="text-zinc-600 text-xs">Status</div>
                                        <div class="font-semibold text-sm">
                                            <div v-if="[2, 3].includes(order.status)">Dikemas</div>
                                            <div v-if="order.status == 4">Dikirim</div>
                                            <div v-if="order.status == 5">Selesai</div>
                                            <div v-if="order.status == 6">Pembatalan</div>
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <div v-for="(detail, index) in historyDetails" class="flex items-center gap-2">
                                            <div class="flex flex-col items-center">
                                                <CheckCircleIcon v-if="index == 0" class="w-5 h-5 text-lime-600" />
                                                <CheckCircleIcon v-else class="w-5 h-5 text-gray-300" />
                                                <div class="h-5 border-l-[1.5px] mt-0.5"></div>
                                            </div>
                                            <div class="flex-1 text-xs">
                                                <div class="flex justify-between items-end mb-1">
                                                    <div class="font-semibold"
                                                        :class="index == 0 ? 'text-lime-600' : 'text-zinc-700'">
                                                        {{ formattedHistoryDate(detail.date_time) }}
                                                    </div>
                                                    <div class="text-zinc-600">
                                                        {{ formattedHistoryTime(detail.date_time) }} WIB
                                                    </div>
                                                </div>
                                                <div class="text-zinc-600">
                                                    <div v-if="detail.status_code == 162 || detail.status_code == 163">
                                                        Pesanan dibatalkan
                                                    </div>
                                                    <div v-else-if="detail.status_code == 101">
                                                        Pengiriman telah diatur. Menunggu pesanan diserahkan ke kurir
                                                    </div>
                                                    <div v-else>{{ detail.status }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <div class="flex flex-col items-center">
                                                <CheckCircleIcon v-if="!order.shipping" class="w-5 h-5 text-lime-600" />
                                                <CheckCircleIcon v-else class="w-5 h-5 text-gray-300" />
                                                <div class="h-5 border-l-[1.5px] mt-0.5"></div>
                                            </div>
                                            <div class="flex-1 text-xs">
                                                <div class="flex justify-between items-end mb-1">
                                                    <div class="font-semibold"
                                                        :class="!order.shipping ? 'text-lime-600' : 'text-zinc-700'">
                                                        {{ formattedHistoryDate(order.created_at) }}
                                                    </div>
                                                    <div class="text-zinc-600">
                                                        {{ formattedHistoryTime(order.created_at) }} WIB
                                                    </div>
                                                </div>
                                                <div class="text-zinc-600">
                                                    Pesanan dibuat
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-6">
                                <button type="button" @click="closeModal"
                                    class="px-6 py-2 border rounded font-semibold text-sm w-full">
                                    Tutup
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
import { CheckCircleIcon } from '@heroicons/vue/24/solid';

export default {
    data() {
        return {
            tracking: null
        }
    },
    components: {
        TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle,
        CheckCircleIcon
    },
    props: {
        isOpen: Boolean,
        order: Object,
    },
    methods: {
        formattedShippedDate(date) {
            if (date) {
                return new Date(date).toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                })
            }
        },
        formattedHistoryDate(date) {
            if (date) {
                return new Date(date).toLocaleDateString('id-ID', {
                    weekday: 'long',
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                })
            }
        },
        formattedHistoryTime(date) {
            if (date) {
                return new Date(date).toLocaleTimeString('id-ID', {
                    hour: 'numeric',
                    minute: 'numeric',
                })
            }
        },
        closeModal() {
            this.$emit('closeModal')
            this.tracking = null
        }
    },
    watch: {
        async isOpen() {
            const response = await axios.get(route('shipping.track', this.order.shipping.awb_no))
            const content = response.data

            if (content.error_id) {
                console.log('ga berhasil')
            }
            else {
                this.tracking = content
            }
        }
    },
    computed: {
        historyDetails() {
            if (this.tracking && this.tracking.history) {
                return this.tracking.history.slice().reverse();
            }
            return [];
        }
    }
}
</script>

<style lang="scss" scoped></style>