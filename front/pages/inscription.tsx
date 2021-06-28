import { useRouter } from "next/router"
import { useState } from "react"
import { useAuth } from "../contexts/auth"
import api from "../lib/api"

const Signin = () => {

  const { login, isAuthenticated } = useAuth()
  const router = useRouter()

  const [username, setUsername] = useState<string>('')
  const [password, setPassword] = useState<string>('')

  if (isAuthenticated) {
    router.push('/')
  }

  const register = () => {

    if (!username || !password) {
      return false
    }

    api.post(`http://localhost:8080/users`, {
      username,
      password
    }).then(() => {
      login(username, password)
        .then(() => {
          router.push('/')
        })
    })
  }

  return (
    <div className="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
      <div className="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 className="mt-6 text-center text-3xl font-extrabold text-gray-900">Inscription</h2>
      </div>

      <div className="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div className="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
          <form className="space-y-6" action="#" method="POST">
            <div>
              <label htmlFor="username" className="block text-sm font-medium text-gray-700">
                Username
              </label>
              <div className="mt-1">
                <input
                  id="username"
                  name="username"
                  type="username"
                  required
                  value={username}
                  onChange={(e) => setUsername(e.currentTarget.value)}
                  className="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                />
              </div>
            </div>

            <div>
              <label htmlFor="password" className="block text-sm font-medium text-gray-700">
                Password
              </label>
              <div className="mt-1">
                <input
                  id="password"
                  name="password"
                  type="password"
                  autoComplete="current-password"
                  value={password}
                  onChange={(e) => setPassword(e.currentTarget.value)}
                  required
                  className="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                />
              </div>
            </div>
            <div>
              <button
                type="submit"
                className="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                onClick={(e) => {e.preventDefault(); register()}}
              >
                Sign in
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  )

}

export default Signin
