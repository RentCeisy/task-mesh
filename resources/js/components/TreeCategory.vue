<template>
    <ul>
        <li v-for="category in categories">
            <span class="clicked" @click="selectCat(category.id)">{{category.value}}</span>
            <root v-if="existChildren(category)" :categories="category.children"></root>
        </li>
    </ul>
</template>

<script>

    export default {
        name: 'root',
        props: [
            'categories',
        ],
        methods: {
            existChildren(category) {
                if(category.children.length > 0) {
                    return true
                }
                return false;
            },
            deleteCat(id) {
                this.$http.delete('/api/category/' + id)
                    .then(resp => {
                        document.location.href = '/';
                    }, resp => {
                        console.log(resp);
                    })
            },
            selectCat(id) {
                this.$store.dispatch("setCategory", id);
            },
        }
    }
</script>

<style>
    .clicked {
        cursor: pointer;
    }
</style>
