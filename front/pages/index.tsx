import { GetStaticProps } from 'next'
import axios from 'axios'
import Link from 'next/link'

interface BookInterface {
	id: number
	title: string
	slug: string
}

interface HomeProps {
  books: BookInterface[]
}

const Home: React.FC<HomeProps> = ({ books }) => {

	return (
    <ul className="divide-y divide-gray-200">
      { books.map(book => (
        <li key={ `home-book-${ book.title }` } className="py-4">
          <Link href={ `/livres/${ book.slug }` } >
            <a>{ book.title }</a>
          </Link>
        </li>
      ))}
    </ul>
	)
}

export const getStaticProps: GetStaticProps = async () => {
	const books = await axios.get<BookInterface[]>(`http://nginx/books`)
    .then(response => {
      return response.data
    })

  return {
    props: { books },
  }
}

export default Home
