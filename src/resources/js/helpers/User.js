import axios, {AxiosResponse} from 'axios';
import Token from './Token'
import AppStorage from './AppStorage'

class User {



    login (data) {
        axios.post('/api/auth/login', data)
        .then(res => {
            const access_token = res.data.access_token
            const user = res.data.user
            this.responseAfterLogin(user, access_token, '/login')
        })
        .catch(error => console.log(error.response.data))
    }

    signup (data) {
        return axios.post('/api/auth/signup', data)
            .then(res => {
                const access_token = res.data.access_token
                const user = res.data.user
                this.responseAfterLogin(user, access_token, '/signup')
            })
            .catch(error => { throw error});
    }

    responseAfterLogin(user, token, api) {
        if(Token.isValid(token, api)) {
            console.log(token)
            AppStorage.store(user, token)
        }
    }

    hasToken() {
        const storedToken = AppStorage.getToken();
        if(storedToken) {
            return Token.isValid(storedToken) ? true: false
        }
        return false
    }

    loggedIn() {
        return this.hasToken()
    }

    //logout the user
    logout() {
        AppStorage.clear()
    }

    //getting the user ID. To the the token we must get the payload of the JWT first. Then access the "sub" entity of the payload which contains the ID
    getUserID() {
        if(this.loggedIn()) {
            const payload = Token.payload(AppStorage.getToken())
            return payload.sub
        }
    }
}


export default User = new User()
