import axios, {AxiosResponse} from 'axios';
import Token from './Token'
import AppStorage from './AppStorage'

class User {
    login (data) {
        axios.post('/api/auth/login', {email: data.email, password: data.password})
        .then(res => {
            const access_token = res.data.access_token
            const user = res.data.user
            this.responseAfterLogin(user, access_token)
        })
        .catch(error => console.log(error.response.data))
    }

    responseAfterLogin(user, token){
        if(Token.isValid(token)){
            console.log(token)
            AppStorage.store(user, token)
        }
    }
}


export default User = new User()
