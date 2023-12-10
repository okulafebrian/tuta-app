<template>
    <Head title="Biodata Diri" />

    <Notif v-if="flash.error || flash.success" :flash="flash" />

    <div class="xl:px-36 py-10 flex flex-col xl:flex-row xl:gap-20">
        <Sidebar />

        <div class="flex-1 p-4 xl:p-0">
            <div class="hidden xl:block text-xl font-semibold mb-6">Biodata Diri</div>

            <div class="flex justify-between items-center rounded-2xl p-4 xl:p-6 mb-4"
                :class="showEditName ? 'bg-gray-100' : 'border'">
                <div class="text-sm w-full">
                    <div class="font-semibold mb-1">Nama Lengkap</div>
                    <div v-if="showEditName" class="flex flex-col xl:flex-row xl:items-center justify-between gap-4">
                        <input type="text" v-model="form.name" @input="validateName"
                            placeholder="Nama Depan & Nama Belakang" class="border-gray-300 rounded-lg text-sm">
                        <div class="flex gap-3">
                            <button type="button" @click="showEditName = false"
                                class="border border-gray-300 bg-white rounded-full px-6 py-2 font-semibold text-sm w-1/2 xl:w-auto">
                                Batal
                            </button>
                            <button type="button" @click="updateName" :disabled="disableUpdateName"
                                class="bg-lime-600 hover:bg-lime-700 disabled:bg-slate-300 disabled:text-slate-500 text-white rounded-full px-4 py-2 font-semibold text-sm w-1/2 xl:w-auto">
                                Simpan
                            </button>
                        </div>
                    </div>
                    <div v-else>{{ auth.user.name }}</div>
                </div>
                <button v-if="!showEditName" type="button" @click="showEditName = true"
                    class="text-sm font-semibold text-lime-600 hover:text-lime-700 p-2">
                    Edit
                </button>
            </div>

            <div class="flex justify-between items-center rounded-2xl p-4 xl:p-6 mb-4"
                :class="showEditPhone ? 'bg-gray-100' : 'border'">
                <div class="text-sm w-full">
                    <div class="font-semibold mb-1">Nomor HP</div>
                    <div v-if="showEditPhone" class="flex flex-col xl:flex-row xl:items-center justify-between gap-4">
                        <div class="flex gap-3">
                            <input type="text" v-model="form.phone_number" @input="validatePhone"
                                class="border-gray-300 rounded-lg text-sm w-full xl:w-auto" required>
                        </div>
                        <div class="flex gap-2">
                            <button type="button" @click="showEditPhone = false"
                                class="border border-gray-300 bg-white rounded-full px-6 py-2 font-semibold text-sm w-1/2 xl:w-auto">
                                Batal
                            </button>
                            <button type="button" @click="updatePhone" :disabled="disableUpdateName"
                                class="bg-lime-600 hover:bg-lime-700 disabled:bg-slate-300 disabled:text-slate-500 text-white rounded-full px-4 py-2 font-semibold text-sm w-1/2 xl:w-auto">
                                Simpan
                            </button>
                        </div>
                    </div>
                    <div v-else>{{ auth.user.phone_number }}</div>
                </div>
                <button v-if="!showEditPhone && allowUpdatePhone" type="button" @click="showEditPhone = true"
                    class="text-sm font-semibold text-lime-600 hover:text-lime-700 p-2">
                    Edit
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import UserLayout from '@/Layouts/UserLayout.vue';
import Sidebar from '@/Components/Sidebar/Account.vue';
import { useForm } from '@inertiajs/vue3';

export default {
    data() {
        return {
            showEditName: false,
            showEditPhone: false,
            disableUpdateName: true,
            disableUpdatePhone: true
        }
    },
    components: {
        Sidebar
    },
    props: {
        auth: Object,
        flash: Object
    },
    methods: {
        validateName() {
            if (this.form.name.length > 30) {
                this.form.name = this.form.name.slice(0, 30);
            }
        },
        validatePhone() {
            this.form.phone_number = this.form.phone_number.replace(/[^0-9]/g, '');

            if (this.form.phone_number.length > 15) {
                this.form.phone_number = this.form.phone_number.slice(0, 15);
            }
        },
        updateName() {
            this.form.post(route('account.update-name', this.auth.user), {
                preserveState: false
            })
        },
        updatePhone() {
            this.form.post(route('account.update-phone', this.auth.user), {
                preserveState: false
            })
        },
    },
    computed: {
        allowUpdatePhone() {
            const phoneLastUpdateDate = new Date(this.auth.user.phone_last_update_date)
            const now = new Date()

            const monthsDifference = Math.abs((now.getFullYear() - phoneLastUpdateDate.getFullYear()) * 12 +
                (now.getMonth() - phoneLastUpdateDate.getMonth()))

            return monthsDifference >= 2;
        }
    },
    watch: {
        'form.name'() {
            this.disableUpdateName = false
        },
        'form.phone_number'() {
            this.disableUpdatePhone = false
        }
    },
    setup(props) {
        const form = useForm({
            _method: 'put',
            name: props.auth.user.name,
            phone_number: props.auth.user.phone_number
        })

        return { form }
    },
    layout: UserLayout
}
</script>

<style lang="scss" scoped></style>