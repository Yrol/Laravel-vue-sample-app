import axios, {AxiosResponse} from 'axios';

class User {
    login (data) {
        axios.post('/api/auth/login', {email: data.email, password: data.password})
        .then(res => console.log(res.data))
        .catch(error => console.log(error.response.data))
    }
}


export default User = new User()
