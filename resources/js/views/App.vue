<template>
    <div>
        <Header></Header>
        <router-view></router-view>
        <!-- <Main></Main> -->
    </div>
</template>

<script>
// import Main from "../components/Main.vue";
import Header from "../components/Header.vue";

export default {
    name: "App",
    components: {
        // Main,
        Header,
    },
};
</script>

<style lang="scss"></style>
