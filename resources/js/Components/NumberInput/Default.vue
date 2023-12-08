<template>
    <div class="flex items-center border rounded-lg">
        <button @click="decrement" type="button" class="p-1.5 m-1"
            :class="count === 1 ? 'text-slate-400 cursor-not-allowed' : 'text-lime-600 hover:bg-gray-100 rounded-md'">
            <MinusIcon class="w-4 h-4" style="stroke-width: 3;" />
        </button>
        <div class="text-sm text-center w-10">{{ count }}</div>
        <button @click="increment" type="button" class="p-1.5 m-1"
            :class="count === max ? 'text-slate-400 cursor-not-allowed' : 'text-lime-600 hover:bg-gray-100 rounded-md'">
            <PlusIcon class="w-4 h-4" style="stroke-width: 3;" />
        </button>
    </div>
</template>

<script>
import { MinusIcon, PlusIcon } from '@heroicons/vue/24/outline';

export default {
    data() {
        return {
            count: this.modelValue
        }
    },
    components: {
        MinusIcon, PlusIcon
    },
    props: {
        modelValue: Number,
        max: Number,
    },
    watch: {
        count() {
            this.$emit('update:modelValue', this.count)
        }
    },
    methods: {
        decrement() {
            if (this.count > 1) {
                this.count--
            }
        },
        increment() {
            if (this.count < this.max) {
                this.count++
            }
        }
    },
};
</script>

<style scoped></style>
