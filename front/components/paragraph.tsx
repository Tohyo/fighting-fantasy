import { useEffect } from "react";
import Encounter from "./encounter";
import { ParagraphCompInterface } from "./interfaces";

const ParagraphComp: React.FC<ParagraphCompInterface> = ({ text, linkedParagraphs, encounters, handleClick }) => {

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
      { encounters.map(encounter => {
        <Encounter { ...encounter } />
      })}
    </>
  )
}

export default ParagraphComp
