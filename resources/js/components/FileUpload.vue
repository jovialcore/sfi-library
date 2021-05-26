<template>
    <div class="container-fluid ">
        <div class="row bg-dark p-5 " style="border-top:1px solid green;">
            <div
                v-bind:class="{
                    'alert alert-dismissible alert-success show ': isActive,
                    'alert alert-dismissible alert-danger show': hasError
                }"
                class=""
                role="alert"
            >
                {{ success }} {{ errorMsg }}
                <div v-for="(errorArray, idx) in errors" :key="idx">
                    <div v-for="(allErrors, idx) in errorArray" :key="idx">
                        {{ allErrors }}
                    </div>
                </div>
                <button
                    type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Close"
                    @click="OnClose"
                >
                    <span aria-hidden="true" v-show="notifDisplay"
                        >&times;</span
                    >
                </button>
            </div>

            <div class=" col">
                <label class="text-white">Select a category: </label>
                <input
                    type="text"
                    v-model="category"
                    class="w-100 form-control"
                    placeholder="Add a category..."
                />
                <button class="btn btn-success mt-4" @click="addCatbtn">
                    Add
                </button>
            </div>

            <div class="col">
                <label class="text-white">Select a category: </label>
                <select
                    class="custom-select w-100 "
                    v-model="cat.name"
                    value="dropdown"
                    placeholder="add a category"
                >
                    <option
                        v-for="(allCats, idx) in computedCats"
                        :key="idx.id"
                    >
                        {{ allCats.name }}
                    </option>
                </select>
            </div>

            <div class="col">
                <label class="text-white">Select File: </label>
                <input
                    type="file"
                    multiple
                    @change="uponUpload"

                    ref="file"
                    class="w-100 form-control"
                    placeholder="Select file..."

                />
                <button class="btn btn-success mt-4" @click="submitFile">
                    Upload
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col bg-white" style="">
                <div class="row mt-2" :show="images.length">
                    <div
                        class="col-3"

                        v-for="(image, id) in images"
                        :key="id"
                    >
                        <div class="" style="">
                            <img
                                class="preview img-fluid"

                                :src="image"

                            />

                            <div class="success-container" v-if="checker > 0">
                                <button class="btn btn-success my-2">
                                    Succesfully uploaded

                                </button>
                            </div>
                            <div class="remove-container" v-else>
                                <button
                                    class="remove btn btn-danger btn-sm my-2"
                                    style="cursor: pointer"
                                    v-on:click="removeFiles(id)"
                                >
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import VueToastr from "vue-toastr";

