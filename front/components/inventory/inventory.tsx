import { useState } from "react"


interface Item {
  name: string
  quantity: number
}

const Inventory = () => {
  const [inventory, setInventory] = useState<Item[]>([])

  return (
    <>
      <div className="flex w-full md:min-h-full h-40 mt-8 border-grey border-solid border-2">
        Equipement
        { inventory.map(item => (
          <>
            { item.quantity } - { item.name }
          </>
        ))}
      </div>
    </>
  )
}

export default Inventory
