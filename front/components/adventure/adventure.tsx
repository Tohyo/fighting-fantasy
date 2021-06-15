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
      <section className="py-8 px-4">
        <div className="flex flex-wrap -mx-2">
          <div className="lg:w-2/5 px-2 lg:pr-16 mb-6 lg:mb-0">
            <Character {...character} />
          </div>
          <div className="lg:w-3/5 px-2">
            <Paragraph { ...paragraph } character={ character } handlePagraphChange={ handlePagraphChange } updateCharacterStamina={ updateCharacterStamina } />
          </div>
        </div>
      </section>
    </>
  )
}

export default Adventure
