import { useEffect } from "react";
import { LinkedParagraphInterface } from "./linkedParagraphInterface";
import { EncouterInterface } from "../encounter/encounterInterface";
import { BookInterface } from "../book/bookInterface";
import Encounter from "../encounter/encounter";
import { CharacterInterface } from "../character/characterInterface";

interface ParagraphCompInterface {
  id: string
  number: number
  text: string
  encounters: EncouterInterface[]
  linkedParagraphs: LinkedParagraphInterface[]
  book: BookInterface
  character: CharacterInterface
  handleClick: (number: number) => void
}

const ParagraphComp: React.FC<ParagraphCompInterface> = ({ character, encounters, text, linkedParagraphs, handleClick }) => {

  useEffect(() => {
    window.addEventListener('click', (event) => {
      if (!event.target.matches('.link-paragraph')) {
        return false
      }

      const linkParagraph = linkedParagraphs.filter(lp => lp.text === event.target.innerText)

      if (linkParagraph.length !== 0) {
        handleClick(linkParagraph[0].number)
      }
    });
  }, [])

  return (
    <>
      <div dangerouslySetInnerHTML={ { __html: text } } />
      { encounters.map((encounter, index) => (
        <Encounter key={`paragraph-encounter-${ index }`} encounter={encounter} character={character} />
      ))}
    </>
  )
}

export default ParagraphComp
