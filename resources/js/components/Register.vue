<template>
  <!-- component -->
  <section class="absolute w-full top-0 pt-5 pb-24">
    <div class="absolute top-0 w-full h-full bg-gray-900" ></div>
    <div class="container mx-auto  px-4 h-screen mt-24 mb-24">
      <div class="flex content-center items-center justify-center h-full">
        <div class="w-full lg:w-4/12 px-4 pt-10">
          <div class="relative flex flex-col min-w-0 break-words w-full mb-10 shadow-lg rounded-lg bg-gray-300 border-0">
            <div class="rounded-t mb-0 px-6 py-6">
              <div class="text-center mb-2">
                <h6 class="text-gray-600 text-lg font-bold">Welcome To DevKind</h6>
              </div>
              <div class="btn-wrapper text-center">
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2 pt-3" for="grid-password">Tell Us Your Age?</label>
                <date-picker placeholder="Date Of Birth" v-model="user.date_of_birth" valueType="format" v-validate="'required'" name="date_of_birth" ></date-picker>

                <div class="text-gray-500 text-center mb-1 font-bold"><small class="text-red-600">{{ errorBag.first('date_of_birth') }} </small></div>
              </div>
              <hr class="mt-3 border-b-1 border-gray-400">
            </div>
            <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
              <form>
                <div class="relative w-full mb-3">
                  <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="grid-password">First Name</label>
                  <input type="text" class="px-3 py-2 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full" placeholder="Saddam"  v-validate="'required|alpha|max:25'" name="first_name" v-model="user.first_name">
                  <span class="text-red-600">{{ errorBag.first('first_name') }}</span>
                </div>
                <div class="relative w-full mb-3">
                  <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="grid-password">Last Name</label>
                  <input type="text" class="px-3 py-2 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full" placeholder="Kamal" v-validate="'required|alpha|max:25'" name="last_name" v-model="user.last_name">
                  <span class="text-red-600">{{ errorBag.first('last_name') }}</span>
                </div>
                <div class="relative w-full mb-3">
                  <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="grid-password">Email</label>
                  <input type="email" class="px-3 py-2 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full" placeholder="Email" v-validate="'required|email|max:250'" name="email"  v-model="user.email">
                  <span class="text-red-600">{{ errorBag.first('email') }}</span>
                </div>
                <div class="relative w-full mb-3">
                  <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="grid-password">Password</label>
                  <input type="password" class="px-3 py-2 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full" placeholder="Password"    name="password"
                  v-validate="'required|max:100|min:8'" ref="passwordRef" v-model="user.password"
                  >
                  <span class="text-red-600">{{ errorBag.first('password') }}</span>
                </div>
                <div class="relative w-full mb-3">
                  <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="grid-password">Confirm Password</label>
                  <input type="password" class="px-3 py-2 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full" placeholder="Password" name="password_confirmation"   v-validate="'required|confirmed:passwordRef'"   v-model="user.password_confirmation">
                  <span class="text-red-600">{{ errorBag.first('password_confirmation') }}</span>
                </div>

                <div class="text-center mt-6">
                  <http :activeCall="send" callType="post" :url="url" :passData="user"@onRequest="getRequestData"
                  @onError="getError"
                  ></http>    

                  <button class="bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full" type="button" @click="onRegister" >Register</button>
                </div>
                <div class="flex flex-wrap mt-2">
                  <div class="w-full text-right"><a href="/login" class="text-gray-800"><small>Sign In?</small></a></div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
</template>

<script>
  import DatePicker from 'vue2-datepicker';
  import 'vue2-datepicker/index.css';   
  export default {
    components: { DatePicker },
    mounted() {
      var user = this.$store.getters.getAuthUser;


      if(user)
      {

       this.$router.push({name: 'profile', params: {id: user.id}});
     }
   },
   data() {
    return {
      time1: null,
      time2: null,
      time3: null,
      user: {
        first_name: '',
        last_name: '',
        email: '',
        password: '',
        password_confirmation: '',
        date_of_birth: '',
      },
      errorMessage: '',
      successMessage:false,
      loading: false,
      send: false,
      url: 'api/user-auth/signup',


    }
  },

  methods: {

    getRequestData(data) {
      this.send = false;

      this.$toast.success(
        data.data.message

        );
   
          setTimeout(() =>{ 

            this.successMessage = false;
            this.$router.push({name: 'login'});

          },2000);

        },
        getError(error) {


          this.$toast.error(
            "You have an error in one of the fields"

            );


          this.send = false;
          var errorKey;

          for (var prop in error.errors)
           errorKey = prop;

         this.errorBag.add({
          field: errorKey,
          msg: error.errors[errorKey][0]

        });





       },

       getAge(date_of_birth){
        var today = new Date();
        var birthDate = new Date(date_of_birth);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
          age--;
        }
        return age;
      },
      onRegister() {



        this.$validator.validateAll().then(valid => {
          if (valid) {
            var age = this.getAge(this.user.date_of_birth);


            if(age < 18)
            {
              this.errorBag.add({
                field:'date_of_birth',
                msg: 'You Must Be Atleast 18 to Join Us'

              });

              return;
            }

                      // this.loading = true;
                      // this.errorMessage = ''

                      this.user.date_of_birth = age;
                      this.send = true;
                      this.errorBag.clear();
                      return;
                    }

                  });
      },

      route(){
        this.$router.push({name: 'login'});
      }
    },
  }
</script>

