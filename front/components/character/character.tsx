import { CharacterInterface } from "./characterInterface"

const Character: React.FC<CharacterInterface> = ({
  initialDexterity,
  initialStamina,
  initialLuck,
  dexterity,
  stamina,
  luck
}) => {
  return (
    <>
      <div className="flex flex-wrap -mx-4 -mb-4 md:mb-0">
        <div className="w-full md:min-h-full h-40 md:w-1/4 px-4 mb-4 md:mb-0 border-grey border-solid border-2">
          <p>Habilete</p>
          <p>Base: { initialDexterity }</p>
          <p className="flex items-center justify-center text-7xl">{ dexterity }</p>
        </div>
        <div className="w-full md:w-1/4 px-4 mb-4 md:mb-0 ml-5 border-grey border-solid border-2">
          <p>Endurance</p>
          <p>Base: { initialStamina }</p>
          <p className="flex items-center justify-center text-7xl">{ stamina }</p>
        </div>
        <div className="w-full md:w-1/4 px-4 mb-4 md:mb-0 ml-5 border-grey border-solid border-2">
          <p>Chance</p>
          <p>Base: { initialLuck }</p>
          <p className="flex items-center justify-center text-7xl">{ luck }</p>
        </div>
      </div>
    </>
  )
}

export default Character
