<script>
import GrafikKas from "../../components/common/grafik-kas.vue";

export default {
    components: {GrafikKas},

    data() {
        return {
            loading: false,
        }
    }
};
</script>

<template>
    <b-row>
        <b-col lg="6">
            <GrafikKas :updating="loading"/>
        </b-col>
        <b-col lg="6">
            <GrafikKas :updating="loading"/>
        </b-col>
    </b-row>
</template>

<style scoped lang="scss">

</style>
