<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Log in" />

    <div class="bg-gray-100 h-screen flex items-center">
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <div class="bg-white rounded-xl shadow-lg mx-auto p-10 w-1/3">
            <div class="mb-10">
                <Link :href="route('home')">
                <img src="/storage/assets/logo.png" class="w-auto h-10 mx-auto">
                </Link>
            </div>

            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="email" value="Email" />

                    <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus
                        autocomplete="username" />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password" value="Password" />

                    <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                        autocomplete="current-password" />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-8">
                    <button class="py-3 rounded-md bg-lime-500 hover:bg-lime-600 text-white w-full font-medium text-sm"
                        :disabled="form.processing" :class="{ 'opacity-25': form.processing }">
                        Log in
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
