
import VueRouter from 'vue-router'
// 1. Define route components.
// These can be imported from other files

// 2. Define some routes
// Each route should map to a component. The "component" can
// either be an actual component constructor created via
// `Vue.extend()`, or just a component options object.
// We'll talk about nested routes later.
const routes = [
{ 
  name: 'login',
  path: '/login', 
  meta: {
    requiresAuth: false,
  },
  component: require('./components/Login.vue').default
},
{ 
  name: 'home',
  path: '/', 
  meta: {
    requiresAuth: true,
  },
  component: require('./components/Home.vue').default
},

{ 
  name: 'register',
  path: '/register', 
  meta: {
    requiresAuth: false,
  },
  component: require('./components/Register.vue').default
},
{ 
  name: 'profile',
  path: '/profile/:id', 
  props: true,
  meta: {
    requiresAuth: true,
  },
  component: require('./components/Profile.vue').default
},






]

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
	mode: 'history',
	routes // short for `routes: routes`
})

export default router;