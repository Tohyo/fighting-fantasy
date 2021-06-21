import { GetStaticProps } from 'next'
import api from '../../lib/api'
import Link from 'next/link'

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
      { books.map(book => (
        <Link
          key={ `home-book-${ book.title }` }
          href={ `/admin/books/${ book.slug }` }
        >
          <a>{ book.title }</a>
        </Link>
      ))}
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

export default Book
