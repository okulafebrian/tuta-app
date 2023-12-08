<template>
    <Head title="Verifikasi OTP" />

    <Notif v-if="flash.error || flash.success" :flash="flash" />

    <div class="xl:w-[30%] mx-6 xl:mx-auto">
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
                    Kode verifikasi telah dikirim melalui WhatsApp ke {{ $page.props.auth.user.phone_number }}.
                </div>
            </div>

            <form @submit.prevent="verify">
                <input v-model="form.code" @input="enforceFourDigits" @keyup.enter="verify" type="text"
                    class="border-gray-300 rounded-lg w-full text-center text-3xl font-semibold mb-8"
                    style="letter-spacing: 0.5rem;" autofocus required>

                <button type="submit" class="py-3 rounded-full bg-lime-600 w-full font-semibold"
                    :disabled="form.processing || disableSubmit"
                    :class="form.processing || disableSubmit ? 'bg-slate-200 text-slate-400 cursor-not-allowed' : 'text-white'">
                    Konfirmasi
                </button>
            </form>

            <!-- <div class="mt-8 text-center text-sm">
                <div v-if="disableResend">
                    Mohon menunggu <span class="font-semibold">{{ counter }} detik</span> untuk mengirim ulang
                </div>
                <div v-else>
                    Tidak menerima kode OTP?
                    <button type="button" @click="resend" class="text-lime-600 font-semibold">
                        Kirim Ulang
                    </button>
                </div>
            </div> -->
        </div>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3';


export default {
    data() {
        return {
            disableSubmit: true,
            disableResend: true,
            // counter: null
        }
    },
    props: {
        flash: Object,
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
        },
        // resend() {
        //     this.$inertia.get(route('verification-phone.send'), {
        //         preserveState: false
        //     })

        //     if (this.auth.user.otp_requests_left > 0) {
        //         localStorage.removeItem('counter');
        //     }
        // },
        // startTimer() {
        //     const interval = setInterval(() => {
        //         this.counter--

        //         if (this.counter <= 0) {
        //             this.disableResend = false
        //             clearInterval(interval)
        //             localStorage.setItem('counter', 0)
        //         } else {
        //             localStorage.setItem('counter', this.counter)
        //         }
        //     }, 1000)
        // }
    },
    watch: {
        'form.code'() {
            this.disableSubmit = this.form.code.length < 6 ?? false
        }
    },
    // mounted() {
    //     this.counter = localStorage.getItem('counter') ?? 10

    //     if (this.counter <= 0) {
    //         this.disableResend = false
    //     } else {
    //         this.startTimer();
    //     }
    // },
    setup() {
        const form = useForm({
            code: ''
        });

        return { form }
    },
}




</script>
