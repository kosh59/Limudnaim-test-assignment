<script>
export default {
    data: function(){
        return {
            page: 1,
            images: [],
            selectedImageId: null,
        }
    },
    methods: {
        load: function() {
            axios.post(route('getPixabayImages'), {'page' : this.page}).then((response) => {
                this.images = response.data;
            });
        },
        loadMore:function() {
            this.$emit('imageSelected', {'url' : null})
            this.page++;
            this.load();
        }
    },
    mounted: function(){
        this.$nextTick(() => {
            this.load();
        })
    },
}
</script>

<template>
    <div class="row row-cols-3">
    <img v-if="images && images.length"
         v-for="image in images"
         class="my-2"
         :class="image.id === selectedImageId ? 'selected' : ''"
         :src="image.previewURL"
         @click="() => {
             this.selectedImageId = image.id;
             $emit('imageSelected', {'url' : image.webformatURL})
         }"
    />
    </div>
    <button @click.prevent="loadMore">More images</button>
</template>

<style>
    .selected {
        border: solid 3px orange;
    }
</style>
