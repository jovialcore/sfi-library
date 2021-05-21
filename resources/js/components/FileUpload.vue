<template>
  <div class="container-fluid ">
    <div class="row bg-dark p-5 " style="border-top:1px solid green;">
        <div
          v-bind:class="{
            'alert alert-dismissible alert-success show ': isActive,
            'alert alert-dismissible alert-danger show': hasError,
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
            <span aria-hidden="true" v-show="notifDisplay">&times;</span>
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
          <button class="btn btn-success mt-4" @click="addCatbtn">Add</button>
        </div>


          <div class="col">
             <label class="text-white">Select a category: </label>
            <select
              class="custom-select w-100 "
              v-model="cat.name"
              value="dropdown"
              placeholder="add a category"
            >
              <option v-for="(allCats, idx) in computedCats" :key="idx.id">
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
            id="upload-file"
            class="w-100 form-control"
            placeholder="Select file..."
            ref="file"
          />
                  <button class="btn btn-success mt-4" @click="submitFile">Upload</button>

        </div>
      </div>
         <div class="row">
      <div
        class="col bg-white"
        style=""
      >
      <div class="row mt-2">
        <div class="col-3" v-for="(file, key) in files " :key="key">


      <div class="" style="">
          <img class="preview img-fluid" v-bind:ref="'preview'+parseInt(key)" />

          <div class="success-container" v-if="file.df > 0">
              <button class="btn btn-success my-2"> Succesfully uploaded </button>

          </div>
             <div class="remove-container" v-else>
                <button class="remove btn btn-danger btn-sm my-2" style="cursor: pointer" v-on:click="removeFiles(key)">Remove</button>
            </div>

        </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      notifDisplay: false,
      files: [],
      allUploaded: [],
      form: new FormData(),
      isActive: null,
      hasError: null,
      success: "",
      errors: "",
      errorMsg: "",
      category: "",
      cat: {
        name: "",
      },
    };
  },
  props: ["categories"],
  computed: {
    computedCats: function () {
      return this.categories;
    },
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
          name: this.category,
        })
        .then((response) => {
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
        .catch((error) => {
          this.notifDisplay = true;
          this.category = "";
          this.hasError = true;
          this.isActive = false;
          this.success = "";
          this.errors = error.response.data.errors;
          this.errorMsg = error.response.data.message;
        });
    },

    getImagePreviews() {
      for (let i = 0; i < this.files.length; i++) {
        //check to see if it is an image
        if (/\.(jpe?g|png|gif)$/i.test(this.files[i].name)) {
          let reader = new FileReader();
             //once the image has been loaded ('on-load') in the local storage, pick it up and display
          reader.addEventListener(
            "load",
            function () {
              this.$refs["preview"+parseInt(i)][0].src = reader.result;
            }.bind(this),
            false
          );
          reader.readAsDataURL(this.files[i]);
        } else {
             //before the dom is updated to the recent changes, pick the image up immediately
             //setTimeOut() can perform this operation but it is slower compared to how fast $nextTick is
          this.$nextTick(function () {
            this.$refs["preview"+parseInt(i)][0].src = "images/header.jpg";
          })
        }
      }
    },
    removeFiles(key) {
      this.files.splice(key, 1)
        this.errors = "";
        this.errorMsg = "";
         this.$refs.file.value = null;
    },
    uponUpload(e) {
      //i should have use computed properties here...so everything happens by default;
      this.success = "";
      this.isActive = false
      this.hasError = false
      this.errors = {}
      let uploadedFiles = this.$refs.file.files;
      for (let i = 0; i < uploadedFiles.length; i++) {
        this.files.push(uploadedFiles[i]);
      }

        this.$refs.file.value = "";
         this.getImagePreviews();
         console.log(this.deleteUploaded())
    },

    deleteUploaded(){

        for(let i=0; this.files.length; i++) { }

            console.log(this.files.[i].df ?? "notfound" )
    },
    submitFile() {
      //append all the file to the form data
      if(this.$refs.file.value == "" && this.files.length ) {

      for (let i = 0; i < this.files.length; i++) {
        // we are simply saying that if the file has an ID, it should terminate the looping of it and continue the loop
        if (this.files[i].id) {
          continue;
        }
        this.form.append("pic[]", this.files[i]);
      }


      //without the JSON.stringify() you will have an object.object 'error'
      this.form.append("cats", JSON.stringify(this.cat.name));
      //lets set the file to multipart/form data for content type
      const config = {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      };
      axios
        .post("/submit", this.form, config)
        .then((response) => {
          //success
          if ((response.status = 201)) {
            this.isActive = true;
            this.notifDisplay = true;
            this.success = response.data.success;
            this.$refs.file.value = "";
            //this is one of the key features: it loops through the files and appends the given number from database to it
            console.log(this.files);
            for(let i= 0; i < this.files.length; i++){
                this.files[i].df = response.data.ids[i]
                this.stuff = this.files[i].df
            }

          }
        })
        .catch((error) => {
        if((error.status = 422)){
            this.hasError = true;
            this.notifDisplay = true
            this.errors =  error.response.data.errors
            this.$refs.file.value = null;
            // this.files = []
        }
        });
    }else {
        console.log('please have some values')
    }
  },
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
