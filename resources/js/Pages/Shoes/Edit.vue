<template>
    <Head title="Edit Produk" />

    <div class="h-full px-10 pt-8 pb-16 bg-gray-100 overflow-y-auto">
        <div class="text-xl font-semibold mb-6">Edit Produk</div>

        <div class="p-8 bg-white rounded-sm shadow-sm space-y-6 mb-4">
            <div class="text-sm flex gap-10 items-top">
                <div class="w-[20%] font-medium">
                    <div class="font-medium mb-2">Foto Produk</div>
                    <div class="text-xs text-zinc-500">
                        Format gambar .jpg .jpeg .png dan rasio 1:1 (persegi).
                    </div>
                </div>
                <div class="flex-1 flex gap-2">
                    <div v-for="(photo, index) in form.main_photos" :key="index">
                        <ImagePreview v-if="photo" :source="photo.url" @removePhoto="removePhoto(index, 'main')" />
                        <label v-else :for="'mainPhotos' + index"
                            class="flex flex-col items-center justify-center cursor-pointer">
                            <div
                                class="h-24 w-24 flex flex-col gap-2 items-center justify-center rounded-md border border-dashed border-gray-300 hover:border-lime-600  text-zinc-500 hover:text-lime-600 overflow-hidden">
                                <PhotoIcon class="w-8 h-8" />
                                <div class="text-xs">Foto {{ index == 0 ? 'Sampul' : '(' + index + '/5)' }}</div>
                            </div>
                            <input :id="'mainPhotos' + index" type="file" class="hidden"
                                @change="handleImageUpload(index, 'main')" />
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
                    <option v-for="category in categories" :value="category.id" :key="category.id">
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
                    <div v-for="color in colors" class="flex items-center">
                        <input v-model="form.colors" :value="color" :id="color.id" type="checkbox"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-200 rounded focus:ring-blue-500">
                        <label :for="color.id" class="ml-2 text-sm">{{ color.name }}</label>
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
                    <div v-for="color in form.colors" class="flex divide-x">
                        <div class="w-[30%] flex justify-center items-center">
                            <div v-if="form.variant_photos[color.id]" :key="color.id" class="flex justify-center">
                                <ImagePreview :source="form.variant_photos[color.id].url"
                                    @removePhoto="removePhoto(color.id, 'variant')" />
                            </div>
                            <label v-else :for="'variant_photos' + color.id"
                                class="flex flex-col items-center cursor-pointer">
                                <div
                                    class="h-24 w-24 flex flex-col gap-2 items-center justify-center rounded-md border border-dashed border-gray-300 hover:border-lime-600  text-zinc-500 hover:text-lime-600 overflow-hidden">
                                    <PhotoIcon class="w-8 h-8" />
                                    <div class="text-xs">Tambah Foto</div>
                                </div>
                                <input :id="'variant_photos' + color.id" type="file" class="hidden"
                                    @change="handleImageUpload(color.id, 'variant')" />
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

        <div class="flex justify-end gap-3 py-2 text-sm font-medium">
            <Link :href="route('shoes.index')" class="border bg-white py-2 px-10 rounded-sm">
            Batal
            </Link>
            <button type="button" @click="updateShoe"
                class="bg-lime-600 disabled:bg-lime-500/50 text-white py-2 px-10 rounded-sm">
                Simpan
            </button>
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
    components: {
        Editor,
        PhotoIcon,
        ImagePreview
    },
    props: {
        shoe: Object,
        categories: Object,
        colors: Object,
        sizes: Object,
        selectedColors: Object,
        stocks: Object,
        mainPhotos: Array,
        variantPhotos: Object,
    },
    watch: {
        'form.colors'() {
            this.initializeVariant()
        }
    },
    methods: {
        formattedPrice() {
            let inputValue = this.form.price.toString().replace(/\D/g, "");

            inputValue = inputValue.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

            this.form.price = inputValue;
        },
        initializeVariant() {
            for (const key in this.form.colors) {
                let color = this.form.colors[key]

                if (!this.form.variant_photos[color.id]) {
                    this.form.variant_photos[color.id] = ''
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
        handleImageUpload(index, type) {
            if (type === 'main') {
                this.form.main_photos[index] = {
                    'url': URL.createObjectURL(event.target.files[0]),
                    'item': event.target.files[0]
                }
            } else {
                this.form.variant_photos[index] = {
                    'url': URL.createObjectURL(event.target.files[0]),
                    'item': event.target.files[0]
                }
            }

            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader()
                reader.onload = (e) => {

                };
                reader.readAsDataURL(input.files[0])

                if (type === 'main' && this.form.main_photos.length < 5) {
                    this.form.main_photos.push('')
                }
            }
        },
        removePhoto(index, type) {
            if (type === 'main') {
                this.form.main_photos.splice(index, 1);

                if (this.form.main_photos.length === 0 || this.form.main_photos[this.form.main_photos.length - 1] !== '') {
                    this.form.main_photos.push('')
                }
            } else {
                this.form.variant_photos[index] = '';
            }
        },
        updateShoe() {
            this.form.price = this.form.price.replace(/\D/g, '')
            this.form.post(route('shoes.update', this.shoe), {
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
            main_photos: [],
            category: props.shoe.category_id,
            name: props.shoe.name,
            price: props.shoe.price.toLocaleString("id-ID"),
            description: props.shoe.description,
            colors: props.selectedColors.map(obj => ({
                id: obj.id,
                name: obj.name
            })),
            variant_photos: {},
            stocks: {}
        })

        props.mainPhotos.forEach((photo, index) => {
            form.main_photos[index] = {
                'url': '/storage/shoes/' + props.shoe.code + '/main/' + photo,
                'item': photo
            }
        });

        props.selectedColors.forEach(color => {
            form.variant_photos[color.id] = {
                'url': '/storage/shoes/' + props.shoe.code + '/' + props.variantPhotos[color.id],
                'item': props.variantPhotos[color.id]
            }

            form.stocks[color.id] = {}

            props.sizes.forEach(size => {
                form.stocks[color.id][size.id] = props.stocks[color.id][size.id]
            })
        });

        return { form }
    },
    layout: AdminLayout
}
</script>

<style lang="scss" scoped></style>