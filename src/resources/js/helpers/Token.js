class Token {

    isValid(token) {
        const payload =  this.payload(token)

        //checking the "iss" (issued server) in the payload to make sure its issued from our server
        if(payload){
            payload.iss == "http://localhost:8080/api/auth/login" ? true : false
        }

        return false
    }

    //this function will get the payload - a token is consist of a Header, Payload and  a Signature. Hence a token is divided into 3 part by dots(.).
    payload(token){
        const payload = token.split('.')[1]
        return this.decode(payload)
    }

    //decoding the payload data and return them in JSON format
    decode(payload) {
        //using "atob" to decode base64 token payload
        return JSON.parse(atob(payload))
    }
}

export default Token = new Token()
