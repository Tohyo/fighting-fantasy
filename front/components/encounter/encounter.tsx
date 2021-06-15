import { useState } from "react"
import { CharacterInterface } from "../character/characterInterface"
import { EncouterInterface } from "./encounterInterface"

interface EncounterProps {
  encounter: EncouterInterface
  character: CharacterInterface
  updateCharacterStamina: (number: number) => void
}

const Encounter: React.FC<EncounterProps> = ({ encounter, character, updateCharacterStamina }) => {

  const [toughness, setToughness] = useState<number>(encounter.toughness)

  const resolveEncounter = () => {
    const heroPower = rollDice()
    const encounterPower = rollDice()

    if (heroPower > encounterPower) {
      setToughness(toughness - 1)
    } else {
      updateCharacterStamina(2)
    }
  }

  const rollDice = () => {
    return Math.floor((Math.random() * 6) + 1)
  }


  return (
    <>
      <span>{ encounter.name }</span>
      <span>{ encounter.dexterity }</span>
      <span>{ toughness }</span>
      <button onClick={() => resolveEncounter()}>Fight</button>

    </>
  )
}


export default Encounter
