<template>
    <Head title="Daftar" />

    <div class="xl:w-[30%] mx-4 xl:mx-auto">
        <div class="flex justify-center py-10">
            <Link :href="route('home')">
            <Logo class="h-10" />
            </Link>
        </div>

        <div class="xl:px-8 xl:py-12 xl:border xl:rounded-xl xl:mb-20">
            <div class="text-2xl text-center font-semibold mb-8">Daftar</div>

            <form @submit.prevent="form.post(route('register'))">
                <div class="mb-6">
                    <div class="text-sm font-medium mb-2">Nama Depan</div>
                    <input v-model="form.first_name" type="text" class="border-gray-300 rounded-lg w-full text-sm" required>
                </div>
                <div class="mb-6">
                    <div class="text-sm font-medium mb-2">Nama Belakang</div>
                    <input v-model="form.last_name" type="text" class="border-gray-300 rounded-lg w-full text-sm">
                </div>
                <div class="mb-8">
                    <div class="text-sm font-medium mb-2">Nomor HP</div>
                    <input v-model="form.phone" @input="validateInput" type="text"
                        class="border-gray-300 rounded-lg w-full text-sm" required>
                    <div class="text-xs text-zinc-500 mt-2">Pastikan nomor HP terhubung ke WhatsApp</div>
                </div>

                <button type="submit" :disabled="form.processing"
                    class="py-3 rounded-full bg-lime-600 hover:bg-lime-700 text-white w-full font-semibold disabled:bg-slate-300 disabled:text-slate-500">
                    Lanjut
                </button>
            </form>

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
    methods: {
        validateInput() {
            this.form.phone = this.form.phone.replace(/[^0-9]/g, '');

            if (this.form.phone.length > 7 && !isNaN(this.form.phone)) {
                this.isDisabled = false
            } else {
                this.isDisabled = true
            }

            if (this.form.phone.length > 15) {
                this.form.phone = this.form.phone.slice(0, 15);
            }
        }
    },
    setup() {
        const form = useForm({
            first_name: '',
            last_name: '',
            phone: ''
        });

        return { form }
    },
}

</script>
