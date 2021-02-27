<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Welcome to Devkind The Home Page is Underdevelopment</div>

                    <div class="card-body">
                    <a href="javascript:void(0)" @click="route">Goto Login Page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {

        },

        methods:{
            route(){
                this.$router.push({name: 'login'});
            }
        }
    }
</script>
