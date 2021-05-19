import React, { useState } from "react"
import { useAuth } from "../../contexts/auth"

export default function IndexPage() {

  const { isAuthenticated, login, user, logout } = useAuth()

  const [profile, setProfile] = useState(false)
  const [username, setUsername] = useState<string>()
  const [password, setPassword] = useState<string>()

  return (
    <>
      <div className="bg-gray-200 h-full w-full">
          <nav className="w-full bg-gray-800 hidden xl:block shadow">
              <div className="container px-6 h-16 flex justify-between items-center lg:items-stretch mx-auto">
                <div className="flex items-center">
                  <div className="mr-10 flex items-center">
                    <h3 className="text-base text-white font-bold tracking-normal leading-tight ml-3 hidden lg:block">Fighting Fantasy</h3>
                  </div>
                  <ul className="hidden xl:flex items-center h-full">
                    <li className="cursor-pointer h-full flex items-center text-sm text-white tracking-normal transition duration-150 ease-in-out">
                      Liste des livres
                    </li>
                  </ul>
                </div>
                  <div className="h-full hidden xl:flex items-center justify-end text-white">
                    <div className="h-full flex">
                      { isAuthenticated ? (
                        <>
                          <div className="flex items-center pl-8 relative cursor-pointer">
                            <p className="text-white text-sm ml-2">{ user.username }</p>
                            <button onClick={() => logout()}>Logout</button>
                          </div>
                        </>
                      ) : (
                        <>
                          <div className="flex items-center pl-8 relative cursor-pointer" onClick={() => setProfile(!profile)}>
                            Connexion
                          </div>
                          { profile && (
                            <>
                              <input type="input" name="username" onChange={e => setUsername(e.target.value)} />
                              <input type="password" name="password" onChange={e => setPassword(e.target.value)} />
                              <button onClick={() => login(username, password)}>Login</button>
                            </>
                          )}
                        </>
                      )}
                    </div>
                  </div>
              </div>
          </nav>
      </div>
    </>
  )
}
