<template>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <div class="col" v-for="(product, index) in products" :key="index">
                <div class="card">
                    <img
                        v-if="product.image"
                        :src="'/storage/' + product.image"
                        class="card-img-top"
                        :alt="product.title"
                    />
                    <img v-else src="/storage/uploads/default.png" alt="" />
                    <div class="card-body">
                        <h5 class="card-title">{{ product.tilte }}</h5>
                        <h5 class="card-title">{{ product.author }}</h5>
                        <p class="card-text">{{ product.content }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3 bg-light">
            <ul class="list-inline bg-light">
                <li class="list-inline-item">
                    <button
                        v-if="cards.prev_page_url"
                        class="btn btn-primary"
                        @click="changePage('prev_page_url')"
                    >
                        Prev
                    </button>
                </li>
                <li class="list-inline-item">
                    <button
                        v-if="cards.next_page_url"
                        class="btn btn-primary"
                        @click="changePage('next_page_url')"
                    >
                        Next
                    </button>
                </li>
            </ul>
        </div>
    </div>
</template>

//
<script>
import Axios from "axios";

export default {
    name: "Main",
    props: ["cards"],
    methods: {
        changePage(vs) {
            this.$emit("changePage", vs);
        },
    },
};
</script>

<style lang="scss" scoped></style>
