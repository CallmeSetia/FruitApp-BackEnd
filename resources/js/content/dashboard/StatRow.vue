<script>
import Stat from "../../components/common/stat.vue";
export default {
    components: {Stat},

    data() {
        return {
            statData: [
                {
                    icon: "bx bx-copy-alt",
                    title: "Total User Customer",
                    value: "1,235",
                },
                {
                    icon: "bx bx-copy-alt",
                    title: "Total Hutang Customer",
                    value: "1,235",
                },
                {
                    icon: "bx bx-archive-in",
                    title: "Kas Besar",
                    value: "Rp 0",
                },
                {
                    icon: "bx bx-purchase-tag-alt",
                    title: "Kas Kecil",
                    value: "Rp 0",
                },
            ],
            loading: false,
        }
    }
};
</script>

<template>
    <b-row>
        <b-col v-for="stat of statData" :key="stat.icon">
            <Stat
                :icon="stat.icon"
                :title="stat.title"
                :value="stat.value"
                :loading="loading"
            />
        </b-col>
    </b-row>
</template>

<style scoped lang="scss">

</style>
