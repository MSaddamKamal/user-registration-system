<template>

  <div class="w-full relative mt-4 shadow-2xl rounded my-24 overflow-hidden">
    <!-- component -->
    <http :activeCall="send" callType="get" :url="url" :passData="user"@onRequest="getRequestData"
    @onError="getError"
    ></http> 




    <http :activeCall="activityLogSend" callType="get" :url="activityLogUrl" :passData="userId"@onRequest="getActivityRequestData"
    @onError="getError"
    ></http> 
    <nav  class="w-full  py-1 bg-white text-right shadow-lg border-b border-blue-400 ">
      <div class="w-full flex items-center justify-between mt-0 px-6 py-2 text-right">




        <div class=" justify-end mr-0 md:mr-4" >
          <div class="auth flex items-center w-full md:w-full">
            <http :activeCall="sendLogout" callType="post" :url="logout_url" @onRequest="getLogoutRequestData"
            @onError="getError"
            ></http> 
            <button class="bg-gray-900 mt-10  text-white active:bg-gray-700 text-sm font-bold  px-4 py-2 rounded shadow hover:shadow-lg outline-none focus:outline-none  " @click="logout">Logout</button>
          </div>
        </div>
      </div>
    </nav>
    <div class="top h-64 w-full bg-blue-600 overflow-hidden relative" >
      <img src="https://images.unsplash.com/photo-1503264116251-35a269479413?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80" alt="" class="bg w-full h-full object-cover object-center absolute z-0">
      <div class="flex flex-col justify-center items-center relative h-full bg-black bg-opacity-50 text-white">
        <img src="https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_960_720.png" class="h-24 w-24 object-cover rounded-full">
        <h1 class="text-2xl font-semibold">{{user.first_name + ' ' + user.last_name}}</h1>
        <h4 class="text-sm mt-1 font-semibold">Joined Since {{user.joined}}</h4>
      </div>
    </div>
    <div class="grid grid-cols-12 bg-white ">

      <div class="col-span-12 w-full px-3 py-6 justify-center flex space-x-4 border-b border-solid md:space-x-0 md:space-y-4 md:flex-col md:col-span-2 md:justify-start ">

        <a href="javascript:void(0)" class="text-sm p-2 bg-indigo-900 text-white text-center rounded font-bold">Basic Information</a>

      </div>

      <div class="col-span-12 md:border-solid md:border-l md:border-black md:border-opacity-25 h-full pb-12 md:col-span-10">
        <div class="px-4 pt-4">
          <form action="#" class="flex flex-col space-y-8">

            <div>
              <h3 class="text-2xl font-semibold">Personal Email</h3>
              <hr>
            </div>

            <div class="form-item">
             <label class="text-xl ">Email</label>
             <input type="text" v-model="user.email" class="w-full appearance-none text-black text-opacity-50 rounded shadow py-1 px-2 mr-2 focus:outline-none focus:shadow-outline focus:border-blue-200 text-opacity-25 " disabled>
           </div>
           <hr>
           <div>
            <h3 class="text-2xl font-semibold ">Edit Info</h3>
            <hr>
          </div>
          <div class="flex flex-col space-y-4 md:space-y-0 md:flex-row md:space-x-4">


            <div class="form-item w-full">
              <label class="text-xl ">First Name</label>
              <input type="text" v-model="user.first_name" class="w-full appearance-none text-black text-opacity-50 rounded shadow py-1 px-2 mr-2 focus:outline-none focus:shadow-outline focus:border-blue-200 text-opacity-25 " >
            </div>

            <div class="form-item w-full">
              <label class="text-xl ">Last Name</label>
              <input type="text" v-model="user.last_name" class="w-full appearance-none text-black text-opacity-50 rounded shadow py-1 px-2 mr-2 focus:outline-none focus:shadow-outline focus:border-blue-200 text-opacity-25 " >
            </div>
          </div>

          <div class="flex flex-col space-y-4 md:space-y-0 md:flex-row md:space-x-4">

            <div class="form-item w-full">
              <label class="text-xl ">Old Password</label>
              <input type="password" value="pppppppppp" class="w-full appearance-none text-black text-opacity-50 rounded shadow py-1 px-2 mr-2 focus:outline-none focus:shadow-outline focus:border-blue-200 text-opacity-25  " disabled>
            </div>

            <div class="form-item w-full">
              <label class="text-xl ">New Password</label>
              <input type="password" v-model="user.password" class="w-full appearance-none text-black text-opacity-50 rounded shadow py-1 px-2 mr-2 focus:outline-none focus:shadow-outline focus:border-blue-200 text-opacity-25  " >
            </div>

     
         </div>

         <div class="flex flex-col space-y-4 md:space-y-0 md:flex-row md:space-x-4">
            <div class="form-item w-full ">
             <http :activeCall="editInfoSend" callType="put" :url="editInfoUrl" :passData="editDetails" @onRequest="getEditInfoRequestData" 
             @onError="getError"
             ></http> 
             <button class="bg-gray-900 mt-10  text-white active:bg-gray-700 text-sm font-bold  px-4 py-2 mb-1 rounded shadow hover:shadow-lg outline-none focus:outline-none " type="button" @click="edit" >Edit All Info</button>
           </div>
         </div>



         <hr>
         <div>
          <h3 class="text-2xl font-semibold ">Activty View</h3>
          <hr>
        </div>

        <div class="form-item w-full">

          <div class=" w-full">
            <div class="shadow overflow-scroll rounded border-b border-gray-200">
              <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                  <tr>
                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Activty</th>
                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Created</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Updated</th>
                 
                  </tr>
                </thead>
                <tbody class="text-gray-700">
                  <tr v-for="(activity, index) in activityArray">
                    <td class="w-1/3 text-left py-3 px-4">{{activity.description}}</td>
                    <td class="w-1/3 text-left py-3 px-4">{{activity.created_at}}</td>
                    <td class="text-left py-3 px-4">{{activity.updated_at}}</td>
                  </tr>
               
                </tbody>
              </table>
            </div>
          </div>
        </div>



      </form>
    </div>
  </div>


