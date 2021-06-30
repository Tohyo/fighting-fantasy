import React, { createContext, useState, useContext, useEffect } from 'react'
import Cookies from 'js-cookie'
import api from '../lib/api'

const AuthContext = createContext({});

export const AuthProvider = ({ children }) => {
  const [user, setUser] = useState(null)
  const [loading, setLoading] = useState(true)

  useEffect(() => {
    async function loadUserFromCookies() {
      const token  = Cookies.get('token')
      if (token) {
        api.defaults.headers.Authorization = `Bearer ${token}`
        try {
          const { data: user } = await api.get('api/users')
          if (user) {
            setUser(user)
          }
        } catch (error) {
          logout()
        }
      }
      setLoading(false)
    }
    loadUserFromCookies()
  }, [])

  interface Login {
    token: string
    refresh_token: string
  }

  const login = async (username: string, password: string) => {
    const { data } = await api.post<Login>('api/login_check', { username, password })
    if (data.token) {
      Cookies.set('token', data.token, { expires: 3600 })
      Cookies.set('refresh_token', data.refresh_token, { expires: 3600 })
      api.defaults.headers.Authorization = `Bearer ${data.token}`
      const { data: user } = await api.get('api/users')
      setUser(user)
    }
  }


  const logout = () => {
    Cookies.remove('token')
    Cookies.remove('refresh_token')
    setUser(null)
    delete api.defaults.headers.Authorization
    window.location.pathname = '/'
  }

  const isAdmin = () => {
    return user !== null && user.roles.includes('ROLE_ADMIN')
  }

  return (
    <AuthContext.Provider value={{ isAuthenticated: !!user, user, login, loading, logout, isAdmin }}>
      {children}
    </AuthContext.Provider>
  )
}

export const useAuth = () => useContext(AuthContext)
