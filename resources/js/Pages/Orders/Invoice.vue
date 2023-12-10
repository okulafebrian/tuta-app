<template>
    <Head title="Invoice" />

    <div class="print-content my-8 mx-64">
        <div class="grid grid-cols-2 mb-8">
            <Logo class="h-10" />
            <div class="text-end">
                <div class="font-bold tracking-wider">INVOICE</div>
                <div class="text-xs font-medium text-lime-600">{{ order.code }}</div>
            </div>
        </div>

        <div class="grid grid-cols-2 mb-8">
            <div class="text-xs">
                <div class="mb-2 font-bold">DITERBITKAN ATAS NAMA</div>
                <div>PT TUTA MANDIRI INDONESIA</div>
            </div>
            <div class="text-xs">
                <div class="mb-2 font-bold">UNTUK</div>
                <div class="space-y-2">
                    <div class="flex gap-1">
                        <div class="w-28 text-zinc-500">Pembeli</div>
                        <div class="w-1 text-zinc-500">:</div>
                        <div class="flex-1 font-bold">{{ order.user }}</div>
                    </div>
                    <div class="flex gap-1">
                        <div class="w-28 text-zinc-500">Tanggal Pembelian</div>
                        <div class="w-1 text-zinc-500">:</div>
                        <div class="flex-1 font-bold">{{ order.formatted_created_at }}</div>
                    </div>
                    <div class="flex gap-1">
                        <div class="w-28 text-zinc-500">Alamat Pengiriman</div>
                        <div class="w-1 text-zinc-500">:</div>
                        <div class="flex-1 space-y-1">
                            <div>
                                <span class="font-bold">{{ order.receiver_name }}</span> ({{ order.receiver_phone }})
                            </div>
                            <div>{{ order.receiver_address }}</div>
                            <div>
                                {{ order.district.name }}, {{ order.city.name }}, {{ order.zip_code.name }} {{
                                    order.province.name }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-6 pb-3 border-b">
            <table class="w-full mb-4">
                <thead>
                    <tr class="text-xs font-bold border-y bg-gray-100">
                        <td class="w-1/2 ps-4 py-3">INFO PRODUK</td>
                        <td class="w-0 py-3 text-end">JUMLAH</td>
                        <td class="py-3 text-end">HARGA SATUAN</td>
                        <td class="pe-4 py-3 text-end">TOTAL HARGA</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="order_detail in order.order_details" class="text-xs border-b">
                        <td class="w-1/2 ps-4 py-3">
                            {{ order_detail.name }}
                        </td>
                        <td class="py-3 text-end">
                            {{ order_detail.quantity }}
                        </td>
                        <td class="py-3 text-end">
                            Rp{{ order_detail.price.toLocaleString("id-ID") }}
                        </td>
                        <td class="pe-4 py-3 text-end">
                            Rp{{ order_detail.sub_total.toLocaleString("id-ID") }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="w-1/2 ms-auto">
                <tbody>
                    <tr class="font-bold">
                        <td class="text-xs">
                            TOTAL HARGA ({{ order.total_quantity }} BARANG)
                        </td>
                        <td class="pe-4 text-sm text-end">
                            Rp{{ order.total_price.toLocaleString("id-ID") }}
                        </td>
                    </tr>
                    <tr class="text-xs">
                        <td class="py-3">
                            Total Ongkos Kirim
                        </td>
                        <td class="py-3 pe-4 text-end">
                            Rp{{ order.shipping_fee.toLocaleString("id-ID") }}
                        </td>
                    </tr>
                    <tr class="text-sm font-bold border-t border-dashed">
                        <td class="py-3 text-xs">
                            TOTAL BELANJA
                        </td>
                        <td class="pe-4 py-3 text-sm text-end">
                            Rp{{ order.total_payment.toLocaleString("id-ID") }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="grid grid-cols-2 text-xs mb-12">
            <div>
                <div class="text-zinc-500 mb-1">Kurir:</div>
                <div class="font-bold">JNT - Reguler</div>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-zinc-500 mb-1">Metode Pembayaran:</div>
                    <div class="font-bold">{{ formatText(order.payment_type) }}</div>
                </div>
                <div v-if="order.paid_at || order.payment_type === 'cod'"
                    class="px-3 py-2 flex gap-2 items-center border border-green-600 font-semibold text-green-600 text-xs rounded">
                    <CheckBadgeIcon class="w-5 h-5 stroke-2" /> LUNAS
                </div>
                <div v-else
                    class="px-3 py-2 flex gap-2 items-center border border-red-600 font-semibold text-red-600 text-xs rounded">
                    <ExclamationCircleIcon class="w-5 h-5 stroke-2" /> BELUM LUNAS
                </div>
            </div>
        </div>

        <div class="flex justify-between text-xs">
            <div>Invoice ini sah dan diproses oleh komputer</div>
            <div class="italic">Dibuat pada {{ currentDateTime }}</div>
        </div>
    </div>
</template>

<script>
import { CheckBadgeIcon, ExclamationCircleIcon } from '@heroicons/vue/24/outline';

export default {
    data() {
        return {
            currentDateTime: '',
            payment_type: ''
        };
    },
    props: {
        order: Object
    },
    components: {
        CheckBadgeIcon, ExclamationCircleIcon
    },
    mounted() {
        this.getCurrentDateTime();

        this.print();
    },
    methods: {
        getCurrentDateTime() {
            const now = new Date();

            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
                timeZoneName: 'short'
            };

            this.currentDateTime = now.toLocaleString('id-ID', options);
        },
        formatText(type) {
            switch (type) {
                case 'credit_card':
                    return 'Kartu Kredit'
                case 'gopay':
                    return GoPay
                case 'qris':
                    return 'QRIS'
                case 'gopay':
                    return 'GoPay'
                case 'shopeepay':
                    return 'ShopeePay'
                case 'bank_transfer':
                    return 'Transfer Bank'
                case 'echannel':
                    return 'E-Channel'
                case 'cstore':
                    return 'Indomaret/Alfamart'
                case 'akulaku':
                    return 'Akulaku'
                case 'cod':
                    return 'COD'
            }
        },
        print() {
            window.print()
        }
    }
}
</script>

<style>
@media print {
    .print-content {
        width: 100vw;
        margin: 0;
        padding: 2rem;
        box-sizing: border-box;
    }
}
</style>