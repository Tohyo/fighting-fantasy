import axios from "axios"
import { useState } from "react"
import Character from "../character/character"
import { CharacterInterface } from "../character/characterInterface"
import ParagraphComp from "../paragraph/paragraph"
import { ParagraphInterface } from "../paragraph/paragraphInterface"
import { AdventureInterface } from "./adventureInterface"
import api from '../../lib/api'


const AdventureComp: React.FC<AdventureInterface> = ( adventure ) => {

  const [paragraph, setParagraph] = useState<ParagraphInterface>(adventure.paragraph)
  const [character, setCharacter] = useState<CharacterInterface>(adventure.character)

  async function handleClick(number: number) {
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
    character.stamina = number
    setCharacter(character)
  }

  return (
    <>
      <div className="flex container mx-auto">
        <div className="w-3/4 rounded border-gray-300 dark:border-gray-700 border-2 h-24">
          <ParagraphComp { ...paragraph } character={ character } handleClick={ handleClick } />
        </div>
        <div className="w-1/4 rounded border-gray-300 dark:border-gray-700 border-2 h-24">
          <Character { ...character } />
        </div>
      </div>
    </>
  )
}

export default AdventureComp
