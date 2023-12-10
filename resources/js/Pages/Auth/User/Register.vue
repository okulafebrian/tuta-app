<template>
    <Head title="Daftar" />

    <Notif v-if="flash.error || flash.success" :flash="flash" />

    <div class="xl:w-[30%] mx-6 xl:mx-auto">
        <div class="flex justify-center py-10">
            <Link :href="route('home')">
            <Logo class="h-10" />
            </Link>
        </div>

        <div class="xl:px-8 xl:py-12 xl:border xl:rounded-xl xl:mb-20">
            <div class="text-2xl text-center font-semibold mb-8">Daftar</div>

            <div>
                <div class="mb-6">
                    <div class="text-sm font-medium mb-2">Nama Lengkap</div>
                    <input v-model="form.name" @input="validateName" type="text"
                        class="border-gray-300 rounded-lg w-full text-sm" placeholder="Nama Depan & Nama Belakang">
                </div>
                <div class="mb-8">
                    <div class="text-sm font-medium mb-2">Nomor HP</div>
                    <input v-model="form.phone_number" @input="validatePhone" type="text"
                        class="border-gray-300 rounded-lg w-full text-sm" placeholder="08xxxxxxxxxx">
                    <div class="text-xs text-zinc-500 mt-2">Pastikan nomor HP terhubung ke WhatsApp</div>
                </div>

                <button type="button" @click="register" :disabled="form.processing"
                    class="py-3 rounded-full bg-lime-600 hover:bg-lime-700 text-white w-full font-semibold disabled:bg-slate-300 disabled:text-slate-500">
                    Lanjut
                </button>
            </div>

            <div class="mt-8 text-center text-sm">
                Sudah punya akun?
                <Link :href="route('login')" class="text-lime-600 font-semibold">Login</Link>
            </div>
        </div>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3';

export default {
    data() {
        return {
            isDisabled: true
        }
    },
    props: {
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

            if (this.form.phone_number.length > 7 && !isNaN(this.form.phone_number)) {
                this.isDisabled = false
            } else {
                this.isDisabled = true
            }

            if (this.form.phone_number.length > 15) {
                this.form.phone_number = this.form.phone_number.slice(0, 15);
            }
        },
        register() {
            this.form.post(route('register'), {
                preserveState: false
            })
        }
    },
    setup() {
        const form = useForm({
            name: '',
            phone_number: ''
        });

        return { form }
    },
}

</script>
