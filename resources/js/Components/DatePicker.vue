<template>
    <div class="flex gap-2">
        <select v-model="day" @change="updateDate" class="py-1 rounded font-medium text-sm border border-gray-200">
            <option v-for="day in 31" :value="day">{{ day }}</option>
        </select>
        <select v-model="month" @change="updateDate" class="py-1 rounded font-medium text-sm border border-gray-200">
            <option v-for="month in months" :value="month.id">{{ month.name }}</option>
        </select>
        <select v-model="year" @change="updateDate" class="py-1 rounded font-medium text-sm border border-gray-200">
            <option v-for="year in years" :value="year">{{ year }}</option>
        </select>
    </div>
</template>

<script>

export default {
    data() {
        return {
            day: new Date().getDate(),
            month: new Date().getMonth() + 1,
            year: new Date().getFullYear(),
            months: [
                {
                    id: 1,
                    name: 'Januari'
                },
                {
                    id: 2,
                    name: 'Februari'
                },
                {
                    id: 3,
                    name: 'Maret'
                },
                {
                    id: 4,
                    name: 'April'
                },
                {
                    id: 5,
                    name: 'Mei'
                },
                {
                    id: 6,
                    name: 'Juni'
                },
                {
                    id: 7,
                    name: 'Juli'
                },
                {
                    id: 8,
                    name: 'Agustus'
                },
                {
                    id: 9,
                    name: 'September'
                },
                {
                    id: 10,
                    name: 'Oktober'
                },
                {
                    id: 11,
                    name: 'November'
                },
                {
                    id: 12,
                    name: 'Desember'
                }
            ]
        }
    },
    computed: {
        years() {
            const currentYear = new Date().getFullYear();
            const futureYears = 10;
            const yearArray = [];
            for (let i = 0; i <= futureYears; i++) {
                yearArray.push(currentYear + i);
            }
            return yearArray;
        }
    },
    methods: {
        updateDate() {
            const day = this.day
            const month = this.month
            const year = this.year

            this.$emit('updateDate', day, month, year)
        }
    }
}
</script>

<style lang="scss" scoped></style>