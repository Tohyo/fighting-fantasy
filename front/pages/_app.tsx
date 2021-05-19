import 'tailwindcss/tailwind.css'

import type { AppProps } from 'next/app'
import Layout from '../components/layout/layout';
import { AuthProvider } from '../contexts/auth'

function App({ Component, pageProps }: AppProps) {
  return (
    <AuthProvider>
      <Layout>
        <Component { ...pageProps } />
      </Layout>
    </AuthProvider>
  )
}

export default App;
