<template>
    <div v-if="isOpen" class="fixed top-24 mx-4 xl:left-1/2 transform xl:-translate-x-1/2 -translate-y-1/2 z-50">
        <div class="flex items-center gap-20 px-4 py-3 text-[13px] rounded-lg text-white shadow"
            :class="message.type === 'failed' ? 'bg-rose-600' : 'bg-lime-600'">
            <div>{{ message.detail }}</div>
            <div>
                <button type="button" @click="close" class="font-bold">Ok</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isOpen: true
        }
    },
    props: {
        message: Object,
    },
    methods: {
        close() {
            this.isOpen = false
        }
    },
    mounted() {
        setTimeout(() => {
            this.isOpen = false
        }, 5000);
    }
}
</script>

<style lang="scss" scoped></style>