<template>
<div>
    <div class="containerView investigationBox">
    <InvestigationEntry :editMode="true"/>
    </div>
</div>
</template>
<script>
import InvestigationEntry from './InvestigationEntry';

export default {
    components: {
        InvestigationEntry
    },
    data() {
        caseId: null
    },
    methods: {

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