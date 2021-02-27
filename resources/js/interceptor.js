
import router from './route';

axios.interceptors.request.use(function(config) {

    config.headers = {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    }

    const token = router.app.$store.getters.getToken;
    if(token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
    
}, function(err) {
    return Promise.reject(err);
});