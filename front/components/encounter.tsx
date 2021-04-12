import { EncouterInterface } from "./interfaces"

const Encounter: React.FC<EncouterInterface> = ({ name, dexterity, toughness }) => {
  return (
    <>
      <span>{ name }</span>
      <span>{ dexterity }</span>
      <span>{ toughness }</span>
    </>
  )
}

export default Encounter
