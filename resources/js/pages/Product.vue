<template>
    <div class="container">
        <div class="row g-4">
            <div class="col">
                <div class="card d-flex flex-row">
                    <img
                        v-if="product.image"
                        :src="'/storage/' + product.image"
                        class="card-img-top w-25"
                        :alt="product.title"
                    />
                    <img
                        v-else
                        src="/storage/uploads/default.png"
                        class="card-img-top w-25"
                        :alt="product.title"
                    />
                    <div class="card-body">
                        <h5 class="card-title">{{ product.title }}</h5>
                        <p class="card-text">{{ product.author }}</p>
                        <p class="card-text">{{ product.content }}</p>
                    </div>
                </div>
                <router-link class="btn btn-info mt-2" :to="{ name: 'home' }"
                    >Go back</router-link
                >
                <router-link
                    class="btn btn-info mt-2"
                    :to="{ name: 'products' }"
                    >torna post</router-link
                >
            </div>
        </div>
    </div>
</template>

<script>
import Axios from "axios";
export default {
    name: "Product",
    props: ["id"],
    data() {
        return {
            product: [],
        };
    },
    created() {
        const url = "http://127.0.0.1:8000/api/v1/posts/" + this.id;
        this.getProduct(url);
    },
    // methods: {
    //     getProduct(url) {
    //         Axios.get(url).then((result) => {
    //             // console.log(result);
    //             this.product = result.data.results.data;
    //         });
    //     },
    // },
    methods: {
        getProduct(url) {
            Axios.get(url, {
                headers: { Authorization: "Bearer 123abczxgsdciuoyl2376342" },
            })
                .then((result) => {
                    console.log(result);
                    this.product = result.data.results.data;
                })
                .catch((error) => console.log(error));
        },
    },
};
</script>

<style lang="scss"></style>
