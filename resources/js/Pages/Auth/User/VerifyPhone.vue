<template>
    <Head title="Verifikasi OTP" />

    <div class="xl:w-[30%] mx-4 xl:mx-auto">
        <div class="flex justify-center py-10">
            <Link :href="route('home')">
            <Logo class="h-10" />
            </Link>
        </div>

        <div class="xl:px-8 xl:py-12 xl:border xl:rounded-xl">
            <div class="text-center mb-8">
                <div class="text-xl font-semibold mb-2">
                    Masukkan Kode Verifikasi
                </div>
                <div class="text-sm">
                    Kode verifikasi telah dikirim melalui WhatsApp ke {{ $page.props.auth.user.phone }}.
                </div>
            </div>

            <form @submit.prevent="verify">
                <input v-model="form.code" @input="enforceFourDigits" type="text"
                    class="border-gray-300 rounded-lg w-full text-center text-3xl font-semibold mb-8"
                    style="letter-spacing: 0.5rem;" autofocus required>

                <button type="submit" class="py-3 rounded-full bg-lime-600 w-full font-semibold"
                    :disabled="form.processing || isDisabled"
                    :class="form.processing || isDisabled ? 'bg-slate-200 text-slate-400' : 'text-white'">
                    Konfirmasi
                </button>
            </form>

            <div class="mt-8 text-center text-sm">
                Tidak menerima kode OTP?
                <Link :href="route('verification-phone.send')" class="text-lime-600 font-semibold">Kirim Ulang</Link>
            </div>
        </div>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3';
import UserLayout from '@/Layouts/UserLayout.vue';

export default {
    data() {
        return {
            success: this.$page.props.flash.success,
            isDisabled: true
        }
    },
    methods: {
        enforceFourDigits() {
            this.form.code = this.form.code.replace(/\D/g, '');

            if (this.form.code.length > 6) {
                this.form.code = this.form.code.slice(0, 6);
            }
        },
        verify() {
            this.form.post(route('verification-phone.verify'), {
                preserveState: false
            })
        }
    },
    watch: {
        'form.code'() {
            this.isDisabled = this.form.code.length < 4 ?? false
        }
    },
    setup() {
        const form = useForm({
            code: ''
        });

        return { form }
    },
}




</script>
