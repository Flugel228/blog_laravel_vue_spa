import axios from "axios";

const api = axios.create();

// start request
api.interceptors.request.use(config => {
    if (localStorage.getItem('access_token')) {
        config.headers.authorization = `Bearer ${localStorage.getItem('access_token')}`
    }

    return config

}, error => {
    return Promise.reject(error)
})

// end request

// start response

api.interceptors.response.use(config => {
    if (localStorage.getItem('access_token')) {
        config.headers.authorization = `Bearer ${localStorage.getItem('access_token')}`
    }

    return config

}, error => {
    if (error.response.status === 401) {
        axios.post('http://localhost:8876/api/auth/refresh', {}, {
            headers: {
                'authorization': `Bearer ${localStorage.getItem('access_token')}`
            }
        }).then(res => {
            localStorage.setItem('access_token', res.data.access_token)
            document.cookie = "jwt=" + res.data.access_token + "; path=/"
        }).catch(error => {
            localStorage.removeItem('access_token')
        })
    }

    return Promise.reject(error)
})

export default api
