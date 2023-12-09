<template>
    <Head title="Edit Produk" />

    <div class="w-3/4 mx-auto pt-6 pb-12">
        <div class="text-xl font-semibold mb-6">Edit Produk</div>

        <div class="p-8 bg-white rounded shadow space-y-6 mb-6">
            <div class="text-sm flex gap-10 items-top">
                <div class="w-[20%]">
                    <div class="font-medium mb-2">Foto Produk</div>
                    <div class="text-xs text-zinc-500">
                        Format gambar .jpg .jpeg .png dan rasio 1:1 (persegi).
                    </div>
                </div>
                <div class="flex-1 grid grid-cols-5 gap-2">
                    <div v-for="(photo, index) in form.main_photos" :key="index">
                        <ImagePreview v-if="photo" :source="photo.url" @removePhoto="removeMainPhoto(index)" />

                        <label v-else :for="'mainPhotos' + index"
                            class="h-full flex flex-col items-center justify-center cursor-pointer">
                            <div
                                class="w-full aspect-square flex flex-col gap-2 items-center justify-center rounded border border-dashed border-gray-300 hover:border-lime-600  text-zinc-500 hover:text-lime-600 overflow-hidden">
                                <PhotoIcon class="w-8 h-8" />
                                <div class="text-xs select-none">Foto {{ index == 0 ? 'Sampul' : '(' + index + '/5)' }}
                                </div>
                            </div>
                            <input :id="'mainPhotos' + index" type="file" class="hidden" @change="uploadMainPhoto(index)" />
                        </label>
                    </div>
                </div>
            </div>

            <div class="text-sm flex items-center gap-10">
                <div class="w-[20%] font-medium">Nama Produk</div>
                <input v-model="form.name" type="text" class="flex-1 text-sm border-gray-200 rounded-md">
            </div>

            <div class="text-sm flex items-center gap-10">
                <div class="w-[20%] font-medium">Kategori Produk</div>
                <select v-model="form.category" class="text-sm border-gray-200 rounded-md flex-1">
                    <option disabled value="">Pilih kategori</option>
                    <option v-for="category in categories" :value="category">
                        {{ category.name }}
                    </option>
                </select>
            </div>

            <div class="text-sm flex items-center gap-10">
                <div class="w-[20%] font-medium">Harga</div>
                <div class="flex-1 flex items-center border border-gray-200 bg-gray-100 rounded-md overflow-hidden w-fit">
                    <div class="text-sm text-gray-500 font-semibold px-3">Rp</div>
                    <input type="text" class="text-sm border-0 focus:ring-0 w-full" v-model="form.price"
                        @input="formattedPrice">
                </div>
            </div>

            <div class="text-sm flex items-top gap-10">
                <div class="w-[20%] font-medium">Deskripsi Produk</div>
                <Editor v-model="form.description" class="flex-1" />
            </div>

            <div class="text-sm flex items-top gap-10">
                <div class="w-[20%] font-medium text-sm">Warna</div>
                <div class="flex-1 grid grid-cols-7 gap-y-4">
                    <div v-for="(color, index) in colors" :key="color" class="flex items-center">
                        <input v-model="form.colors" :value="color" :id="'color' + color.id" type="checkbox"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-200 rounded focus:ring-blue-500">
                        <label :for="'color' + color.id" class="ml-2 text-sm">{{ color.name }}</label>
                    </div>
                </div>
            </div>

            <div class="flex items-top gap-10">
                <div class="w-[20%] font-medium text-sm">Variasi Produk</div>
                <div class="flex-1 border divide-y text-sm rounded-sm">
                    <div class="flex divide-x font-medium">
                        <div class="w-[30%] px-4 py-2">Foto Produk</div>
                        <div class="w-[30%] px-4 py-2">Warna</div>
                        <div class="w-[20%] font-medium px-4 py-2">Ukuran</div>
                        <div class="w-[20%] font-medium px-4 py-2">Stok</div>
                    </div>
                    <div v-for="(color, index) in form.colors" class="flex divide-x">
                        <div class="w-[30%] flex justify-center items-center">
                            <div v-if="form.variant_photos[index]" :key="index" class="flex justify-center h-28 w-28">
                                <ImagePreview :source="form.variant_photos[index].url"
                                    @removePhoto="removeVariantPhoto(color.id)" />
                            </div>
                            <label v-else :for="'variant_photos' + color.id"
                                class="flex flex-col items-center cursor-pointer">
                                <div
                                    class="h-28 w-28 flex flex-col gap-2 items-center justify-center rounded-md border border-dashed border-gray-300 hover:border-lime-600  text-zinc-500 hover:text-lime-600 overflow-hidden">
                                    <PhotoIcon class="w-8 h-8" />
                                    <div class="text-xs select-none">Tambah Foto</div>
                                </div>
                                <input :id="'variant_photos' + color.id" type="file" class="hidden"
                                    @change="uploadVariantPhoto(color.id)" />
                            </label>
                        </div>
                        <div class=" w-[30%] flex items-center px-4">
                            {{ color.name }}
                        </div>
                        <div class="w-[20%] divide-y">
                            <div v-for="size in sizes" class="px-4 py-2">{{ size.name }}</div>
                        </div>
                        <div class="w-[20%] divide-y">
                            <div v-for="size in sizes">
                                <input type="number" class="w-full text-sm border-0 px-4"
                                    v-model="form.stocks[color.id][size.id]">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3 text-sm font-medium">
            <div>
                <Link :href="route('products.index')" class="block border bg-white py-2 px-10 rounded">
                Batal
                </Link>
            </div>
            <div>
                <button type="button" @click="updateShoe"
                    class="bg-lime-600 hover:bg-lime-700 text-white py-2 px-10 rounded">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { useForm } from "@inertiajs/vue3"
