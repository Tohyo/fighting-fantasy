import { CharacterInterface } from "./characterInterface"

const Character: React.FC<CharacterInterface> = (character) => {
  return (
    <>
      habilete
      endurance
      chance
      {character.dexterity}
      {character.stamina}
      {character.luck}
    </>
  )
}

export default Character
