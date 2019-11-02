<template>
    <div class="side-bar">
        <div class="side-bar__header has-text-centered">
            <strong>Категории</strong>
        </div>
        <div>
            <ul>
                <li class="cursor" v-for="category in categories">
                    <strong @click="selectCat(category.id)">{{category.value}}</strong>
                    <ul>
                        <li class="cursor" v-for="child in category.child">
                                <span @click="selectCat(child.id)">{{child.value}}</span>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                categories: null,
                selectedRoot: null
            }
        },
        methods: {
            selectCat(id) {
                this.$store.dispatch("setCategory", id);
            },
            getCategories() {
                this.$http.get('/category')
                    .then(response => {
                        this.categories = response.body;
                    }, response => {
                        console.log(response);
                    });
            }
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
</style>
