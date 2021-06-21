import { GetStaticPaths, GetStaticProps } from 'next'
import { BookInterface } from '../../../components/book/bookInterface'
import { ParagraphInterface } from '../../../components/paragraph/paragraphInterface'
import api from '../../../lib/api'
import React from 'react'
import { Formik, Form, Field, ErrorMessage } from 'formik'

export interface BookProps {
  book: BookInterface,
  firstParagraph: ParagraphInterface
}

const Book: React.FC<BookProps> = ({ book }) => {
	return (
		<div>
    <h1>Edit book</h1>

    <Formik
      initialValues={{ title: book.title }}
      validate={values => {
        const errors = {}

        return errors;
      }}

      onSubmit={(values, { setSubmitting }) => {
        setTimeout(() => {
          alert(JSON.stringify(values, null, 2))
          setSubmitting(false);
        }, 400);
      }}
    >
      {({ isSubmitting }) => (
        <Form>
          <Field type="text" name="title" />
          <ErrorMessage name="title" component="div" />
          <button type="submit" disabled={isSubmitting}>
            Submit
          </button>
        </Form>
      )}
    </Formik>
   </div>
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
