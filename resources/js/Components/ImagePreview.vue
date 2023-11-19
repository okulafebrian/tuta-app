<template>
    <div class="relative h-24 w-24 border border-solid border-gray-200 rounded-md overflow-hidden hover:brightness-95"
        @mouseover="showButton = true" @mouseout="showButton = false">
        <img :src="source">
        <button v-show="showButton" @click="removePhoto"
            class="absolute bottom-0 right-0 bg-white text-zinc-500 rounded-md m-2 p-1">
            <TrashIcon class="w-5 h-5" />
        </button>
    </div>
</template>

<script>
import { TrashIcon } from '@heroicons/vue/20/solid'

export default {
    data() {
        return {
            showButton: false,
        }
    },
    props: {
        source: String
    },
    components: {
        TrashIcon
    },
    methods: {
        removePhoto() {
            this.$emit('removePhoto')
        }
    }
}
</script>

<style lang="scss" scoped></style>