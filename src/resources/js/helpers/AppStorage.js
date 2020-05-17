class AppStorage {

    //store token in the local storage
    storeToken(token){
        localStorage.setItem('token', token)
    }

    //store user in the local storage
    storeUser(user){
        localStorage.setItem('user', user)
    }

    //calling the above storeToken and storeUser functions
    store(user, token) {
        this.storeToken(token)
        this.storeUser(user)
    }

    getToken() {
        return localStorage.getItem('token')
    }

    getUser() {
        return localStorage.getItem('user')
    }

    //clear tokens and user information from the local storage
    clear(){
        localStorage.clear();
    }
}

export default AppStorage = new AppStorage()
