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

  const login = async (username: string, password: string) => {
    const { data: token } = await api.post('api/login_check', { username, password })
    if (token) {

      Cookies.set('token', token.token, { expires: 3600 })
      api.defaults.headers.Authorization = `Bearer ${token.token}`
      const { data: user } = await api.get('api/users')
      setUser(user)
    }
  }

  const logout = () => {
    Cookies.remove('token')
    setUser(null)
    delete api.defaults.headers.Authorization
    window.location.pathname = '/'
  }

  return (
    <AuthContext.Provider value={{ isAuthenticated: !!user, user, login, loading, logout }}>
      {children}
    </AuthContext.Provider>
  )
}

export const useAuth = () => useContext(AuthContext)
