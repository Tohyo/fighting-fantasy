import { GetStaticPaths, GetStaticProps } from "next"
import { BookInterface } from "../../../../components/book/bookInterface"
import { ParagraphInterface } from "../../../../components/paragraph/paragraphInterface"
import api from "../../../../lib/api"

interface ParagraphListProps {
  paragraphs: ParagraphInterface[]
}

const ParagraphList = (paragraphList: ParagraphListProps) => {

  return (
    <>
      {paragraphList.paragraphs.map(paragraph => (
        <div>
          { paragraph.number }
        </div>
      ))}
    </>
  )
}

export const getStaticProps: GetStaticProps = async ({ params }) => {
	const paragraphs = await api.get<ParagraphInterface[]>(`http://nginx/books/${ params.slug }/paragraphs`)
    .then(response => {
      return response.data.paragraphs
    })

  return {
    props: { paragraphs },
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

export default ParagraphList
