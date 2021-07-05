import Axios from "axios"
import createAuthRefreshInterceptor from "axios-auth-refresh"
import Cookies from 'js-cookie'

const api = Axios.create({
  baseURL: "http://localhost:8080",
  headers: {
    "Accept": "application/json",
    "Content-Type": "application/json"
  }
})

interface RefreshToken {
  token: string
  refresh_token: string
}

// const refreshAuthLogic = async (failedRequest) => {
//   const { data } = await api.post<RefreshToken>('api/token/refresh')

//   Cookies.set('token', data.token, { expires: 3600 })
//   Cookies.set('refresh_token', data.refresh_token)

//   api.defaults.headers.Authorization = `Bearer ${data.token}`
//   // failedRequest.response.config.headers['Authorization'] = 'Bearer ' + data.token
//   return Promise.resolve()
// }

// createAuthRefreshInterceptor(api, refreshAuthLogic);

export default api
