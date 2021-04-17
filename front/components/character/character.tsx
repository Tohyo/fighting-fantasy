import { CharacterInterface } from "./characterInterface"

const Character: React.FC<CharacterInterface> = (character) => {

  return (
    <>
      habilete
      endurance
      chance
      {character.initialDexterity}
    </>
  )
}

export default Character
