<template>

        <div class="container-fluid bg-dark p-5">
    
                <div class="form-group">
                    <div class="alert alert-success" @if="success != '' "> {{ success }}</div>
                    <label class="text-white">Form Title </label>
                <form enctype="multipart/form-data">
                    <input type="file" multiple @change="uponUpload" id="upload-file" class="form-control" placeholder="Select file..."> 
                </form>
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
                    success: '',
                    errors: ''
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
                    
                },

                submitFile(){  

                     let existingObj = this;

                     //append all the file to the form data 
                    for(let i =0; i < this.attachments.length; i++) {
                        this.form.append('pics[]', this.attachments[i])
                        }
                     //lets set the file to multipart/form data for content type
                    const config = { headers: { 
                        
                                        "content-type" : "multipart/form-data" 
                                        } 
                                    }
                                    //this should remove the name immediately  
                    document.getElementById('upload-file').value=[];

                      // lets send the data to backend

                    axios.post('/submit', this.form, config).then(Res => {
                        //success

                        existingObj.success = Res.this.form.success

                    }).catch (Res=> {
                        existingObj.success = Res.this.form.success
                           
                    });
                }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
