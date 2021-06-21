import { useState } from "react"
import { InventoryInterface } from "./inventoryInterface"
import { ItemInterface } from "./itemInterface"
import api from '../../lib/api'

const Inventory: React.FC<InventoryInterface> = ({ items }) => {

  return (
    <>
      <div className="flex w-full md:min-h-full h-40 mt-8 border-grey border-solid border-2">
        Equipement
        { items.map(item => (
          <ItemRow key={`inventory-${item.id}`} {...item} />
        ))}
      </div>
    </>
  )
}

const ItemRow: React.FC<ItemInterface> = ({ id, name, quantity }) => {

  const [itemQuantity, setItemQuantity] = useState<number>(quantity)

  const updateItemQuantity = async (itemId: string, quantity) => {
    await api.put(`api/items/${ itemId }`, {
      'quantity': quantity
    })
    .then(() => {
      setItemQuantity(quantity)
    })
  }

  return (
    <div className="flex w-full">
      <svg
        className="w-6 h-6"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
        onClick={() => updateItemQuantity(id, itemQuantity - 1)}
      ><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
      </svg>
      { itemQuantity } { name }
      <svg
        className="w-6 h-6"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
        onClick={() => updateItemQuantity(id, itemQuantity + 1)}
      ><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
      </svg>
    </div>
  )
}

export default Inventory
