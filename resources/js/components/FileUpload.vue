<template>

        <div class="container-fluid bg-dark p-5">
    
                <div class="form-group">
                    <label class="text-white">Form Title </label>
                    <input type="file" multiple @change="uponUpload" class="form-control" placeholder="Select file..."> 
                </div>
                <button class="btn btn-success" @click="submitFile" >Submit </button>
        </div>
</template>

<script>
    export default {
        data() {
                return {
                    attachments: [],
                    form: new FormData(),
                }
        },
        methods: {
                uponUpload(e){

                    let selectedFiles = e.target.files
                    //if there are no files
                    if(!selectedFiles.length){
                        return false
                    }

                    //lets loop through all the files that will be selected

                    for(let i=0; i<selectedFiles.length;  i++){
                    //so here we are going to push eevryhting thh attachment array vaiable 
                        this.attachments.push(selectedFiles[i])
                    }

                    console.log(this.attachments)
                },

                submitFile(){                
                     //append all the file to the form data 
                    for(let i =0; i < this.attachments.length; i++) {
                        this.form.append('pics[]', this.attachments[i])
                        }
                     //lets set the file to multipart/form data for content type
                    const config = { headers: { 
                        
                                        'content-type': 'multipart/form-data' 
                                        } 
                                    };  

                      // lets send the data to backend
                    axios.post('/submit', this.form, config).then(Response => {
                        //success

                        console.log(Response)
                    }).catch (response => {

                            console.log(response)
                    });
                }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
