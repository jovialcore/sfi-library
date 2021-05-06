<template>

</template>


<script>

export default({
        propData : function () {
            return {
                allCatgeories : []
            }
        },

        methods: {
            getAllCategories() {
                axios.get(/allCats)
                .then(response => {
                    this.allCatgeories = response.data
                })
            }
        }
})
</script>
