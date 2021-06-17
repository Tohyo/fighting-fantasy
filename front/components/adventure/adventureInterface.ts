import { BookInterface } from "../book/bookInterface"
import { CharacterInterface } from "../character/characterInterface"
import { InventoryInterface } from "../inventory/inventoryInterface"
import { ParagraphInterface } from "../paragraph/paragraphInterface"

export interface AdventureInterface {
  id: string
  book: BookInterface
  paragraph: ParagraphInterface
  character: CharacterInterface
  inventory: InventoryInterface
}
