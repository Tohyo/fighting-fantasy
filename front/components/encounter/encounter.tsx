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
  const [rollRecap, setRollRecap] = useState<number[][]>([])

  const resolveEncounter = () => {
    const heroPower = rollDice() + character.dexterity
    const encounterPower = rollDice() + encounter.dexterity

    rollRecap.push([heroPower, encounterPower])
    setRollRecap(rollRecap)

    if (heroPower > encounterPower) {
      setToughness(toughness - 2)
    } else {
      updateCharacterStamina(character.stamina - 2)
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

      ----------------------
      {rollRecap.map((roll, index) => (
        <div key={`${ encounter.name }-${ index }`}>
          Hero Power: { roll[0] } X Encounter Power: { roll[1] }
        </div>
      ))}
    </>
  )
}


export default Encounter
