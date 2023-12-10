<template>
    <TransitionRoot appear :show="isOpen" as="template">
        <Dialog as="div" class="relative z-10">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
                leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-black bg-opacity-50" />
            </TransitionChild>

            <div class="fixed inset-0 top-0 overflow-y-auto">
                <div class="flex justify-center">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100" leave="duration-300 ease-out" leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95">
                        <DialogPanel
                            class="w-full xl:w-[45%] xl:rounded-md flex flex-col xl:my-6 transform bg-white align-middle shadow-xl transition-all px-4 xl:px-8 py-6">
                            <DialogTitle class="text-xl text-center font-bold">
                                Alamat Baru
                            </DialogTitle>
                            <div class="py-6">
                                <div class="mb-4">
                                    <div class="font-semibold text-sm mb-2">Nama Lengkap</div>
                                    <input v-model="form.name" @input="validateName(30)" type="text"
                                        class="text-sm border-gray-300 rounded-md w-full">
                                    <div class="text-right text-xs text-gray-500 mt-1">
                                        {{ form.name.length }}/30
                                    </div>
                                </div>
                                <div class="mb-8">
                                    <div class="font-semibold text-sm mb-2">Nomor HP</div>
                                    <input v-model="form.phone_number" @input="validatePhone" type="text"
                                        placeholder="08xxxxxxxxxx" class="text-sm border-gray-300 rounded-md w-full">
                                </div>
                                <div class="mb-8">
                                    <div class="font-semibold text-sm mb-2">Provinsi</div>
                                    <select v-model="form.province_id" class="text-sm border-gray-300 rounded-md w-full">
                                        <option value="" disabled>Pilih Provinsi</option>
                                        <option v-for="province in provinces" :value="province.id">
                                            {{ province.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-8">
                                    <div class="font-semibold text-sm mb-2">Kota</div>
                                    <select v-model="form.city_id"
                                        class="text-sm border-gray-300 rounded-md w-full disabled:bg-gray-200"
                                        :disabled="!form.province_id">
                                        <option value="" disabled>Pilih Kota</option>
                                        <option v-for="city in cities" :value="city.id">
                                            {{ city.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-8">
                                    <div class="font-semibold text-sm mb-2">Kecamatan</div>
                                    <select v-model="form.district_id"
                                        class="text-sm border-gray-300 rounded-md w-full disabled:bg-gray-200"
                                        :disabled="!form.city_id">
                                        <option value="" disabled>Pilih Kecamatan</option>
                                        <option v-for="district in districts" :value="district.id">
                                            {{ district.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-8">
                                    <div class="font-semibold text-sm mb-2">Kode Pos</div>
                                    <select v-model="form.zip_code_id"
                                        class="text-sm border-gray-300 rounded-md w-full disabled:bg-gray-200"
                                        :disabled="!form.district_id">
                                        <option value="" disabled>Pilih Kode Pos</option>
                                        <option v-for="zipCode in zipCodes" :value="zipCode.id">
                                            {{ zipCode.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <div class="font-semibold text-sm mb-2">Alamat Lengkap</div>
                                    <textarea rows="3" v-model="form.detail" @input="validateAddress(200)"
                                        class="text-sm border-gray-300 rounded-md w-full resize-none"></textarea>
                                    <div class="text-right text-xs text-gray-500">
                                        {{ form.detail.length }}/200
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <input id="set-main" type="checkbox" v-model="form.is_main" :disabled="!mainAddress"
                                        class="w-5 h-5 text-lime-600 bg-gray-100 border-gray-300 rounded focus:ring-lime-500 disabled:text-lime-600/50">
                                    <label for="set-main" class="ml-3 select-none">
                                        Jadikan alamat utama
                                    </label>
                                </div>
                            </div>
                            <div class="py-2 flex xl:justify-end gap-2">
                                <button v-if="mainAddress || $page.component !== 'Carts/Checkout'" type="button"
                                    @click="closeModal" class="px-8 py-2 rounded-full border font-semibold w-1/2 xl:w-auto">
                                    Batal
                                </button>
                                <button type="button" @click="addAddress" :disabled="!validateForm"
                                    class="px-8 py-2 rounded-full bg-lime-600 hover:bg-lime-700 disabled:bg-slate-200 disabled:text-slate-500 font-semibold text-white w-1/2 xl:w-auto">
                                    Simpan
                                </button>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script>
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'
import { XMarkIcon } from '@heroicons/vue/24/outline';
import { useForm } from '@inertiajs/vue3';

export default {
    data() {
        return {
            provinces: '',
            cities: '',
            districts: '',
            zipCodes: ''
        }
    },
    components: {
        TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle,
        XMarkIcon
    },
    props: {
        isOpen: Boolean,
        mainAddress: Object
    },
    methods: {
        validateName(limit) {
            if (this.form.name.length > limit) {
                this.form.name = this.form.name.slice(0, limit);
            }
        },
        validateAddress(limit) {
            if (this.form.detail.length > limit) {
                this.form.detail = this.form.detail.slice(0, limit);
            }
        },
        validatePhone() {
            this.form.phone_number = this.form.phone_number.replace(/[^0-9]/g, '');

            if (this.form.phone_number.length > 15) {
                this.form.phone_number = this.form.phone_number.slice(0, 15);
            }
        },
        closeModal() {
            this.$emit('closeModal')
        },
        addAddress() {
            this.form.post(route('addresses.store'), {
                onSuccess: () => {
                    this.closeModal(),
                        this.form.reset()
                }
            });
        },
    },
    computed: {
        validateForm() {
            return this.form.name !== '' && this.form.phone_number !== '' && this.form.province_id !== '' && this.form.city_id !== '' && this.form.district_id !== '' && this.form.zip_code_id !== '' && this.form.detail !== ''
        }
    },
    watch: {
        'form.province_id'() {
            if (this.form.province_id) {
                axios.get(route('cities.load', this.form.province_id))
                    .then(response => {
                        this.cities = response.data.cities.sort((a, b) => {
                            return a.name.localeCompare(b.name);
                        });
                    })
            }

            this.form.city_id = ''
        },
        'form.city_id'() {
            if (this.form.city_id) {
                axios.get(route('districts.load', this.form.city_id))
                    .then(response => {
                        this.districts = response.data.districts.sort((a, b) => {
                            return a.name.localeCompare(b.name);
                        });
                    })
            }

            this.form.district_id = ''
        },
        'form.district_id'() {
            if (this.form.district_id) {
                axios.get(route('zip-codes.load', this.form.district_id))
                    .then(response => {
                        this.zipCodes = response.data.zipCodes.sort((a, b) => {
                            return a.name.localeCompare(b.name);
                        });
                    })
            }

            this.form.zip_code_id = ''
        },
    },
    mounted() {
        axios.get(route('provinces.load'))
            .then(response => {
                this.provinces = response.data.provinces.sort((a, b) => {
                    return a.name.localeCompare(b.name);
                });
            })
    },
    setup(props) {
        const form = useForm({
            name: '',
            phone_number: '',
            province_id: '',
            city_id: '',
            district_id: '',
            zip_code_id: '',
            detail: '',
            is_main: props.mainAddress ? false : true
        })

        return { form }
    }
}
</script>

<style lang="scss" scoped></style>