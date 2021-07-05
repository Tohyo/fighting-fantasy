import { useRouter } from "next/router"
import { useState } from "react"
import api from "../../../lib/api"

const CreateBook: React.FC = () => {

  const router = useRouter()

  const [title, setTitle] = useState('')
  const [slug, setSlug] = useState('')

  const handleform = () => {
    api.post('api/books', {
      title,
      slug
    }).then(() => {
      router.push(`/admin/books`)
    })
  }

  return (
    <>
      <div className="pt-8 space-y-6 sm:pt-10 sm:space-y-5">
        <div>
          <h3 className="text-lg leading-6 font-medium text-gray-900">Create book</h3>
        </div>
        <div className="space-y-6 sm:space-y-5">
          <div className="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
            <label htmlFor="title" className="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
              Title
            </label>
            <div className="mt-1 sm:mt-0 sm:col-span-2">
              <input
                type="text"
                name="title"
                id="title"
                value={title}
                onChange={(e) => setTitle(e.currentTarget.value)}
                className="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md"
              />
            </div>
            <label htmlFor="slug" className="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
              Slug
            </label>
            <div className="mt-1 sm:mt-0 sm:col-span-2">
              <input
                type="text"
                name="slug"
                id="slug"
                value={slug}
                onChange={(e) => setSlug(e.currentTarget.value)}
                className="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md"
              />
            </div>
          </div>
        </div>
      </div>
      <div className="pt-5">
        <div className="flex justify-end">
          <button
            type="submit"
            onClick={handleform}
            className="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
          >
            Save
          </button>
        </div>
      </div>
      {/* <input type="text" name="title" />
      <input type="text" name="slug" value={slug} onChange={(e) => setSlug(e.currentTarget.value)} />
      <button onClick={handleform}>Submit</button> */}
    </>
  )
}

export default CreateBook
