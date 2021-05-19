import axios from "axios"
import { useState } from "react"
import Character from "../character/character"
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
      <div className="flex container mx-auto">
        <div className="w-3/4 rounded border-gray-300 dark:border-gray-700 border-2 h-24">
          <ParagraphComp { ...paragraph } handleClick={handleClick} />
        </div>
        <div className="w-1/4 rounded border-gray-300 dark:border-gray-700 border-2 h-24">
          <Character { ...adventure.character } />
        </div>
      </div>
    </>
  )
}

export default AdventureComp
