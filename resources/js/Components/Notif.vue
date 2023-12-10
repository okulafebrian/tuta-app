<template>
    <TransitionRoot :show="isOpen" enter="transition-opacity duration-300" enter-from="opacity-0" enter-to="opacity-100"
        leave="transition-opacity duration-300" leave-from="opacity-100" leave-to="opacity-0">
        <div
            class="xl:w-[40%] fixed top-24 left-0 right-0 mx-6 xl:mx-0 xl:left-1/2 transform xl:-translate-x-1/2 -translate-y-1/2 z-50">
            <div v-if="error" class="px-4 py-3 text-xs rounded-lg text-white shadow bg-red-600">
                {{ error }}
            </div>

            <div v-if="success" class="px-4 py-3 text-xs rounded-lg text-white shadow bg-gray-700">
                {{ success }}
            </div>
        </div>
    </TransitionRoot>
</template>

<script>
import { TransitionRoot } from '@headlessui/vue';

export default {
    data() {
        return {
            error: this.flash.error ?? '',
            success: this.flash.success ?? '',
            isOpen: this.flash.error || this.flash.success ? true : false
        };
    },
    props: {
        flash: Object
    },
    mounted() {
        setTimeout(() => {
            this.error = null;
            this.success = null;
        }, 2000);
    },
    components: { TransitionRoot }
}
</script>

<style lang="scss" scoped></style>