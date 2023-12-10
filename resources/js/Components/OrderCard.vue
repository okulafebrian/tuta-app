<template>
    <div class="bg-white rounded shadow">
        <div class="flex gap-2 text-xs border-b px-4 py-3">
            <div class="font-semibold">
                <div v-if="[2, 3].includes(order.status)">Perlu Dikirim</div>
                <div v-if="order.status == 4">Dikirim</div>
                <div v-if="order.status == 5">Selesai</div>
                <div v-if="order.status == 6">Pembatalan</div>
            </div>
            <div class="text-zinc-200">/</div>
            <div class="font-semibold text-lime-600">{{ order.code }}</div>
            <div class="text-zinc-200">/</div>
            <div>
                {{ order.user }}
            </div>
            <div class="text-zinc-200">/</div>
            <div>{{ order.formatted_created_at }}</div>
            <div class="text-zinc-200">/</div>
            <div>Midtrans</div>
        </div>

        <div class="p-4 space-y-4">
            <div class="flex divide-x text-xs">
                <div class="w-1/2 space-y-4 pe-4">
                    <div v-for="orderDetail in order.order_details" class="flex gap-4">
                        <div>
                            <img :src="'/storage/products/' + orderDetail.code + '/' + orderDetail.photo"
                                class="w-14 border bg-white rounded p-1">
                        </div>
                        <div class="flex-1 text-xs space-y-0.5">
                            <div class="font-semibold">{{ orderDetail.name }}</div>
                            <div class="text-zinc-600">
                                {{ orderDetail.quantity }}x {{ orderDetail.color }}, {{ orderDetail.size }}
                            </div>
                            <div>
                                Rp{{ orderDetail.price.toLocaleString("id-ID") }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-grow grid grid-cols-2 ps-4">
                    <div>
                        <div class="font-semibold mb-1">Alamat</div>
                        <div class="text-zinc-600">
                            <div>{{ order.receiver_name }} ({{ order.receiver_phone }})</div>
                            <div>{{ order.receiver_address }}</div>
                            <div>{{ order.district.name }}, {{ order.city.name }}</div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <div class="font-semibold mb-1">Kurir</div>
                            <div class="flex items-center gap-1">
                                <div class="text-zinc-600">J&T - Reguler</div>
                                <div v-if="order.payment_type == 'cod'"
                                    class="font-bold bg-red-600/10 px-1 text-red-600 text-[10px] rounded">
                                    COD
                                </div>
                            </div>
                        </div>
                        <div v-if="order.shipping">
                            <div class="font-semibold mb-1">No. Resi</div>
                            <div class="text-zinc-600">{{ order.shipping.awb_no }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between bg-gray-100 px-3 py-2 rounded">
                <div class="text-xs">
                    <span class="font-bold">Total Harga</span> ({{ order.total_quantity }} Barang)
                </div>
                <div class="font-bold">Rp{{ order.total_payment.toLocaleString("id-ID") }}</div>
            </div>

            <div class="flex items-center justify-between">
                <div v-if="order.status == 3" class="bg-amber-100 text-amber-600 px-4 py-2 rounded text-xs font-semibold">
                    Menunggu pick up
                </div>
                <div v-else-if="order.status == 6"
                    class="bg-blue-100 text-blue-600 px-4 py-2 rounded text-xs font-semibold">
                    Dibatalkan pada {{ order.formatted_cancelled_at }}
                </div>
                <div class="flex-grow flex justify-end gap-3 font-medium text-sm">
                    <button v-if="[3, 4].includes(order.status)" type="button" @click="track"
                        class="px-4 py-2 border rounded">
                        Lacak Pesanan
                    </button>
                    <button v-if="[2, 3].includes(order.status)" type="button" @click="cancel"
                        class="px-4 py-2 border rounded">
                        Batalkan Pesanan
                    </button>
                    <button v-if="order.status == 3" type="button" @click="receipt"
                        class="flex items-center gap-2 px-4 py-2 border rounded">
                        <PrinterIcon class="w-4 h-4" />
                        <div>Cetak Label</div>
                    </button>
                    <button v-if="order.status == 2" type="button" @click="pickup"
                        class="px-4 py-2 bg-lime-600 hover:bg-lime-700 text-white rounded">
                        Atur Pengiriman
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Status from '@/Components/Status.vue'
import { PrinterIcon } from '@heroicons/vue/24/outline'

export default {
    components: {
        Status,
        PrinterIcon,
    },
    methods: {
        cancel() {
            if (window.confirm('Apakah Anda yakin ingin membatalkan pesanan ini')) {
                this.$inertia.put(route('orders.cancel', this.order));
            }
        },
        receipt() {
            const url = route('shipping.receipt', this.order.shipping);
            window.open(url, '_blank');
        },
        pickup() {
            this.$emit('pickup')
        },
        track() {
            this.$emit('track')
        }
    },
    props: {
        order: Object
    }
}
</script>

<style lang="scss" scoped></style>