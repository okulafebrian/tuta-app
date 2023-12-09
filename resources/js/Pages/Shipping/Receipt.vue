<template>
    <Head title="Cetak Resi" />

    <div class="hide w-[10cm] mx-auto flex justify-between items-center mt-8 mb-4">
        <div class="font-medium text-sm">Ukuran Kertas A6</div>
        <button type="button" @click="print"
            class="block bg-lime-600 hover:bg-lime-700 text-white font-medium px-6 py-1.5 text-sm rounded">
            Print
        </button>
    </div>

    <div class="print-content w-[10cm] max-h-[15cm] mx-auto">
        <div class="border border-black">
            <div class="flex items-center justify-between border-b p-3">
                <Logo class="h-5" />
                <img src="/storage/assets/jnt.png" class="h-4">
            </div>

            <div class="p-3">
                <div class="mx-4 mb-2">
                    <img :src="'data:image/png;base64,' + jntBarcode" alt="Barcode" class="w-full h-7" />
                </div>

                <div class="text-center">
                    <div class="text-[8px]">No. Resi Pengiriman</div>
                    <div class="font-semibold text-[10px]">{{ shipping.awb_no }}</div>
                </div>

                <div class="p-2 my-3 text-center border text-[8px]">
                    Penjual <span class="font-semibold">tidak perlu bayar</span> biaya pengirim ke kurir
                </div>

                <div class="grid grid-cols-2 text-[8px] mb-3">
                    <div>
                        <table class="w-full">
                            <tr>
                                <td class="w-16">No. Pesanan</td>
                                <td class="w-4">:</td>
                                <td class="font-semibold">{{ shipping.code }}</td>
                            </tr>
                            <tr>
                                <td>Berat Barang</td>
                                <td>:</td>
                                <td class="font-semibold">{{ shipping.order.total_quantity }} kg</td>
                            </tr>
                            <tr>
                                <td>COD</td>
                                <td>:</td>
                                <td class="font-semibold">Rp{{ shipping.order.payment_type === 'cod' ?
                                    shipping.order.total_payment.toLocaleString("id-ID") : 0 }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="space-y-2">
                        <div>
                            <div class="font-semibold mb-1">PENGIRIM</div>
                            <div class="font-semibold">
                                TUTA OFFICIAL SHOP - 628117676890
                            </div>
                            <div>Kota Tangerang</div>
                        </div>
                        <div>
                            <div class="font-semibold mb-1">PENERIMA</div>
                            <div class="font-semibold">
                                {{ shipping.order.receiver_name }} - {{ shipping.order.receiver_phone }}
                            </div>
                            <div>{{ shipping.order.receiver_address }}</div>
                            <div>{{ shipping.order.district }}, {{ shipping.order.city }}, {{
                                shipping.order.province }}</div>
                        </div>
                    </div>
                </div>

                <div class="text-[8px]">
                    <div class="font-semibold mb-1">DETAIL BARANG</div>
                    <table class="w-full">
                        <tr class="text-zinc-500 font-semibold border-b">
                            <td class="text-start py-1">Nama Barang</td>
                            <td class="text-start py-1">Variasi</td>
                            <td class="text-start">Jumlah</td>
                        </tr>
                        <tr v-for="orderDetail in shipping.order.order_details">
                            <td class="py-1">{{ orderDetail.name }}</td>
                            <td>{{ orderDetail.color }}, {{ orderDetail.size }}</td>
                            <td>{{ orderDetail.quantity }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    mounted() {
        this.loadImages().then(() => {
            this.print();
        });
    },
    methods: {
        loadImages() {
            return new Promise((resolve) => {
                const images = document.querySelectorAll('img');
                let loadedImages = 0;

                const imageLoaded = () => {
                    loadedImages++;
                    if (loadedImages === images.length) {
                        resolve();
                    }
                };

                images.forEach((img) => {
                    if (img.complete) {
                        imageLoaded();
                    } else {
                        img.onload = imageLoaded;
                    }
                });
            });
        },
        print() {
            window.print()
        }
    },
    props: {
        shipping: Object,
        orderBarcode: String,
        jntBarcode: String
    }
};
</script>

<style>
@media print {
    .print-content {
        margin: 0;
        padding: 0;
    }

    .hide {
        display: none;
    }
}
</style>
