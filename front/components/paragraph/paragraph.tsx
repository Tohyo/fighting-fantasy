import { useEffect } from "react";
import { LinkedParagraphInterface } from "./linkedParagraphInterface";
import { EncouterInterface } from "../encounter/encounterInterface";
import { BookInterface } from "../book/bookInterface";
import Encounter from "../encounter/encounter";
import { CharacterInterface } from "../character/characterInterface";

interface ParagraphInterface {
  id: string
  number: number
  text: string
  encounters: EncouterInterface[]
  linkedParagraphs: LinkedParagraphInterface[]
  book: BookInterface
  character: CharacterInterface
  handlePagraphChange: (number: number) => void
  updateCharacterStamina: (number: number) => void
}

const Paragraph: React.FC<ParagraphInterface> = ({ character, encounters, text, linkedParagraphs, handlePagraphChange, updateCharacterStamina }) => {

  useEffect(() => {
    window.addEventListener('click', (event) => {
      if (!event.target.matches('.link-paragraph')) {
        return false
      }

      const linkParagraph = linkedParagraphs.filter(lp => lp.text === event.target.innerText)

      if (linkParagraph.length !== 0) {
        handlePagraphChange(linkParagraph[0].number)
      }
    });
  }, [])

  return (
    <>
      <div dangerouslySetInnerHTML={ { __html: text } } />
      { encounters.map((encounter, index) => (
        <Encounter key={`paragraph-encounter-${ index }`} encounter={encounter} character={character} updateCharacterStamina={ updateCharacterStamina } />
      ))}
    </>
  )
}

export default Paragraph
