<template>
    <div class="h-screen flex">
        <Sidebar />

        <div class="flex-grow h-full w-[85%]">
            <slot />
        </div>
    </div>
</template>

<script>
import Sidebar from '@/Components/Sidebar/Admin.vue';
import { CheckCircleIcon } from '@heroicons/vue/20/solid';

export default {
    data() {
        return {
            isOpen: false
        }
    },
    components: {
        Sidebar, CheckCircleIcon
    },
    createad() {
        return {
            message: this.$page.props.flash.message
        }
    }
}

</script>
