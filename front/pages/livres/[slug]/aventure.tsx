import { GetServerSideProps } from 'next'
import AdventureComp from '../../../components/adventure/adventure'
import api from '../../../lib/api'
import useSWR from 'swr'

const Adventure: React.FC<String> = ({ bookSlug }) => {

  const { data } = useSWR(`http://localhost:8080/api/adventures/${ bookSlug }`, async (url) => {
    return await api.get(url)
      .then(result => {
        return result.data
      })
  })

  return (
    <>
      {!data ? (
        <>Loading</>
      ) : (
        <AdventureComp { ...data } />
      )}
    </>
  )
}

export const getServerSideProps: GetServerSideProps = async (context) => {
  return {
    props: {
      bookSlug: context.query.slug
    },
  }
}

export default Adventure
