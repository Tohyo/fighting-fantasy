import { useState } from "react"

const Encounter: React.FC = ({ name, dexterity, toughness, character, updateCharacterStamina }) => {

  const [currentDexterity, seCurrentDexterity] = useState(dexterity)
  const [currentToughness, setCurrentToughness] = useState(toughness)
  const [heroToughness, setHeroToughness] = useState<number>(character.stamina)
  const [heroDexterity, setHeroDexterity] = useState<number>(character.dexterity)

  const resolveEncounter = () => {

    const monsterStrength = rollDice() + currentDexterity
    const heroStrength = rollDice() + heroDexterity

    if (monsterStrength > heroStrength) {
      setHeroToughness(heroToughness - 2)
    } else {
      setCurrentToughness(currentToughness - 2)
    }

    console.log(monsterStrength, heroStrength, currentToughness, heroToughness)
    if (heroToughness <= 0) {
      updateCharacterStamina(0)
    }
  }

  const rollDice = () => {
    return Math.floor((Math.random() * 6) + 1)
  }

  return (
    <>
      <span>{ name }</span>
      <span>{ currentDexterity }</span>
      <span>{ currentToughness }</span>
      <button onClick={() => resolveEncounter()}>Combat</button>
    </>
  )
}

export default Encounter
