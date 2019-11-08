<template>
    <div class="hero-app">
        <div class="columns has-text-centered">
            <div class="column">
            </div>
            <div class="column">
            </div>
            <div class="column">
                <router-link tag="button" class="button" :to="'/'">Back</router-link>
            </div>
        </div>
        <div class="columns has-text-centered">
            <div class="column">
            </div>
            <div class="column">
                <label for="name">Input name:</label><br/>
                <input type="text" id="name" v-model="name" name="name">
            </div>
            <div class="column">
            </div>
        </div>
        <div class="columns has-text-centered">
            <div class="column"></div>
            <div class="column">
                <label for="cat">Select Category:</label>
                <div class="field">
                    <div class="control has-text-centered">
                        <div class="select is-primary">
                            <select id="cat" v-model="category">
                                <option v-for="cat in categories" :value="cat.id">{{cat.value}}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column"></div>
        </div>
        <div class="columns has-text-centered">
            <div class="column"></div>
            <div class="column">
                <label for="image">Add Image:</label>
                <input type="file" id="image" name="name" multiple accept="image/*" @change="onFileChange">
            </div>
            <div class="column"></div>
        </div>
        <div class="columns has-text-centered">
            <div class="column"></div>
            <div class="column">
                <img :src="image" v-if="image" />
            </div>
            <div class="column"></div>
        </div>
        <div class="columns has-text-centered">
            <div class="column">
                <label for="description">Input Decription:</label>
                <textarea class="textarea" id="description" v-model="description"></textarea>
            </div>
        </div>
        <div class="columns has-text-centered">
            <div class="column">
            </div>
            <div class="column">
                <button class="button" @click="saveProduct">Save</button>
            </div>
            <div class="column">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: '',
                description: '',
                image: null,
                category: '',
                categories: [],
                productImage: null,
                id: 0
            }
        },
        methods: {
            saveProduct() {
                const config = { headers: { 'Content-Type': 'multipart/form-data' } };
                let data = new FormData;
                data.append('name', this.name);
                data.append('description', this.name);
                data.append('image', this.productImage);
                data.append('category', this.category);
                if (this.id == 0) {
                    this.$http.post('/api/product', data, config).then(resp => {
                        document.location.href = '/';
                    }, resp => {
                        console.log(resp)
                    })
                } else {
                    //This is a known laravel's issue.
                    data.append("_method", "PUT");
                    this.$http.post('/api/product/' + this.id, data, config).then(resp => {
                        document.location.href = '/';
                    }, resp => {
                        console.log(resp)
                    })
                }
            },
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                if(files[0].size > 1024 * 1024) {
                    return;
                }
                this.productImage = files[0];
                this.createImage(files[0])
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            getCategories() {
                this.$http.get('/api/category')
                    .then(resp => {
                        this.categories = [];
                        this.sortCategory(resp.body, '');
                    }, resp => {
                        console.log(resp);
                    })
            },
            getProduct() {
                this.$http.get('/api/product/' + this.id)
                    .then(resp => {
                        this.name = resp.body.name;
                        this.description = resp.body.description;
                        this.category = resp.body.category_id;
                        this.image = resp.body.image;
                    })
            },
            sortCategory(categories, prefix) {
                for (let index in categories) {
                    this.categories.push({
                        id: categories[index].id,
                        value: prefix + ' ' + categories[index].value,
                    });
                    if(categories[index].children.length > 0) {
                        this.sortCategory(categories[index].children, '-' + prefix);
                    }
                }
            }
        },
        created() {
            this.id = this.$route.params.id;
            this.getCategories();
            if (this.id != 0) {
                this.getProduct();
            }
        }
    }
</script>

<style>

</style>

