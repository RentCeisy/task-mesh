<template>
    <div class="side-bar">
        <div class="side-bar__header has-text-centered">
            <strong>Категории</strong>
        </div>
        <div class="btn-add-category">
            <router-link tag="button" :to="'/category/edit/0'" class="button">Add category</router-link>
        </div>
        <div>
            <tree-category v-if="categories != null" :categories="categories"></tree-category>
        </div>
    </div>
</template>

<script>
    import treeCategory from './TreeCategory'

    export default {
        data() {
            return {
                categories: null,
                selectedRoot: null
            }
        },
        methods: {
            getCategories() {
                this.$http.get('/categories')
                    .then(response => {
                        this.categories = response.body;
                    }, response => {
                        console.log(response);
                    });
            }
        },
        components: {
            treeCategory,
        },
        created() {
            this.getCategories();
        }
    }
</script>

<style lang="scss" scoped>
    .side-bar {
        width: 16rem;
        background: #5fd2b2;
        height: 100%;
        position: fixed;
        box-shadow: 1px 0 10px rgba(0, 0, 0, 0.2);

        .side-bar__header {
            border-bottom: 1px solid #1F896B;
            width: 100%;
            height: 50px;
        }
    }

    .btn-add-category {
        padding: 5px;
        text-align: center;
    }
</style>
