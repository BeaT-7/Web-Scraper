<template>
    <Layout class="body">
        <DataViewComponent :data="scrapedData" />
    </Layout>
</template>

<script setup>
    import Layout from '../Layouts/BaseLayout.vue'
    import DataViewComponent from '../Components/DataViewComponent.vue';

    const {
        scrapedData
    } = defineProps(['scrapedData']);

</script>

<style scoped>
    .body {
        height: auto;
    }
</style>
