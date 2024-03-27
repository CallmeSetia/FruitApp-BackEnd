import axios from "axios";
import router from "./router";

function setAxiosAuthorization() {
    const user = JSON.parse(localStorage.getItem('user'));
    const token = user?.token;

    axios.defaults.headers.common['Authorization'] = token ? `Bearer ${token}` : null;
}

setAxiosAuthorization();

// axios.defaults.baseURL = "https://api.zaj.kastaradigital.com";
axios.defaults.baseURL = "http://localhost:8000";

// axios.interceptors.response.use((response) => {
//     const user = localStorage.getItem('user');
//     if( user ){
//         localStorage.removeItem('user')
//     }
//     router.push('/login')
//
//     return response;
// }, (error) => {
//     if (error.response.status == 401 || store.state.user.user == null ) {
//
//         const user = localStorage.getItem('user');
//
//         if( user ){
//             localStorage.removeItem('user')
//         }
//
//         sessionStorage.clear();
//
//
//         router.push('/login');
//     }
//     return Promise.reject(error);
// });


export { setAxiosAuthorization };
