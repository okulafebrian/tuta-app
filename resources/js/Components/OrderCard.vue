<template>
    <div class="bg-white rounded-md shadow-sm">
        <div class="flex justify-between text-sm border-b px-4 py-3">
            <div class="flex gap-2">
                <Status :status="order.status" />
                <div class="text-zinc-200">/</div>
                <div class="font-semibold">{{ order.code }}</div>
                <div class="text-zinc-200">/</div>
                <div class="text-zinc-600">
                    {{ order.user.first_name }} {{ order.user.last_name }}
                </div>
                <div class="text-zinc-200">/</div>
                <div class="text-zinc-600">{{ order.formatted_created_at }}</div>
            </div>
        </div>

        <div class="grid grid-cols-3 px-4 py-4 divide-x text-sm">
            <div class="space-y-4">
                <div v-for="orderDetail in order.order_details" class="flex gap-4">
                    <div>
                        <img :src="'/storage/shoes/' + orderDetail.code + '/' + orderDetail.photo"
                            class="w-14 border bg-white rounded-lg p-1">
                    </div>
                    <div class="flex-1 text-xs space-y-0.5">
                        <div class="font-semibold">{{ orderDetail.name }}</div>
                        <div class="text-zinc-600">
                            {{ orderDetail.quantity }} x {{ orderDetail.color }}, {{ orderDetail.size }}
                        </div>
                        <div>
                            Rp {{ orderDetail.price.toLocaleString("id-ID") }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-6">
                <div class="font-semibold mb-1">Alamat</div>
                <div class="text-zinc-600">
                    <div>{{ order.receiver_name }} ({{ order.receiver_phone }})</div>
                    <div>{{ order.address }}</div>
                    <div>{{ order.district.name }}, {{ order.city.name }}</div>
                </div>
            </div>
            <div class="space-y-4 px-6">
                <div>
                    <div class="font-semibold mb-1">Kurir</div>
                    <div class="flex items-center gap-2">
                        <div class="text-zinc-600">J&T - Reguler</div>
                        <div v-if="order.cod" class="font-bold bg-red-600/10 px-2 text-red-600 text-xs rounded-sm">
                            COD
                        </div>
                    </div>
                </div>
                <div v-if="order.status != 0 && order.status != 1">
                    <div class="font-semibold mb-1">No. Resi</div>
                    <div class="text-zinc-600">{{ order.shipping.awb_no }}</div>
                </div>
            </div>
        </div>
        <div class="p-4 pt-0">
            <div class="flex items-center justify-between  bg-zinc-100 px-4 py-2 rounded-md">
                <div class="flex gap-1 text-sm">
                    <div class="font-semibold">Total Penjualan</div>
                    <div class="font-medium text-zinc-600">(3 Barang)</div>
                </div>
                <div class="font-semibold">Rp {{ order.total_payment.toLocaleString("id-ID") }}</div>
            </div>
        </div>
        <div class="flex justify-between p-4 border-t">
            <div>
                <button v-if="order.status == 3" type="button" @click="accept"
                    class="p-2 font-medium hover:bg-gray-100 text-sm rounded-sm">
                    <div class="flex items-center gap-2">
                        <PrinterIcon class="w-4 h-4" />
                        <div>Cetak Label</div>
                    </div>
                </button>
            </div>
            <div>
                <button v-if="order.status == 1" type="button" @click="accept"
                    class="px-6 py-2 font-medium bg-lime-600 hover:bg-lime-700 text-white text-sm rounded-sm">
                    Terima Pesanan
                </button>
                <button v-if="order.status == 4" type="button" @click="accept"
                    class="px-6 py-2 font-medium bg-lime-600 hover:bg-lime-700 text-white text-sm rounded-sm">
                    Request Pick Up
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import Status from '@/Components/Status.vue';
import { PrinterIcon } from '@heroicons/vue/24/outline';

export default {
    components: {
        Status,
        PrinterIcon
    },
    methods: {
        accept() {
            this.$inertia.put(route('orders.accept', this.order))
        }
    },
    props: {
        order: Object
    }
}
</script>

<style lang="scss" scoped></style>