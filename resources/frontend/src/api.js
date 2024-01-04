/**
 * Created by Xavier on 2/8/2020.
 */


import client from "@/client.js"

const api = {
    login(credentials) {
        return client.get('/sanctum/csrf-cookie/')
            .then(() => {
                return client.post('/login', credentials)
                    .then(response => response)
                    .catch(error => {
                        console.log('cannot login', error)
                        throw error
                    })
            })
            .catch(error => {
                console.log('get csrf error, ', error)
                throw error
            })
    },
    logout() {
        return client.post('/logout')
    },
    isLogin() {
        return client.get('/api/is_login')
    },
}

export default api
