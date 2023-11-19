<template>
    <div class="flex items-center border rounded-lg">
        <button v-if="form.quantity > 1" @click="decrement" type="button" class="p-3"
            :class="form.quantity === 1 ? 'text-slate-400 cursor-not-allowed' : 'text-lime-600'">
            <MinusIcon class="w-4 h-4" style="stroke-width: 3;" />
        </button>
        <button v-else @click="remove" type="button" class="p-3 text-lime-600">
            <TrashIcon class="w-4 h-4 stroke-2" />
        </button>
        <div class="text-center w-10">{{ form.quantity }}</div>
        <button @click="increment" type="button" class="p-3"
            :class="form.quantity === max ? 'text-slate-400 cursor-not-allowed' : 'text-lime-600'">
            <PlusIcon class="w-4 h-4" style="stroke-width: 3;" />
        </button>
    </div>
</template>

<script>
import { MinusIcon, PlusIcon, TrashIcon } from '@heroicons/vue/24/outline';
import { useForm } from '@inertiajs/vue3';

export default {
    components: {
        MinusIcon, PlusIcon,
        TrashIcon
    },
    props: {
        modelValue: Number,
        max: Number,
        id: Number
    },
    watch: {
        'form.quantity'() {
            this.form.put(route('carts.update', this.id), {
                preserveScroll: true
            })
            this.$emit('update:modelValue', this.form.quantity)
        }
    },
    methods: {
        decrement() {
            if (this.form.quantity > 1) {
                this.form.quantity--
            }
        },
        increment() {
            if (this.form.quantity < this.max) {
                this.form.quantity++
            }
        },
        remove() {
            this.$inertia.delete(route('carts.destroy', this.id))
        },
    },
    setup(props) {
        const form = useForm({
            quantity: props.modelValue
        })

        return { form }
    }
};
</script>

<style scoped></style>
