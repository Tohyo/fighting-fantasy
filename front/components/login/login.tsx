import { useState } from "react"
import { useAuth } from "../../contexts/auth";

const Login = () => {

  const { login, user } = useAuth()

  const [username, setUsername] = useState<string>()
  const [password, setPassword] = useState<string>()

  return (
    <>
      { user ?
        <>
          { user.username }
        </> :
        <>
          <input type="input" name="username" onChange={e => setUsername(e.target.value)} />
          <input type="password" name="password" onChange={e => setPassword(e.target.value)} />
          <button onClick={() => login(username, password)}>Login</button>
        </>
      }
    </>
  )
}

export default Login
