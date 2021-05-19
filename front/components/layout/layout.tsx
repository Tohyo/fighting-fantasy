import Header from "./header"

const Layout = (props) => {

  return (
    <>
      <Header />
      { props.children }
    </>
  )
}

export default Layout