export default {
    data() {
        return {
            checker : 0,
            notifDisplay: false,
            imageFiles: [],
            images: [],
            allUploaded: [],
            form: new FormData(),
            isActive: null,
            hasError: null,
            success: "",
            errors: "",
            errorMsg: "",
            category: "",
            cat: {
                name: ""
            }
        };
    },
    props: ["categories"],
    computed: {
        computedCats: function() {
            return this.categories;
        },

        filesLa: function() {
            return this.files;
        }
    },
    methods: {
        OnClose() {
            this.hasError = false;
            this.isActive = false;
            this.errors = "";
            this.errorMsg = "";
            this.success = "";
            this.notifDisplay = false;
            this.$refs.file.value = null;
        },
        addCatbtn() {
            if (this.category == "") return;
            axios
                .post("/addcategory", {
                    name: this.category
                })
                .then(response => {
                    if ((response.status = 201)) {
                        this.$emit("categoriesUpdated");
                        this.category = "";
                        this.errors = "";
                        this.errorMsg = "";
                        this.notifDisplay = true;
                        this.success = response.data.success;
                        this.isActive = true;
                        this.hasError = false;
                    }
                })
                .catch(error => {
                    this.notifDisplay = true;
                    this.category = "";
                    this.hasError = true;
                    this.isActive = false;
                    this.success = "";
                    this.errors = error.response.data.errors;
                    this.errorMsg = error.response.data.message;
                });
        },
        getImagePreviews(image) {
                if(!image.type.match('image.*')){
                    this.$toastr.e(`${image.name} is not an image`);
                    return;
                    }

                this.imageFiles.push(image)
                const img = new Image()
                const  reader = new FileReader()
                reader.onload = (e) => this.images.push(e.target.result);
                reader.readAsDataURL(image)

        },
        removeFiles(key) {
            this.images.splice(key, 1);
            this.errors = "";
            this.errorMsg = "";
            this.$refs.file.value = null;
        },
        uponUpload(e) {
            //i should have use computed properties here...so everything happens by default;
            if(this.checker) {

                this.images  = []
                this.imageFiles = []
                console.log(this.imageFiles)
            }
             this.checker = 0
            this.success = "";
            this.isActive = false;
            this.hasError = false;
            this.errors = {};
            const files = e.target.files
    //i want to understand this Array.from() metho
          Array.from(files).forEach(file => this.getImagePreviews(file))

            // let uploadedFiles = this.$refs.file.files;
            // for (let i = 0; i < uploadedFiles.length; i++) {
            //     this.files.push(uploadedFiles[i]);
            // }
            this.$refs.file.value = "";
            // this.getImagePreviews(this.files);
            //  console.log(this.deleteUploaded())
        },
        deleteUploaded() {




            // let images = [
            //     { size: 24, name: "apples", quantity: 2 },
            //     { name: "apples", quantity: 2 }
            // ];

            for (let i = 0; i < this.files.length; i++) {
                for (var key in this.files[i]) {
                    if (key === "df") delete this.files[i];
                }
            }
            //this removes the undefined in the files...very important
            this.files = this.files.filter(Boolean);

            this.getImagePreviews(this.files);

            //         if (this.files.length > 0) {
            //       for(var i =0; i < this.files.length; i++) {
            //             if ('df' in this.files[i]){
            //                 this.files.filter(word => word.df > 0);
            //               this.files.splice(i, this.files.length);
            //               i--;
            //             }
            //       }
            // }

            //         if (this.files.length > 0) {
            //             for (var i = this.files.length; i--;) {
            //                 if(this.files[i].df > 0){
            //                     this.files.splice(i,2)
            //                 }
            //             }
            // }
            //

            // let words = ['spray', 'limit', 'elite', 'exuberant', 'destruction', 'present'];

            // const result = words.filter(word => word.length > 6);

            // console.log(result);
            // words = []
            // console.log(words.push(result))
            // console.log(words)
            // expected output: Array ["exuberant", "destruction", "present"]

            //   console.log(this.files)
            //console.log(this.files.filter(element => element.df > 0).splice(0,0));\

            // this.files.filter(e => e.df > 0);
            //         this.files.forEach(f => this.files.splice(this.files.findIndex(e => e.df > 0),1));
            //         console.log(this.files.forEach(f => this.files.splice(this.files.findIndex(e => e.df > 0),0)));

            // }
        },
        submitFile() {
            //append all the file to the form data
            if (this.$refs.file.value == "" && this.imageFiles.length) {
                for (let i = 0; i < this.imageFiles.length; i++) {
                    // we are simply saying that if the file has an ID, it should terminate the looping of it and continue the loop
                    if (this.imageFiles[i].df) {
                        continue;
                    }
                    this.form.append("pic[]", this.imageFiles[i]);
                }
                //without the JSON.stringify() you will have an object.object 'error'
                this.form.append("cats", JSON.stringify(this.cat.name));
                //lets set the file to multipart/form data for content type
                const config = {
                    headers: {
                        "Content-Type": "multipart/form-data"
                    }
                };
                axios
                    .post("/submit", this.form, config)
                    .then(response => {
                        //success
                        if ((response.status = 201)) {
                            this.isActive = true;
                            this.notifDisplay = true;
                            this.success = response.data.success;
                            this.$refs.file.value = "";
                            if(response.data.ids){ this.checker++}
                        }
                    })
                    .catch(error => {
                        console.log(error)
                        // if ((error.status = 422)) {
                        //     this.hasError = true;
                        //     this.notifDisplay = true;
                        //     this.errors = error.response.data.errors;
                        //     this.$refs.file.value = null;
                        //     // this.files = []
                        // }
                    });
            } else {
                console.log("please have some values");
            }
        }
    },
    mounted() {
        console.log("Component mounted.");
    }
};
</script>
