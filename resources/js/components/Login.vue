<template>
  <!-- component -->
  <section class="absolute w-full top-0">
    <div class="absolute top-0 w-full h-full bg-gray-900" ></div>
    <div class="container mx-auto px-4 h-screen">
      <div class="flex content-center items-center justify-center h-full">
        <div class="w-full lg:w-4/12 px-4 pt-10">
          <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-300 border-0">
            <div class="rounded-t mb-0 px-6 py-6">
              <div class="text-center mb-2">
                <h6 class="text-gray-600 text-lg font-bold">Welcome To DevKind</h6>
              </div>

              <hr class="mt-3 border-b-1 border-gray-400">
            </div>
            <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
              <form>

               <div class="relative w-full mb-3">
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="grid-password">Email</label>
                <input type="email" class="px-3 py-2 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full" placeholder="Email"
                v-validate="'required|email|max:250'" name="email"  v-model="data.email">
                <span class="text-red-600">{{ errorBag.first('email') }}</span>
              </div>
              <div class="relative w-full mb-3">
                <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="grid-password">Password</label>
                <input type="password" class="px-3 py-2 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full" placeholder="Password" 

                name="password"
                v-validate="'required|max:100|min:8'"  v-model="data.password"
                >
                <span class="text-red-600">{{ errorBag.first('password') }}</span>
              </div>

              <div class="text-center mt-6">
                <http :activeCall="send" callType="post" :url="url" :passData="data"@onRequest="getRequestData"
                @onError="getError"
                ></http> 
                <button class=" bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full" type="button" 
                @click="onLogin" 

                >Login</button>
              </div>
              <div class="flex flex-wrap mt-6">
                <div class="w-1/2"><a href="#" class="text-gray-800"><small></small></a></div>
                <div class="w-1/2 text-right"><a href="/register" class="text-gray-800"><small>Create new account</small></a></div>
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

  export default {

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
      send: false,
      url: 'api/user-auth/login',
      data: {
        email: '',
        password: ''
      }


    }
  },

  methods: {

    getRequestData(response) {
     this.send = false;


     this.$toast.success(
      response.data.message

      );



     var data = response.data;
     this.send = false;
     this.successMessage = response.data.message;
     setTimeout(() =>{ 

      this.$store.commit('setToken', data.access_token);
      this.$store.commit('setAuthUser', data.data);
      this.$router.push({name: 'profile', params: {id: response.data.data.id}});

    },2000);

   },
   getError(error) {

    this.send = false;
    var errorKey;

    for (var prop in error.errors)
     errorKey = prop;



   this.$toast.error(
    error.errors[errorKey][0]

    );








 },


 onLogin() {

   this.$validator.validateAll().then(valid => {
    if (valid) {
      this.send = true;
      this.errorBag.clear();
      return;
    }

  });

 },


},
}
</script>

