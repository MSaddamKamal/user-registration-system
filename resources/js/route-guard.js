import router from './route';

const ADMIN = 1;
const WORKER = 2;
const GUEST = 3;

router.beforeEach((to, from, next) => {
	var user = router.app.$store.getters.getAuthUser;
	
	console.log(user);

	if(to.matched.some(record => record.meta.requiresAuth)) {
		// auth routes
		if(!user) {
			next({name: 'login'});
		}else {
			next();
		}

	}else {
		// no auth routes
		next();
	}
})

router.afterEach((to, from) => {

})