import { PhotoIcon } from '@heroicons/vue/24/outline'
import Editor from "@/Components/Editor.vue"
import ImagePreview from '@/Components/ImagePreview.vue'


export default {
    data() {
        return {
            urlMainPhotos: [],
            urlVariantPhotos: []
        }
    },
    components: {
        Editor,
        PhotoIcon,
        ImagePreview
    },
    props: {
        product: Object,
        categories: Object,
        colors: Object,
        sizes: Object,
        stocks: Object
    },
    watch: {
        'form.colors'() {
            this.initializeVariant()
        }
    },
    methods: {
        formattedPrice() {
            let inputValue = this.form.price.replace(/\D/g, "");

            inputValue = inputValue.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

            this.form.price = inputValue;
        },
        initializeVariant() {
            for (const key in this.form.colors) {
                let color = this.form.colors[key]

                if (!this.form.variant_photos[color]) {
                    this.form.variant_photos[color] = ''
                }

                if (!this.form.stocks[color.id]) {
                    this.form.stocks[color.id] = {}
                }

                for (const key in this.sizes) {
                    let size = this.sizes[key]

                    if (!this.form.stocks[color.id][size.id]) {
                        this.form.stocks[color.id][size.id] = 0
                    }
                }
            }
        },
        uploadMainPhoto(index) {
            this.form.main_photos[index] = event.target.files[0]
            this.urlMainPhotos[index] = URL.createObjectURL(event.target.files[0])

            if (index < 4) {
                this.form.main_photos.push('')
            }
        },
        uploadVariantPhoto(index) {
            this.form.variant_photos[index] = event.target.files[0]
            this.urlVariantPhotos[index] = URL.createObjectURL(event.target.files[0])
        },
        removeMainPhoto(index) {
            this.form.main_photos.splice(index, 1)
            this.urlMainPhotos.splice(index, 1)

            if (this.form.main_photos.length === 0 || this.form.main_photos[this.form.main_photos.length - 1] !== '') {
                this.form.main_photos.push('')
            }
        },
        removeVariantPhoto(index) {
            this.form.variant_photos[index] = '';
            this.urlVariantPhotos[index] = '';
        },
        updateShoe() {
            this.form.price = this.form.price.replace(/\D/g, '')
            this.form.post(route('products.update', this.product), {
                preserveScroll: true
            })
        },
    },
    created() {
        this.initializeVariant()

        if (this.form.main_photos.length < 5) {
            this.form.main_photos.push('')
        }
    },
    setup(props) {
        const form = useForm({
            _method: 'put',
            main_photos: [''],
            category: "",
            name: "",
            price: "",
            description: "",
            colors: [],
            variant_photos: [''],
            stocks: {}
        })

        const product = props.product

        form.main_photos = product.main_photos
        form.category = product.category
        form.name = product.name
        form.price = product.price.toLocaleString("id-ID")
        form.description = product.description
        form.variant_photos = product.variant_photos
        form.stocks = props.stocks

        product.colors.forEach((color, i) => {
            form.colors[i] = color
        });

        return { form }
    },
    layout: AdminLayout
}
</script>

<style lang="scss" scoped></style>