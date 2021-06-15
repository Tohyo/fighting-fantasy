import axios from "axios"
import { useState } from "react"
import Character from "../character/character"
import Paragraph from "../paragraph/paragraph"
import { ParagraphInterface } from "../paragraph/paragraphInterface"
import { AdventureInterface } from "./adventureInterface"
import api from '../../lib/api'
import { CharacterInterface } from "../character/characterInterface"


const Adventure: React.FC<AdventureInterface> = ( adventure ) => {

  const [paragraph, setParagraph] = useState<ParagraphInterface>(adventure.paragraph)
  const [character, setCharacter] = useState<CharacterInterface>(adventure.character)

  async function handlePagraphChange(number: number) {
    setParagraph(
      await axios.get<ParagraphInterface>(`http://localhost:8080/paragraphs/${ number }/books/${ adventure.book.id }`)
        .then(async response => {
          await api.put(`api/adventures/${ adventure.id }`, {
            'paragraph': number
          })
          return response.data
        })
    )
  }

  async function updateCharacterStamina(number: number) {
    setCharacter({ ...character, stamina: number })
  }

  return (
    <>
      <div className="flex container mx-auto">
        <div className="w-3/4 rounded border-gray-300 dark:border-gray-700 border-2 h-24">
          <Paragraph { ...paragraph } character={ character } handlePagraphChange={ handlePagraphChange } updateCharacterStamina={ updateCharacterStamina } />
        </div>
        <div className="w-1/4 rounded border-gray-300 dark:border-gray-700 border-2 h-24">
          <Character {...character} />
        </div>
      </div>
    </>
  )
}

export default Adventure
