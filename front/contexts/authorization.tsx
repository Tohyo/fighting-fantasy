import React, { ComponentType } from 'react'
import { useRouter } from 'next/router';
import { useAuth } from './auth';

export const needAuthorization = (Component: ComponentType): ComponentType => (props) => {
  const { isAdmin, loading } = useAuth()
  const router = useRouter()

  if (!loading && !isAdmin() && process.browser) {
    router.push('/')
    return null
  }

  return <Component {...props} />
}
