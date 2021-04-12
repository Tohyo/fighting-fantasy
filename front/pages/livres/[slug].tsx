
import axios from 'axios'
import { GetStaticPaths, GetStaticProps } from 'next'
import { useRouter } from 'next/router'
import { BookInterface, BookProps, GameInterface } from '../../components/interfaces'

const Book: React.FC<BookProps> = ({ book }) => {

  const router = useRouter()

  const newAdventure = async () => {
    const adventure = await axios.post<GameInterface>(`http://localhost:8080/adventures`, {
      'book': book.slug,
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
