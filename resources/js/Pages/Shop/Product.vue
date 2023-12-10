<template>
    <Head :title="product.name" />

    <Notif v-if="flash.error || flash.success" :flash="flash" />

    <div class="px-0 xl:px-36 xl:pt-10 pb-10">
        <div class="flex flex-col xl:flex-row gap-4 xl:gap-14">

            <div class="w-screen xl:w-1/2 xl:flex gap-4">
                <div class="relative overflow-x-auto xl:overflow-y-auto snap-x snap-mandatory border-b xl:border-0">
                    <div class="flex flex-row xl:flex-col xl:gap-2">
                        <img v-for="photo in product.photos" :src="photo.url" @click="selectPhoto(photo)"
                            class="snap-start rounded-lg xl:w-40 p-1 cursor-pointer"
                            :class="photo.name === selectedPhoto.name ? 'xl:bg-gray-100/60 xl:brightness-95 xl:border-0' : 'xl:border'">
                    </div>
                </div>

                <div class="hidden xl:block">
                    <img :src="selectedPhoto.url" class="border rounded-2xl p-4">
                </div>
            </div>

            <div class="flex-1 px-4 xl:px-0">
                <div class="mb-4">
                    <div class="font-semibold text-lg">{{ product.name }}</div>
                    <div class="text-sm">{{ product.category.name }}</div>
                </div>

                <div class="flex gap-2 xl:gap-3 text-2xl border-b pb-4 mb-4">
                    <div class="font-bold" :class="{ 'text-red-600': product.is_discount }">
                        Rp{{ (product.is_discount ? product.discount_price : product.price).toLocaleString("id-ID") }}
                    </div>
                    <div v-if="product.is_discount" class="text-slate-400 line-through">
                        Rp{{ product.price.toLocaleString("id-ID") }}
                    </div>
                </div>

                <div class="text-sm mb-4">
                    <div class="font-semibold mb-2">Pilih Warna</div>

                    <div class="grid grid-cols-2 xl:grid-cols-4 gap-3">
                        <div v-for="(color, index) in product.colors">
                            <input :id="'color' + color.id" v-model="form.color_id" :value="color.id"
                                :disabled="color.total_stock < 1" type="radio" class="hidden peer"
                                @change="selectColorPhoto(index)">
                            <label :for="'color' + color.id"
                                class="border rounded-lg block text-center py-2 select-none cursor-pointer peer-checked:border-lime-600 peer-checked:text-lime-600 peer-checked:bg-lime-100 peer-disabled:cursor-not-allowed peer-disabled:ring-0 peer-disabled:bg-gray-100 peer-disabled:text-gray-400">
                                {{ color.name }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="text-sm mb-4">
                    <div class="font-semibold mb-2">Pilih Ukuran</div>

                    <div class="grid grid-cols-5 gap-3">
                        <div v-for="size in product.sizes">
                            <input :id="'size' + size.id" v-model="form.size_id" :value="size.id"
                                :disabled="size.total_stock < 1 || sizeStock[size.id] < 1" type="radio" class="hidden peer">
                            <label :for="'size' + size.id"
                                class="border rounded-lg block text-center py-2 select-none cursor-pointer peer-checked:border-lime-600 peer-checked:text-lime-600 peer-checked:bg-lime-100 peer-disabled:cursor-not-allowed peer-disabled:border-0 peer-disabled:bg-gray-100 peer-disabled:text-gray-400">
                                {{ size.name }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <div class="text-sm font-semibold mb-2">Atur Jumlah</div>
                    <div class="w-fit">
                        <NumberInput v-model="form.quantity" :max="stock" />
                    </div>
                </div>

                <div class="border-b mb-6 pb-6">
                    <button type="button" @click="addCart" :disabled="!isFormComplete"
                        class="rounded-full bg-lime-600 hover:bg-lime-700 py-3 font-semibold text-white w-full disabled:cursor-not-allowed disabled:hover:bg-lime-600">
                        Tambah ke keranjang
                    </button>
                </div>

                <div v-html="product.description" class="prose select-none"></div>
            </div>
        </div>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3'
import NumberInput from '@/Components/NumberInput/Default.vue';
import UserLayout from '@/Layouts/UserLayout.vue';

export default {
    data() {
        return {
            selectedPhoto: this.product.photos[0],
            stock: this.product.stock,
            sizeStock: []
        };
    },
    components: {
        NumberInput
    },
    props: {
        product: Object,
        stocks: Object,
        flash: Object
    },
    methods: {
        selectPhoto(photo) {
            this.selectedPhoto = photo
        },
        selectColorPhoto(index) {
            this.selectedPhoto = this.product.variant_photos[index]
        },
        updateStock() {
            if (this.form.color_id && this.form.size_id) {
                this.stock = this.stocks[this.form.color_id][this.form.size_id]
            }
        },
        addCart() {
            this.form.post(route('carts.store'), {
                preserveState: false,
                preserveScroll: true
            })
        }
    },
    watch: {
        'form.color_id'() {
            this.updateStock()

            this.form.size_id = ''

            this.product.sizes.forEach(size => {
                this.sizeStock[size.id] = this.stocks[this.form.color_id][size.id]
            });
        },
        'form.size_id'() {
            this.updateStock()
        }
    },
    computed: {
        isFormComplete() {
            return Object.values(this.form).every(value => value !== '')
        }
    },
    mounted() {
        const color = this.product.colors.find(color => color.total_stock > 0)
        this.form.color_id = color.id
    },
    setup(props) {
        const form = useForm({
            product_id: props.product.id,
            color_id: '',
            size_id: '',
            quantity: 1
        })

        return { form }
    },
    layout: UserLayout
}
</script>

<style lang="scss" scoped></style>