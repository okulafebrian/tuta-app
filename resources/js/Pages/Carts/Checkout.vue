<template>
    <Head title="Checkout" />

    <Notif v-if="flash.error || flash.success" :flash="flash" />

    <AddressList :isOpen="addressListOpen" @addAddress="openAddressCreate" @closeModal="closeAddressList"
        :userAddresses="addresses" :address="selectedAddress" />
    <AddressCreate :isOpen="addressCreateOpen" @closeModal="closeAddressCreate" :mainAddress="mainAddress" />

    <div class="px-4 xl:px-24 py-10">
        <div class="text-xl font-bold mb-6">Checkout</div>

        <div class="flex flex-col xl:flex-row gap-8 xl:gap-10">
            <div class="flex-1 space-y-8">
                <div>
                    <div class="font-semibold mb-2">Alamat Pengiriman</div>
                    <div v-if="selectedAddress" class="border flex gap-4 justify-between items-center p-4 rounded-xl">
                        <div class="flex-1 text-sm">
                            <div class="font-semibold line-clamp-1">{{ selectedAddress.name }}</div>
                            <div>{{ selectedAddress.phone_number }}</div>
                            <div class="line-clamp-1">{{ selectedAddress.detail }}</div>
                        </div>
                        <button type="button" @click="openAddressList"
                            class="rounded-full px-4 py-2 font-semibold border border-lime-600 text-lime-600 text-sm">
                            Ganti <span class="hidden xl:inline">Alamat</span>
                        </button>
                    </div>
                    <div v-else class="px-6 py-4 rounded-xl bg-slate-100 font-medium text-slate-400">
                        Belum ada alamat tersimpan
                    </div>
                </div>

                <div>
                    <div class="font-semibold mb-2">Metode Pembayaran</div>
                    <div class="grid xl:grid-cols-2 gap-2 xl:gap-4 text-sm font-medium">
                        <label for="cashless" class="border p-4 rounded-xl flex items-center justify-between">
                            <div>Pembayaran non-tunai</div>
                            <input id="cashless" type="radio" name="payment_type" v-model="form.payment_type"
                                value="cashless" class="w-5 h-5 text-lime-600 focus:ring-lime-600">
                        </label>
                        <label for="cod" class="border p-4 rounded-xl flex items-center justify-between">
                            <div>COD (Bayar di Tempat)</div>
                            <input id="cod" type="radio" name="payment_type" v-model="form.payment_type" value="cod"
                                class="w-5 h-5 text-lime-600 focus:ring-lime-600">
                        </label>
                    </div>
                </div>

                <div>
                    <div class="font-semibold mb-4">Detail Pembelian</div>
                    <div class="space-y-4">
                        <div v-for="cart in carts" class="flex gap-4 text-sm">
                            <div>
                                <img :src="'/storage/products/' + cart.product.code + '/' + cart.photo"
                                    class="w-20 border border-gray-200 bg-white rounded-lg p-1">
                            </div>
                            <div class="flex-1 text-sm">
                                <div class="line-clamp-1 font-semibold">{{ cart.product.name }}</div>
                                <div class="text-slate-600">
                                    {{ cart.quantity }}x {{ cart.color.name }}, {{ cart.size.name }}
                                </div>
                                <div class="flex gap-2">
                                    <div class="font-semibold" :class="{ 'text-red-600': cart.product.is_discount }">
                                        Rp{{ (cart.product.is_discount ? cart.product.discount_price :
                                            cart.product.price).toLocaleString("id-ID") }}
                                    </div>
                                    <div v-if="cart.product.is_discount" class="text-slate-400 line-through font-medium">
                                        Rp{{ cart.product.price.toLocaleString("id-ID") }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="xl:w-1/3">
                <div class="border rounded-xl p-6">
                    <div class="font-semibold mb-4">Ringkasan Pembayaran</div>

                    <div class="space-y-2 text-sm text-slate-600 my-4">
                        <div class="flex justify-between">
                            <div>Total Harga</div>
                            <div>Rp{{ totalPrice.toLocaleString("id-ID") }}</div>
                        </div>
                        <div class="flex justify-between">
                            <div>Total Ongkos Kirim</div>
                            <div>Rp{{ (form.shipping_fee).toLocaleString("id-ID") }}</div>
                        </div>
                    </div>
                    <div class="border-t py-4 mb-4 flex justify-between font-semibold">
                        <div>Total Belanja</div>
                        <div>Rp{{ (form.total_payment).toLocaleString("id-ID") }}</div>
                    </div>
                    <button type="button" @click="createOrder" :disabled="!form.shipping_fee"
                        class="bg-lime-600 hover:bg-lime-700 disabled:bg-slate-200 disabled:text-slate-500 py-3 w-full rounded-full font-semibold text-white text-center">
                        Buat Pesanan
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import UserLayout from '@/Layouts/UserLayout.vue'
import AddressList from '@/Pages/Addresses/List.vue'
import AddressCreate from '@/Pages/Addresses/Create.vue'
import { useForm } from '@inertiajs/vue3'

export default {
    data() {
        return {
            addressListOpen: false,
            addressCreateOpen: false,
            selectedAddress: this.mainAddress
        }
    },
    props: {
        addresses: Object,
        mainAddress: Object,
        carts: Object,
        totalPrice: Number,
        flash: Object
    },
    components: {
        AddressList, AddressCreate
    },
    methods: {
        openAddressList() {
            this.addressListOpen = true
        },
        closeAddressList(selectedAddress) {
            this.addressListOpen = false

            if (selectedAddress) {
                this.selectedAddress = selectedAddress
                this.form.address_id = selectedAddress.id
                this.updatePayment(selectedAddress)
            }
        },
        openAddressCreate() {
            this.addressListOpen = false
            this.addressCreateOpen = true
        },
        closeAddressCreate() {
            this.addressCreateOpen = false
            this.addressListOpen = true
        },
        createOrder() {
            this.form.post(route('orders.store'))
        },
        async updatePayment(address) {
            const response = await axios.get(route('shipping.tariff-check'), {
                params: {
                    district: address.district.name,
                    weight: this.$page.props.cartQuantity
                }
            });

            const content = JSON.parse(response.data.content);
            const shippingFee = parseInt(content[0].cost, 10);

            this.form.shipping_fee = shippingFee
            this.form.total_payment = shippingFee + this.totalPrice
        }
    },
    async mounted() {
        if (this.selectedAddress) {
            await this.updatePayment(this.selectedAddress)
        } else {
            this.openAddressCreate()
        }
    },
    setup(props) {
        const form = useForm({
            payment_type: '',
            address_id: props.mainAddress ? props.mainAddress.id : null,
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