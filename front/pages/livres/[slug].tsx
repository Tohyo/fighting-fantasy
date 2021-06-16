import { GetStaticPaths, GetStaticProps } from 'next'
import { useRouter } from 'next/router'
import { AdventureInterface } from '../../components/adventure/adventureInterface'
import { BookInterface } from '../../components/book/bookInterface'
import { ParagraphInterface } from '../../components/paragraph/paragraphInterface'
import api from '../../lib/api'
import useSWR from 'swr'
import Link from 'next/link'

export interface BookProps {
  book: BookInterface,
  firstParagraph: ParagraphInterface
}

const Book: React.FC<BookProps> = ({ book }) => {

  const router = useRouter()
  const { data } = useSWR(`http://localhost:8080/api/users/adventures/${ book.slug }`, async (url) => {
    return await api.get(url)
      .then(result => {
        return result.data
      })
  })

  const newAdventure = async () => {
    await api.post<AdventureInterface>(`http://localhost:8080/api/adventures`, {
      'book': book.slug,
    }).then(response => {
      router.push(`/livres/${ book.slug }/aventure`)
    })
  }

	return (
		<>
      { book.title }
      {!data
        ? <a onClick={ newAdventure }>Nouvelle aventure</a>
        : <Link href={ `/livres/${ book.slug }/aventure` } >Continuez votre aventure</Link>
      }
    </>
	)
}

export const getStaticProps: GetStaticProps = async ({ params }) => {
	const book = await api.get<BookInterface>(`http://nginx/books/${ params.slug }`)
    .then(response => {
      return response.data
    })

  return {
    props: { book },
  }
}

export const getStaticPaths: GetStaticPaths = async () => {
  const books = await api.get<BookInterface[]>('http://nginx/books')
		.then(response => {
			return response.data
		})

	const paths = books.map(book => ({
		params: { slug: book.slug },
	}))

	return { paths, fallback: false }
}

export default Book;
