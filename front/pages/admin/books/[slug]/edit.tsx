import { GetStaticPaths, GetStaticProps } from 'next'
import React from 'react'
import { Formik, Form, Field } from 'formik'
import router from 'next/router'
import api from '../../../../lib/api'
import { ParagraphInterface } from '../../../../components/paragraph/paragraphInterface'
import { BookInterface } from '../../../../components/book/bookInterface'

export interface BookProps {
  book: BookInterface,
  firstParagraph: ParagraphInterface
}

const Book: React.FC<BookProps> = ({ book }) => {
	return (

    <Formik
      initialValues={{ title: book.title }}
      validate={values => {
        const errors = {}

        return errors;
      }}

      onSubmit={(values, { setSubmitting }) => {
        api.put(`http://localhost:8080/api/books/${book.id}`, {
          ...values
        }).then(() => {
          setSubmitting(false)
          router.push(`/admin/books`)
        })
      }}
    >
      {({ isSubmitting }) => (
        <Form>
          <div className="pt-8 space-y-6 sm:pt-10 sm:space-y-5">
            <div>
              <h3 className="text-lg leading-6 font-medium text-gray-900">Modifier livre</h3>
            </div>
            <div className="space-y-6 sm:space-y-5">
              <div className="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                <label htmlFor="title" className="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                  Title
                </label>
                <div className="mt-1 sm:mt-0 sm:col-span-2">
                  <Field
                    type="text"
                    name="title"
                    id="title"
                    className="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md"
                  />
                </div>
              </div>
            </div>
          </div>
          <div className="pt-5">
            <div className="flex justify-end">
              <button
                type="button"
                className="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              >
                Cancel
              </button>
              <button
                type="submit"
                disabled={isSubmitting}
                className="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              >
                Save
              </button>
            </div>
          </div>
        </Form>
      )}
    </Formik>
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
