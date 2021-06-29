import React, { useState } from "react"
import { useAuth } from "../../contexts/auth"
import Link from "next/link"
import Login from "../login/login"

export default function Header() {

  const { isAuthenticated, user, logout } = useAuth()

  const [displayLoginForm, setDisplayLoginForm] = useState(false)

  return (
    <>
      <nav className="w-full bg-gray-800 hidden xl:block shadow">
        <div className="container px-6 h-16 flex justify-between items-center lg:items-stretch mx-auto">
          <div className="flex items-center">
            <div className="mr-10 flex items-center">
              <h3 className="text-base text-white font-bold tracking-normal leading-tight ml-3 hidden lg:block">Fighting Fantasy</h3>
            </div>
            <ul className="hidden xl:flex items-center h-full">
              <li className="cursor-pointer h-full flex items-center text-sm text-white tracking-normal transition duration-150 ease-in-out">
                <Link href="/">
                  Liste des livres
                </Link>
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
                  <div className="flex items-center pl-8 relative cursor-pointer" onClick={() => setDisplayLoginForm(!displayLoginForm)}>
                    Connexion
                  </div>
                  <div className="flex items-center pl-8 relative cursor-pointer">
                    <Link href='/inscription'>
                      Inscription
                    </Link>
                  </div>
                </>
              )}
            </div>
          </div>
        </div>
      </nav>

      { displayLoginForm && <Login /> }

    </>
  )
}
