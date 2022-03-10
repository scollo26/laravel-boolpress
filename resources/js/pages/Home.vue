<template>
    <div>
        <Main :cards="cards" @changePage="changePage($event)"></Main>
    </div>
</template>

<script>
import Axios from "axios";
import Main from "../components/Main.vue";

export default {
    name: "Home",
    components: {
        Main,
    },
    data() {
        return {
            cards: {
                products: null,
                next_page_url: null,
                prev_page_url: null,
            },
        };
    },
    created() {
        this.getProducts("http://127.0.0.1:8000/api/v1/posts/random");
    },
    methods: {
        changePage(vs) {
            let url = this.cards[vs];
            if (url) {
                this.getProducts(url);
            }
        },
        getProducts(url) {
            Axios.get(url).then((result) => {
                this.cards.products = result.data.results.data;
                this.cards.next_page_url = result.data.results.next_page_url;
                this.cards.prev_page_url = result.data.results.prev_page_url;
            });
        },
    },
};
</script>

<style></style>
