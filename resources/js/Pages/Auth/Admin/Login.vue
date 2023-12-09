<template>
    <Head title="Masuk" />

    <div class="xl:w-[30%] mx-4 xl:mx-auto">
        <div class="flex justify-center py-10">
            <Link :href="route('home')">
            <Logo class="h-10" />
            </Link>
        </div>

        <div class="xl:px-8 xl:py-12 xl:border xl:rounded-xl">
            <div class="text-2xl text-center font-semibold mb-8">Login Admin</div>

            <form @submit.prevent="submit">
                <div class="mb-6">
                    <div class="text-sm font-medium mb-2">Email</div>
                    <input id="email" type="email" class="w-full text-sm rounded-md border-gray-300" v-model="form.email"
                        required />
                    <div class="mt-2 text-sm text-red-500">{{ form.errors.email }}</div>
                </div>

                <div class="mb-8">
                    <div class="text-sm font-medium mb-2">Password</div>
                    <input id="password" type="password" class="w-full text-sm rounded-md border-gray-300"
                        v-model="form.password" required />
                    <div class="mt-2 text-sm text-red-500">{{ form.errors.password }}</div>
                </div>

                <button type="submit" :disabled="form.processing"
                    class="py-3 rounded-full bg-lime-600 hover:bg-lime-700 text-white w-full font-medium disabled:bg-slate-300 disabled:text-slate-500">
                    Masuk
                </button>
            </form>
        </div>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3';

export default {
    props: {
        canResetPassword: {
            type: Boolean,
        },
        status: {
            type: String,
        },
    },
    setup() {
        const form = useForm({
            email: '',
            password: '',
            remember: false,
        });

        const submit = () => {
            form.post(route('admin.login'), {
                onFinish: () => form.reset('password'),
            });
        };

        return { form, submit }
    },
}
</script>

