<template>
    <div class="relative w-full border border-solid border-gray-200 rounded overflow-hidden"
        @mouseover="showButton = true; addBrightness()" @mouseout="showButton = false; removeBrightness()">
        <img :src="source" :class="brightness">
        <button v-show="showButton" @click="removePhoto"
            class="absolute inset-x-0 bottom-0 bg-white hover:bg-gray-100 font-semibold text-xs rounded shadow m-2 py-1">
            Hapus
        </button>
    </div>
</template>

<script>

export default {
    data() {
        return {
            showButton: false,
            brightness: ''
        }
    },
    props: {
        source: String
    },
    methods: {
        removePhoto() {
            this.$emit('removePhoto')
        },
        addBrightness() {
            this.brightness = 'brightness-75'
        },
        removeBrightness() {
            this.brightness = ''
        }
    }
}
</script>

<style lang="scss" scoped></style>