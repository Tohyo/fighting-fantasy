import { GetServerSideProps } from 'next'
import Adventure from '../../../components/adventure/adventure'
import api from '../../../lib/api'
import useSWR from 'swr'

interface AdventurePageProps {
  bookSlug: string
}

const AdventurePage: React.FC<AdventurePageProps> = ({ bookSlug }) => {

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
        <>
          <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <Adventure { ...data } />
          </div>
        </>
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

export default AdventurePage
