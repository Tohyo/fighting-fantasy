import axios from "axios"
import { useState } from "react"
import ParagraphComp from "../paragraph/paragraph"
import { ParagraphInterface } from "../paragraph/paragraphInterface"
import { AdventureInterface } from "./adventureInterface"

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
