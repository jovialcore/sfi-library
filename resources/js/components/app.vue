<template>
    <file-upload :categories="categories"  v-on:categoriesUpdated='getCats()'/>
</template>


<script>

import fileupload from "./FileUpload.vue"


export default {
    components : {
        fileupload
    },

    data : function (){
        return {
            categories: [],
        }
    },

    methods: {
        getCats () {
            axios.get('/allCats')
            .then( response => {
                this.categories = response.data
            })
            .catch( error => {
                    console.log(error)
            })
        },
    },
        created() {
            this.getCats()
        }

}

</script>
