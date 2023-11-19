<template>
    <Head title="Checkout" />

    <AddressCreate :isOpen="createIsOpen" @closeModal="closeCreateModal" :provinces="provinces" />
    <AddressList :isOpen="listIsOpen" @closeModal="closeListModal" @addAddress="openCreateModal" :addresses="addresses" />

    <div class="px-4 xl:px-16 pt-6 xl:pt-10">
        <div class="text-xl xl:text-2xl font-semibold mb-6">Checkout</div>

        <div class="flex flex-col xl:flex-row gap-8 xl:gap-10">
            <div class="flex-1">
                <div class="mb-8">
                    <div class="font-medium text-lg mb-4">Alamat Pengiriman</div>
                    <button type="button"
                        class="w-full text-start flex justify-between items-center bg-slate-100 hover:bg-slate-200/60 px-6 py-4 rounded-xl"
                        @click="openListModal">
                        <div v-if="address" class="text-sm">
                            <div class="font-medium text-base line-clamp-1">{{ address.name }}</div>
                            <div class="text-slate-600">{{ address.phone }}</div>
                            <div class="text-slate-600 line-clamp-1">{{ address.detail }}</div>
                        </div>
                        <div v-else class="font-medium text-slate-400">
                            Belum ada alamat terpilih
                        </div>
                        <div>
                            <ChevronRightIcon class="w-4 h-4 text-slate-400" style="stroke-width: 3;" />
                        </div>
                    </button>
                </div>

                <div class="mb-8">
                    <div class="font-medium text-lg mb-4">Metode Pembayaran</div>
                    <div class="space-y-2">
                        <label for="cashless" class="p-4 rounded-xl flex items-center gap-3"
                            :class="[form.payment_method === 'cashless' ? 'border bg-lime-300/40 border-lime-600' : 'bg-slate-100 hover:bg-slate-200/60']">
                            <input id="cashless" type="radio" name="payment_method" v-model="form.payment_method"
                                value="cashless" required
                                class="border-slate-300 bg-white checked:bg-lime-500 checked:focus:bg-lime-500 checked:hover:bg-lime-500 checked:focus:ring-lime-500">
                            <div>Pembayaran non-tunai</div>
                        </label>
                        <label for="cod" class="p-4 rounded-xl flex items-center gap-3"
                            :class="[form.payment_method === 'cod' ? 'border bg-lime-300/40 border-lime-600' : 'bg-slate-100 hover:bg-slate-200/60']">
                            <input id="cod" type="radio" name="payment_method" v-model="form.payment_method" value="cod"
                                class="border-slate-300 bg-white checked:bg-lime-500 checked:focus:bg-lime-500 checked:hover:bg-lime-500 checked:focus:ring-lime-500">
                            <div>COD (Bayar di Tempat)</div>
                        </label>
                    </div>
                </div>

                <div>
                    <div class="font-medium text-lg mb-4">Detail Pembelian</div>
                    <div class="space-y-4">
                        <div v-for="(cart, i) in carts" class="flex gap-4 text-sm">
                            <div>
                                <img v-if="cart.variantPhoto" :src="'/storage/shoes/' + cart.code + '/' + cart.variantPhoto"
                                    class="w-20 border border-slate-200 bg-white rounded-lg p-1">
                            </div>
                            <div class="flex-1 text-sm space-y-1">
                                <div class="line-clamp-1 font-medium">{{ cart.name }}</div>
                                <div class="text-slate-600">
                                    {{ cart.quantity }}x {{ cart.color }}, {{ cart.size }}
                                </div>
                                <div>
                                    <div v-if="cart.is_discount" class="flex gap-2">
                                        <span>Rp{{ cart.discount_price.toLocaleString("id-ID") }}</span>
                                        <div class="flex gap-1">
                                            <div
                                                class="font-semibold bg-rose-100 text-rose-600 rounded-md px-2 py-0.5 text-xs">
                                                {{ cart.discount }}%
                                            </div>
                                            <span class="text-slate-400 line-through">
                                                Rp{{ cart.price.toLocaleString("id-ID") }}
                                            </span>
                                        </div>
                                    </div>
                                    <div v-else>Rp{{ cart.price.toLocaleString("id-ID") }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="xl:w-1/3">
                <div class="border rounded-xl p-6">
                    <div class="text-lg font-semibold mb-4">Ringkasan Pembayaran</div>

                    <div class="space-y-2 text-slate-500 my-4">
                        <div class="flex justify-between">
                            <div>Total Harga</div>
                            <div>Rp{{ totalPrice.toLocaleString("id-ID") }}</div>
                        </div>
                        <div class="flex justify-between">
                            <div>Total Ongkos Kirim</div>
                            <div>Rp{{ (form.shipping_fee).toLocaleString("id-ID") }}</div>
                        </div>
                    </div>
                    <div class="border-t py-4 mb-4 flex justify-between text-lg font-semibold">
                        <div>Total Belanja</div>
                        <div>Rp{{ (form.total_payment).toLocaleString("id-ID") }}</div>
                    </div>
                    <button type="button" @click="createOrder" :disabled="!form.shipping_fee"
                        class="bg-lime-600 hover:bg-lime-700 disabled:bg-slate-300 disabled:text-slate-500 py-3 w-full rounded-full font-medium text-white text-center text-lg">
                        Buat Pesanan
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import UserLayout from '@/Layouts/UserLayout.vue';
import AddressCreate from '@/Pages/Addresses/Create.vue';
import AddressList from '@/Pages/Addresses/List.vue';
import { ChevronRightIcon } from '@heroicons/vue/24/outline';
import { useForm, usePage } from '@inertiajs/vue3';

export default {
    data() {
        return {
            listIsOpen: false,
            createIsOpen: false,
            address: this.mainAddress
        }
    },
    props: {
        carts: Object,
        totalPrice: Number,
        addresses: Object,
        mainAddress: Object,
        provinces: Object,
        auth: Object,
    },
    components: {
        AddressCreate, AddressList, ChevronRightIcon
    },
    methods: {
        openListModal() {
            this.listIsOpen = true
        },
        closeListModal(selectedAddress) {
            this.listIsOpen = false
            this.address = selectedAddress
            this.form.address_id = selectedAddress.id
            this.updatePayment(selectedAddress)
        },
        openCreateModal() {
            this.createIsOpen = true
            this.listIsOpen = false
        },
        closeCreateModal() {
            this.createIsOpen = false
            this.listIsOpen = true
        },
        createOrder() {
            this.form.post(route('orders.store'))
        },
        async updatePayment(address) {
            const response = await axios.get('api/tariff-check', {
                params: {
                    district: address.district.name,
                    weight: this.$page.props.quantity
                }
            });

            const content = JSON.parse(response.data.content);
            const shippingFee = parseInt(content[0].cost, 10);

            this.form.shipping_fee = shippingFee
            this.form.total_payment = shippingFee + this.totalPrice
        }
    },
    mounted: async function () {
        await this.updatePayment(this.mainAddress);
    },
    setup(props) {
        const form = useForm({
            payment_method: '',
            address_id: props.mainAddress.id,
            total_price: props.totalPrice,
            shipping_fee: '',
            total_payment: '',
        })

        return { form }
    },
    layout: UserLayout
}
</script>

<style lang="scss" scoped></style>