import Header from "./header"

const Layout = (props) => {

  return (
    <>
      <Header />
      <div className="max-w-9xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="max-w-7xl mx-auto">
          { props.children }
        </div>
      </div>
    </>
  )
}

export default Layout

