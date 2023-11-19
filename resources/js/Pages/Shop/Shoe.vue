<template>
    <Head :title="shoe.name" />

    <Message v-if="this.$page.props.flash.message" :message="this.$page.props.flash.message" />

    <div class="px-0 xl:px-36 xl:pt-10">
        <div class="flex flex-col xl:flex-row gap-4 xl:gap-14">

            <div class="w-screen xl:w-1/2 xl:flex gap-4">
                <div class="relative overflow-x-auto xl:overflow-y-auto snap-x snap-mandatory border-b xl:border-0">
                    <div class="flex flex-row xl:flex-col xl:gap-2">
                        <img :src="photo.path" v-for="photo in shoe.photos" @click="selectPhoto(photo)"
                            class="snap-start rounded-lg xl:w-40 p-1 cursor-pointer"
                            :class="photo === selectedPhoto ? 'xl:bg-gray-100/60 xl:brightness-95 xl:border-0' : 'xl:border'">
                    </div>
                </div>

                <div class="hidden xl:block">
                    <img :src="selectedPhoto.path" class="border rounded-2xl p-4">
                </div>
            </div>

            <div class="flex-1 px-4 xl:px-0">
                <div class="mb-6">
                    <div class="font-medium xl:text-lg">{{ shoe.name }}</div>
                    <div class="text-zinc-600">{{ shoe.category.name }}</div>
                </div>

                <div class="border-b-[1.5px] border-slate-100 pb-6 mb-6">
                    <div class="font-semibold text-xl xl:text-3xl mb-2">
                        Rp{{ (shoe.is_discount ? shoe.discount_price : shoe.price).toLocaleString("id-ID") }}
                    </div>
                    <div v-if="shoe.is_discount" class="flex items-center gap-2">
                        <div class="font-semibold bg-rose-100 text-rose-600 rounded-md px-2 py-0.5 text-xs">
                            {{ shoe.discount }}%
                        </div>
                        <div class="text-slate-400 line-through">
                            Rp{{ shoe.price.toLocaleString("id-ID") }}
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <div class="font-medium mb-2">Pilih Warna</div>
                    <div class="grid grid-cols-2 xl:grid-cols-4 gap-3">
                        <div v-for="color in colors" @click="selectColorPhoto(color.id)">
                            <input :disabled="color.total_stock < 1" v-model="form.color_id" :id="'c' + color.id"
                                :value="color.id" type="radio" class="hidden peer" @change="updateSize">
                            <label :for="'c' + color.id"
                                class="border rounded-lg block text-center py-2 select-none cursor-pointer peer-checked:border-lime-600 peer-checked:text-lime-600 peer-disabled:cursor-not-allowed peer-disabled:ring-0 peer-disabled:bg-gray-100 peer-disabled:text-gray-400">
                                {{ color.name }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <div class="font-medium mb-2">Pilih Ukuran</div>
                    <div class="grid grid-cols-5 gap-3">
                        <div v-for="size in sizes">
                            <input :disabled="size.total_stock < 1 || sizeStock[size.id] < 1" v-model="form.size_id"
                                :id="'s' + size.id" :value="size.id" type="radio" class="hidden peer" @change="updateColor">
                            <label :for="'s' + size.id"
                                class="border rounded-lg block text-center py-2 select-none cursor-pointer peer-checked:border-lime-600 peer-checked:text-lime-600 peer-disabled:cursor-not-allowed peer-disabled:border-0 peer-disabled:bg-gray-100 peer-disabled:text-gray-400">
                                {{ size.name }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <div class="font-medium mb-2">Atur Jumlah</div>
                    <div class="w-fit">
                        <NumberInput v-model="form.quantity" :max="stock" />
                    </div>
                </div>

                <div class="mb-8 border-b pb-8">
                    <button type="button" @click="addCart"
                        class="rounded-full bg-lime-600 hover:bg-lime-700 py-3 font-medium text-white w-full">
                        Tambah ke keranjang
                    </button>
                </div>

                <div v-html="shoe.description" class="prose select-none"></div>
            </div>
        </div>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3'
import NumberInput from '@/Components/NumberInput/Default.vue';
import UserLayout from '@/Layouts/UserLayout.vue';
import { ChevronRightIcon } from '@heroicons/vue/20/solid';

export default {
    data() {
        return {
            selectedPhoto: this.shoe.photos[0],
            stock: this.totalStock,
            colorStock: [],
            sizeStock: [],
            initial: true,
        };
    },
    components: {
        NumberInput, ChevronRightIcon
    },
    props: {
        shoe: Object,
        stocks: Object,
        colors: Object,
        sizes: Object,
        totalStock: Number,
        color1: Number,
        size1: Number,
    },
    methods: {
        updateSize() {
            this.sizes.forEach(size => {
                console.log(size)
                this.sizeStock[size.id] = this.stocks[this.form.color_id][size.id]
            });

            if (this.initial) {
                this.initial = false
            } else {
                this.form.size_id = ''
            }

            this.stock = parseInt(this.colors.find(color => color.id === this.form.color_id)['total_stock'])
        },
        updateColor() {
            this.colors.forEach(color => {
                this.colorStock[color.id] = this.stocks[color.id][this.form.size_id]
            });

            if (this.form.color_id && this.form.size_id) {
                this.stock = this.stocks[this.form.color_id][this.form.size_id]
            } else {
                this.stock = parseInt(this.sizes.find(size => size.id === this.form.size_id)['total_stock'])
            }
        },
        selectPhoto(photo) {
            this.selectedPhoto = photo
        },
        selectColorPhoto(id) {
            const photo = this.shoe.photos.find(photo => photo.name === id)

            if (photo !== undefined) {
                this.selectedPhoto = photo
            }
        },
        addCart() {
            this.form.post(route('carts.store'), {
                preserveState: true,
                preserveScroll: true
            })
        }
    },
    mounted() {
        this.updateSize()
        this.selectColorPhoto(this.colors.filter(color => color.total_stock > 0)[0]['id'])
    },
    setup(props) {
        const form = useForm({
            shoe_id: props.shoe.id,
            color_id: props.color1,
            size_id: props.size1,
            quantity: 1
        })

        return { form }
    },
    layout: UserLayout
}
</script>

<style lang="scss" scoped></style>