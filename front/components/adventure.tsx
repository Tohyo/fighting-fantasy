import axios from "axios"
import { useState } from "react"
import { AdventureInterface, ParagraphInterface } from "./interfaces"
import ParagraphComp from "./paragraph"

const AdventureComp: React.FC<AdventureInterface> = ( adventure ) => {

  async function handleClick(number: number) {
    setParagraph(
      await axios.get<ParagraphInterface>(`http://localhost:8080/paragraphs/${ number }/books/${ adventure.book.id }`)
        .then(response => {
          return response.data
        })
    )
  }

  const [paragraph, setParagraph] = useState<ParagraphInterface>(adventure.paragraph)

  return (
    <>
      <ParagraphComp { ...paragraph } handleClick={handleClick} />
    </>
  )
}

export default AdventureComp
