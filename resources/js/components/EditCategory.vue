<template>
    <div class="hero-app">
        <div class="columns has-text-centered">
            <div class="column">
                <router-link tag="button" class="button" :to="'/'">Back</router-link>
            </div>
        </div>
        <div class="columns has-text-centered">
            <div class="column">
                <label for="category">Category's name</label><br/>
                <input type="text" id="category" v-model="categoryName">
            </div>
        </div>
        <div class="columns has-text-centered">
            <div class="column">
                <label for="cat">Select Parent Category:</label>
                <div class="field">
                    <div class="control has-text-centered">
                        <div class="select is-primary">
                            <select id="cat" v-model="categoryRoot">
                                <option value="0">Root Category</option>
                                <option v-for="cat in categories" :value="cat.id">{{cat.value}}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="columns has-text-centered">
            <div class="column">
                <button class="button" @click="saveCategory()">Save</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                categoryName: '',
                categoryRoot: 0,
                categories: null,
                id: 0
            }

        },
        methods: {
            getCategories() {
                this.$http.get('/api/category')
                    .then(resp => {
                        this.categories = resp.body;
                    }, resp => {
                        console.log(resp);
                    })
            },
            getCategory() {
                this.$http.get('/api/category/' + this.id)
                    .then(resp => {
                        this.categoryName = resp.body.value;
                        if (resp.body.parent_id != null) {
                            console.log(resp.body.parent_id)
                            this.categoryRoot = resp.body.parent_id;
                        }
                    }, resp => {
                        console.log(resp)
                    })
            },
            saveCategory() {
                if (this.id == 0) {
                    let data = new FormData;
                    data.append('value', this.categoryName);
                    data.append('parent', this.categoryRoot);
                    this.$http.post('/api/category', data)
                        .then(resp => {
                        // document.location.href = '/';
                    }, resp => {
                        console.log(resp)
                    })
                } else {

                }
            }
        },
        created() {
            this.id = this.$route.params.id;
            if (this.id != 0) {
                this.getCategory();
            }
            this.getCategories();
        },
    }
</script>

<style>

</style>
