<template>
<div>
    <a-layout :style="{ minHeight:'100vh'}">
        <a-layout-header>
            <div class="logo">

                <div class="headerLogo"><a-icon type="radar-chart" style="fontSize:30px;color:#1890ff;vertical-align:middle;" />&nbsp;&nbsp;&nbsp;CUSTOMS TARGETING & ANTI CRIME CENTRE</div>
                <a-menu
                    theme="dark"
                    mode="horizontal"
                    :defaultSelectedKeys="['1']"
                    :style="{ lineHeight: '64px', float: 'right'}"
                >
                    <a-menu-item key="1"><router-link to="/investigation">Investigations</router-link></a-menu-item>
                    <!--
                    <a-menu-item key="2"><router-link to="/users">Users</router-link></a-menu-item>
                    <a-menu-item key="3"><router-link to="/settings">Settings</router-link></a-menu-item>
                    -->
                </a-menu>
            </div>
        </a-layout-header>
        <a-layout-content class="mainContainer">
            <router-view></router-view>
        </a-layout-content>
        <a-layout-footer>© 2019, CTAC by SHAFT: Sabah Anti Fraud Team</a-layout-footer>
    </a-layout>
</div>
</template>

<script>
export default {
    data() {
        return {
            message: 'Hey there'
        }
    }
}
</script>

<style>
.headerLogo {
    color: #ffffff;
    font-weight: bold;
    width: 500px;
    height: 31px;
    float: left;
}
.mainContainer {
    padding: 60px 50px;
    text-align: left;
}

.containerView {
    text-align: left;
}
</style>