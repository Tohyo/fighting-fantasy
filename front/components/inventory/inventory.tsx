import { InventoryInterface } from "./inventoryInterface"


const Inventory: React.FC<InventoryInterface> = ({ items }) => {

  return (
    <>
      <div className="flex w-full md:min-h-full h-40 mt-8 border-grey border-solid border-2">
        Equipement
        { items.map((item, index) => (
          <div key={`inventory-${index}`}>
            { item.quantity } - { item.name }
          </div>
        ))}
      </div>
    </>
  )
}

export default Inventory
