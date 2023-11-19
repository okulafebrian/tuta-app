<template>
    <TransitionRoot appear :show="isOpen" as="template" @after-leave="afterModalClosed">
        <Dialog as="div" @close="closeModal" class="relative z-10">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
                leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-black bg-opacity-50" />
            </TransitionChild>

            <div class="fixed inset-0 top-0">
                <div class="flex h-screen justify-center">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100" leave="duration-300 ease-out" leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95">
                        <DialogPanel
                            class="w-full xl:w-1/2 xl:rounded-2xl overflow-hidden flex flex-col xl:my-5 transform bg-white align-middle shadow-xl transition-all">
                            <DialogTitle class="flex justify-between items-center px-8 py-6">
                                <div class="text-xl xl:text-2xl font-semibold flex-1">
                                    Alamat Baru
                                </div>
                                <button type="button" @click="closeModal">
                                    <XMarkIcon class="w-6 h-6" />
                                </button>
                            </DialogTitle>
                            <div class="px-8 pb-6 overflow-y-auto">
                                <div class="mb-3">
                                    <div class="font-semibold text-sm mb-2">Nama Lengkap</div>
                                    <input v-model="form.name" @input="limitText('name', 30)" type="text"
                                        class="text-sm border-gray-300 rounded-md w-full">
                                    <div class="text-right text-xs text-gray-500 mt-1">
                                        {{ form.name.length }}/30
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <div class="font-semibold text-sm mb-2">Nomor HP</div>
                                    <input v-model="form.phone" @input="validateInput" type="text"
                                        placeholder="08xxxxxxxxxx" class="text-sm border-gray-300 rounded-md w-full">
                                </div>
                                <div class="mb-6">
                                    <div class="font-semibold text-sm mb-2">Provinsi</div>
                                    <select v-model="form.province_id" class="text-sm border-gray-300 rounded-md w-full">
                                        <option value="" disabled>Pilih Provinsi</option>
                                        <option v-for="province in provinces" :value="province.id">
                                            {{ province.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-6">
                                    <div class="font-semibold text-sm mb-2">Kota</div>
                                    <select v-model="form.city_id"
                                        class="text-sm border-gray-300 rounded-md w-full disabled:bg-slate-200"
                                        :disabled="!form.province_id">
                                        <option value="" disabled>Pilih Kota</option>
                                        <option v-for="city in cities" :value="city.id">
                                            {{ city.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-6">
                                    <div class="font-semibold text-sm mb-2">Kecamatan</div>
                                    <select v-model="form.district_id"
                                        class="text-sm border-gray-300 rounded-md w-full disabled:bg-slate-200"
                                        :disabled="!form.city_id">
                                        <option value="" disabled>Pilih Kecamatan</option>
                                        <option v-for="district in districts" :value="district.id">
                                            {{ district.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-6">
                                    <div class="font-semibold text-sm mb-2">Kode Pos</div>
                                    <select v-model="form.zip_code_id"
                                        class="text-sm border-gray-300 rounded-md w-full disabled:bg-slate-200"
                                        :disabled="!form.district_id">
                                        <option value="" disabled>Pilih Kode Pos</option>
                                        <option v-for="zipCode in zipCodes" :value="zipCode.id">
                                            {{ zipCode.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <div class="font-semibold text-sm mb-2">Alamat Lengkap</div>
                                    <textarea rows="3" v-model="form.detail" @input="limitText('detail', 200)"
                                        class="text-sm border-gray-300 rounded-md w-full resize-none"></textarea>
                                    <div class="text-right text-xs text-gray-500">
                                        {{ form.detail.length }}/200
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <input id="set-main" type="checkbox" v-model="form.is_main"
                                        :disabled="!this.$page.props.auth.user.main_address"
                                        class="w-4 h-4 text-lime-600 bg-gray-100 border-gray-300 rounded focus:ring-lime-500 disabled:text-lime-600/50">
                                    <label for="set-main" class="ml-3 font-medium select-none">
                                        Jadikan alamat utama
                                    </label>
                                </div>
                            </div>
                            <div class="px-8 py-6 bg-white text-end">
                                <button type="button" @click="closeModal"
                                    class="px-6 py-2 text-lime-700 hover:text-lime-600 font-semibold">
                                    Batal
                                </button>
                                <button type="button" @click="addAddress"
                                    class="px-6 py-2 rounded-full bg-lime-600 hover:bg-lime-700 font-medium text-white">
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
import { useForm, usePage } from '@inertiajs/vue3';

export default {
    data() {
        return {
            cities: '',
            districts: '',
            zipCodes: '',
        }
    },
    components: {
        TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle,
        XMarkIcon
    },
    props: {
        isOpen: Boolean,
        provinces: Object,
    },
    methods: {
        limitText(field, limit) {
            if (this.address[field].length > limit) {
                this.address[field] = this.address[field].slice(0, limit);
            }
        },
        validateInput() {
            this.form.phone = this.form.phone.replace(/[^0-9]/g, '');

            if (this.form.phone.length > 15) {
                this.form.phone = this.form.phone.slice(0, 15);
            }
        },
        afterModalClosed() {
            this.form.reset();
        },
        closeModal() {
            this.$emit('closeModal')
        },
        addAddress() {
            this.form.post(route('addresses.store'), {
                onSuccess: () => this.closeModal(),
                preserveState: false
            });
        },
    },
    watch: {
        'form.province_id'() {
            if (this.form.province_id) {
                axios.get(route('cities.load', this.form.province_id))
                    .then(response => this.cities = response.data.cities)
            }

            this.form.city_id = ''
        },
        'form.city_id'() {
            if (this.form.city_id) {
                axios.get(route('districts.load', this.form.city_id))
                    .then(response => this.districts = response.data.districts)
            }

            this.form.district_id = ''
        },
        'form.district_id'() {
            if (this.form.district_id) {
                axios.get(route('zip-codes.load', this.form.district_id))
                    .then(response => this.zipCodes = response.data.zipCodes)
            }

            this.form.zip_code_id = ''
        },
    },
    setup() {
        const form = useForm({
            name: '',
            phone: '',
            province_id: '',
            city_id: '',
            district_id: '',
            zip_code_id: '',
            detail: '',
            is_main: !usePage().props.auth.user.main_address ?? true,
        })

        return { form }
    }
}
</script>

<style lang="scss" scoped></style>