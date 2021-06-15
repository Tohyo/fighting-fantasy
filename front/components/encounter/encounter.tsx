import { useState } from "react"
import { CharacterInterface } from "../character/characterInterface"
import { EncouterInterface } from "./encounterInterface"

interface EncounterProps {
  encounter: EncouterInterface
  character: CharacterInterface
}

const Encounter: React.FC<EncounterProps> = ({ encounter, character }) => {

  console.log('greiojg', encounter.toughness)
  const [currentToughness, setCurrentToughness] = useState<number>(encounter.toughness)
  const [heroToughness, setHeroToughness] = useState<number>(character.stamina)

  const [encounterDiceRoll, setEncounterDiceRoll] = useState<number[][]>([])
  const [encounterReport, setEncounterReport] = useState<boolean>(false)

  const resolveEncounter = () => {
    encounterDiceRoll.push([
      rollDice() + encounter.dexterity,
      rollDice() + character.dexterity
    ])
    setEncounterDiceRoll(encounterDiceRoll)

    if (!encounterReport) {
      setEncounterReport(true)
    }
    console.log(encounterDiceRoll)
  }

  const rollDice = () => {
    return Math.floor((Math.random() * 6) + 1)
  }


  return (
    <>
      <span>{ encounter.name }</span>
      <span>{ encounter.dexterity }</span>
      <span>{ currentToughness }</span>

      { encounterReport && encounterDiceRoll.map(dice => {
        return (
          <>
            {dice[0]} X {dice[1]}
          </>
        ) })
      }
      <button onClick={() => resolveEncounter()}>Combat</button>
    </>
  )
}


export default Encounter
