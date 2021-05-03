<template>

        <div class="container-fluid bg-dark p-5">
    
                <div class="form-group">
                      <div v-bind:class="{'alert alert-success': isActive, 'alert alert-danger': hasError }" class="ex-ccss" >
                        <div  v-for="errorArray in errors" :key="errorArray" >
                            <div v-for="allErrors in errorArray" :key="allErrors">
                            {{success}}
                            {{allErrors}} 
                        </div>
                     </div>
                    </div>
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
                    isActive:null,
                    hasError:null,
                    success: '',
                    errors: null
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
                     
                     //append all the file to the form data 
                    for(let i =0; i < this.attachments.length; i++) {
                        this.form.append('pics[' + i + ']', this.attachments[i])
                        }
                     //lets set the file to multipart/form data for content type
                    const config = { headers: { 
                        
                                        "Content-Type" : "multipart/form-data" 
                                        } 
                                    }
                                    //this should remove the name immediately  
                    document.getElementById('upload-file').value=[];
                      // lets send the data to backend
                    axios.post('/submit', this.form, config).then(Res => {
                        //success
                        this.isActive = true
                        this.success = Res.data.success
                    }).catch (error=> {

                        this.hasError = true
                        this.errors = error.response.data.errors || error.response.data.message ;
                           
                    });
                }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
