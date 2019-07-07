<template>
<div>
    <div class="tabBar">
    <a-tabs @change="onTabChanged" type="card" :defaultActiveKey="(this.$route.path == '/investigation/entry') ? '2' : '1'">
        <a-tab-pane tab="Rekod Kes" key="1"></a-tab-pane>
        <a-tab-pane tab="Kes Baru" key="2"></a-tab-pane>
    </a-tabs>
    </div>
    <div class="containerView investigationBox">
        <router-view></router-view>
    </div>
</div>
</template>

<script>
export default {
    created() {
        console.log(this.$route.path);
    },
    methods: {
        onTabChanged (index) {
            if (index == 2) {
                this.$router.push('/investigation/entry');
            } else {
                this.$router.push('/investigation');
            }
        }
    }
}
</script>
<style>
.tabBar {
    height: 41px;
}

.investigationBox {
    background-color: #ffffff;
    padding: 15px;
}
</style>