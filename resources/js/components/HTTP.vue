<template>

</template>

<script>
    export default {

       props:['url','activeCall','callType','passData'],

       data(){

            return{
                typeOfCall: this.callType,
                resourceURL: this.url,
                requestData:[],
                errors:[],
                requestObj: null,
            
             }
        },

        watch: {
            // url(val){
            //     alert(1111);
            //     this.resourceURL = val;
            // },

            activeCall(val){
           

                if(val == true){
                    this.resourceURL = this.url;
                    this.call();
                    
                }
            },



        },
        methods:{

            call(){
                
                if(typeof(this.resourceURL) == 'undefined'){
                    return;
                }

                if(typeof(this.typeOfCall) == 'undefined'){

                    this.typeOfCall = 'get';
                }


             

                switch(this.typeOfCall) {
                    case 'get':


                        this.requestObj = this.$http.get(this.resourceURL);
                    break;

                    case 'put':
                    
                        this.requestObj = this.$http.put(this.resourceURL,this.passData);    
                    
                    

                    break;

                    case 'post':

                    
                        this.requestObj = this.$http.post(this.resourceURL,this.passData);    
                        

                    
                    break;


                    case 'delete':

                    this.requestObj = this.$http.delete(this.resourceURL);

                    break; 

                }

                if(typeof(this.requestObj) == "undefined") {
                    return;
                }

                this.requestObj.then(({data}) => {

                   this.requestData = data;

                   this.sendData();

                   }, error => {
                    error = error.response;
                    this.errors = error.data;
                    this.$emit('onError', error.data);
                });
            },

           sendData(){

                var callData = {

                    data: this.requestData,
                    

                }

                this.$emit('onRequest',callData);
              },

        },



    }
</script>
