import Inventory from "./inventory";

export default function CharacterSheet(props) {

  const { habilete, endurance, chance } = props.character

  return (
    <>
      <div className="flex">
        <div className="border-2 border-gray-200 w-16">
          habilete
        </div>
        <div className="border-2 border-gray-200 w-16">
          endurance
        </div>
        <div className="border-2 border-gray-200 w-16">
          chance
        </div>
      </div>
      <div className="flex">
        <div className="border-2 border-gray-200 w-16">
          {habilete}
        </div>
        <div className="border-2 border-gray-200 w-16">
          {endurance}
        </div>
        <div className="border-2 border-gray-200 w-16">
          {chance}
        </div>
      </div>


      <Inventory />
    </>
  )
}
