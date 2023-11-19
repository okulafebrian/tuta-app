<template>
    <Head title="Masuk" />

    <div class="xl:w-[30%] mx-4 xl:mx-auto">
        <div class="flex justify-center py-10">
            <Link :href="route('home')">
            <Logo class="h-10" />
            </Link>
        </div>

        <div class="xl:px-8 xl:py-12 xl:border xl:rounded-xl">
            <div class="text-2xl text-center font-semibold mb-8">Masuk</div>

            <form @submit.prevent="login">
                <div class="mb-8">
                    <div class="text-sm font-medium mb-2">Nomor HP</div>
                    <input v-model="form.phone" @input="validateInput" type="text"
                        class="border-gray-300 rounded-lg w-full text-sm" required>
                </div>

                <button type="submit"
                    class="py-3 rounded-full bg-lime-600 hover:bg-lime-700 text-white w-full font-semibold">
                    Lanjut
                </button>
            </form>

            <div class="mt-8 text-center text-sm">
                Belum punya akun?
                <Link :href="route('register')" class="text-lime-600 font-semibold">Daftar</Link>
            </div>
        </div>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3';
import { ExclamationCircleIcon } from '@heroicons/vue/24/outline';

export default {
    data() {
        return {
            isDisabled: true
        }
    },
    components: {
        ExclamationCircleIcon
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
        },
        login() {
            this.form.post(route('login'), {
                preserveState: false
            })
        }
    },
    setup() {
        const form = useForm({
            phone: ''
        });

        return { form }
    },
}
</script>

