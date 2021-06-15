import { CharacterInterface } from "./characterInterface"

const Character: React.FC<CharacterInterface> = ({ stamina }) => {
  return (
    <>
      { stamina }
    </>
  )
}

export default Character
