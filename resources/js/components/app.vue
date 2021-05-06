<template>
    <file-upload :categories="categories"/>
</template>


<script>

import fileupload from "./FileUpload.vue"


export default {
    components : {
        fileupload
    },

    data : function (){
        return {
            categories: []
        }
    },

    methods: {
        getCats () {
            axios.get('/allCats')
            .then( response => {
                this.categories = response.data
                // console.log(this.categories)
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
