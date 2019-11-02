<template>
    <div class="primary-window">
        <div class="columns">
            <div class="column">
                <label for="image">Add Image:</label>
                <input type="file" id="image" name="name">
            </div>
            <div class="column">
                <label for="name">Input name:</label>
                <input type="text" id="name" name="name">
            </div>
            <div class="column">
                <label for="cat">Select Category:</label>
                <div class="field">
                    <div class="control">
                        <div class="select is-primary">
                            <select id="cat">
                                <option>Select dropdown</option>
                                <option>With options</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <label for="description">Input Decription:</label>
                <textarea class="textarea" id="description" placeholder="e.g. Hello world"></textarea>
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
                image: '',
                category: '',
                categories: null
            }
        },
        created() {
            this.ax
        }
    }
</script>

<style>

</style>

