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
		<>
      { books.map(book => (
        <Link
          key={ `home-book-${ book.title }` }
          href={ `/livres/${ book.slug }` }
        >
          <a>{ book.title }</a>
        </Link>
      ))}
    </>
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

export default Home;