</div>
</div>
</template>

<script>

  export default {
    props: ['id'],

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
          joined: '',
        },
        oldPasswordChanged : false,

        send: false,
        sendLogout: false,
        url: window.location.origin,
        logout_url : window.location.origin,
        activityLogSend : false,
        activityLogUrl: window.location.origin,
        userId: {},
        editInfoSend: false,
        editInfoUrl : window.location.origin,
        editDetails :{},
        activityArray : [],


      }
    },

    watch: {
      'user.password': function(val, oldVal){
        if (oldVal !== val) {

          this.oldPasswordChanged = true;
        }
      }
    },

    mounted() {

      this.url = this.url +'/api/profile/' + this.id;
      this.logout_url = this.logout_url +'/api/user-auth/logout';
      this.activityLogUrl = this.activityLogUrl +'/api/activity/'+this.id; 
       this.editInfoUrl = this.editInfoUrl +'/api/profile/'+this.id;
      this.userId.id =  this.id;

      this.send =true;
      this.activityLogSend =true;
    },

    methods: {
      edit(){
        this.editDetails = {
          first_name: this.user.first_name,
          last_name: this.user.last_name,
        
        };


        if(this.oldPasswordChanged)
        {

          this.editDetails.password = this.user.password;
        

        }

        this.editInfoSend = true;
      },
      getActivityRequestData(data)
      {
        this.activityLogSend =false;
        this.activityArray = data.data.data; 
   
      },

      getEditInfoRequestData(data)
      {
        this.editInfoSend = false;
        this.activityLogSend =true;

         this.$toast.success(
        "Record Updated Successfully"

        );
      },



     getLogoutRequestData(data){
      this.sendLogout = false;
      var navigate = this.$router;

      this.$toast.success(
        "Logout Successfully"

        );

    
      this.$store.commit('unAuthorizeUser');
      this.$store.commit('revokeToken');


      setTimeout(function(){   
         
          navigate.push({name: 'login'});

           }, 1000);


    },

 

   logout()
   {
    this.sendLogout = true;
  },

  getRequestData(data) {
    this.send = false;

    this.user.first_name =  data.data.data.first_name;
    this.user.last_name =  data.data.data.last_name;
    this.user.email =  data.data.data.email;

    this.user.joined =  new Date(data.data.data.created_at).getFullYear();



  },
  getError(error) {

    this.send = false;
    this.activityLogSend =false;
    this.editInfoSend =false;

    this.$toast.error(
      "An Error Occured"

      );


  },

},
}
</script>

