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
            { book.title }
            <Link href={ `/admin/books/${ book.slug }/edit` }>
              <svg
              className="w-6 h-6 cursor-pointer"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                >
                </path>
              </svg>
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
