import axios from 'axios'
import { GetServerSideProps } from 'next'
import AdventureComp from '../../../../components/adventure'
import { AdventureInterface, AdventureProps } from '../../../../components/interfaces'

const Adventure: React.FC<AdventureProps> = ({ adventure }) => {
  return (
    <>
    <AdventureComp { ...adventure } />
    </>
  )
}

export const getServerSideProps: GetServerSideProps = async (context) => {
  const adventure = await axios.get<AdventureInterface>(`http://nginx/adventures/${ context.query.id }`)
    .then(response => {
      return response.data
    })

  return {
    props: {
      adventure
    },
  }
}

export default Adventure
