<template>
    <div class="primary-window">
        <div class="card">
            <div class="columns">
                <div class="column">
                    <router-link tag="button" :to="'/product/edit/0'" class="button">Add Product</router-link>
                </div>
            </div>
            <table class="table">
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Delete</th>
                </tr>
                <tr v-for="product in products">
                    <th><router-link :to="'product/edit/' + product.id">{{product.name}}</router-link></th>
                    <th><img class="product-image" :src="product.image"></th>
                    <th>{{product.description}}</th>
                    <th></th>
                    <th><button @click="deleteProduct(product.id)" class="button is-primary">Delete</button></th>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        data() {
            return {
                products: null,
                categoryId: 0,
                path: ''
            }
        },
        methods: {
            saveProduct() {

            },
            getProducts() {
                this.$http.get('/products/cat/' + this.getCurCategory())
                    .then(resp => {
                        this.products = resp.body;
                    }, resp => {
                        console.log(resp);
                    })
            },
            deleteProduct(id) {
                this.$http.delete('/api/product/' + id)
                    .then(resp => {
                        this.getProducts();
                    }, resp => {
                        console.log(resp);
                    })
            },
            getCurCategory() {
                return this.$store.getters.getCategory;
            },

        },
        computed: mapState(['selectCat']),
        watch: {
            selectCat(oldVal, newVal) {
                this.getProducts()
            }
        },
        created() {
            this.getProducts();
        }
    }
</script>

<style lang="scss" scoped>
    .product-image {
        width: 150px;
    }
</style>
