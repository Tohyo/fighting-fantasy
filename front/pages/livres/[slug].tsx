
import axios from 'axios'
import { GetStaticPaths, GetStaticProps } from 'next'
import { useRouter } from 'next/router'
import { AdventureInterface } from '../../components/adventure/adventureInterface'
import { BookInterface } from '../../components/book/bookInterface'
import { ParagraphInterface } from '../../components/paragraph/paragraphInterface'

export interface BookProps {
  book: BookInterface,
  firstParagraph: ParagraphInterface
}

const Book: React.FC<BookProps> = ({ book }) => {

  const router = useRouter()

  const newAdventure = async () => {
    const adventure = await axios.post<AdventureInterface>(`http://localhost:8080/api/adventures`, {
      'book': book.slug,
    }, {
      headers: {
        'authorization': 'bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2MjA2Nzk0NjAsImV4cCI6MTYyMDY4MzA2MCwicm9sZXMiOlsiUk9MRV9VU0VSIl0sInVzZXJuYW1lIjoidG9oeW8ifQ.kHVp4FY8akQy2ytS03mgWf_Hbyse9QHsJEvbB9T_s7-9uvl6-k9KuVMVcQT4WGMZOXvJ69IWGQ2WZYXbjDUa-Mhkg4mzzOHZJ4O-FR7k-xruzzSRgiVX0XVCR98UN45GVSik0a4Ks9srwv9iUSEp8XgXIlSr5WxEyX6OVxMANC6BbATAiG5foUp9sZ2GrCvD7gh0IHmK1psFXeXD83jjJfjphww9rcdUfehlFEjQwQg_T3LT1ZaUX959P_zxu4lDy28Z08AO7pDBBGmOeJvdEFHD1lKKjROywefEiCQHLKdPMiwinlLK0z6nFbEgwHI1HAx84vguyulxBv_ytWkt52i1talvM9dpfC2aJLkzINSaIyBN1FtqZ63ycNGESj86JgL4h9tahpRwX40EnJhH8q4u3sT77U2Obvg-SrttyUE9ZYK-aP65lmAuTmlzEvE22n6EizJqT4Y_jhI1gX9C-XmgJj9ai4D3mPHE1JjjPynTHQyMq_rMCbld5aZuTWdhAuHKXcBQemfGcI18xta7cdo6mIE--h8sPniqWg-NkCR20jsoRNho52poXXuMSc-Vfo9DXD6wRyv7L2EsWTamfY93EGfqb37_uG45KMUWRHNfdg9Bo9SLtAXimUOAulhu5gFLs6PLrNIZ9VAX1WMxz0-mjwzpN2ILF7i2pEX-kbU'
      }
    }).then(response => {
      return response.data
    })

    router.push(`/livres/${ book.slug }/aventure/${ adventure.id }`)
  }

	return (
		<>
      { book.title }
      <a onClick={newAdventure}>Nouvelle aventure</a>
    </>
	)
}

export const getStaticProps: GetStaticProps = async ({ params }) => {
	const book = await axios.get<BookInterface>(`http://nginx/books/${ params.slug }`)
    .then(response => {
      return response.data
    })

  return {
    props: { book },
  }
}

export const getStaticPaths: GetStaticPaths = async () => {
  const books = await axios.get<BookInterface[]>('http://nginx/books')
		.then(response => {
			return response.data
		})

	const paths = books.map(book => ({
		params: { slug: book.slug },
	}))

	return { paths, fallback: false }
}

export default Book;
