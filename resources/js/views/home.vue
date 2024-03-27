<script>
import Layout from "../layouts/main.vue";
import GrafikRow from "../content/dashboard/GrafikRow.vue";
import StatRow from "../content/dashboard/StatRow.vue";
/**
 * Dashboard Component
 */
export default {
    components: {Layout, GrafikRow,StatRow},
    data() {
        return {

        }
    }
};
</script>

<template>
    <Layout>
        <StatRow></StatRow>
        <GrafikRow></GrafikRow>
    </Layout>
</template>
