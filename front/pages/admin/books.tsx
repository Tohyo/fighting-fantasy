import { GetStaticProps } from 'next'
import api from '../../lib/api'
import Link from 'next/link'
import { needAuthorization } from '../../contexts/authorization'

interface BookInterface {
	id: number
	title: string
	slug: string
}

interface BookProps {
  books: BookInterface[]
}

const Book: React.FC<BookProps> = ({ books }) => {

	return (
    <>
      <Link href="/admin/books/create">Create book</Link>
      <ul className="divide-y divide-gray-200">
        { books.map(book => (
          <li key={ `home-book-${ book.title }` } className="py-4">
            <Link href={ `/admin/books/${ book.slug }` }>
              <a>{ book.title }</a>
            </Link>
          </li>
        ))}
      </ul>
    </>
	)
}

export const getStaticProps: GetStaticProps = async () => {
	const books = await api.get<BookInterface[]>(`http://nginx/books`)
    .then(response => {
      return response.data
    })

  return {
    props: { books },
  }
}

export default needAuthorization(Book)
