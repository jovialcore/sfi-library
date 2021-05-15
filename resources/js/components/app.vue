<template>
    <file-upload :categories="categories" :key="componentKey"/>
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
            componentKey : 0,
        }
    },

    methods: {
        forcRenrender() {
            this.componentKey += 1
        },
        getCats () {
            axios.get('/allCats')
            .then( response => {
                this.categories = response.data
                this.forcRenrender()
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
