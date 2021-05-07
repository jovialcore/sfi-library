<template>
        <div class="container bg-dark p-5 mt-5">

                <div class="form-group">
                      <div v-bind:class="{'alert alert-success': isActive, 'alert alert-danger': hasError }" class="ex-ccss" >
                            {{success}}
                        <div  v-for="errorArray in errors" :key="errorArray" >
                            <div v-for="allErrors in errorArray" :key="allErrors">
                            {{allErrors}}
                        </div>
                     </div>
                    </div>

                    <label class="text-white">Category: </label>
                <form v-for="allCats in categories" :key="allCats">

                      <select   class="custom-select w-50 mb-4"  v-model="cat.name" value="dropdown" placeholder="add a category">
                        <option > {{allCats.name}}</option>
                    </select>
  <br>
                    <input type="text" placeholder="add a category">

                <label class="text-white">Select File: </label>
                    <input type="file" multiple @change="uponUpload" id="upload-file" class="w-50 form-control" placeholder="Select file..." >
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
                    success: "",
                    errors: null,
                    category : '',
                    cat : {
                        name: ""
                    }
                }
        },

            props : ['categories'],

        methods: {
                uponUpload(e){
                   //i should have use computed properties here...so everything happens by default;
                     this.success = ""
                     this.errors = ""
                     this.isActive = false
                     this.hasError = false
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

                    //without the JSON.stringify() you will have an object.object 'error'
                    this.form.append('cats', JSON.stringify(this.cat.name))

                     //lets set the file to multipart/form data for content type
                    const config = { headers: {

                                        "Content-Type" : "multipart/form-data"
                                        }
                                    }

                      // lets get the first request
                    //   const fileUploadRequest = axios.post('/submit', this.form, config);

                    //   //lets get the second request
                    // const categoryRequest = axios.post('/store');

                    // axios.all([fileUploadRequest, ategoryRequest]).then(axios.spread((...responses) =>{


                    //     const fileUploadResponse = responses[0]
                    //     const categoryResponse = responses[1]

                    //     console.log(fileUploadResponse, categoryResponse)

                    //  } ))  .catch(errors => {
                    //         // react on errors.
                    //      console.error(errors);
                    //     })

                    axios.post ('/submit', this.form, config).then(Res => {
                        //success
                        this.isActive = true
                        this.success = Res.data.success
                        JSON.parse(this.success)
                    }).catch (error=> {

                        this.hasError = true
                        this.errors = error.response.data.errors || error.response.data.message ;
                    });

                   this.attachments = [];
                     document.getElementById('upload-file').value = ""
                }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

